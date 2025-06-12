<x-layout>
    <x-global.top-bar :title="__('Container info')" :breadcrumbs-items="[
        ['label'=>__('Containers'), 'href'=>route('containers.index')],
        ['label'=>$container->containerType->name]
    ]">
        @can('update', $container)
            <div class="flex items-center">
                <x-link-button href="{{ route('containers.edit', $container->id) }}" icon-name="edit">{{ __('Edit client container') }}</x-link-button>
            </div>
        @endcan
    </x-global.top-bar>
    <article class="p-4">
        <div class="flex flex-col max-w-300 gap-8 lg:mx-auto my-15 mx-5">
            <div class="flex flex-col gap-3">
                <x-global.top-bar.page-title class="text-xl">{{ __('Container info') }}</x-global.top-bar.page-title>
                <x-forms.separator class="my-2"/>
                <div class="grid grid-cols-1 gap-4">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <x-forms.field :label="__('client')" name="client_id">
                            <x-global.tables.model-link href="{{ route('clients.show', $container->client->id) }}">
                                {{ $container->client->name }}
                            </x-global.tables.model-link>
                        </x-forms.field>
                        <x-forms.field :label="__('container type')" name="container_type_id">
                            <x-global.tables.model-link href="{{ route('container_types.show', $container->containerType->id) }}">
                                {{ $container->containerType->name }}
                            </x-global.tables.model-link>
                        </x-forms.field>
                    </div>
                    <div class="grid">
                        <x-forms.textarea disabled :label="__('observations')" name="observations" :value="$container->observations" class="h-60"/>
                    </div>
                </div>
            </div>
            <div class="flex gap-3 justify-end">
                <x-link-button href="{{ route('containers.show', $container->id) }}" type="secondary">{{ __('Cancel') }}</x-link-button>
                <x-forms.button class="px-10">{{ __('Save') }}</x-forms.button>
            </div>
        </div>
    </article>
</x-layout>
