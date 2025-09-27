@props([
'structures', 'numberOfParticipants', 'selectedStructure',
'selectedParticipant', 'selectedDateStart', 'selectedDateEnd',
'accessTypes', 'selectedAccessType', 'tags', 'route'
])

@php
$selectOptions = [
'structure' => [
'label' => 'Structure',
'options' => $structures,
'default' => 'Choisissez une structure',
'selected' => $selectedStructure ?? "",
],
'participants' => [
'label' => 'Nombre de participants',
'options' => $numberOfParticipants,
'default' => 'Choisissez un nombre de participants',
'selected' => $selectedParticipant ?? "",
],
'accessType' => [
'label' => 'Type d\'accès',
'options' => $accessTypes,
'default' => 'Choisissez un type d\'accès',
'selected' => $selectedAccessType ?? "",
],
];

$dates = [
'start' => [
'label' => 'Date de début',
'name' => 'date_start',
'value' => $selectedDateStart ?? ""
],
'end' => [
'label' => 'Date de fin',
'name' => 'date_end',
'value' => $selectedDateEnd ?? ""
],
];
@endphp

<div class="flex items-center justify-center mt-5">
    <nav class="w-full relative px-4">
        <!-- Bouton Filtres -->
        <button id="filterButton" type="button"
            class="flex items-center justify-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-500 text-black font-semibold rounded-lg shadow-md hover:scale-105 hover:shadow-lg transition-transform duration-300"
            aria-expanded="false">
            <span>Filtres</span>
            <svg id="filterIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5 transition-transform duration-300">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
            </svg>
        </button>

        <!-- Dropdown -->
        <div id="filterDropdown" class="hidden absolute left-50/100 z-50 w-10/12 -translate-x-1/2 transform px-2 sm:px-0">
            <div class="overflow-hidden rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 mx-auto border-2 border-custom-light-purple">
                <div class="relative grid gap-6 bg-white px-5 py-6 sm:gap-8 sm:p-8">
                    <form id="filterbar" action="{{ route($route) }}" method="get" class="py-4 flex flex-wrap w-full bg-white justify-center">
                        @csrf
                        @foreach($selectOptions as $key => $selectOption)
                        <div class="flex flex-col flex-wrap mb-8 mr-4 w-30">
                            <label class="mb-3 text-lg text-custom-blue" for="{{ $key }}">{{ $selectOption['label'] }}</label>
                            <select name="{{ $key }}" id="{{ $key }}" class="bg-white border border-custom-purple text-gray-900 text-l rounded-lg p-2.5 w-full">
                                <option value="" disabled selected hidden>{{$selectOption['default']}}</option>
                                @if($selectOption['options']->count() > 0)
                                @foreach ($selectOption['options'] as $option)
                                @if(isset($option))
                                <option value="{{ $option->name }}" {{ $selectOption['selected'] == $option->name ? 'selected' : '' }}>
                                    {{ $option->name }}
                                </option>
                                @else
                                <option value="{{ $option->name }}">{{ $option->name }}</option>
                                @endif
                                @endforeach
                                @endif
                                <option value="">
                                    <hr class="mt-6 mb-4 border-gray-300 dark:border-gray-700">
                                </option>

                                <option value="">Réinitialiser</option>
                            </select>
                        </div>
                        @endforeach

                        <div class="flex flex-wrap mb-4 px-2.5 justify-center w-full">
                            @foreach($tags as $tag)
                            <label class="flex-col mr-8 my-2 w-1/5">
                                <input id="tags" type="checkbox" name="tags[]" value="{{ $tag->id }}" class="bg-white border border-gray-300 text-gray-900 text-l checked:bg-custom-purple rounded-lg p-2.5 @error('tags') is-invalid @enderror" @if(is_array(old('tags')) && in_array($tag->id, old('tags'))) checked @endif>
                                {{ $tag->name }}
                            </label>
                            @endforeach

                        </div>

                        @foreach($dates as $date)
                        <div class="flex flex-col mb-4 mr-10 w-1/4" id="tags">
                            <label class="mb-3 text-xl" for="{{ $date['name'] }}">{{ $date['label'] }} :</label>
                            <input id="{{ $date['name'] }}" class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2 w-full" name="{{ $date['name'] }}" type="date" value="{{ $date['value'] }}">
                        </div>
                        @endforeach
                        <div class="flex items-center gap-4">
                            <button class="cursor-pointer block mx-auto text-center text-white rounded-lg p-3  bg-custom-purple transition duration-300 transform hover:scale-110" type="submit" id="filterButon">Appliquer les filtres</button>
                            <button type="button" id="resetBtn" class="hover:bg-gray-300 w-fit p-3 rounded-lg">Réinitialiser</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</div>

<script src="{{ asset('js/filterbar.js') }}"></script>