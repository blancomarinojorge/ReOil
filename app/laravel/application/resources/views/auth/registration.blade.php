<x-app>
    <x-header.header-public-pages>
        <div class="flex gap-4 items-center">
            <span class="text-sm hidden sm:block">{{ __("Already have an account?") }}</span>
            <x-link-button href="{{ route('login') }}">{{ __("Login") }}</x-link-button>
        </div>
    </x-header.header-public-pages>

    <main class="flex items-center justify-center xl:h-[calc(100vh-4.5rem-1px)] mt-18">
        <section id="login" class="grow p-auto space-y-4 overflow-x-hidden my-20 flex flex-col items-center">
            <div class="flex flex-col rounded-md bg-tertiary/5 p-10 w-[90%] max-w-xl sm:w-[75%]">
                <span class="text-3xl mb-4">{{ __('Create your account') }}</span>
                <span class="text-sm text-muted">{{ __('Enter your company name and your new admin account credentials') }}</span>
                <x-forms.form method="POST" action="{{ route('registration.store') }}" class="mt-10 flex flex-col gap-5">
                    <x-forms.input name="company" type="text" label="{{ __('company name') }}" required="true" :placeholder="__('Enter your company name')"/>
                    <x-forms.separator class="my-2"/>
                    <x-forms.input name="email" label="email" required="true" :placeholder="__('Enter your email address')"/>
                    <x-forms.input name="password" type="password" label="password" required="true" :placeholder="__('Enter your password')"/>
                    <x-forms.input name="password_confirmation" type="password" label="repeat password" required="true" :placeholder="__('Repeat your password')"/>
                    <x-forms.button class="py-4 mt-3">{{ __("Sign Up") }}</x-forms.button>
                </x-forms.form>
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
    </main>
</x-app>
