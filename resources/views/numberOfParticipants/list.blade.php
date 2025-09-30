<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<x-app-layout>
    <x-slot name="header">
        <h2 class="page-header">
            {{ __('Liste des libellé des participants') }}
        </h2>
    </x-slot>

    @if (session('success'))
    <x-sucess-message />
    @endif

    <div class="action-bar">
        <x-custom-button route="admin.numberOfParticipants.create" content="+ Ajouter un nouveau libellé" />
    </div>

    <div class="list-grid">
        @foreach($numberOfParticipants as $participants)
        <div class="admin-list-card">
            <h3 class="card-name">{{ $participants->name }}</h3>

            <div class="card-actions">
                <x-edit-button :route="'admin.numberOfParticipants.edit'" :item="$participants" />
                <x-delete-button-with-confirmation
                    :route="route('admin.numberOfParticipants.destroy', $participants->id)"
                    :id="$participants->id"
                    :name="$participants->name" />
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>