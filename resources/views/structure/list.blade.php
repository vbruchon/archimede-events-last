<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-6">
            {{ __('Liste des structures') }}
        </h2>
    </x-slot>

    <div class=" mt-8">
        @if (session('success'))
        <div id="success-message" class="bg-green-400 p-6 text-center rounded shadow animate-movedown">
            {{ session('success') }}
        </div>
        @endif
        <div class="ml-6">
            <x-custom-button route="admin.structure.create" content="Ajouter une nouvelle structure" />
        </div>


        <div class="flex flex-wrap mt-6 justify-center flex-col">
            @foreach($structures as $structure)
            <div class="flex justify-between p-8 bg-white shadow-lg shadow-gray-350 rounded-lg w-full my-4">

                <h3 class="p-2  py-4 text-lg font-medium mr-6">{{ $structure->name }}</h3>

                <div class="flex space-x-3  flex-items-center h-11 mt-3">
                    <a href="{{ route('admin.structure.edit', $structure) }}" class="px-3 py-2 transition duration-300 transform hover:scale-110 bg-custom-blue text-white hover:shadow-lg text-m font-semibold">
                        Modifier</a>
                    <form method="post" action="{{ route('admin.structure.destroy', ['structure' => $structure->id]) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="h-11 transition duration-300 transform hover:scale-110 bg-red-600 p-2 pl-3 pr-3 text-white hover:shadow-lg text-m font-semibold delete-button" data-target="#confirmDeleteModal">Supprimer</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>