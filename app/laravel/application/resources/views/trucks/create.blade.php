<x-layout>
    <x-global.top-bar :title="__('New truck')" :breadcrumbs-items="[
        ['label'=>__('Trucks'), 'href' => route('trucks.index') ],
        ['label' => __('New truck')]
    ]">
    </x-global.top-bar>
    <article class="p-4">
        <x-forms.form method="POST" action="{{ route('trucks.store') }}" class="flex flex-col max-w-300 gap-8 lg:mx-auto my-15 mx-5">
            <div class="flex flex-col gap-3">
                <x-global.top-bar.page-title class="text-xl">{{ __('Truck data') }}</x-global.top-bar.page-title>
                <x-forms.separator class="my-2"/>
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
                    <x-forms.input :label="__('license plate')" name="license_plate" :required="true"/>
                    <x-forms.input :label="__('name')" name="name" />
                </div>
            </div>

            <div class="flex gap-3 justify-end">
                <x-link-button href="{{ route('trucks.index') }}" type="secondary">{{ __('Cancel') }}</x-link-button>
                <x-forms.button class="px-10">{{ __('Save') }}</x-forms.button>
            </div>
        </x-forms.form>
    </article>
</x-layout>
