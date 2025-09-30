<x-app-layout>
    <x-slot name="header">
        <h2 class="page-header ml-4">
            {{ __('Liste des événements') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('css/event-popup.css') }}">

    {{-- Boutons principaux --}}
    <div class="mt-6 mb-12 ml-4 space-x-2">
        <x-custom-button route="userEvent.my" content="Mes événements" />
        <x-custom-button route="userEvent.create" content="Ajouter un nouvel événement" />
        <x-custom-button route="userEvent.all" content="Vue liste" />
    </div>

    {{-- Calendrier --}}
    <div id="calendar-container" wire:ignore>
        <div id="calendar" class="w-10/12 mx-auto my-8 !text-white"></div>
    </div>

    {{-- Popup --}}
    <x-event-popup :svg="$svg" />

    @push('scripts')
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.js'></script>

    <script>
        document.addEventListener('livewire:load', function() {
            const Calendar = FullCalendar.Calendar;
            const calendarEl = document.getElementById('calendar');
            const calendar = new Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                locale: `{{ config('app.locale') }}`,
                events: JSON.parse(`{!! $events !!}`),
                eventDidMount: function(info) {
                    info.el.style.backgroundColor = info.event.extendedProps.is_Fix ? 'var(--color-custom-purple)' : 'var(--color-custom-blue)';
                    info.el.style.color = "#ffff";
                    info.el.classList.add('fc-event-custom');
                },
                eventClick: function(info) {
                    const props = info.event.extendedProps;
                    document.getElementById('popupTitle').textContent = info.event.title;

                    // Tags
                    const tagsContainer = document.getElementById('tags');
                    tagsContainer.innerHTML = '';
                    props.tags.forEach(tag => {
                        const tagElement = document.createElement('p');
                        tagElement.classList.add('tag');
                        tagElement.textContent = '#' + tag.name;
                        tagsContainer.appendChild(tagElement);
                    });

                    // Structure & Partners
                    document.getElementById('popupStructure').textContent = props.structure;
                    if (props.partners) {
                        document.getElementById('popupPartners').textContent = props.partners;
                        document.getElementById('partners').style.display = 'flex';
                    } else {
                        document.getElementById('partners').style.display = 'none';
                    }

                    // Description
                    document.getElementById('popupDescription').textContent = props.description;

                    // People
                    document.getElementById('popupNbreParticipants').textContent = props.nbre_participants;
                    document.getElementById('popupAccessType').textContent = props.accessType;

                    // Date & Location
                    const date = info.event.start;
                    document.getElementById('popupDate').textContent = formatDate(date);

                    // Heures
                    const start = info.event.start;
                    const end = info.event.end;
                    const formatHours = date => date.toLocaleTimeString('fr-FR', {
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                    document.getElementById('popupHours').textContent =
                        start && end ? ` ${formatHours(start)} - ${formatHours(end)}` : '';

                    document.getElementById('popupLocation').textContent = props.location;

                    // Author
                    document.getElementById('popupAuthor').textContent = props.author;

                    openPopup();
                }
            });
            calendar.render();
        });

        function formatDate(date) {
            return date.toLocaleDateString('fr-FR', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
        }

        function openPopup() {
            document.getElementById('popupContainer').style.display = 'block';
        }

        function closePopup() {
            document.getElementById('popupContainer').style.display = 'none';
        }

        document.getElementById('popupContainer').addEventListener('click', function(e) {
            if (e.target === this) closePopup();
        });
    </script>
    @endpush
</x-app-layout>