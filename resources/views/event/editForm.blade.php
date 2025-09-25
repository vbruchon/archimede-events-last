<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/fr.js"></script>

<x-app-layout>
    <x-slot name="header">
        <h2 class="ml-6 font-semibold text-xl text-gray-800 leading-tight">
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

    <form action="{{ route('userEvent.update', $event) }}" method="POST" class="bg-gray-100 block p-8 rounded-2xl w-full justify-center mx-auto mt-8 mb-6">
        @csrf
        @method('put')
        <section class="relative border-2 border-custom-light-purple rounded-lg p-16 mb-12 ">
            <h2 class="absolute top-0 left-8 bg-gray-100 px-3 py-1 mt-[-20px] text-custom-light-purple rounded-tl rounded-tr text-lg">Informations générales</h2>
            <div>
                <p style="color:red; font-weight:700;">Les guillemets ("") sont interdits dans les champs du formulaire</p><br />
            </div>
            <div class="flex flex-col mb-4">
                <label class="mb-3 text-xl" for="name">Intitulé de l'événement <span class="text-red-600">*</span> :</label>
                <input class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2 @error('name') is-invalid @enderror" name="name" type="text" value="{{ old('name', $event->name) }}" placeholder="Veuillez renseigner le nom de l'événement">
                @error('name')<span class="text-red-600">{{ $message }}</span>@enderror
            </div>

            <div class="w-full flex place-content-between mb-4">
                <div class="flex flex-col w-2/5 mr-8">
                    <label class="mb-3 text-xl" for="structure_id">Structure <span class="text-red-600">*</span> :</label>
                    <select name="structure_id" id="" class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2.5 @error('structure_id') is-invalid @enderror">
                        <option value="{{ old('structure_id', $event->structure_id) }}" selected hidden>{{ $event->structure->name }}</option>
                        @if($structures->count() > 0)
                        @foreach($structures as $structure)
                        <option value="{{ $structure->id }}">{{ $structure->name }}</option>
                        @endforeach
                        @endif
                    </select>
                    @error('structure_id')<span class="text-red-600">{{ $message }}</span>@enderror
                </div>
                <div class="flex flex-col w-3/5 mb-4">
                    <label class="mb-3 text-xl" for="partners">Partenaires organisateurs :</label>
                    <input name="partners" class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2" type="text" value="{{ old('partners', $event->partners) }}" placeholder='Séparer chaque partenaire par une virgule  " , "'>
                </div>
            </div>

            <div class="flex flex-col mb-8">
                <label class="mb-3 text-xl" for="description">Description courte de l'événement <span class="text-red-600">*</span> :</label>

                <input type="text" class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2 @error('description') is-invalid @enderror" name="description" value="{{ old('description', $event->description) }}" placeholder="Veuillez décrire le but de l'événement.">
                {{ $event->description }}</input>
                @error('description')<span class="text-red-600">{{ $message }}</span>@enderror
            </div>

            <div class="w-full flex place-content-between mb-4">
                <div class="flex flex-col w-full mr-8 mb-4">
                    <label class="mb-3 text-xl" for="number_of_participants_id">Nombre de personnes présentes estimé <span class="text-red-600">*</span> :</label>
                    <select class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2.5 @error('nbre_people') is-invalid @enderror" name="number_of_participants_id">
                        <option value="{{ old('number_of_participants_id', $event->number_of_participants_id) }}" selected hidden>{{ $event->number_of_participants->name }}</option>
                        @if($numberOfParticipants->count() > 0)
                        @foreach($numberOfParticipants as $participants)
                        <option value="{{ $participants->id }}">{{ $participants->name }}</option>
                        @endforeach
                        @endif
                    </select>
                    @error('nbre_people')<span class="text-red-600">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="flex flex-col w-full mr-8">
                <label class="mb-3 text-xl" for="accessType_id">Type d'événement <span class="text-red-600">*</span> :</label>
                <select name="accessType_id" id="" class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2.5 @error('accessType_id') is-invalid @enderror">
                    <option value="" disabled selected hidden>Choisissez un type</option>
                    @if($accessType->count() > 0)
                    @foreach($accessType as $type)
                    <option value="{{ $type->id }}" @if(old('accessType_id', $event->accessType_id) == $type->id) selected @endif>{{ $type->name }}</option>
                    @endforeach
                    @endif
                </select>
                @error('accessType_id')<span class="text-red-600">{{ $message }}</span>@enderror
            </div>
            <div class="flex flex-col w-2/5 mr-8">
                <label class="mb-3 text-xl">Tags <span class="text-red-600">*</span> :</label>
                @foreach($tags as $tag)
                <label>
                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2.5 @error('tags') is-invalid @enderror" @if(in_array($tag->id, old('tags', $event->tags->pluck('id')->toArray()))) checked @endif>
                    {{ $tag->name }}
                </label>
                @endforeach
                @error('tags')<span class="text-red-600">{{ $message }}</span>@enderror
            </div>
        </section>
        <section class="relative border-2 border-custom-light-purple rounded-lg p-16 mb-12 ">
            <h2 class="absolute top-0 left-8 bg-gray-100 px-3 py-1 mt-[-20px] text-custom-light-purple rounded-tl rounded-tr text-lg">Planification de l'événement</h2>
            <div class="flex flex-col w-full mr-8">
                <label class="mb-3 text-xl" for="location">Lieu de l'événement :</label>
                <input class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2 mb-6" name="location" type="text" value="{{ old('location') }}" placeholder="Veuillez renseigner le lieu de l'événement">
            </div>
            <div class="w-full flex place-content-between mb-4">
                <label class="mb-3 text-xl" for="is_Fix">Les dates sont <span class="text-red-600">*</span> :</label>
                <span class="mb-3 text-xl">Fixes :</span>
                <input class="accent-custom-light-purple -mt-2 @error('is_Fix') is-invalid @enderror"
                    name="is_Fix"
                    type="radio"
                    id="fix"
                    value="1" {{ old('is_Fix') == '1' ? 'checked' : '' }}>
                @error('is_Fix')
                <span class="text-red-600">{{ $message }}</span>@enderror

                <!-- Prévisionnelles radio button -->
                <span class="mb-3 text-xl">Prévisionnelles :</span>
                <input class="accent-custom-light-purple -mt-2 @error('is_not_fix') is-invalid @enderror"
                    name="is_Fix"
                    type="radio"
                    id="fix"
                    value="0" {{ old('is_Fix') == '0' ? 'checked' : '' }}>
                @error('is_not_fix')
                <span class="text-red-600">{{ $message }}</span>@enderror
            </div>

            <div id="is_fix" class="mb-8">
                <p class="italic">Veuillez sélectionner la date de début et la date de fin de l'événement.</p>
            </div>
            <div id="is_not_fix" class="mb-8">
                <p class="italic">Veuillez indiquer la période durant laquelle l'événement se déroulera.</p>
            </div>
            <div id="date" class="w-full flex mb-6">
                <div class="w-2/5">
                    <label class="mb-3 text-xl" for="date-start">Début :<span class="text-red-600">*</span></label>
                    <input class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2 w-3/5 @error('date_start') is-invalid @enderror" name="date_start" type="text" id="dateStart" value="{{ old('start', optional($event->date_start)->format('d-m-Y H:i')) }}" onchange="verifyDateStart()">
                </div>
                <div class="ml-12 w-2/5">
                    <label class="mb-3 text-xl" for="date-end">Fin :</label>
                    <input class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2 w-3/5 @error('date_end') is-invalid @enderror" name="date_end" value="{{ old('end', optional($event->date_end)->format('d-m-Y H:i')) }}" type="text" id="dateEnd" onchange="verifyDateEnd()">
                </div>
            </div>
            @error('date_start')<span class="text-red-600">{{ $message }}</span>@enderror
            @error('date_end')<span class="text-red-600">{{ $message }}</span>@enderror
        </section>
        <section class="relative border-2 border-custom-light-purple rounded-lg p-16 mb-6 ">
            <h2 class="absolute top-0 left-8 bg-gray-100 px-3 py-1 mt-[-20px] text-custom-light-purple rounded-tl rounded-tr text-lg">Informations Complémentaires</h2>

            <div class="flex flex-col w-full mr-8">
                <label class="mb-3 text-xl">Lien de l'événement :</label>
                <input class="mb-6 h-8 border-2 border-grey-300" name="link" type="text" value="{{ old('link', $event->link) }}" placeholder="Veuillez renseigner un lien concernant l'événement">
            </div>

            <label class="mb-3 text-xl" for="organizer_needs">Besoin de l'organisateur</label>
            <input type="text" class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2 w-full" id="" name="organizer_needs" placeholder="Si vous avez des besoins spécifiques veuillez les saisir ici...">{{ old('needs_organizer') }}</input>
        </section>
        <x-submitInput label="Modifier l'événement" />
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