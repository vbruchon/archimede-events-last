<x-app-layout>
    <x-slot name="header">
        <h2 class="page-header">
            {{ __('Modifier le libellé') }}
        </h2>
    </x-slot>
    <main class="w-full">
        <x-form-edit route="admin.numberOfParticipants.update" :model="$numberOfParticipant" />
    </main>
</x-app-layout>