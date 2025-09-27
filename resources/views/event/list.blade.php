<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            {{ __('Liste des événements') }}
        </h2>
    </x-slot>

    <div class="mx-auto md:py-12">
        <div class=" overflow-hidden sm:rounded-lg md:p-8 md:max-w-48">
            <div class="grid md:grid-cols-1 xl:grid-cols-3 gap-4 md:gap-8 justify-center auto-cols-max" style="width: fit-content;">
                <x-custom-button route="userEvent.my" content="Mes événements" />
                <x-custom-button route="userEvent.create" content="Ajouter un nouvel événement" />
                <x-custom-button route="userEvent.calendar" content="Calendrier complet" />
            </div>



            @if(!Str::contains(request()->url(), 'my'))
            <div class="ml-4">
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
                        @isset($dateStart)
                        <p style="left: 1.5rem; top: 2rem;" class="absolute top-2 p-2 text-custom-blue font-medium">{{ $dateStart }}</p>
                        @endisset


                        <div class="relative px-8 py-4 border-2 w-80 mt-16 mb-6 mx-auto shadow-lg rounded-2xl"
                            onmouseover="this.querySelector('.admin-buttons').style.opacity='1';"
                            onmouseout="this.querySelector('.admin-buttons').style.opacity='0';">
                            @if($event->is_Fix === 0)
                            <img src="{{ asset('image/badge.png') }}" alt="" style="max-width: 200px; top: 4rem !important;" class="absolute right-0">
                            @endif

                            <p class="py-4 font-semibold text-2xl text-custom-blue ">{{$event->name}}</p>

                            @if($isAdmin || $event->user_id == Auth::id())
                            <div class="admin-buttons" style="position:absolute; top:1rem; right:1rem; display:flex; gap:0.5rem; opacity:0; transition:opacity 0.3s;">
                                <a href="{{ route('userEvent.edit', $event) }}"
                                    style="color:#182946; padding:0.5rem; transition: transform 0.3s;"
                                    onmouseover="this.style.transform='scale(1.1)';"
                                    onmouseout="this.style.transform='scale(1)';">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                        <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                    </svg>
                                </a>
                                <form id="deleteForm-{{ $event->id }}" method="post" action="{{ route('userEvent.destroy', $event->id) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"
                                        style="color:#DC2626; padding:0.5rem; transition: color 0.3s;"
                                        onmouseover="this.style.transform='scale(1.1)';"
                                        onmouseout="this.style.transform='scale(1)';">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                            <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                            <!-- Modal -->
                            <div id="confirmDeleteModal-{{ $event->id }}" class="fixed inset-0 hidden items-center justify-center z-50">
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
                            @endif

                            <!-- @if($isAdmin || $event->user_id == Auth::id())
                            <div style="position:absolute; top:1rem; right:1rem; display:flex; gap:0.5rem; opacity:0; transition:opacity 0.3s;"
                                onmouseover="this.style.opacity='1';"
                                onmouseout="this.style.opacity='0';">>
                                <a href="{{ route('userEvent.edit', $event) }}"
                                    style="color:#1D4ED8; padding:0.5rem; transition: transform 0.3s;"
                                    onmouseover="this.style.transform='scale(1.1)'"
                                    onmouseout="this.style.transform='scale(1)'">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                        <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                    </svg>
                                </a>
                                <form id="deleteForm-{{ $event->id }}" method="post" action="{{ route('userEvent.destroy', $event->id) }}" class="transition duration-300 transform hover:scale-110 ">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"
                                        style="color:#DC2626; padding:0.5rem; transition: color 0.3s;"
                                        onmouseover="this.style.color='#B91C1C'"
                                        onmouseout="this.style.color='#DC2626'">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                            <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form>
                            </div>



                            <!- Modal -
                            <div id="confirmDeleteModal-{{ $event->id }}" class="fixed inset-0 hidden items-center justify-center z-50">
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
                            @endif -->


                            <div class="my-6 flex flex-wrap space-x-4 ">
                                @foreach ($event->tags as $tag)
                                <p class="font-bold bg-custom-blue py-2 px-4 mb-4 rounded-full text-white">#{{ $tag->name }}</p>
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
                                <div class="flex items-center mb-5 ">
                                    {!! $svg['partners'] !!}
                                    <p class="p-2 mr-12 text-lg text-custom-blue font-semibold">{{ $event->partners }}</p>
                                </div>
                                @endif
                            </div>
                            @if ($event->description)
                            <div class="flex mb-5 items-start gap-2">
                                {!! $svg['description'] !!}
                                <p class="text-lg text-custom-blue max-w-sm font-semibold flex-1">{{ $event->description }}</p>
                            </div>

                            @endif


                            @if ($event->number_of_participants->name)
                            <div class="flex mb-5 items-center">
                                {!! $svg['participants'] !!}
                                <p class="p-2 mr-12 text-lg text-custom-blue font-semibold">{{ $event->number_of_participants->name }}</p>
                                @if($event->accessType->name)
                                <div class="flex items-center">
                                    {!! $svg['accessType'] !!}
                                    <p class="italic"><span>{{ $event->accessType->name }}</span> au public </p>
                                </div>
                                @endif
                            </div>
                            @endif

                            @if($event->date_start)
                            <div class="flex mb-5 flex-col">
                                <div class="flex mb-5 items-center gap-x-4">
                                    {!! $svg['date'] !!}
                                    <p class="p-2 text-lg text-custom-blue font-semibold">{{ \Carbon\Carbon::parse($event->date_start)->translatedFormat('j F Y H\h') }}</p>
                                    @if($event->date_end !== null && $event->date_end !== $event->date_start)
                                    <span class="font-semibold">-</span>
                                    <p class="p-2 text-lg text-custom-blue font-semibold">{{ \Carbon\Carbon::parse($event->date_end)->translatedFormat('j F Y H\h') }}</p>
                                    @endif
                                </div>
                                @if($event->location)
                                <div class="flex mb-5">
                                    {!! $svg['locate'] !!}
                                    <p class="p-2 text-lg text-custom-blue font-semibold">{{ $event->location }}</p>
                                </div>
                                @endif
                            </div>
                            @endif

                            @if($event->organizer_needs)
                            <div class="flex mb-5">
                                {!! $svg['needs'] !!}
                                <p class="italic text-custom-blue">{{$event->organizer_needs}}</p>
                            </div>
                            @endif


                            @if($event->link)
                            <div class="flex mb-5 items-center gap-5 rounded bg-purple-400 p-2">
                                {!! $svg['link'] !!}

                                <a href="{{ $event->link }}"
                                    class="underline hover:text-custom-purple text-custom-blue max-w-xl"
                                    target="_blank"
                                    style="overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                                    {{ $event->link }}
                                </a>
                            </div>
                            @endif




                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </section>
        </div>
        <script>
            let toastSucess = document.getElementById('toast-success');

            setTimeout(() => {
                toastSucess.classList.remove('animate-fadein');
            }, 1000);
        </script>
        <script src="{{ asset('js/deleteModal.js') }}"></script>
</x-app-layout>