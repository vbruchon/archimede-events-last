@props(['activeView'])

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-4">
            {{ __('Liste des événements') }}
        </h2>
    </x-slot>

    <x-slot name="styles">
        @livewireStyles
        @stack('styles')
    </x-slot>
    <style>

    </style>
    @if (session('success'))
    var successMessage = '{{ session('success') }}';
    if (successMessage) {
    <div id="success-message" class="bg-green-400 p-6 text-center rounded shadow animate-movedown">
        {{ session('success') }}
    </div>
    }
    @endif
    <div class="mt-6 ml-4">
        <x-custom-button route="userEvent.my" content="Mes événements" />
        <x-custom-button route="userEvent.create" content="Ajouter un nouvel événement" />
        <button id="calendrier-btn" class="transition duration-300 transform hover:scale-105 ml-6 mt-5 mb-3 text-xl text-center text-white rounded-lg p-3 bg-custom-purple">Calendrier</button>
        <button id="liste-btn" class="transition duration-300 transform hover:scale-105 ml-6 mt-5 mb-3 text-xl text-center text-white rounded-lg p-3 bg-custom-purple">Liste</button>

    </div>
    <!-- Reste du contenu de la vue -->
    @livewire('filter-bar')


    <div class="w-full ml-8">
        @livewire('event-list')
    </div>

    <script>
        if (document.getElementById('sucess-message')) {
            let sucessMessage = document.getElementById('success-message');

            setTimeout(() => {
                sucessMessage.classList.add('hidden');
            }, 5000);
        }

        document.addEventListener("DOMContentLoaded", function() {
            // Récupérer les références aux éléments HTML
            var calendarBtn = document.getElementById("calendrier-btn");
            var listBtn = document.getElementById("liste-btn");
            var calendarContainer = document.getElementById("calendarContainer");
            var eventsDiv = document.getElementById("events");

            // Fonction pour afficher le calendrier et masquer la liste
            function displayCalendar() {
                calendarContainer.classList.remove('hidden');
                eventsDiv.classList.add("hidden");
            }

            // Fonction pour afficher la liste et masquer le calendrier
            function displayList() {
                calendarContainer.classList.add("hidden");
                eventsDiv.classList.remove('hidden');
            }

            // Écouter les clics sur le bouton calendrier
            calendarBtn.addEventListener("click", displayCalendar);

            // Écouter les clics sur le bouton liste
            listBtn.addEventListener("click", displayList);
        });
    </script>
</x-app-layout>
