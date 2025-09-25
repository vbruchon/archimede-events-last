<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter un type d\'accès') }}
        </h2>
    </x-slot>
    <x-create-form route="admin.accessType.store" label="Nom du type d'accès :"/>
</x-app-layout>