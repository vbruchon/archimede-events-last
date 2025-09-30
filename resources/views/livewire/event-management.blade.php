<x-app-layout>
    <x-slot name="header">
        <h2 class="page-header ml-4">
            {{ __('Liste des événements') }}
        </h2>
    </x-slot>

    <div wire:id="event-management">
        <!-- Contenu du composant EventManagement -->
        @if ($activeView === 'event-list')
        @livewire('event-list', ['activeView' => $activeView], key('event-list'))
        @elseif ($activeView === 'calendar')
        @livewire('calendar', ['activeView' => $activeView], key('calendar'))
        @endif
    </div>

    <div>
        <button wire:click="showEventList" wire:loading.attr="disabled">Vue Liste</button>
        <button wire:click="showCalendar" wire:loading.attr="disabled">Vue Calendrier</button>
    </div>
    <div wire:loading>
        Chargement en cours...
    </div>

</x-app-layout>