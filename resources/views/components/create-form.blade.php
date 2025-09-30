<form action="{{ route($route) }}" method="post" class="form-container">
    <section class="form-section">
        <h2>Informations générales</h2>
        @csrf
        <div class="form-group">
            <label for="name">{{$label}}</label>
            @error('name')<span class="form-error-text">{{ $message }}</span>@enderror
            <input name="name" type="text" value="{{ old('name') }}">
        </div>
    </section>
    <input type="submit" value="Envoyer" class="submit-btn">
</form>