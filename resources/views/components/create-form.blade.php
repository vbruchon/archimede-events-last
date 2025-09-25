<form action="{{ route($route) }}" method="post" class="bg-gray-100 block p-8 rounded-2xl w-full justify-center mx-auto mt-8 mb-6">
    <section class="relative border-2 border-custom-light-purple rounded-lg p-14 mb-8 ">
        <h2 class="absolute top-0 left-8 bg-gray-100 px-3 py-1 mt-[-20px] text-custom-light-purple rounded-tl rounded-tr text-lg">Informations générales</h2>
        @csrf
        <div class="flex flex-col w-full mr-8">

            <label class="mb-3 text-xl text-custom-purple" for="name">{{$label}}</label>
            @error('name')<span class="text-red-600">{{ $message }}</span>@enderror
            <input class="h-8 border-2 border-custom-light-purple @error('name') is-invalid @enderror" name="name" type="text" value="{{ old('name') }}">
        </div>
    </section>
    <input class="w-3/5 mb-3 cursor-pointer block mx-auto text-xl text-center text-white rounded-lg p-5 bg-fuchsia-900 transition duration-300 transform hover:scale-105" type="submit" value="Envoyer">
</form>