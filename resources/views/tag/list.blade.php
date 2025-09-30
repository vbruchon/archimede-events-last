<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<x-app-layout>
    <x-slot name="header">
        <h2 class="page-header">
            {{ __('Liste des tags') }}
        </h2>
    </x-slot>


    @if (session('success'))
    <x-sucess-message />
    @endif

    <div class="action-bar">
        <x-custom-button route="admin.tags.create" content="+ Ajouter un nouveau tag" />
    </div>

    <div class="list-grid">
        @foreach($tags as $tag)
        <div class="admin-list-card">
            <h3 class="card-name">{{ $tag->name }}</h3>
            <div class="card-actions">
                <x-edit-button :route="'admin.tags.edit'" :item="$tag" />
                <x-delete-button-with-confirmation
                    :route="route('admin.tags.destroy', $tag->id)"
                    :id="$tag->id"
                    :name="$tag->name" />
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>