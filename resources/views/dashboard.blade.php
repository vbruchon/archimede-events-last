<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl ml-6 text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="md:py-12">
        <div class="mx-auto px-6 md:mt-3 lg:px-8">
            <div class="bg-white shadow-sm overflow-hidden sm:rounded-lg p-8 max-w-48">
                <div class="text-gray-900 md:max-w-2x1 lg:max-w-2x1">
                    @auth
                    <h1 class="text-2xl mb-6">Bonjour {{ Auth::user()->name }},</h1>
                    @endauth
                    <h2 class="text-xl mb-6">Bienvenue sur votre tableau de bord Archimède !</h2>

                    <div class="grid md:grid-cols-1 xl:grid-cols-3 gap-4 md:gap-8 mb-8">
                        <x-custom-button route="userEvent.all" content="Consulter les événements" />
                        <x-custom-button route="userEvent.create" content="Ajouter un événement" />
                        <x-custom-button route="userEvent.my" content="Voir mes événements" />
                    </div>

                    <section class="grid gap-6 mb-4">
                        <div class="bg-white shadow-lg shadow-gray-350 rounded-lg p-8">
                            <!-- SVG + Span Flex Container -->
                            <div class="flex items-center">
                                <!-- SVG Icon -->
                                <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-blue-600 bg-custom-blue rounded-full mr-6">
                                    {!! $svg['event'] !!}
                                </div>
                                <!-- Span Text -->
                                <div>
                                    <span class="block text-gray-500">Événements créés</span>
                                    <span class="block text-2xl font-bold">{{ $countEvents }}</span>
                                </div>
                            </div>
                    </section>

                    @if($isAdmin)
                    <section>
                        <section class="grid gap-6 mb-4">
                            <div class="bg-white shadow-lg shadow-gray-350 rounded-lg p-8">
                                <!-- SVG + Span Flex Container -->
                                <div class="flex items-center mb-6">
                                    <!-- SVG Icon -->
                                    <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-blue-600 bg-custom-blue rounded-full mr-6">
                                        {!! $svg['user'] !!}
                                    </div>
                                    <div class="w-full">
                                        <span class="block text-gray-500">Utilisateurs</span>
                                        <span class="block text-2xl font-bold">{{$countUsers}}</span>
                                    </div>
                                </div>
                                <!-- SVG + Span Flex Container -->
                                <div class="flex items-center">
                                    <!-- SVG Icon -->
                                    <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-blue-600 bg-custom-blue rounded-full mr-6">
                                        {!! $svg['user'] !!}
                                    </div>
                                    <div class="w-full">
                                        <span class="block text-gray-500">Dernier utilisateur inscrit</span>
                                        <span class="block text-xl font-bold">{{$latestUser->name}}</span>
                                        <span class="block text-xs font-bold">{{$latestUser->email}}</span>
                                    </div>
                                </div>
                                @endif
                        </section>

                        <section class="grid gap-6 mb-4">
                            <div class="bg-white shadow-lg shadow-gray-350 rounded-lg p-8">
                                <!-- SVG + Span Flex Container -->
                                <div class="flex items-center">
                                    <!-- SVG Icon -->
                                    <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-blue-600 bg-custom-blue rounded-full mr-6">
                                        {!! $svg['event'] !!}
                                    </div>
                                    <!-- Span Text -->
                                    <div>
                                        <span class="block text-2xl font-bold">Dernièrs événements créés :</span>
                                    </div>
                                </div>

                                <!-- Full-Width Table -->
                                <div class="mt-4">
                                    <table class="w-full border mx-auto my-4">
                                        <thead>
                                            <tr class="bg-[rgb(24,41,70)] text-white border-b">
                                                <th class="p-2 border-r text-m font-thin">
                                                    <div class="flex items-center justify-center">Nom de l'événement</div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($lastEventsCreate as $lastEvent)
                                            <tr class="bg-white text-center border-b text-gray-600">
                                                <td class="p-2 border-r py-4">{{ $lastEvent->name }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                </div>
                </section>

                <section class="grid gap-6 mb-4">
                    <div class="bg-white shadow-lg shadow-gray-350 rounded-lg p-8">
                        <!-- SVG + Span Flex Container -->
                        <div class="flex items-center">
                            <!-- SVG Icon -->
                            <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-blue-600 bg-custom-blue rounded-full mr-6">
                                {!! $svg['event'] !!}
                            </div>
                            <!-- Span Text -->
                            <div>
                                <span class="block text-2xl font-bold">Dernière contribution :</span>
                                @if($userEvent !== null)
                                <span class="block text-gray-500">{{ $userEvent->name }}</span>
                                @else
                                <span class="block text-gray-500">Aucun événement encore créé</span>
                                @endif
                            </div>
                        </div>
                </section>

                <section class="grid gap-6 mb-4">
                    <div class="bg-white shadow-lg shadow-gray-350 rounded-lg p-4 md:p-8">
                        <!-- SVG + Span Flex Container -->
                        <div class="flex items-center">
                            <!-- SVG Icon -->
                            <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-blue-600 bg-custom-blue rounded-full mr-6">
                                {!! $svg['event'] !!}
                            </div>
                            <!-- Span Text -->
                            <div>
                                <span class="block text-2xl font-bold">Prochains événements dans les 30 jours :</span>
                            </div>
                        </div>
                        <!-- Full-Width Table -->
                        <div class="mt-4">
                            <table class="w-full border mx-auto my-4">
                                <thead>
                                    <tr class="bg-[rgb(24,41,70)] text-white border-b">
                                        <th class="p-2 border-r text-m font-thin">
                                            <div class="flex items-center justify-center">Nom de l'événement</div>
                                        </th>
                                        <th class="p-2 border-r text-m font-thin">
                                            <div class="flex items-center justify-center">Date de début</div>
                                        </th>
                                        <th class="p-2 border-r text-m font-thin">
                                            <div class="flex items-center justify-center">Heure</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($futureEvents as $event)
                                    <tr class="bg-white text-center border-b text-gray-600 transition-colors duration-300">
                                        <td class="p-2 border-r py-4">{{ $event->name }}</td>
                                        <td class="p-2 border-r py-4">{{ \Carbon\Carbon::parse($event->date_start)->format('j F Y') }}</td>
                                        <td class="p-2 border-r py-4">{{ \Carbon\Carbon::parse($event->date_start)->format('G\hi') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>