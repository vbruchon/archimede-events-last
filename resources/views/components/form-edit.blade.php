<!-- resources/views/components/FormEdit.blade.php -->

@props(['route', 'model'])

<form action="{{ route($route, $model) }}" method="post" class="bg-gray-100 flex flex-col p-8 rounded-2xl w-full justify-center mx-auto mt-8 mb-6">
    @csrf
    @method('put')

    <section class="relative border-2 border-custom-light-purple rounded-lg p-14 mb-8 ">
        <h2 class="absolute top-0 left-8 bg-gray-100 px-3 py-1 mt-[-20px] text-custom-light-purple rounded-tl rounded-tr text-lg">Informations générales</h2>
        <div class="flex flex-col w-full mr-8">
            <label class="text-custom-blue" for="name">Libellé :</label>
            @error('name')<span class="text-red-600">{{ $message }}</span>@enderror
            <input class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2 w-4/5 @error('name') is-invalid @enderror" name="name" type="text" value="{{ old('name', $model->name) }}">
        </div>
    </section>
    <input class="w-3/5 mb-3 cursor-pointer block mx-auto text-xl text-center text-white rounded-lg p-5 bg-fuchsia-900 transition duration-300 transform hover:scale-105" type="submit" value="Envoyer">
</form>