<x-layout class="overflow-x-visible">
    <x-global.top-bar :title=" __('Route pickups')" :breadcrumbs-items="[
        ['label'=>__('Routes'), 'href'=>route('routes.index')],
        ['label'=> $route->id, 'href'=>route('routes.show', $route->id)],
        ['label'=>__('Pickups')],
    ]">
    </x-global.top-bar>
    <article class="p-5">
        <div class="flex flex-col xl:flex-row gap-5">
            <section class="flex flex-col p-7  w-full xl:min-w-[30%] xl:max-w-[41%]">
                <div class="flex justify-between">
                    <h4 class="text-xl">{{ __('Route data') }}</h4>
                    <x-status-tag :status="$route->state" />
                </div>
                <x-forms.separator class="mt-2 mb-0"></x-forms.separator>
                <div class="grid grid-cols-2  pt-10 pb-12 gap-4">
                    <x-show-views.show-text-sm :label="__('truck')" icon-name="trucks">
                        {{ $route->truck->license_plate }}
                    </x-show-views.show-text-sm>
                    <div class="flex flex-col gap-2">
                        <span>driver</span>
                        <div class="flex gap-3 bg-tertiary/5 py-2 px-5 rounded-sm grow items-center">
                            <div class="w-8">
                                <img src="{{ Vite::asset('resources/img/user-photos/1.png') }}" title="{{ Auth::user()->name }}" alt="Your photo" class="object-cover h-full w-full">
                            </div>
                            {{ $route->driver->name }}
                        </div>
                    </div>
                    <x-show-views.show-text-xl class="col-span-2" :label="__('description')">
                        olaa quii ejr erwenw r werjwe rw rehj w ehr eh er ej werb wehr we ehr ehr ewrehr
                    </x-show-views.show-text-xl>
                </div>

                <span class="text-sm text-center mb-4">7 clientes</span>
                <div class="flex">
                    <div class="w-8 flex flex-col pt-7">
                        @for($i=0;$i<7;$i++)
                            <!-- por cada pickup -->
                            <div>
                                <div class="w-6 h-6 bg-muted rounded-full"></div>
                                <div class="w-1 h-33 bg-muted translate-x-2.5 -translate-y-0.5"></div>
                            </div>
                        @endfor
                    </div>
                    <div class="flex flex-col gap-6 grow" id="drag-container">
                        @for($i=0;$i<7;$i++)
                        <!-- por cada pickup -->
                        <div class="flex group" draggable="true">
                            <div class="flex flex-col h-35 pt-5 px-8 pb-4 bg-tertiary/5 rounded-sm grow justify-between hover:cursor-pointer">
                                <div class="flex flex-col gap-1">
                                    <span>Talleres Juan Antornio SL Sociedad anonima</span>
                                    <div class="text-sm">
                                        Rúa Antonio Amigo, 8, 15860 Santa Comba, A Coruña
                                    </div>
                                </div>
                                <div class="text-sm text-tertiary/80">
                                    15 residues
                                </div>
                            </div>
                            <div class="flex items-center w-8">
                                <x-global.icons.svg-move class="opacity-0 group-hover:opacity-100 transition-opacity duration-200 hover:cursor-move"/>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
                <div class="flex px-8 pt-5">
                    <x-link-button href="{{ route('routes.pickups.create', $route->id) }}" type="secondary" icon-name="add-user" class="grow hover:bg-primary hover:cursor-pointer hover:text-secondary py-5">
                        {{ __('Add pickup') }}
                    </x-link-button>
                </div>
            </section>
            <section class="p-8 bg-tertiary/5 grow">
                <div class="flex justify-between">
                    <x-global.top-bar.page-title class="text-xl">{{ __('Pickup data') }}</x-global.top-bar.page-title>
                    <div class="flex items-center">
                        <x-link-button href="{{ route('routes.edit', $route->id) }}" icon-name="edit">{{ __('Edit pickup') }}</x-link-button>
                    </div>
                </div>
                <x-forms.separator class="mt-2 mb-4"/>
                <div class="flex justify-end">
                    <x-status-tag :status="$route->state" />
                </div>
                <div class="flex flex-col gap-3 my-10">
                    <h3 class="text-xl">Talleres Juan Antornio SL Sociedad anonima</h3>
                    <div class="text-sm flex gap-2 items-center">
                        <x-global.icons.svg-location class="w-6"/>
                        <span>Rúa Antonio Amigo, 8, 15860 Santa Comba, A Coruña</span>
                    </div>
                </div>
                <div class="flex flex-col gap-5">
                    <div class="grid grid-cols-1 xl:grid-cols-2 gap-5">
                        <x-show-views.show-text-xl :label="__('delivery note notes')">
                            olaa quii ejr erwenw r werjwe rw rehj w ehr eh er ej werb wehr we ehr ehr ewrehr
                        </x-show-views.show-text-xl>
                        <x-show-views.show-text-xl :label="__('observations')">
                            olaa quii ejr erwenw r werjwe rw rehj w ehr eh er ej werb wehr we ehr ehr ewrehr
                        </x-show-views.show-text-xl>
                    </div>
                    <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">
                        <x-show-views.show-text-sm :label="__('client signature')" icon-name="trucks">
                            no signature
                        </x-show-views.show-text-sm>
                        <x-show-views.show-text-sm :label="__('started at')">10/5/2024 08:45</x-show-views.show-text-sm>
                        <x-show-views.show-text-sm :label="__('ended at')"></x-show-views.show-text-sm>
                    </div>
                </div>
            </section>
        </div>
    </article>

    <script>

        //Change the pickups order with drag and drop
        document.addEventListener("DOMContentLoaded", () => {
            const draggables = document.querySelectorAll("[draggable='true']");
            const container = document.getElementById("drag-container");

            draggables.forEach((item) => {
                item.addEventListener("dragstart", () => {
                    item.classList.add("opacity-50");
                });

                item.addEventListener("dragend", () => {
                    item.classList.remove("opacity-50");
                });
            });

            container.addEventListener("dragover", (e) => {
                e.preventDefault();
                const afterElement = getDragAfterElement(container, e.clientY);
                const dragging = document.querySelector(".opacity-50");
                if (afterElement == null) {
                    container.appendChild(dragging);
                } else {
                    container.insertBefore(dragging, afterElement);
                }
            });

            function getDragAfterElement(container, y) {
                const draggableElements = [...container.querySelectorAll("[draggable='true']:not(.opacity-50)")];

                return draggableElements.reduce((closest, child) => {
                    const box = child.getBoundingClientRect();
                    const offset = y - box.top - box.height / 2;
                    if (offset < 0 && offset > closest.offset) {
                        return { offset: offset, element: child };
                    } else {
                        return closest;
                    }
                }, { offset: Number.NEGATIVE_INFINITY }).element;
            }
        });
    </script>
</x-layout>
