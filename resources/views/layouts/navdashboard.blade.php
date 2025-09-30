<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-custom-purple" id="menu">
        <x-application-logo class="text-white" />

        <ul class="mt-8 space-y-2 font-medium">
            @foreach(\App\Helpers\NavigationHelper::getNavigationLinks() as $link)
            @if ($link['label'] === 'Tableau de bord')
            <li class="w-full mb-8">
                @else
            <li class="w-full">
                @endif

                @if ($link['label'] === 'Mon profil')
            <li>
                <hr class="mt-6 mb-4 border-gray-200">
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


</aside>
<div class="hide" id="displayMenuMobile">
    <img src="image/MenuBurger.png" alt="menu" onclick="showMenu()" />
</div>

<div class="hide" id="undisplayMenuMobile">
    <img src="image/FermerMenu.png" alt="fermer" onclick="hideMenu()" />
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

    iconeMobile = document.getElementById("displayMenuMobile");
    iconeFermerMobile = document.getElementById("undisplayMenuMobile");
    menuDesktop = document.getElementById("menu");

    if (screen.width < 1024) {
        menuDesktop.classList.add("hide");
        iconeMobile.classList.remove("hide");
    }

    function showMenu() {
        iconeMobile.classList.add("hide");
        iconeFermerMobile.classList.remove("hide");
        iconeFermerMobile.classList.add("passeDevant");
        menuDesktop.classList.remove("hide");
    }

    function hideMenu() {
        iconeMobile.classList.remove("hide");
        iconeFermerMobile.classList.add("hide");
        iconeFermerMobile.classList.remove("passeDevant");
        menuDesktop.classList.add("hide");
    }
</script>

<style>
    .hide {
        display: none;
    }

    .passeDevant {
        position: absolute;
        z-index: 20000;
    }
</style>