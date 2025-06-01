<x-app>
    <x-header.header>
        @isset($customHeaderSideContent)
            <x-slot name="customHeaderSideContent">
                {{ $customHeaderSideContent }}
            </x-slot>
        @endisset
    </x-header.header>


</x-app>
