<x-app>
    <x-header.header-public-pages>
        <div class="flex gap-4">
            <x-link-button href="{{ route('login') }}" type="secondary">{{ __('Log in') }}</x-link-button>
            <x-link-button href="{{ route('registration') }}">{{ __('Sign Up') }}</x-link-button>
        </div>
    </x-header.header-public-pages>

    <main class="mt-18">
        <section id="web-app" class="flex flex-col 2xl:flex-row w-full 2xl:h-200 relative items-center overflow-x-hidden">
            <div class="w-full flex justify-center mt-25 mb-10 px-20 2xl:w-[45%] 2xl:justify-end 2xl:mb-25">
                <div class="flex flex-col items-start gap-5 max-w-xl">
                    <h1 class="text-4xl">The best oil management system, in your hands.</h1>
                    <p class="text-muted">Manage and track oil waste collection efficiently and compliantly. Streamline oil waste pickup operations with real-time tracking and reporting.</p>
                    <x-link-button href="{{ route('registration') }}" class="mt-4 px-20 flex-none md:px-25">{{ __('Sign Up') }}</x-link-button>
                </div>
            </div>
            <div class="flex grow h-full w-full items-center justify-end 2xl:justify-start 2xl:w-auto">
                <div class="rounded-md max-h-170 max-w-260 overflow-hidden translate-x-20 2xl:translate-x-0 2xl:max-h-90 2xl:max-w-180">
                    <img src="{{ Vite::asset('resources/img/dashboard.png') }}" alt="" class="object-cover w-full h-full"/>
                </div>
            </div>
            <div class="hidden h-full w-1/2 absolute overflow-hidden right-0 z-[-1] 2xl:block">
                <img class="object-cover w-full h-full" alt="" src="{{ Vite::asset('resources/img/hero-section1-bg.png') }}" aria-disabled="true"/>
                <div class="absolute inset-0 bg-black/30 backdrop-blur-sm"></div>
            </div>
        </section>

        <section id="clients" class="flex flex-col text-center my-30 gap-15 items-center overflow-x-hidden 2xl:my-60">
            <h4 class="text-2xl text-muted">Our clients trust us</h4>
            <div class="flex gap-20  max-w-250 overflow-x-hidden [mask-image:_linear-gradient(to_right,transparent_0,_black_128px,_black_calc(100%-150px),transparent_100%)]">
                <div class="flex gap-20 animate-slide-images">
                    <div class="inline-flex gap-20">
                        <div class="w-30 h-30 shrink-0 rounded-md opacity-[65%]">
                            <img src="{{ Vite::asset('resources/img/clients-logos/1.svg') }}" alt="" class="object-cover w-full h-full rounded-sm">
                        </div>
                        <div class="w-30 h-30 shrink-0 rounded-md opacity-[65%]">
                            <img src="{{ Vite::asset('resources/img/clients-logos/2.svg') }}" alt="" class="object-cover w-full h-full rounded-sm">
                        </div>
                        <div class="w-30 h-30 shrink-0 rounded-md opacity-[65%]">
                            <img src="{{ Vite::asset('resources/img/clients-logos/3.svg') }}" alt="" class="object-cover w-full h-full rounded-sm">
                        </div>
                        <div class="w-30 h-30 shrink-0 rounded-md opacity-[65%]">
                            <img src="{{ Vite::asset('resources/img/clients-logos/4.svg') }}" alt="" class="object-cover w-full h-full rounded-sm">
                        </div>
                        <div class="w-30 h-30 shrink-0 rounded-md opacity-[65%]">
                            <img src="{{ Vite::asset('resources/img/clients-logos/5.svg') }}" alt="" class="object-cover w-full h-full rounded-sm">
                        </div>
                    </div>

                    <!-- repeated logos, so i can make the loop work -->
                    <div class="inline-flex gap-20" aria-hidden="true">
                        <div class="w-30 h-30 shrink-0 rounded-md opacity-[65%]">
                            <img src="{{ Vite::asset('resources/img/clients-logos/1.svg') }}" alt="" class="object-cover w-full h-full rounded-sm">
                        </div>
                        <div class="w-30 h-30 shrink-0 rounded-md opacity-[65%]">
                            <img src="{{ Vite::asset('resources/img/clients-logos/2.svg') }}" alt="" class="object-cover w-full h-full rounded-sm">
                        </div>
                        <div class="w-30 h-30 shrink-0 rounded-md opacity-[65%]">
                            <img src="{{ Vite::asset('resources/img/clients-logos/3.svg') }}" alt="" class="object-cover w-full h-full rounded-sm">
                        </div>
                        <div class="w-30 h-30 shrink-0 rounded-md opacity-[65%]">
                            <img src="{{ Vite::asset('resources/img/clients-logos/4.svg') }}" alt="" class="object-cover w-full h-full rounded-sm">
                        </div>
                        <div class="w-30 h-30 shrink-0 rounded-md opacity-[65%]">
                            <img src="{{ Vite::asset('resources/img/clients-logos/5.svg') }}" alt="" class="object-cover w-full h-full rounded-sm">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="mobile-app" class="flex flex-col-reverse md:flex-row w-full md:h-200 relative items-center overflow-x-hidden mb-30">
            <div class="w-1/2 flex justify-center mx-20 items-center md:justify-end 2xl:mx-0">
                <div class="h-auto w-70 perspective-[1000px] rounded-lg">
                    <img src="{{ Vite::asset('resources/img/android-app.png') }}" alt="Android app" class="object-cover shadow-[0_30px_60px_rgba(0,0,0,0.6)] rounded-md h-full w-full transform-3d rotate-y-[15deg] rotate-x-[5deg]"/>
                </div>
            </div>
            <div class="w-full flex my-15 px-20 justify-center 2xl:w-[45%] 2xl:justify-start">
                <div class="flex flex-col items-start gap-5 max-w-sm">
                    <h1 class="text-4xl">Mobile app for your truck drivers</h1>
                    <p class="text-muted">A simple app for drivers to view schedules, follow optimized routes, and log oil waste pickups in real-time.</p>
                </div>
            </div>
            <div class="hidden h-full w-[40%] absolute overflow-hidden left-0 z-[-1] 2xl:block">
                <img class="object-cover w-full h-full blur-xs" alt="" src="{{ Vite::asset('resources/img/truck2.png') }}" aria-disabled="true"/>
                <div class="absolute inset-0 bg-black/70 backdrop-blur-sm"></div>
            </div>
        </section>
    </main>
    <footer>
        <div class="flex flex-col items-center justify-center h-30 border-t-[0.5px] border-muted">
            <div class="grow flex items-center">
                <div>
                    <img class="w-12" src="{{ Vite::asset('resources/img/logo.svg') }}" alt="logo">
                </div>
            </div>
            <div class="bg-primary text-secondary-soft text-xs w-full flex justify-center rounded-b-md py-0.5">
                © 2025 ReOil. All rights reserved
            </div>
        </div>
    </footer>
</x-app>
