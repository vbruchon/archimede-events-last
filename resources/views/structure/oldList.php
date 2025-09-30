<x-app-layout>
    <x-slot name="header">
        <h2 class="page-header ml-6">
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
        <div class="table w-full p-2 mt-8">
            <table class="w-11/12 border mx-auto my-4">
                <thead>
                    <tr class="bg-gray-50 border-b">
                        <th class="p-2 border-r cursor-pointer text-xl font-thin text-gray-500">
                            <div class="flex items-center justify-center">
                                Nom de la structure
                            </div>
                        </th>
                        <th class="p-2 border-r cursor-pointer text-xl font-thin text-gray-500">
                            <div class="flex items-center justify-center">
                                Action
                            </div>
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($structures as $structure)

                    <tr class="bg-gray-100 text-center border-b text-xl text-gray-600">
                        <td class="p-2 border-r py-4">{{ $structure->name }}</td>
                        <td class="p-2 border-r py-4">
                            <div class="flex space-x-3 justify-center">
                                <a href="{{ route('admin.structure.edit', $structure) }}" class="bg-fuchsia-700 p-2 pl-3 pr-3 text-white hover:shadow-lg text-lg font-semibold">Modifier</a>

                                <form method="post" action="{{ route('admin.structure.destroy', ['structure' => $structure->id]) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="bg-red-500 p-2 pl-3 pr-3 text-white hover:shadow-lg text-lg font-semibold">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>