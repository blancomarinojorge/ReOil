<x-layout>
    <x-global.top-bar :title="__('Your company')" :breadcrumbs-items="[
        ['label'=>__('Company')],
    ]">
        <div class="flex items-center">
            <x-link-button href="{{ route('company.edit') }}" icon-name="edit">{{ __('Edit company') }}</x-link-button>
        </div>
    </x-global.top-bar>
    <article class="p-4">
        <div class="flex flex-col max-w-150 gap-8 lg:mx-auto my-15 mx-5">
            <div class="flex flex-col gap-3">
                <x-global.top-bar.page-title class="text-xl">{{ __('Company data') }}</x-global.top-bar.page-title>
                <x-forms.separator class="my-2"/>
                <div class="grid grid-cols-1 gap-4">
                    <x-forms.input :label="__('name')" name="name" :value="$company->name" disabled/>
                    <x-forms.input :label="__('nif')" name="nif" :value="$company->nif" disabled/>
                </div>
            </div>
        </div>
    </article>
</x-layout>
