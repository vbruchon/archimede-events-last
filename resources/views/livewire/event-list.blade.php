<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl ml-6 text-gray-800">
            {{ __('Liste des événements') }}
        </h2>
    </x-slot>

    <div class="md:py-12">
        @if($events->isEmpty())
        <div class="p-8 border-2 w-3/4 mb-6 mx-auto">
            <p class="">Aucun événement trouvé.</p>
        </div>
        @else
        @foreach($events as $event)
        <div class="relative w-full">
            @if(isset($dateStartToString[$event->id]))
            @php
            $dateStart = $dateStartToString[$event->id];
            @endphp
            @endif


            <div class="p-2 border-2 w-80  mb-6 mx-auto">
                @isset($dateStart)
                <p class="absolute top-0 left-0 p-2 text-custom-blue font-medium">{{ $dateStart }}</p>
                <!-- <hr class="absolute top-8 left-16 p-2 w-1/15 border-custom-blue"> -->
                @endisset
                @if($event->is_Fix === 0)
                <img src="{{asset('image/badge.png')}}" alt="" class="w-1/6 absolute top-8 right-10">
                @endif
                <p class="p-4 font-semibold text-3xl text-custom-blue">{{$event->name}}</p>
                <div class="my-6 flex space-x-4">
                    @foreach ($event->tags as $tag)
                    <p class="font-bold bg-custom-blue p-2 rounded-full text-white">#{{ $tag->name }}</p>
                    @endforeach
                </div>
                <div class="flex mb-5 items-center">
                    @if ($event->structure->name)
                    <div class="flex mb-5 items-center">
                        {!! $svg['structure'] !!}
                        <p class="p-2 mr-12 text-lg text-custom-blue font-semibold">{{ $event->structure->name }}</p>
                    </div>
                    @endif
                    @if ($event->partners)
                    <div class="flex mb-5 items-center">
                        {!! $svg['partners'] !!}
                        <p class="p-2 mr-12 text-lg text-custom-blue font-semibold">{{ $event->partners }}</p>
                    </div>
                    @endif
                </div>
                @if ($event->description)
                <div class="flex mb-5 items-center">
                    {!! $svg['description'] !!}
                    <p class="p-2 mr-12 text-lg text-custom-blue font-semibold">{{ $event->description }}</p>
                </div>
                @endif

                @if ($event->number_of_participants->name)
                <div class="flex mb-5 items-center">
                    {!! $svg['participants'] !!}
                    <p class="p-2 mr-12 text-lg text-custom-blue font-semibold">{{ $event->number_of_participants->name }}</p>
                    @if($event->accessType->name)
                    <div class="flex mb-5  items-center">
                        {!! $svg['accessType'] !!}
                        <p class="italic"><span>{{ $event->accessType->name }}</span> au public </p>
                    </div>
                    @endif
                </div>
                @endif

                @if($event->date_start)
                <div class="flex mb-5 items-center space-x-6">
                    <div class="flex mb-5 items-center">
                        {!! $svg['date'] !!}
                        <p class="p-2 text-lg text-custom-blue font-semibold">{{ \Carbon\Carbon::parse($event->date_start)->translatedFormat('j F Y H\h') }}</p>
                        @if($event->date_end !== null && $event->date_end !== $event->date_start)
                        <p class="p-2 text-lg text-custom-blue font-semibold">{{ \Carbon\Carbon::parse($event->date_end)->translatedFormat('j F Y H\h') }}</p>
                        @endif
                        <p class="p-2 text-lg text-custom-blue font-semibold">{{ $event->hours }}</p>
                    </div>
                    @if($event->location)
                    <div class="flex mb-5  items-center">
                        {!! $svg['locate'] !!}
                        <p class="p-2 text-lg text-custom-blue font-semibold">{{ $event->location }}</p>
                    </div>
                    @endif
                </div>
                @endif

                @if($event->organizer_needs)
                <div class="flex mb-5  items-center">
                    {!! $svg['needs'] !!}
                    <p class="italic text-custom-blue">{{$event->organizer_needs}}</p>
                </div>
                @endif


                @if($event->link)
                <div class="flex mb-5  items-center">
                    {!! $svg['link'] !!}
                    <a href="{{ $event->link }}" class="hover:text-custom-purple" target="_blank">{{ $event->link }}</a>
                </div>
                @endif
                <div class="flex mb-5  items-center ">
                    {!! $svg['user'] !!}
                    <p class="italic">{{ $event->user->name }}</p>
                </div>
                @if($isAdmin || $event->user_id == Auth::id())
                <div class="flex flex-nowrap justify-end space-x-1 ">
                    <a href="{{ route('userEvent.edit', $event) }}" class="transition duration-300 transform hover:scale-110 bg-custom-blue p-2 pl-3 pr-3 text-white hover:shadow-lg text-m font-semibold  ">
                        Modifier
                    </a>
                    <form id="deleteForm-{{ $event->id }}" method="post" action="{{ route('userEvent.destroy', $event->id) }}"> @csrf
                        @method('delete')
                        <button type="button" class="transition duration-300 transform hover:scale-110 bg-red-600 p-2 pl-3 pr-3 text-white hover:shadow-lg text-m font-semibold delete-button" data-target="#confirmDeleteModal">
                            Supprimer
                        </button>
                    </form>

                    <!-- Modal -->
                    <div id="confirmDeleteModal-{{ $event->id }}" class="hidden fixed inset-0 flex items-center justify-center z-50">
                        <div class="bg-custom-purple rounded-lg w-1/2 p-4">
                            <div class="p-6">
                                <h3 class="text-2xl text-white font-bold mb-6">Confirmation de suppression</h3>
                                <p class="text-white text-lg mb-6">Êtes-vous sûr de vouloir supprimer l'événement : {{$event->name}} ?</p>
                                <div class="flex justify-end">
                                    <button type="button" id="cancelButton" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2" data-dismiss="modal">Annuler</button>
                                    <button type="button" id="confirmDeleteButton" class="bg-red-600 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Confirmer la suppression</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </div>
        @endforeach
        @endif
    </div>
    <script src="{{ asset('js/deleteModal.js') }}"></script>
</x-app-layout>