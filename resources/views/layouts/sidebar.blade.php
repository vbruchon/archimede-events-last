<div class=" text-white w-64 h-screen fixed top-0 left-0 transform transition-transform duration-300 z-50">
    <div class="p-4 flex justify-end">
        <!-- Close Button -->
        <button @click="open = false" class="text-white focus:outline-none block md:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    <div class="p-2 h-full">
        <div class="px-8 -mt-6 md:px-0 md:mt-0">
            <x-application-logo class="text-white object-contain" />
        </div>
        <ul class="mt-6 space-y-2 font-medium">
            @foreach(\App\Helpers\NavigationHelper::getNavigationLinks() as $link)
            @if ($link['label'] === 'Tableau de bord')
            <li class="w-full mb-6">
                @else
            <li class="w-full">
                @endif

                @if ($link['label'] === 'Mon profil')
            <li>
                <hr class="mt-4 mb-6 border-gray-200">
            </li>
            @endif


            @if ($link['label'] === 'Déconnexion')
            <form id="logout-form" method="POST" action="{{ route('logout') }}">
                @csrf
                <x-nav-link href="route('logout')" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="w-full flex items-center px-2 py-2 rounded-lg text-white hover:bg-custom-blue">
                    {!! $link['svg'] !!}
                    <span class="ml-3 ">{{ $link['label'] }}</span>
                </x-nav-link>
            </form>
            @else

            <a href="{{ $link['url'] }}" class="nav-item w-full flex items-center px-2 py-2 rounded-lg text-white hover:bg-custom-blue hover:border-b-4" data-url="{{ $link['url'] }}">
                {!! $link['svg'] !!}
                <span class="ml-3">{{ $link['label'] }}</span>
            </a>



            </li>
            @endif


            @endforeach
        </ul>
    </div>
</div>

<script>
    const current_url = window.location.pathname;
    console.log(current_url);
    const linkElements = document.querySelectorAll('.nav-item');

    linkElements.forEach(linkElement => {
        const linkUrl = linkElement.href;
        //Create instance URL by complete url and extract pathname access of URL
        const linkPathname = new URL(linkUrl).pathname;

        // Vérifier si l'URL de la page correspond à l'URL du lien
        if (current_url === linkPathname) {
            linkElement.classList.add('bg-custom-blue');
            linkElement.classList.add('border-b-4');
        }
    });
</script>