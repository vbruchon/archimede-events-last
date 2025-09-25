<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier l\'utilisateur') }}
        </h2>
    </x-slot>
    <main class="w-full">
    <a href="{{route('userEvent.all')}}" class="w-3/6 mb-3 block ms-8 text-xl text-center text-white rounded-lg p-2.5 bg-fuchsia-900 transition duration-300 transform hover:scale-105">
        Retourner aux utilisateurs
    </a>
        <form action="{{ route('admin.users.update', $user) }}" method="post" class="bg-gray-100 flex flex-col p-8 rounded-2xl w-full justify-center mx-auto mt-8 mb-6">
            @csrf
            @method('put')
            <div class="relative border-2 border-custom-purple rounded-lg p-6 mb-12">
                <h2 class="absolute top-0 left-8 bg-gray-100 px-3 py-1 mt-[-20px] text-custom-purple rounded-tl rounded-tr text-lg">Utilisateurs</h2>
                <div class="flex flex-col w-full mr-8">
                    <label class="mb-3 text-xl" for="name">Nom :</label>
                    @error('name')<span class="text-red-600">{{ $message }}</span>@enderror
                    <input class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2 mb-4 @error('name') is-invalid @enderror" name="name" type="text" value="{{ old('name', $user->name) }}">

                    <label class="mb-3 text-xl" for="name">Email :</label>
                    @error('email')<span class="text-red-600">{{ $message }}</span>@enderror
                    <input class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2 @error('email') is-invalid @enderror" name="email" type="text" value="{{ old('email', $user->email) }}">

                    @error('password')<span class="text-red-600">{{ $message }}</span>@enderror
                    <input class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2 @error('email') is-invalid @enderror" name="password" type="hidden" value="{{ old('password', $user->password) }}">
                </div>
            </div>
            <input class="w-3/5 mb-3 cursor-pointer block mx-auto text-xl text-center text-white rounded-lg p-5 bg-fuchsia-900 transition duration-300 transform hover:scale-105" type="submit" value="Envoyer">
        </form>
    </main>
</x-app-layout>