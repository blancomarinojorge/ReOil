<x-layout class="overflow-x-visible">
    <x-global.top-bar :title=" __('Route pickups')" :breadcrumbs-items="[
        ['label'=>__('Routes'), 'href'=>route('routes.index')],
        ['label'=> $route->id, 'href'=>route('routes.show', $route->id)],
        ['label'=>__('Pickups')],
    ]">
    </x-global.top-bar>
    <article class="p-5">
        <div class="flex flex-col xl:flex-row gap-5 justify-center">
            <x-routes.route-pickups-info :route="$route" class="xl:max-w-[60%]"/>
        </div>
    </article>
</x-layout>
