<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\Hash;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // Retrieve the user by email
        $user = AuthUser::where('email', $this->email)->first();

        // Prepare the error messages array
        $errors = [];

        // Check if the email exists
        if (! $user) {
            $errors['email'] = trans('auth.failed'); // Email does not exist
        } else {
            // Email exists, now check the password
            if (! Hash::check($this->password, $user->password)) {
                $errors['password'] = trans('auth.password'); // Password is incorrect
            }
        }

        // If there are errors, throw validation exception with messages
        if (! empty($errors)) {
            RateLimiter::hit($this->throttleKey());

            // Log errors for debugging
            //dd($errors); // This will dump the errors in the browser

            // Throw validation exception with appropriate messages
            throw ValidationException::withMessages($errors);
        }

        // Clear the rate limiter on successful attempt
        RateLimiter::clear($this->throttleKey());

        // Proceed with login if both email and password are correct
        Auth::attempt($this->only('email', 'password'), $this->boolean('remember'));
    }


    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('email')) . '|' . $this->ip());
    }
}
