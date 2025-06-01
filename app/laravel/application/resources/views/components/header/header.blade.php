<header class="flex justify-between items-center px-10 h-18 border-b-1 border-b-muted/50 fixed w-full bg-secondary top-0 z-50">
    <div class="flex items-center justify-between grow">
        <div class="flex gap-4">
            <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 7.5H25M5 15H17.5M5 22.5H11.25" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <a href="{{ route('home') }}">
                <img class="w-18" src="{{ Vite::asset('resources/img/logo.svg') }}" alt="logo">
            </a>
        </div>
        <div>
            <!-- I let the possibility to customize the right content, just in case -->
            @isset($customHeaderSideContent)
                {{ $customHeaderSideContent }}
            @else
                <div class="flex gap-4 items-center">
                    <span>{{ Auth::user()->name }}</span>
                    <div class="w-10">
                        <img src="{{ Vite::asset('resources/img/user-photos/1.png') }}" title="{{ Auth::user()->name }}" alt="Your photo" class="object-cover h-full w-full">
                    </div>
                </div>

            @endif
        </div>
    </div>
</header>
