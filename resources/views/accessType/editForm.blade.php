<x-app-layout>
    <x-slot name="header">
        <h2 class="page-header">
            {{ __('Modifier le type d\'accès') }}
        </h2>
    </x-slot>
    <main class="w-full">
        <x-form-edit route="admin.accessType.update" :model="$accessType" />
    </main>
</x-app-layout>