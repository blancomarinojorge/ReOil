<header class="flex justify-between items-center px-4 lg:px-10 h-[var(--header-height)] border-b-1 border-b-muted/50 fixed w-full bg-secondary top-0 z-50">
    <div class="flex items-center justify-between grow">
        <div class="flex gap-4">
            <svg id="nav-bar-toggle" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                <div class="relative" id="user-menu-container">
                    <div id="user-menu-toggle" class="flex gap-4 items-center text-sm cursor-pointer select-none">
                        <span class="hidden lg:inline">{{ Auth::user()->name }}</span>
                        <div class="w-10">
                            <img src="{{ Vite::asset('resources/img/user-photos/1.png') }}" title="{{ Auth::user()->name }}" alt="Your photo" class="object-cover h-full w-full rounded-full">
                        </div>
                    </div>

                    <!-- Dropdown menu hidden by default -->
                    <div id="user-dropdown" class="absolute right-0 mt-2 w-36 bg-secondary rounded-md shadow-lg py-2 hidden z-50 hover:cursor-pointer">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm hover:text-error hover:cursor-pointer">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const toggle = document.getElementById('user-menu-toggle');
                        const dropdown = document.getElementById('user-dropdown');

                        toggle.addEventListener('click', (e) => {
                            e.stopPropagation();
                            dropdown.classList.toggle('hidden');
                        });

                        document.addEventListener('click', () => {
                            if (!dropdown.classList.contains('hidden')) {
                                dropdown.classList.add('hidden');
                            }
                        });
                    });

                </script>
            @endif
        </div>
    </div>
</header>
