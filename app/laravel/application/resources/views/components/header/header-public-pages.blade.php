<header class="flex justify-between items-center px-10 h-18 border-b-1 border-b-muted/50 fixed w-full bg-secondary top-0 z-50">
    <div class="flex items-center justify-between max-w-6xl grow lg:mx-auto">
        <div>
            <a href="{{ route('hero.page') }}">
                <img class="w-18" src="{{ Vite::asset('resources/img/logo.svg') }}" alt="logo">
            </a>
        </div>
        <div>
            {{ $slot }}
        </div>
    </div>
</header>
