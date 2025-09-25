<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 ml-6 leading-tight">
            {{ __('Ajouter un libellé pour le nombre de participants') }}
        </h2>
    </x-slot>
    <x-create-form route="admin.numberOfParticipants.store" label="Nom du libellé de la nouvelle tranche :"/>
</x-app-layout>
