<x-app-layout>
    <x-slot name="header">
        <h2 class="page-header">
            {{ __('Liste des types d\'accès') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <div>
        @if (session('success'))
        <div id="success-message" class="success-message">
            {{ session('success') }}
        </div>
        @endif

        <div class="action-bar">
            <x-custom-button route="admin.accessType.create" content="+ Ajouter un nouveau type d'accès" />
        </div>

        <div class="list-grid">
            @foreach($accessTypes as $type)
            <div class="admin-list-card">
                <h3 class="card-name">{{ $type->name }}</h3>

                <div class="card-actions">
                    <x-edit-button :route="'admin.accessType.edit'" :item="$type" />
                    <x-delete-button-with-confirmation
                        :route="route('admin.accessType.destroy', $type->id)"
                        :id="$type->id"
                        :name="$type->name" />
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>