<head>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="page-header">
            {{ __('Liste des structures') }}
        </h2>
    </x-slot>

    <div class="my-8 bg-gray-100 py-8 min-h-screen">
        <div class="mx-auto px-6">
            @if (session('success'))
            <div id="success-message" class="bg-green-500 text-white p-4 rounded shadow mb-6 text-center">
                {{ session('success') }}
            </div>
            @endif

            <div class="action-bar">
                <x-custom-button route="admin.structure.create" content="+ Ajouter une nouvelle structure" />
            </div>

            <div class="list-grid">
                @foreach($structures as $structure)
                <div class="admin-list-card">
                    <h3 class="card-name">{{ $structure->name }}</h3>

                    <div class="card-actions">
                        <x-edit-button :route="'admin.structure.edit'" :item="$structure" />
                        <x-delete-button-with-confirmation
                            :route="route('admin.structure.destroy', $structure->id)"
                            :id="$structure->id"
                            :name="$structure->name" />
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>