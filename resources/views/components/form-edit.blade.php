@props(['route', 'model'])

<form action="{{ route($route, $model) }}" method="post" class="bg-gray-100 flex flex-col p-8 rounded-2xl w-full justify-center mx-auto mt-8 mb-6">
    @csrf
    @method('put')

    <section class="form-section">
        <h2>Informations générales</h2>
        <div class="flex flex-col w-full mr-8">
            <label for="name">Libellé :</label>
            @error('name')<span class="form-error-text">{{ $message }}</span>@enderror
            <input class="@error('name') is-invalid @enderror" name="name" type="text" value="{{ old('name', $model->name) }}">
        </div>
    </section>
    <input type="submit" value="Envoyer" class="submit-btn">
</form>