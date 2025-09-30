<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/fr.js"></script>

<x-app-layout>
    <x-slot name="header">
        <h2 class="ml-6 page-header">
            {{ __("Modifier l'événement") }}
        </h2>
    </x-slot>
    @if (session('success'))
    <div class="bg-green-400 p-6 text-center m-6 rounded shadow border border-green-800 animate-ping">
        {{ session('success') }}
    </div>
    @endif
    <div class="mb-8"></div>

    <div class="ml-6 mt-6 ">
        <x-custom-button route="userEvent.all" content="Retourner aux événements" />
    </div>

    <form action="{{ route('userEvent.update', $event) }}" method="POST" class="form-container">
        @csrf
        @method('put')

        <!-- Informations générales -->
        <section class="form-section">
            <h2>Informations générales</h2>

            <p class="form-error-text">Les guillemets ("") sont interdits dans les champs du formulaire</p>

            <div class="form-group">
                <label for="name">Intitulé de l'événement <span class="required">*</span> :</label>
                <input name="name" type="text" value="{{ old('name', $event->name) }}" placeholder="Veuillez renseigner le nom de l'événement" class="@error('name') is-invalid @enderror">
                @error('name')<span class="form-error-text">{{ $message }}</span>@enderror
            </div>

            <div class="form-row">
                <div class="form-group half">
                    <label for="structure_id">Structure <span class="required">*</span> :</label>
                    <select name="structure_id" class="@error('structure_id') is-invalid @enderror">
                        <option value="{{ old('structure_id', $event->structure_id) }}" selected hidden>{{ $event->structure->name }}</option>
                        @foreach($structures as $structure)
                        <option value="{{ $structure->id }}">{{ $structure->name }}</option>
                        @endforeach
                    </select>
                    @error('structure_id')<span class="form-error-text">{{ $message }}</span>@enderror
                </div>

                <div class="form-group half">
                    <label for="partners">Partenaires organisateurs :</label>
                    <input name="partners" type="text" value="{{ old('partners', $event->partners) }}" placeholder='Séparer chaque partenaire par une virgule ","'>
                </div>
            </div>

            <div class="form-group">
                <label for="description">Description courte de l'événement <span class="required">*</span> :</label>
                <textarea name="description" rows="4" placeholder="Veuillez décrire le but de l'événement." class="@error('description') is-invalid @enderror">{{ old('description', $event->description) }}</textarea>
                @error('description')<span class="form-error-text">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="number_of_participants_id">Nombre de personnes présentes estimé <span class="required">*</span> :</label>
                <select name="number_of_participants_id" class="@error('nbre_people') is-invalid @enderror">
                    <option value="{{ old('number_of_participants_id', $event->number_of_participants_id) }}" selected hidden>{{ $event->number_of_participants->name }}</option>
                    @foreach($numberOfParticipants as $participants)
                    <option value="{{ $participants->id }}">{{ $participants->name }}</option>
                    @endforeach
                </select>
                @error('nbre_people')<span class="form-error-text">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="accessType_id">Type d'événement <span class="required">*</span> :</label>
                <select name="accessType_id" class="@error('accessType_id') is-invalid @enderror">
                    <option value="" disabled selected hidden>Choisissez un type</option>
                    @foreach($accessType as $type)
                    <option value="{{ $type->id }}" @if(old('accessType_id', $event->accessType_id) == $type->id) selected @endif>{{ $type->name }}</option>
                    @endforeach
                </select>
                @error('accessType_id')<span class="form-error-text">{{ $message }}</span>@enderror
            </div>

            <div class="form-group-checkbox">
                <label>Tags <span class="required">*</span> :</label>
                <div class="form-grid-checkbox">
                    @foreach($tags as $tag)
                    <label>
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="@error('tags') is-invalid @enderror" @if(in_array($tag->id, old('tags', $event->tags->pluck('id')->toArray()))) checked @endif>
                        {{ $tag->name }}
                    </label>
                    @endforeach
                </div>
                @error('tags')<span class="form-error-text">{{ $message }}</span>@enderror
            </div>
        </section>

        <!-- Planification -->
        <section class="form-section">
            <h2>Planification de l'événement</h2>

            <div class="form-group">
                <label for="location">Lieu de l'événement :</label>
                <input name="location" type="text" value="{{ old('location', $event->location) }}" placeholder="Veuillez renseigner le lieu de l'événement">
            </div>

            <div class="form-group-radio">
                <label>Les dates sont <span class="required">*</span> :</label>
                <label><input type="radio" name="is_Fix" value="1" {{ old('is_Fix', $event->is_Fix) == 1 ? 'checked' : '' }}> Fixes</label>
                <label><input type="radio" name="is_Fix" value="0" {{ old('is_Fix', $event->is_Fix) == 0 ? 'checked' : '' }}> Prévisionnelles</label>
            </div>

            <div id="is_fix" class="form-info">
                <p>Veuillez sélectionner la date de début et la date de fin de l'événement.</p>
            </div>
            <div id="is_not_fix" class="form-info">
                <p>Veuillez indiquer la période durant laquelle l'événement se déroulera.</p>
            </div>

            <div class="form-row">
                <div class="form-group half">
                    <label for="date-start">Début :<span class="required">*</span></label>
                    <input name="date_start" type="text" id="dateStart" value="{{ old('start', optional($event->date_start)->format('d-m-Y H:i')) }}">
                </div>
                <div class="form-group half">
                    <label for="date-end">Fin :</label>
                    <input name="date_end" type="text" id="dateEnd" value="{{ old('end', optional($event->date_end)->format('d-m-Y H:i')) }}">
                </div>
            </div>
        </section>

        <!-- Infos complémentaires -->
        <section class="form-section">
            <h2>Informations Complémentaires</h2>

            <div class="form-group">
                <label for="link">Lien de l'événement :</label>
                <input name="link" type="text" value="{{ old('link', $event->link) }}" placeholder="Veuillez renseigner un lien concernant l'événement">
            </div>

            <div class="form-group">
                <label for="organizer_needs">Besoin de l'organisateur :</label>
                <input name="organizer_needs" type="text" value="{{ old('needs_organizer', $event->organizer_needs) }}" placeholder="Si vous avez des besoins spécifiques veuillez les saisir ici...">
            </div>
        </section>

        <input type="submit" value="Modifier l'événement" class="submit-btn">
    </form>


    <script src="{{ asset('js/form.js') }}"></script>

    <script>
        // Activate the date and time picker with headers for hours and minutes
        document.addEventListener('DOMContentLoaded', function() {
            const startDatePicker = flatpickr("#dateStart", {
                enableTime: true,
                time_24hr: true,
                dateFormat: "d-m-Y H:i",
                locale: "fr", // set locale to French
                onChange: function(selectedDates, dateStr, instance) {
                    endDatePicker.set('minDate', dateStr); // Set the minimum date for endDate based on startDate
                },
                onReady: function(selectedDates, dateStr, instance) {
                    instance.calendarContainer.querySelector('.flatpickr-time').insertAdjacentHTML('afterbegin', `
                    <div class="custom-time-header">
            <span class="time-label">Heures</span>
            <span class="time-label">Minutes</span>
        </div>
                `);
                }
            });

            const endDatePicker = flatpickr("#dateEnd", {
                enableTime: true,
                time_24hr: true,
                dateFormat: "d-m-Y H:i",
                locale: "fr", // set locale to French
                onReady: function(selectedDates, dateStr, instance) {
                    instance.calendarContainer.querySelector('.flatpickr-time').insertAdjacentHTML('afterbegin', `
                    <div class="custom-time-header">
            <span class="time-label">Heures</span>
            <span class="time-label">Minutes</span>
        </div>
                `);
                }
            });
        });

        window.onload = function() {
            document.getElementById('dateStart').value = "{{ old('start', optional($event->date_start)->format('d-m-Y H:i')) }}";
            document.getElementById('dateEnd').value = "{{ old('end', optional($event->date_end)->format('d-m-Y H:i')) }}";

            // Optionally, if you want to initialize Flatpickr with these values
            startDatePicker.setDate(document.getElementById('dateStart').value, true);
            endDatePicker.setDate(document.getElementById('dateEnd').value, true);
        };



        function verifyDateStart() {
            newDateStart = new Date(start.value);

            if (newDateStart.toTimeString().slice(9, 17) == "GMT+0100") {
                newDateStart.setHours(newDateStart.getHours() + 1);
            } else {
                newDateStart.setHours(newDateStart.getHours() + 2);
            }
            start.value = newDateStart.toISOString().slice(0, 16);

            dateTomorrow.setDate(newDateStart.getDate());
            dateTomorrow.setHours(newDateStart.getHours() + 1);
            dateTomorrow.setMinutes(newDateStart.getMinutes());
            end = document.getElementById('dateEnd');
            end.value = dateTomorrow.toISOString().slice(0, 16);

        }


        function verifyDateEnd() {
            newDateEnd = new Date(end.value);
            startDate = new Date(start.value);
            if (newDateEnd.toTimeString().slice(9, 17) == "GMT+0100") {
                newDateEnd.setHours(newDateEnd.getHours() + 1);
            } else {
                newDateEnd.setHours(newDateEnd.getHours() + 2);
            }
            end.value = newDateEnd.toISOString().slice(0, 16);
        }


        let url = window.location.href;
        console.log(url);
        let realURL = (url.substring(0, url.length - 5));

        console.log("nouw ", realURL);
        /*fetch(url)
            .then((response) => {
                console.log("coucou ", response.data);
            })
            .catch((error) => {
                console.log("error ", error);
            });*/
    </script>
</x-app-layout>