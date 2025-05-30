<x-app>
    <x-header.header-public-pages>
        <div class="flex gap-4">
            <x-link-button href="{{ route('registration') }}" type="secondary">Log in</x-link-button>
            <x-link-button href="{{ route('registration') }}">Sign in</x-link-button>
        </div>
    </x-header.header-public-pages>

    <main class="flex h-[calc(100vh-4.5rem)]">
        <section id="login" class="grow m-auto">
            <div class="flex flex-col rounded-md bg-tertiary/5 p-10 w-[75%] mx-auto max-w-xl">
                <span class="text-3xl mb-4">{{ __('Login to your account') }}</span>
                <span class="text-sm text-muted">{{ __('Enter the email address provided by your administrator') }}</span>
                <form method="POST" action="{{ route('login.store') }}" class="mt-10 flex flex-col gap-5">
                    <x-forms.input name="email" label="email" required="true"/>
                    <x-forms.input name="password" label="password" required="true"/>
                    <x-forms.button class="px-10">Login</x-forms.button>
                </form>
            </div>
        </section>
        <div class="overflow-hidden h-full w-2/3 hidden relative 2xl:block">
            <!-- Image -->
            <img src="{{ Vite::asset('resources/img/truck1.jpeg') }}" aria-disabled="true" alt=""
                 class="w-full h-full object-cover">
            <!-- Blur Overlay -->
            <div class="absolute inset-0 bg-black/30 backdrop-blur-sm"></div>
        </div>
</main>
</x-app>
