<x-app-layout>
    <x-slot name="header">
        <h2 class="page-header">
            {{ __('Ajouter un tag') }}
        </h2>
    </x-slot>
    <x-create-form route="admin.tags.store" label="Nom du tag :" />
</x-app-layout>