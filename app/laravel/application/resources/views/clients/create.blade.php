<x-layout>
    <x-global.top-bar :title="__('New client')" :breadcrumbs-items="[
        ['label'=>__('Clients'), 'href'=>route('clients.index')],
        ['label'=>__('New client')]
    ]">
    </x-global.top-bar>
    <article class="p-4">
        <x-forms.form method="POST" action="{{ route('clients.store') }}" enctype="multipart/form-data" class="flex flex-col max-w-300 gap-8 lg:mx-auto my-15 mx-5">
            <div class="flex flex-col gap-3">
                <x-global.top-bar.page-title class="text-xl">{{ __('Contact data') }}</x-global.top-bar.page-title>
                <x-forms.separator class="my-2"/>
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
                    <x-forms.input :label="__('name')" name="name" :required="true"/>
                    <x-forms.input :label="__('phone')" name="phone"/>
                    <x-forms.input :label="__('email')" name="email"/>
                </div>
            </div>
            <div class="flex flex-col gap-3">
                <x-global.top-bar.page-title class="text-xl">{{ __('Location data') }}</x-global.top-bar.page-title>
                <x-forms.separator class="mt-2"/>
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
                    <x-forms.input :label="__('address')" name="address" class="lg:col-span-2" placeholder="Rúa Antonio Amigo, 8, 15860 Santa Comba, A Coruña"/>
                    <x-forms.input :label="__('coordinates')" name="latitude_longitude" placeholder="42.87910236891688, -8.547280818279893"/>
                </div>
            </div>

            <div class="flex gap-3 justify-end">
                <x-link-button href="{{ route('clients.index') }}" type="secondary">{{ __('Cancel') }}</x-link-button>
                <x-forms.button class="px-10">{{ __('Save') }}</x-forms.button>
            </div>
        </x-forms.form>
    </article>
</x-layout>
