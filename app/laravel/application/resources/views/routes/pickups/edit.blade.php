<x-layout class="overflow-x-visible">
    <x-global.top-bar :title=" __('Edit pickup')" :breadcrumbs-items="[
        ['label'=>__('Routes'), 'href'=>route('routes.index')],
        ['label'=> $route->id, 'href'=>route('routes.show', $route->id)],
        ['label'=>__('Pickups'), 'href'=>route('routes.pickups.index', $route->id)],
        ['label'=> $pickup->client->name, 'href'=>route('pickups.edit', $pickup->id)],
        ['label'=> 'Edit']
    ]">
    </x-global.top-bar>
    <article class="p-5">
        <div class="flex flex-col xl:flex-row gap-5">
            <x-routes.route-pickups-info :route="$route" :pickup="$pickup"/>
            <section class="p-8 bg-tertiary/5 grow">
                <div class="flex justify-between">
                    <x-global.top-bar.page-title class="text-xl">{{ __('Pickup data') }}</x-global.top-bar.page-title>
                    @can('delete', $pickup)
                        <x-forms.form method="DELETE" action="{{ route('pickups.destroy', $pickup->id) }}">
                            <div class="flex items-center">
                                <x-forms.button class="bg-error text-tertiary hover:bg-error/80">{{ __('Delete pickup') }}</x-forms.button>
                            </div>
                        </x-forms.form>
                    @endcan
                </div>
                <x-forms.separator class="mt-2 mb-4"/>
                <div class="flex justify-end">
                    <x-status-tag :status="$pickup->state" :enum-class="\App\Enums\PickupState::class"/>
                </div>
                <div class="flex flex-col gap-3 my-10">
                    <h3 class="text-xl">{{ $pickup->client->name }}</h3>
                    <div class="text-sm flex gap-2 items-center">
                        <x-global.icons.svg-location class="w-6"/>
                        <span>{{ $pickup->client->address }}</span>
                    </div>
                </div>
                <x-forms.form method="PUT" action="{{ route('pickups.update', $pickup->id) }}" class="flex flex-col gap-5">
                    <div class="grid grid-cols-1 xl:grid-cols-2 gap-5">
                        <x-forms.textarea :label="__('delivery note notes')" name="delivery_note_notes" class="h-40" :value="$pickup->delivery_note_notes"/>
                        <x-forms.textarea :label="__('observations')" name="observations" class="h-40" :value="$pickup->observations"/>
                    </div>
                    <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">
                        <x-show-views.show-text-sm :label="__('client signature')" :icon-name="$pickup->signature ? 'signature' : null" @endif>
                            @if($pickup->signature)
                                {{ __('client signature') }}
                            @else
                                <span class="text-muted">{{ __('no signature') }}</span>
                            @endif
                        </x-show-views.show-text-sm>
                        <x-forms.input type="datetime-local" name="start_time" :label="__('started at')" :value="$pickup->start_time"/>
                        <x-forms.input type="datetime-local" name="end_time" :label="__('ended at')" :value="$pickup->end_time"/>
                        <x-forms.field :label="__('state')" name="state" :required="true">
                            <select class="py-3 pl-5 border-1 border-tertiary/40 focus:border-tertiary/70" name="state" id="state">
                                <option value="">{{ __('Select a state...') }}</option>
                                @foreach(\App\Enums\PickupState::cases() as $state)
                                    <option value="{{ $state->value }}" @if(old('state', $pickup->state->value) == $state->value) selected @endif>{{ $state->getLabel() }}</option>
                                @endforeach
                            </select>
                        </x-forms.field>
                    </div>
                    <div class="flex gap-3 justify-end mt-8">
                        <x-link-button href="{{ route('pickups.show', $pickup->id) }}" type="secondary">{{ __('Cancel') }}</x-link-button>
                        <x-forms.button class="px-10">{{ __('Save') }}</x-forms.button>
                    </div>
                </x-forms.form>

            </section>
        </div>
    </article>
</x-layout>
