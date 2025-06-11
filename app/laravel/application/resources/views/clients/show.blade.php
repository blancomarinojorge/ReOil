<x-layout>
    <x-global.top-bar :title="__('Client data')" :breadcrumbs-items="[
        ['label'=>__('Clients'), 'href'=>route('clients.index')],
        ['label'=> $client->name ]
    ]">
    @can('update', $client)
        <div class="flex items-center">
            <x-link-button href="{{ route('clients.edit', $client->id) }}" icon-name="edit">{{ __('Edit client') }}</x-link-button>
        </div>
    @endcan
    </x-global.top-bar>
    <article class="p-4">
        <div class="flex flex-col max-w-300 gap-8 lg:mx-auto my-15 mx-5">
            <div class="flex flex-col gap-3">
                <x-global.top-bar.page-title class="text-xl">{{ __('Contact data') }}</x-global.top-bar.page-title>
                <x-forms.separator class="my-2"/>
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
                    <x-forms.input :label="__('name')" name="name" :value="$client->name" disabled/>
                    <x-forms.input :label="__('phone')" name="phone" :value="$client->phone" disabled/>
                    <x-forms.input :label="__('email')" name="email" :value="$client->email" disabled/>
                </div>
            </div>
            <div class="flex flex-col gap-3">
                <x-global.top-bar.page-title class="text-xl">{{ __('Location data') }}</x-global.top-bar.page-title>
                <x-forms.separator class="mt-2"/>
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
                    <x-forms.input :label="__('address')" name="address" class="lg:col-span-2" :value="$client->address" disabled/>
                    <x-forms.input :label="__('coordinates')" name="latitude_longitude" :value="$client->latitude_longitude" disabled/>
                </div>
            </div>
        </div>
    </article>
</x-layout>
