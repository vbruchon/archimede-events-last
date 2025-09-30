<x-app-layout>
    <x-slot name="header">
        <h2 class="page-header">
            {{ __('Modifier le tag') }}
        </h2>
    </x-slot>
    <main class="w-full">
        <div class="my-6">
            <x-custom-button route="admin.tags.list" content="Retourner aux tags" />
        </div>
        <x-form-edit route="admin.tags.update" :model="$tag" />
    </main>
</x-app-layout>