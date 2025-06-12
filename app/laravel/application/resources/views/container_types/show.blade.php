<x-layout>
    <x-global.top-bar :title="__('Container type info')" :breadcrumbs-items="[
        ['label'=>__('Container types'), 'href'=>route('container_types.index')],
        ['label'=>$containerType->name]
    ]">
        @can('update', $containerType)
            <div class="flex items-center">
                <x-link-button href="{{ route('container_types.edit', $containerType->id) }}" icon-name="edit">{{ __('Edit container type') }}</x-link-button>
            </div>
        @endcan
    </x-global.top-bar>
    <article class="p-4">
        <div class="flex flex-col max-w-300 gap-8 lg:mx-auto my-15 mx-5">
            <div class="flex flex-col gap-3">
                <x-global.top-bar.page-title class="text-xl">{{ __('Container type info') }}</x-global.top-bar.page-title>
                <x-forms.separator class="my-2"/>
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                    <x-forms.input :label="__('name')" name="name" disabled :value="$containerType->name"/>
                    <x-forms.input :label="__('un code')" name="un_code" :value="$containerType->un_code" disabled/>
                </div>
            </div>
            <div class="flex flex-col gap-3">
                <x-global.top-bar.page-title class="text-xl">{{ __('Specifications') }}</x-global.top-bar.page-title>
                <x-forms.separator class="my-2"/>
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
                        <x-forms.input :label="__('capacity')" name="capacity" class="lg:col-span-2" disabled :value="$containerType->capacity"/>
                        <x-forms.field :label="__('unit')" name="unit">
                            <x-global.unit-tag :unit="$containerType->unit"></x-global.unit-tag>
                        </x-forms.field>
                    </div>
                    <div class="grid gap-4">
                        <x-forms.input :label="__('dimensions (cm)')" name="dimensions" :value="$containerType->dimensions" disabled/>
                    </div>
                </div>
            </div>
        </div>
    </article>
</x-layout>
