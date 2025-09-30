<x-app-layout>
    <x-slot name="header">
        <h2 class="page-header">
            {{ __('Ajouter un type d\'accès') }}
        </h2>
    </x-slot>
    <x-create-form route="admin.accessType.store" label="Nom du type d'accès :" />
</x-app-layout>