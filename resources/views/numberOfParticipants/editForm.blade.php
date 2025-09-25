<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier le libellé') }}
        </h2>
    </x-slot>
    <main class="w-full">
        <x-form-edit route="admin.numberOfParticipants.update" :model="$numberOfParticipant" />
    </main>
</x-app-layout>