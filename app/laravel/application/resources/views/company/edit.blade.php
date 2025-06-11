<x-layout>
    <x-global.top-bar :title="__('Your company')" :breadcrumbs-items="[
        ['label'=>__('Company'), 'href' => route('company.show')],
        ['label'=>__('Edit')]
    ]">
    </x-global.top-bar>
    <article class="p-4">
        <x-forms.form method="PUT" action="{{ route('company.update') }}" class="flex flex-col max-w-150 gap-8 lg:mx-auto my-15 mx-5">
            <div class="flex flex-col gap-3">
                <x-global.top-bar.page-title class="text-xl">{{ __('Company data') }}</x-global.top-bar.page-title>
                <x-forms.separator class="my-2"/>
                <div class="grid grid-cols-1 gap-4 ">
                    <x-forms.input :label="__('name')" name="name" :value="$company->name" :required="true"/>
                    <x-forms.input :label="__('nif')" name="nif" :value="$company->nif"/>
                </div>
                <div class="flex gap-3 justify-end">
                    <x-link-button href="{{ route('company.show') }}" type="secondary">{{ __('Cancel') }}</x-link-button>
                    <x-forms.button class="px-10">{{ __('Save') }}</x-forms.button>
                </div>
            </div>
        </x-forms.form>
    </article>
</x-layout>
