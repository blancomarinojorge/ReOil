<x-layout>
    <x-global.top-bar :title="__('Edit truck')" :breadcrumbs-items="[
        ['label'=>__('Trucks'), 'href'=>route('trucks.index')],
        ['label'=>$truck->id, 'href' => route('trucks.show',$truck->id)],
        ['label'=>__('Edit')]
    ]">
    </x-global.top-bar>
    <article class="p-4">
        <x-forms.form method="PUT" action="{{ route('trucks.update',$truck->id) }}" class="flex flex-col max-w-300 gap-8 lg:mx-auto my-15 mx-5">
            <div class="flex flex-col gap-3">
                <x-global.top-bar.page-title class="text-xl">{{ __('Truck data') }}</x-global.top-bar.page-title>
                <x-forms.separator class="my-2"/>
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
                    <x-forms.input :label="__('license plate')" name="license_plate" :value="$truck->license_plate" :required="true"/>
                    <x-forms.input :label="__('name')" name="name" :value="$truck->name"/>
                </div>
            </div>

            <div class="flex gap-3 justify-end">
                <x-link-button href="{{ route('trucks.index') }}" type="secondary">{{ __('Cancel') }}</x-link-button>
                <x-forms.button class="px-10">{{ __('Save') }}</x-forms.button>
            </div>
        </x-forms.form>
    </article>
</x-layout>
