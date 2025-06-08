<x-layout>
    <x-global.top-bar :title="__('Truck info')" :breadcrumbs-items="[
        ['label'=>__('Trucks'), 'href' => route('trucks.index') ],
        ['label'=>$truck->id],
    ]">
        @can('update', $truck)
            <div class="flex items-center">
                <x-link-button href="{{ route('trucks.edit', $truck->id) }}" icon-name="edit">{{ __('Edit truck') }}</x-link-button>
            </div>
        @endcan
    </x-global.top-bar>
    <article class="p-4">
        <div class="flex flex-col max-w-300 gap-8 lg:mx-auto my-15 mx-5">
            <div class="flex flex-col gap-3">
                <x-global.top-bar.page-title class="text-xl">{{ __('Truck data') }}</x-global.top-bar.page-title>
                <x-forms.separator class="my-2"/>
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
                    <x-forms.input :label="__('license plate')" name="license_plate" :value="$truck->license_plate" disabled/>
                    <x-forms.input :label="__('name')" name="name" :value="$truck->name" disabled/>
                    <x-forms.input :label="__('creation date')" name="creation_date" :value="$truck->created_at" disabled/>
                </div>
            </div>
        </div>
    </article>
</x-layout>
