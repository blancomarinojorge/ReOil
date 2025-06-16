<x-app>
    <x-header.header>
        @isset($customHeaderSideContent)
            <x-slot name="customHeaderSideContent">
                {{ $customHeaderSideContent }}
            </x-slot>
        @endisset
    </x-header.header>

    <main class="flex flex-row pt-[var(--header-height)]">
        <x-global.navbar.navigation-bar/>
        <section {{ $attributes->twMerge(['class' => 'grow overflow-x-hidden']) }}>
            {{ $slot }}
        </section>
    </main>
</x-app>
