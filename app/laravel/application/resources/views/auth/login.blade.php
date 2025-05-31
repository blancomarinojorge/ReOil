<x-app>
    <x-header.header-public-pages>
        <div class="flex gap-4 items-center">
            <span class="text-sm hidden sm:block">{{ __("Don´t have an account?") }}</span>
            <x-link-button href="{{ route('registration') }}">Sign in</x-link-button>
        </div>
    </x-header.header-public-pages>

    <main class="flex items-center justify-center xl:h-[calc(100vh-4.5rem-1px)] mt-18">
        <section id="login" class="grow p-auto space-y-4 overflow-x-hidden my-20 flex flex-col items-center">
            <div class="flex flex-col rounded-md bg-tertiary/5 p-10 w-[90%] max-w-xl sm:w-[75%]">
                <span class="text-3xl mb-4">{{ __('Login to your account') }}</span>
                <span class="text-sm text-muted">{{ __('Enter the email address provided by your administrator') }}</span>
                <x-forms.form method="POST" action="{{ route('login.store') }}" class="mt-10 flex flex-col gap-5">
                    <x-forms.input name="email" label="email" :placeholder="__('Enter your email address')"/>
                    <x-forms.input name="password" type="password" label="password" :placeholder="__('Enter your password')"/>
                    <x-forms.button class="py-4 mt-3">{{ __("Login") }}</x-forms.button>
                </x-forms.form>
                <x-forms.separator/>
                <x-link>{{ __('Forgot password?') }}</x-link>
            </div>
            <p class="w-[75%] mx-auto max-w-xl text-muted text-xs">
                {!! __('messages.consent_message',
                        [
                            'terms' => '<a href="#" class="underline hover:text-tertiary/80">'.__("Terms of Service").'</a>',
                            'privacy' => '<a href="#" class="underline hover:text-tertiary/80">'.__("Privacy Policy").'</a>',
                            'cookie' => '<a href="#" class="underline hover:text-tertiary/80">'.__("Cookie Policy").'</a>',
                        ]
                ) !!}
            </p>
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
