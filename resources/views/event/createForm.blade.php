<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/form.css') }}">


<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/fr.js"></script>

<x-app-layout>
    <x-slot name="header">
        <h2 class="page-header">
            {{ __('Ajouter un événement') }}
        </h2>
    </x-slot>
    <div class="my-8 bg-gray-100 py-8 min-h-screen">

        <div class="back-action-bar">
            <x-custom-button route="userEvent.all" content="Retourner aux événements" />
        </div>

        @if ($errors->any())
        <div class="form-error">
            <ul>
                @foreach ($errors->all() as $error)
                <li class="form-erro-text">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('userEvent.add') }}" method="POST" class="form-container">
            @csrf
            <section class="form-section">
                <h2>Informations générales</h2>
                <div>
                    <p class="form-error-text">Les guillemets ("") sont interdits dans les champs du formulaire</p>
                </div>

                <div class="form-group">
                    <label for="name">Intitulé de l'événement <span class="required">*</span> :</label>
                    <input name="name" type="text" class=" @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Veuillez renseigner le nom de l'événement">
                    @error('name')<span class="form-error-text">{{ $message }}</span>@enderror
                </div>

                <div class="form-row">
                    <div class="form-group half">
                        <label for="structure_id">Structure <span class="required">*</span> :</label>
                        <select name="structure_id" class=" @error('structure_id') is-invalid @enderror">
                            <option value="" disabled selected hidden>Choisissez une structure</option>
                            @foreach($structures as $structure)
                            <option value="{{ $structure->id }}" @if(old('structure_id')==$structure->id) selected @endif>{{ $structure->name }}</option>
                            @endforeach
                        </select>
                        @error('structure_id')<span class="form-error-text">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group half">
                        <label for="partners">Partenaires organisateurs :</label>
                        <input name="partners" class="" type="text" value="{{ old('partners') }}" placeholder='Séparer chaque partenaire par une virgule ","'>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description courte de l'événement <span class="required">*</span> :</label>
                    <textarea
                        name="description"
                        class="form-textarea @error('description') is-invalid @enderror"
                        placeholder="Veuillez décrire le but de l'événement."
                        rows="4"></textarea>
                    @error('description')<span class="form-error-text">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="number_of_participants_id">Nombre de personnes présentes estimé <span class="required">*</span> :</label>
                    <select class=" @error('nbre_people') is-invalid @enderror" name="number_of_participants_id">
                        <option value="" disabled selected hidden>Choisissez le nombre de personnes prévus</option>
                        @foreach($numberOfParticipants as $participants)
                        <option value="{{ $participants->id }}" @if(old('number_of_participants_id')==$participants->id) selected @endif>{{ $participants->name }}</option>
                        @endforeach
                    </select>
                    @error('nbre_people')<span class="form-error-text">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="accessType_id">Type d'événement <span class="required">*</span> :</label>
                    <select name="accessType_id" class=" @error('accessType_id') is-invalid @enderror">
                        <option value="" disabled selected hidden>Choisissez un type</option>
                        @foreach($accessType as $type)
                        <option value="{{ $type->id }}" @if(old('accessType_id')==$type->id) selected @endif>{{ $type->name }}</option>
                        @endforeach
                    </select>
                    @error('accessType_id')<span class="form-error-text">{{ $message }}</span>@enderror
                </div>

                <div class="form-group-checkbox">
                    <label>Tags <span class="required">*</span> :</label>
                    <div class="form-grid-checkbox">
                        @foreach($tags as $tag)
                        <label>
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="form-checkbox @error('tags') is-invalid @enderror"
                                @if(is_array(old('tags')) && in_array($tag->id, old('tags'))) checked @endif>
                            {{ $tag->name }}
                        </label>
                        @endforeach
                        @error('tags')<span class="form-error-text">{{ $message }}</span>@enderror
                    </div>
                </div>
            </section>

            <section class="form-section">
                <h2>Planification de l'événement</h2>
                <div class="form-group">
                    <label for="location">Lieu de l'événement :</label>
                    <input class="" name="location" type="text" value="{{ old('location') }}" placeholder="Veuillez renseigner le lieu de l'événement">
                </div>

                <div class="form-group-radio">
                    <label for="is_Fix">Les dates sont <span class="required">*</span> :</label>
                    <label><input type="radio" name="is_Fix" value="1" {{ old('is_Fix') == '1' ? 'checked' : '' }}> Fixes</label>
                    <label><input type="radio" name="is_Fix" value="0" {{ old('is_Fix') == '0' ? 'checked' : '' }}> Prévisionnelles</label>
                    @error('is_Fix')<span class="form-error-text">{{ $message }}</span>@enderror
                </div>

                <div id="is_fix" class="form-info">
                    <p>Veuillez sélectionner la date de début et la date de fin de l'événement.</p>
                </div>
                <div id="is_not_fix" class="form-info">
                    <p>Veuillez indiquer la période durant laquelle l'événement se déroulera.</p>
                </div>

                <div id="date" class="form-row">
                    <div class="form-group half">
                        <label for="date-start">Début :<span class="required">*</span></label>
                        <input class=" @error('date_start') is-invalid @enderror" name="date_start" type="text" id="dateStart">
                    </div>
                    <div class="form-group half">
                        <label for="date-end">Fin :</label>
                        <input class=" @error('date_end') is-invalid @enderror" name="date_end" type="text" id="dateEnd">
                    </div>
                </div>
                @error('date_start')<span class="form-error-text">{{ $message }}</span>@enderror
                @error('date_end')<span class="form-error-text">{{ $message }}</span>@enderror
            </section>

            <section class="form-section">
                <h2>Informations Complémentaires</h2>
                <div class="form-group">
                    <label for="link">Lien de l'événement :</label>
                    <input class="" name="link" type="text" value="{{ old('link') }}" placeholder="Veuillez renseigner un lien concernant l'événement">
                </div>
                <div class="form-group">
                    <label for="organizer_needs">Besoin de l'organisateur :</label>
                    <input type="text" class="" name="organizer_needs" placeholder="Si vous avez des besoins spécifiques veuillez les saisir ici..." value="{{ old('needs_organizer') }}">
                </div>
            </section>

            <input type="submit" value="Envoyer" class="submit-btn">
        </form>
    </div>

    <script type="module">
        import {
            initEventForm
        } from '/js/form.js';
        initEventForm({
            defaultStart: null,
            defaultEnd: null
        });
    </script>
</x-app-layout>