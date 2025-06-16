<x-layout>
    <x-global.top-bar :title="__('New client container')" :breadcrumbs-items="[
        ['label'=>__('Containers'), 'href'=>route('containers.index')],
        ['label'=> __('New client container')],
    ]">
    </x-global.top-bar>
    <article class="p-4">
        <x-forms.form method="POST" action="{{ route('containers.store') }}" class="flex flex-col max-w-300 gap-8 lg:mx-auto my-15 mx-5">
            <div class="flex flex-col gap-3">
                <x-global.top-bar.page-title class="text-xl">{{ __('Container info') }}</x-global.top-bar.page-title>
                <x-forms.separator class="my-2"/>
                <div class="grid grid-cols-1 gap-4">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <x-forms.field :label="__('client')" name="client_id" :required="true">
                            <select class="py-3 pl-5 border-1 border-tertiary/40 focus:border-tertiary/70" name="client_id" id="client_id">
                                <option value="">{{ __('Select a client') }}</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" @if(old('client_id') == $client->id) selected @endif>{{ $client->name }}</option>
                                @endforeach
                            </select>
                        </x-forms.field>
                        <x-forms.field :label="__('container type')" name="container_type_id" :required="true">
                            <select class="py-3 pl-5 border-1 border-tertiary/40 focus:border-tertiary/70" name="container_type_id" id="container_type_id">
                                <option value="">{{ __('Select a unit...') }}</option>
                                @foreach($containerTypes as $containerType)
                                    <option value="{{ $containerType->id }}" @if(old('container_type_id') == $containerType->id) selected @endif>{{ $containerType->name }}</option>
                                @endforeach
                            </select>
                        </x-forms.field>
                    </div>
                    <div class="grid">
                        <x-forms.textarea :label="__('observations')" name="observations" placeholder="This container suffered damage in wend..." class="h-60"/>
                    </div>
                </div>
            </div>
            <div class="flex gap-3 justify-end">
                <x-link-button href="{{ route('containers.index') }}" type="secondary">{{ __('Cancel') }}</x-link-button>
                <x-forms.button class="px-10">{{ __('Save') }}</x-forms.button>
            </div>
        </x-forms.form>
    </article>
</x-layout>
