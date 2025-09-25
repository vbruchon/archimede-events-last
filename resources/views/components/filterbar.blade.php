<!-- resources/views/components/filerbar.blade.php -->

@props(['structures', 'numberOfParticipants', 'selectedStructure', 'selectedParticipant', 'selectedDateStart', 'selectedDateEnd', 'accessTypes', 'selectedAccessType', 'tags', 'route'])

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
'default' => 'Choisissez une nombre de participants',
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
'start' =>[
'label' => 'Date de début',
'name' => 'date_start',
'value' => $selectedDateStart ?? ""
],
'end' =>[
'label' => 'Date de fin',
'name' => 'date_end',
'value' => $selectedDateEnd ?? ""
],
];


@endphp

<div class='flex items-center justify-center mt-5'>
    <nav class="hidden space-x-10 md:flex w-full">
        <div class="relative w-full left-0">
            <button id="filterButton" type="button" class=" transition duration-300 transform hover:scale-105 text-white group p-4 inline-flex items-center rounded-md bg-custom-blue text-base font-medium hover:text-gray-900 hover:bg-custom-purple hover:text-white ml-4 mb-4 shadow-lg" aria-expanded="false">
                <span>Filtres</span>
                <svg id="filterIcon" class="text-gray-400 ml-2 h-5 w-5 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                </svg>
            </button>

            <div id="filterDropdown" class="hidden absolute left-50/100 z-full w-10/12 -translate-x-1/2 transform px-2 sm:px-0">
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

                            <div class="flex flex-wrap mb-4 px-2.5 justify-center w-full mb-8">
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
                            <button class="w-1/5 cursor-pointer block mx-auto mt-5 mb-3 text-xl text-center text-white rounded-lg p-3 bg-custom-purple transition duration-300 transform hover:scale-110" type="submit" id="filterButon">Appliquer les filtres</button>
                            <button type="button" id="resetBtn">Réinitialiser</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>



<script src="{{ asset('js/filterbar.js') }}"></script>


<!-- 
<form id="filterbar" action="{{ route($route) }}" method="get" class="px-8 py-4 flex flex-col justify-evenly w-full bg-white">
    @csrf
    @foreach($selectOptions as $key => $selectOption)
    <div class="flex flex-col flex-wrap mb-4 mr-10">
        <label class="mb-3 text-lg text-custom-blue" for="{{ $key }}">{{ $selectOption['label'] }}</label>
        <select name="{{ $key }}" id="{{ $key }}" class="bg-white border border-custom-purple text-gray-900 text-l rounded-lg p-2.5 w-full">
            <option value="" disabled selected hidden>Choisissez une structure</option>
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

    <div class="flex flex-col  mb-4 mr-10">
        <label class="mb-3 text-xl" for="date_start">Date de début :</label>
        <input class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2 w-full" name="date_start" type="date" value="">
        <div class="flex flex-col  mb-4 mr-10">
            <label class="mb-3 text-xl" for="date_end">Date de fin :</label>
            <input class="bg-white border border-gray-300 text-gray-900 text-l rounded-lg p-2 w-full" name="date_end" type="date" value="">
        </div>
    </div>

    <button class="hidden" type="submit">Filtrer</button>
    <button class="hidden" type="button" onclick="resetFilters()">Réinitialiser</button> <!-- Bouton de réinitialisation --
</form> -->