<x-app-layout>
    <x-slot name="header">
        <h2 class="page-header">
            {{ __('Ajouter une structure') }}
        </h2>
    </x-slot>
    <x-create-form route="admin.structure.store" label="Nom de la structure :" />
</x-app-layout>