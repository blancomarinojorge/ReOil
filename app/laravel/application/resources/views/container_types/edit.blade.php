<x-layout>
    <x-global.top-bar :title="__('Edit container type')" :breadcrumbs-items="[
        ['label'=>__('Container types'), 'href'=>route('container_types.index')],
        ['label'=>$containerType->name, 'href'=>route('container_types.show', $containerType->id)],
        ['label'=>__('Edit')]
    ]">
    </x-global.top-bar>
    <article class="p-4">
        <x-forms.form method="PUT" action="{{ route('container_types.update', $containerType->id) }}" class="flex flex-col max-w-300 gap-8 lg:mx-auto my-15 mx-5">
            <div class="flex flex-col gap-3">
                <x-global.top-bar.page-title class="text-xl">{{ __('Container type info') }}</x-global.top-bar.page-title>
                <x-forms.separator class="my-2"/>
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                    <x-forms.input :label="__('name')" name="name" :required="true" placeholder="UN Certified Box" :value="$containerType->name"/>
                    <x-forms.input :label="__('un code')" name="un_code" placeholder="UN 1H1/Y1.9/200/23/D/BAM1234" :value="$containerType->un_code"/>
                </div>
            </div>
            <div class="flex flex-col gap-3">
                <x-global.top-bar.page-title class="text-xl">{{ __('Specifications') }}</x-global.top-bar.page-title>
                <x-forms.separator class="my-2"/>
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
                        <x-forms.input :label="__('capacity')" name="capacity" :required="true" class="lg:col-span-2" placeholder="150" :value="$containerType->capacity"/>
                        <x-forms.field :label="__('unit')" name="unit" :required="true">
                            <select class="py-3 pl-5 border-1 border-tertiary/40 focus:border-tertiary/70" name="unit" id="unit">
                                <option value="">{{ __('Select a unit...') }}</option>
                                @foreach(\App\Enums\Unit::cases() as $unit)
                                    <option value="{{ $unit->value }}" @if(old('unit', $containerType->unit->value) == $unit->value) selected @endif>{{ __($unit->getLabel()) }}</option>
                                @endforeach
                            </select>
                        </x-forms.field>
                    </div>
                    <div class="grid gap-4 grid-cols-3">
                        <x-forms.input :label="__('length')" name="length_cm" :value="$containerType->length_cm"/>
                        <x-forms.input :label="__('width')" name="width_cm" :value="$containerType->width_cm"/>
                        <x-forms.input :label="__('height')" name="height_cm" :value="$containerType->height_cm"/>
                    </div>
                </div>
            </div>
            <div class="flex gap-3 justify-end">
                <x-link-button href="{{ route('container_types.show', $containerType->id) }}" type="secondary">{{ __('Cancel') }}</x-link-button>
                <x-forms.button class="px-10">{{ __('Save') }}</x-forms.button>
            </div>
        </x-forms.form>
    </article>
</x-layout>
