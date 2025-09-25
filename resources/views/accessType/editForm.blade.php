<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier le type d\'accès') }}
        </h2>
    </x-slot>
    <main class="w-full">
        <x-form-edit route="admin.accessType.update" :model="$accessType" />
    </main>
</x-app-layout>