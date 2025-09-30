<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<x-app-layout>
    <x-slot name="header">
        <h2 class="page-header">
            {{ __('Liste des utilisateurs') }}
        </h2>
    </x-slot>

    <div>
        @if (session('success'))
        <div id="success-message" class="success-message">
            {{ session('success') }}
        </div>
        @endif

        <div class="list-grid">
            @foreach($users as $user)
            <div class="admin-list-card">

                <div class="card-content">
                    <h3 class="card-name">{{ $user->name }}</h3>
                    <p class="card-subtext">{{ $user->email }}</p>
                </div>

                <div class="card-actions">
                    <x-edit-button :route="'admin.users.edit'" :item="$user" />
                    <x-delete-button-with-confirmation
                        :route="route('admin.users.destroy', $user->id)"
                        :id="$user->id"
                        :name="$user->name" />
                </div>
            </div>
            @endforeach
        </div>

    </div>
</x-app-layout>