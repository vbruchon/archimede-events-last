<x-app-layout>
    <x-slot name="header">
        <h2 class="page-header">
            {{ __('Liste des événements') }}
        </h2>
    </x-slot>
    @if (session('success'))
    <div id="success-message" class="bg-green-400 p-6 text-center rounded shadow animate-movedown">
        {{ session('success') }}
    </div>
    @endif
    <main class="w-full mt-10">

        <x-custom-button route="userEvent.create" content="Ajouter un nouvel événement" />

        <div class="events">
            @if($events->isEmpty())
            <div class="p-8 border-2 w-3/4 mb-6 mx-auto mt-16">
                <p class="">Aucun événement trouvé.</p>
            </div>
            @else
            @foreach($events as $event)
            <div class="relative">
                <div class="p-8 border-2 w-3/4 mt-16 mb-6 mx-auto">
                    <p class="p-8 font-semibold text-3xl">{{$event->name}}</p>
                    <div class="flex mb-5 ">
                        <svg fill="#701a75" class="w-9" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0" />
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                            <g id="SVGRepo_iconCarrier">
                                <path d="M30,25.11H29v-.89a2,2,0,0,0-2-2H26V14.11h1a2,2,0,0,0,2-2v-.89h2a1,1,0,0,0,.43-1.9l-15-7.22a1,1,0,0,0-.86,0L.57,9.32A1,1,0,0,0,1,11.22H3v.89a2,2,0,0,0,2,2H6v8.11H5a2,2,0,0,0-2,2v.89H2a2,2,0,0,0-2,2V29a1,1,0,0,0,1,1H31a1,1,0,0,0,1-1V27.11A2,2,0,0,0,30,25.11Zm-14-21L26.62,9.22H5.38Zm-11,8v-.89H27v.89H5Zm19,2v8.11H21.5V14.11Zm-4.5,0v8.11H17V14.11Zm-4.5,0v8.11H12.5V14.11Zm-4.5,0v8.11H8V14.11ZM5,24.22H27v.89H5ZM30,28H2v-.89H30Z" />
                            </g>
                        </svg>
                        <p class="p-2 mr-12 text-lg"> {{$event->structure->name}}</p>

                        <svg class="w-9" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" fill="#701a75">
                            <g id="SVGRepo_bgCarrier" stroke-width="0" />
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                            <g id="SVGRepo_iconCarrier">
                                <title>partners</title>
                                <g id="Layer_2" data-name="Layer 2">
                                    <g id="invisible_box" data-name="invisible box">
                                        <rect width="48" height="48" fill="none" />
                                    </g>
                                    <g id="Layer_6" data-name="Layer 6">
                                        <g>
                                            <path d="M18.4,13.8A5.9,5.9,0,0,1,23,12.1a7.6,7.6,0,0,1,5.2,2.2c2.9,2.8,3.4,7.2,1,9.7a2.1,2.1,0,0,0,0,2.9,2.4,2.4,0,0,0,1.4.5,1.8,1.8,0,0,0,1.4-.6c3.2-3.3,3.5-8.2,1.3-12.3H34a6.1,6.1,0,0,0,4.5-1.9,6.3,6.3,0,0,0-.2-8.9A6.5,6.5,0,0,0,34,2a6.6,6.6,0,0,0-4.6,1.9,6.3,6.3,0,0,0-1.6,5.3,11.2,11.2,0,0,0-4.7-1.1,9.5,9.5,0,0,0-7.6,3,2,2,0,1,0,2.9,2.7ZM32.3,6.7A2.4,2.4,0,0,1,34,6a2.2,2.2,0,0,1,1.5.6,2.2,2.2,0,0,1,.1,3.2,1.9,1.9,0,0,1-1.6.7,2.3,2.3,0,0,1-1.6-.6A2.2,2.2,0,0,1,32.3,6.7Z" />
                                            <path d="M21.4,38.4C18,37.5,16,33.6,17,29.7s4.5-6.6,7.9-5.7a2,2,0,0,0,2.4-1.5,1.9,1.9,0,0,0-1.4-2.4,10.4,10.4,0,0,0-11.3,5.1,6.3,6.3,0,0,0-4.3-3.6l-1.4-.2a6.3,6.3,0,0,0-6.1,4.8,6.2,6.2,0,0,0,4.6,7.6l1.5.2a6.2,6.2,0,0,0,3.9-1.4,10.5,10.5,0,0,0,7.7,9.7h.4a2,2,0,0,0,2-1.5A1.9,1.9,0,0,0,21.4,38.4ZM11.1,28.2A2.3,2.3,0,0,1,8.9,30H8.3a2.3,2.3,0,0,1-1.7-2.7,2.3,2.3,0,0,1,2.3-1.8h.5a2.1,2.1,0,0,1,1.4,1A2.5,2.5,0,0,1,11.1,28.2Z" />
                                            <path d="M40.5,33.9a11.9,11.9,0,0,0,3.3-3.4A9.8,9.8,0,0,0,45,22.4,2,2,0,0,0,42.5,21a2,2,0,0,0-1.3,2.5,5.6,5.6,0,0,1-.8,4.8,8.2,8.2,0,0,1-4.5,3.4C32,32.9,28,31,27,27.7a2,2,0,0,0-2.5-1.4,2,2,0,0,0-1.4,2.5A10.5,10.5,0,0,0,33.2,36a6.3,6.3,0,0,0,5,10,5.7,5.7,0,0,0,1.8-.3,6.3,6.3,0,0,0,.5-11.8Zm-1.6,8h-.7A2.4,2.4,0,0,1,36,40.4a2.5,2.5,0,0,1,1.6-2.9h.6a2.3,2.3,0,0,1,2.2,1.7A2.2,2.2,0,0,1,38.9,41.9Z" />
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                        <p class="p-2 text-lg"> : {{$event->partners}}</p>
                    </div>
                    <div class="flex mb-5">
                        <svg version="1.0" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="w-9" viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve" fill="#701a75">
                            <g id="SVGRepo_bgCarrier" stroke-width="0" />
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                            <g id="SVGRepo_iconCarrier">
                                <g>
                                    <path fill="#701a75" d="M24.008,32.038L9.541,27.904c-0.527-0.146-1.084,0.155-1.236,0.688c-0.151,0.53,0.156,1.084,0.688,1.236 l14.467,4.134C23.551,33.987,23.643,34,23.734,34c0.435,0,0.835-0.286,0.961-0.726C24.847,32.744,24.539,32.19,24.008,32.038z" />
                                    <path fill="#701a75" d="M24.008,39.038L9.541,34.905c-0.527-0.146-1.084,0.155-1.236,0.688c-0.151,0.531,0.156,1.084,0.688,1.236 l14.467,4.133C23.551,40.987,23.643,41,23.734,41c0.435,0,0.835-0.286,0.961-0.726C24.847,39.743,24.539,39.19,24.008,39.038z" />
                                    <path fill="#701a75" d="M24.008,25.038L9.541,20.904c-0.527-0.146-1.084,0.155-1.236,0.688c-0.151,0.53,0.156,1.084,0.688,1.236 l14.467,4.134C23.551,26.987,23.643,27,23.734,27c0.435,0,0.835-0.286,0.961-0.726C24.847,25.744,24.539,25.19,24.008,25.038z" />
                                    <path fill="#701a75" d="M24.008,18.038L9.541,13.904c-0.527-0.146-1.084,0.155-1.236,0.688c-0.151,0.53,0.156,1.084,0.688,1.236 l14.467,4.134C23.551,19.987,23.643,20,23.734,20c0.435,0,0.835-0.286,0.961-0.726C24.847,18.744,24.539,18.19,24.008,18.038z" />
                                    <path fill="#701a75" d="M39.963,33.962c0.092,0,0.184-0.013,0.275-0.038l14.467-4.134c0.531-0.152,0.839-0.706,0.688-1.236 c-0.152-0.532-0.708-0.832-1.236-0.688L39.689,32c-0.531,0.152-0.839,0.706-0.688,1.236C39.128,33.676,39.528,33.962,39.963,33.962 z" />
                                    <path fill="#701a75" d="M54.459,34.905l-14.467,4.133c-0.531,0.152-0.839,0.705-0.688,1.236C39.431,40.714,39.831,41,40.266,41 c0.092,0,0.184-0.013,0.275-0.038l14.467-4.133c0.531-0.152,0.839-0.705,0.688-1.236C55.543,35.061,54.987,34.761,54.459,34.905z" />
                                    <path fill="#701a75" d="M54.459,20.904l-14.467,4.134c-0.531,0.152-0.839,0.706-0.688,1.236C39.431,26.714,39.831,27,40.266,27 c0.092,0,0.184-0.013,0.275-0.038l14.467-4.134c0.531-0.152,0.839-0.706,0.688-1.236C55.543,21.06,54.987,20.758,54.459,20.904z" />
                                    <path fill="#701a75" d="M54.459,13.904l-14.467,4.134c-0.531,0.152-0.839,0.706-0.688,1.236C39.431,19.714,39.831,20,40.266,20 c0.092,0,0.184-0.013,0.275-0.038l14.467-4.134c0.531-0.152,0.839-0.706,0.688-1.236C55.543,14.06,54.987,13.76,54.459,13.904z" />
                                    <path fill="#701a75" d="M63.219,0.414c-0.354-0.271-0.784-0.413-1.221-0.413c-0.172,0-0.345,0.022-0.514,0.066L32,7.93L2.516,0.067 c-0.17-0.045-0.343-0.066-0.515-0.066c-0.437,0-0.866,0.142-1.22,0.413C0.289,0.793,0,1.379,0,2v49.999 c0,0.906,0.609,1.699,1.484,1.933l25.873,6.899C28.089,62.685,29.887,64,32,64s3.911-1.315,4.643-3.169l25.873-6.899 C63.391,53.698,64,52.905,64,51.999V2C64,1.379,63.711,0.793,63.219,0.414z M32,54c0.173,0,0.347-0.022,0.516-0.067L62,46.07v1.954 l-30,7.941L2,48.024V46.07l29.484,7.862C31.653,53.978,31.827,54,32,54z M1.998,2.001c0,0,0.001,0,0.003,0V2L31,9.733v42L2,44 L1.998,2.001z M34.979,59.205c-0.079,1.143-0.785,2.111-1.788,2.546l-0.676,0.181c-0.169,0.045-0.343,0.067-0.516,0.067 s-0.347-0.022-0.516-0.067l-0.676-0.181c-1.003-0.435-1.709-1.403-1.788-2.546L2,51.999v-1.906l29.744,7.874 C31.828,57.989,31.914,58,32,58s0.172-0.011,0.256-0.033L62,50.093v1.906L34.979,59.205z M33,51.733v-42L62,2v42L33,51.733z" />
                                </g>
                            </g>
                        </svg>
                        <p class="p-2 text-lg">{{$event->description}}</p>
                    </div>
                    <div class="flex mb-5">
                        <svg fill="#701a75" class="w-9" version="1.1" id="Icons" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve">

                            <g id="SVGRepo_bgCarrier" stroke-width="0" />

                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                            <g id="SVGRepo_iconCarrier">
                                <path d="M28,12H14H4c-2.2,0-4,1.8-4,4s1.8,4,4,4h10h14c2.2,0,4-1.8,4-4S30.2,12,28,12z M4,18c-1.1,0-2-0.9-2-2s0.9-2,2-2h10 c1.1,0,2,0.9,2,2s-0.9,2-2,2H4z" />
                            </g>

                        </svg>
                        <p class="p-2 text-lg"> {{$event->status->name}}</p>
                    </div>
                    <div class="flex mb-5">
                        <svg class="w-9" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" fill="#701a75">
                            <g id="SVGRepo_bgCarrier" stroke-width="0" />
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                            <g id="SVGRepo_iconCarrier">
                                <defs>
                                    <style>
                                        .cls-1 {
                                            fill: none;
                                            stroke: #701a75;
                                            stroke-linecap: round;
                                            stroke-linejoin: round;
                                            stroke-width: 2px;
                                        }
                                    </style>
                                </defs>
                                <g data-name="79-users" id="_79-users">
                                    <circle class="cls-1" cx="16" cy="13" r="5" />
                                    <path class="cls-1" d="M23,28A7,7,0,0,0,9,28Z" />
                                    <path class="cls-1" d="M24,14a5,5,0,1,0-4-8" />
                                    <path class="cls-1" d="M25,24h6a7,7,0,0,0-7-7" />
                                    <path class="cls-1" d="M12,6a5,5,0,1,0-4,8" />
                                    <path class="cls-1" d="M8,17a7,7,0,0,0-7,7H7" />
                                </g>
                            </g>

                        </svg>
                        <p class="p-2 text-lg"> {{$event->number_of_participants->name}}</p>
                    </div>
                    <div class="flex mb-5">
                        <svg fill="#701a75" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="w-9" viewBox="0 0 612 612" xml:space="preserve" stroke="#701a75">

                            <g id="SVGRepo_bgCarrier" stroke-width="0" />

                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                            <g id="SVGRepo_iconCarrier">
                                <g>
                                    <g>
                                        <path d="M612,463.781c0-70.342-49.018-129.199-114.75-144.379c-10.763-2.482-21.951-3.84-33.469-3.84 c-3.218,0-6.397,0.139-9.562,0.34c-71.829,4.58-129.725,60.291-137.69,131.145c-0.617,5.494-0.966,11.073-0.966,16.734 c0,10.662,1.152,21.052,3.289,31.078C333.139,561.792,392.584,612,463.781,612C545.641,612,612,545.641,612,463.781z M463.781,561.797c-54.133,0-98.016-43.883-98.016-98.016s43.883-98.016,98.016-98.016s98.016,43.883,98.016,98.016 S517.914,561.797,463.781,561.797z" />
                                        <polygon points="482.906,396.844 449.438,396.844 449.438,449.438 396.844,449.438 396.844,482.906 482.906,482.906 482.906,449.438 482.906,449.438 " />
                                        <path d="M109.969,0c-9.228,0-16.734,7.507-16.734,16.734v38.25v40.641c0,9.228,7.506,16.734,16.734,16.734h14.344 c9.228,0,16.734-7.507,16.734-16.734V54.984v-38.25C141.047,7.507,133.541,0,124.312,0H109.969z" />
                                        <path d="M372.938,0c-9.228,0-16.734,7.507-16.734,16.734v38.25v40.641c0,9.228,7.507,16.734,16.734,16.734h14.344 c9.228,0,16.734-7.507,16.734-16.734V54.984v-38.25C404.016,7.507,396.509,0,387.281,0H372.938z" />
                                        <path d="M38.25,494.859h236.672c-2.333-11.6-3.572-23.586-3.572-35.859c0-4.021,0.177-7.999,0.435-11.953H71.719 c-15.845,0-28.688-12.843-28.688-28.688v-229.5h411.188v88.707c3.165-0.163,6.354-0.253,9.562-0.253 c11.437,0,22.61,1.109,33.469,3.141V93.234c0-21.124-17.126-38.25-38.25-38.25h-31.078v40.641c0,22.41-18.23,40.641-40.641,40.641 h-14.344c-22.41,0-40.641-18.231-40.641-40.641V54.984H164.953v40.641c0,22.41-18.231,40.641-40.641,40.641h-14.344 c-22.41,0-40.641-18.231-40.641-40.641V54.984H38.25C17.126,54.984,0,72.111,0,93.234v363.375 C0,477.733,17.126,494.859,38.25,494.859z" />
                                        <circle cx="134.774" cy="260.578" r="37.954" />
                                        <circle cx="248.625" cy="260.578" r="37.954" />
                                        <circle cx="362.477" cy="260.578" r="37.954" />
                                        <circle cx="248.625" cy="375.328" r="37.953" />
                                        <circle cx="134.774" cy="375.328" r="37.953" />
                                    </g>
                                </g>
                            </g>

                        </svg>
                        <p class="p-2 text-lg"> {{$event->date_start}}</p>
                        @if($event->date_end !== $event->date_start)
                        <p class="p-2 text-lg"> {{$event->date_end}}</p>
                        @endif
                        <p class="p-2 text-lg">{{$event->hours}}</p>
                    </div>
                    <div class="flex mb-5">
                        <svg class="w-9" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">

                            <g id="SVGRepo_bgCarrier" stroke-width="0" />

                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                            <g id="SVGRepo_iconCarrier">
                                <path d="M8 9.5H15M8 13.5H13M18 20L21 21L19.1 15.3C19.1 15.3 20 14 20 11.5C20 8.90308 18.8354 6.57817 17 5.01903M11.5 3C6.80558 3 3 6.80558 3 11.5C3 16.1944 6.80558 20 11.5 20C14.0847 20 15.3 19.1 15.3 19.1" stroke="#701a75" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </g>

                        </svg>
                        <p class="italic">{{$event->organizer_needs}}</p>
                    </div>
                    <div class="flex flex-nowrap justify-end space-x-1 ">
                        <a href="{{ route('userEvent.edit', $event) }}" class="bg-fuchsia-700 p-2 pl-3 pr-3 text-white hover:shadow-lg text-m font-semibold  ">
                            Modifier
                        </a>
                        <form method="post" action="{{ route('userEvent.destroy', $event->id) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="bg-red-500 p-2 pl-3 pr-3 text-white hover:shadow-lg text-m font-semibold">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
        <script>
            let sucessMessage = document.getElementById('success-message');

            setTimeout(() => {
                sucessMessage.classList.add('hidden');
            }, 5000);
        </script>
    </main>
</x-app-layout>