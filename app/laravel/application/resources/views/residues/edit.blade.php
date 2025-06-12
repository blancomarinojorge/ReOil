<x-layout>
    <x-global.top-bar :title="__('Edit residue')" :breadcrumbs-items="[
        ['label'=>__('Residues'), 'href'=>route('residues.index')],
        ['label'=> $residue->name, 'href'=>route('residues.show',$residue->id)],
        ['label'=>__('Edit residue')]
    ]">
    </x-global.top-bar>
    <article class="p-4">
        <x-forms.form method="PUT" action="{{ route('residues.update', $residue->id) }}" class="flex flex-col max-w-300 gap-8 lg:mx-auto my-15 mx-5">
            <div class="flex flex-col gap-3">
                <x-global.top-bar.page-title class="text-xl">{{ __('Residue data') }}</x-global.top-bar.page-title>
                <x-forms.separator class="my-2"/>
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
                    <x-forms.input :label="__('name')" name="name" :required="true" class="lg:col-span-2" :value="$residue->name"/>
                    <x-forms.field :label="__('unit')" name="unit" :required="true">
                        <select class="py-3 pl-5 border-1 border-tertiary/40 focus:border-tertiary/70" name="unit" id="unit">
                            <option value="">{{ __('Select a unit...') }}</option>
                            @foreach(\App\Enums\Unit::cases() as $unit)
                                <option value="{{ $unit->value }}" @if(old('unit', $residue->unit->value) == $unit->value) selected @endif>{{ __($unit->getLabel()) }}</option>
                            @endforeach
                        </select>
                    </x-forms.field>
                </div>
            </div>
            <div class="flex gap-3 justify-end">
                <x-link-button href="{{ route('residues.show', $residue->id) }}" type="secondary">{{ __('Cancel') }}</x-link-button>
                <x-forms.button class="px-10">{{ __('Save') }}</x-forms.button>
            </div>
        </x-forms.form>
    </article>
</x-layout>
