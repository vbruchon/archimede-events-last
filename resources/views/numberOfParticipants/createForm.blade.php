<x-app-layout>
    <x-slot name="header">
        <h2 class="page-header">
            {{ __('Ajouter un libellé pour le nombre de participants') }}
        </h2>
    </x-slot>
    <x-create-form route="admin.numberOfParticipants.store" label="Nom du libellé de la nouvelle tranche :" />
</x-app-layout>