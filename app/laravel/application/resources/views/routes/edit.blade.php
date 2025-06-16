<x-layout>
    <x-global.top-bar :title="__('Edit route')" :breadcrumbs-items="[
        ['label'=>__('Routes'), 'href'=>route('routes.index')],
        ['label'=> $route->id, 'href'=>route('routes.show', $route->id)],
        ['label'=> __('Edit route')],
    ]">
    </x-global.top-bar>
    <article class="p-4">
        <x-forms.form method="PUT" action="{{ route('routes.update', $route->id) }}" class="flex flex-col max-w-300 gap-8 lg:mx-auto my-15 mx-5">
            <div class="flex flex-col gap-3">
                <x-global.top-bar.page-title class="text-xl">{{ __('Route data') }}</x-global.top-bar.page-title>
                <x-forms.separator class="my-2"/>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                    <x-forms.field :label="__('driver')" name="driver_id" :required="true">
                        <select class="py-3 pl-5 border-1 border-tertiary/40 focus:border-tertiary/70" name="driver_id" id="driver_id">
                            <option value="">{{ __('Select the driver...') }}</option>
                            @foreach($drivers as $driver)
                                <option value="{{ $driver->id }}" @if(old('driver_id', $route->driver_id) == $driver->id) selected @endif>{{ $driver->name }} {{ $driver->surname_1 }} {{ $driver->surname_2 }}</option>
                            @endforeach
                        </select>
                    </x-forms.field>
                    <x-forms.field :label="__('truck')" name="truck_id" :required="true">
                        <select class="py-3 pl-5 border-1 border-tertiary/40 focus:border-tertiary/70" name="truck_id" id="truck_id">
                            <option value="">{{ __('Select a unit...') }}</option>
                            @foreach($trucks as $truck)
                                <option value="{{ $truck->id }}" @if(old('truck_id', $route->truck_id) == $truck->id) selected @endif>{{ $truck->license_plate }}{{ $truck->name ? ' - '.$truck->name : '' }}</option>
                            @endforeach
                        </select>
                    </x-forms.field>
                    <x-forms.input type="datetime-local" name="start_date" :required="true" :label="__('start date')" :value="$route->start_date"/>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                    <x-forms.field :label="__('state')" name="state" :required="true">
                        <select class="py-3 pl-5 border-1 border-tertiary/40 focus:border-tertiary/70" name="state" id="state">
                            <option value="">{{ __('Select a state...') }}</option>
                            @foreach(\App\Enums\RouteState::cases() as $state)
                                <option value="{{ $state->value }}" @if(old('state', $route->state->value) == $state->value) selected @endif>{{ $state->getLabel() }}</option>
                            @endforeach
                        </select>
                    </x-forms.field>
                </div>
                <div class="grid">
                    <x-forms.textarea :label="__('description')" name="description" placeholder="Ruta pola costa de Noia para a recollida de ..." class="h-60" :value="$route->description"/>
                </div>
            </div>
            <div class="flex gap-3 justify-end">
                <x-link-button href="{{ route('routes.show', $route->id) }}" type="secondary">{{ __('Cancel') }}</x-link-button>
                <x-forms.button class="px-10">{{ __('Save') }}</x-forms.button>
            </div>
        </x-forms.form>
    </article>
</x-layout>
