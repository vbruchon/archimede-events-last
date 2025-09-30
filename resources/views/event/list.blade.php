<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/event-list-page.css') }}">


<x-app-layout>
    <x-slot name="header">
        <h2 class="page-header">
            {{ __('Liste des événements') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="buttons-grid">
            <x-custom-button route="userEvent.my" content="Mes événements" />
            <x-custom-button route="userEvent.create" content="Ajouter un nouvel événement" />
            <x-custom-button route="userEvent.calendar" content="Calendrier complet" />
        </div>



        @if(!Str::contains(request()->url(), 'my'))
        <div>
            @if(isset($selectedStructure) || isset($selectedParticipant) || isset($selectedAccessType) || isset($selectedDateStart) || isset($selectedDateEnd))
            <x-filterbar :structures="$structures" :numberOfParticipants="$numberOfParticipants" :selectedStructure="$selectedStructure ?? ''" :selectedParticipant="$selectedParticipant ?? ''" :selectedDateStart="$selectedDateStart ?? ''" :selectedDateEnd="$selectedDateEnd ?? ''" :accessTypes="$accessTypes" :selectedAccessType="$selectedAccessType ?? ''" :tags="$tags" :checkedTags="$checkedTags ?? []" :route="'userEvent.filter'" />
            @else
            <x-filterbar :structures="$structures" :numberOfParticipants="$numberOfParticipants" :accessTypes="$accessTypes" :tags="$tags" route="userEvent.filter" />
            @endif
        </div>
        @endif
        @if (session('success'))
        <x-sucess-message />
        @endif

        <section>
            <div id="events">
                @if($events->isEmpty())
                <div class="empty-card">
                    <p class="event-name">Aucun événement trouvé.</p>
                </div>
                @else
                @foreach($events as $event)
                <div class="event-wrapper">
                    @if(isset($dateStartToString[$event->id]))
                    @php
                    $dateStart = $dateStartToString[$event->id];
                    @endphp
                    @endif
                    @isset($dateStart)
                    <p class="event-date">{{ $dateStart }}</p>
                    @endisset


                    <div class="event-card">
                        @if($event->is_Fix === 0)
                        <img src="{{ asset('image/badge.png') }}" alt="" class="event-badge">
                        @endif

                        <p class="event-name">{{$event->name}}</p>

                        @if($isAdmin || $event->user_id == Auth::id())
                        <div class="admin-buttons">
                            <x-edit-button :route="'userEvent.edit'" :item="$event" />
                            <x-delete-button-with-confirmation
                                :route="route('userEvent.destroy', $event->id)"
                                :id="$event->id"
                                :name="$event->name" />
                        </div>
                        @endif

                        <div class="event-tags">
                            @foreach ($event->tags as $tag)
                            <p class="tag">#{{ $tag->name }}</p>
                            @endforeach
                        </div>
                        <div class="event-info">
                            @if ($event->structure->name)
                            <div class="event-info">
                                {!! $svg['structure'] !!}
                                <p class="event-info-text">{{ $event->structure->name }}</p>
                            </div>
                            @endif
                            @if ($event->partners)
                            <div class="event-info ">
                                {!! $svg['partners'] !!}
                                <p class="event-info-text">{{ $event->partners }}</p>
                            </div>
                            @endif
                        </div>
                        @if ($event->description)
                        <div class="event-description">
                            {!! $svg['description'] !!}
                            <p class="event-info-text ">{{ $event->description }}</p>
                        </div>

                        @endif


                        @if ($event->number_of_participants->name)
                        <div class="event-info">
                            {!! $svg['participants'] !!}
                            <p class="event-info-text">{{ $event->number_of_participants->name }}</p>
                            @if($event->accessType->name)
                            <div class="flex items-center">
                                {!! $svg['accessType'] !!}
                                <p class="italic"><span>{{ $event->accessType->name }}</span> au public </p>
                            </div>
                            @endif
                        </div>
                        @endif

                        @if($event->date_start)
                        <div class="event-col">
                            <div class="event-gap-x">
                                {!! $svg['date'] !!}
                                <p class="event-info-date">{{ \Carbon\Carbon::parse($event->date_start)->translatedFormat('j F Y H\h') }}</p>
                                @if($event->date_end !== null && $event->date_end !== $event->date_start)
                                <span class="event-info-date">-</span>
                                <p class="event-info-date">{{ \Carbon\Carbon::parse($event->date_end)->translatedFormat('j F Y H\h') }}</p>
                                @endif
                            </div>
                            @if($event->location)
                            <div class="event-info">
                                {!! $svg['locate'] !!}
                                <p class="event-info-text">{{ $event->location }}</p>
                            </div>
                            @endif
                        </div>
                        @endif

                        @if($event->organizer_needs)
                        <div class="event-info">
                            {!! $svg['needs'] !!}
                            <p class="italic event-info-text">{{$event->organizer_needs}}</p>
                        </div>
                        @endif


                        @if($event->link)
                        <div class="event-link-box">
                            {!! $svg['link'] !!}
                            <a href="{{ $event->link }}" class="event-link" target="_blank">{{ $event->link }}</a>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </section>
</x-app-layout>