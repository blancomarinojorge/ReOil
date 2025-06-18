<x-layout class="overflow-x-visible">
    <x-global.top-bar :title=" __('Route pickups')" :breadcrumbs-items="[
        ['label'=>__('Routes'), 'href'=>route('routes.index')],
        ['label'=> $route->id, 'href'=>route('routes.show', $route->id)],
        ['label'=>__('Pickups')],
    ]">
    </x-global.top-bar>
    <article class="p-5">
        <div class="flex flex-col xl:flex-row gap-5">
            <x-routes.route-pickups-info :route="$route" :showCreateNew="false"/>
            <section class="p-8 bg-tertiary/5 grow h-[78vh]">
                <div class="flex justify-between">
                    <x-global.top-bar.page-title class="text-xl">{{ __('New pickup') }}</x-global.top-bar.page-title>
                </div>
                <x-forms.separator class="mt-2 mb-4"/>
                <div class="flex items-center justify-center h-full">
                    <x-forms.form method="POST" action="{{ route('routes.pickups.store', $route->id) }}" class="flex flex-col gap-3 w-1/2">
                        <h4 class="text-xl">Select a client</h4>
                        <x-forms.field :label="null" name="client_id" :required="true">
                            <select class="py-3 pl-5 border-1 border-tertiary/40 focus:border-tertiary/70" name="client_id" id="client_id">
                                <option value="">{{ __('Select the client...') }}</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" @if(old('client_id') == $client->id) selected @endif>{{ $client->name }}</option>
                                @endforeach
                            </select>
                        </x-forms.field>
                        <div class="flex gap-3 justify-end">
                            <x-link-button href="{{ route('routes.pickups.index', $route->id) }}" type="secondary">{{ __('Cancel') }}</x-link-button>
                            <x-forms.button class="px-10">{{ __('Create and configure') }}</x-forms.button>
                        </div>
                    </x-forms.form>
                </div>
            </section>
        </div>
    </article>
</x-layout>
