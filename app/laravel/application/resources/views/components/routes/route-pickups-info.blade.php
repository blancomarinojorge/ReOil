@props(['route','pickup' => null, 'showCreateNew' => true])

<section {{ $attributes->twMerge(['class' => "flex flex-col p-7  w-full xl:min-w-[30%] xl:max-w-[41%] relative self-start"]) }}>
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
            {{ $route->description }}
        </x-show-views.show-text-xl>
    </div>

    <span class="text-sm text-center mb-4">
        @choice('messages.x_clients', $route->pickups_count, ['count' => $route->pickups_count])
    </span>
    <div class="flex">
        <div class="w-8 flex flex-col pt-7">
            @foreach($route->pickups as $routePickup)
                <!-- por cada pickup -->
                <div>
                    <div class="w-6 h-6 bg-muted rounded-full"></div>
                    @if(!$loop->last)
                        <div class="w-1 h-33 bg-muted translate-x-2.5 -translate-y-0.5"></div>
                    @endif
                </div>
            @endforeach
        </div>
        <div class="flex flex-col gap-6 grow" id="drag-container">
            @foreach($route->pickups as $routePickup)
                <!-- por cada pickup -->
                <div class="flex group" draggable="true" data-pickup-id="{{ $routePickup->id }}">
                    <a href="{{ route('pickups.show', $routePickup->id) }}" class="flex flex-col h-35 pt-5 px-8 pb-4 {{ $routePickup->id == $pickup?->id ? 'bg-tertiary/15' : 'bg-tertiary/5' }} rounded-sm grow justify-between hover:cursor-pointer hover:bg-tertiary/10">
                        <div class="flex flex-col gap-1">
                            <span>{{ $routePickup->client->name }}</span>
                            <div class="text-sm">
                                {{ $routePickup->client->address }}
                            </div>
                        </div>
                        <div class="text-sm text-tertiary/80">
                            15 residues
                        </div>
                    </a>
                    <div class="flex items-center w-8">
                        @can('update', $route)
                            <x-global.icons.svg-move class="opacity-0 group-hover:opacity-100 transition-opacity duration-200 hover:cursor-move"/>
                        @endcan
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @if($showCreateNew && Auth::user()->can('update', $route))
        <div class="flex px-8 pt-5 pb-8">
            <x-link-button href="{{ route('routes.pickups.create', $route->id) }}" type="secondary" icon-name="plus" class="grow hover:bg-primary hover:cursor-pointer hover:text-secondary py-5">
                {{ __('Add pickup') }}
            </x-link-button>
        </div>
    @endif

    <div id="orderActionButtonsContainer" class="absolute bottom-0 left-0 w-full hidden flex gap-2">
        <x-forms.button id="btnUndoOrderChanges" class="bg-secondary text-tertiary hover:bg-tertiary/15">
            Undo changes
        </x-forms.button>
        <x-forms.button id="btnSaveOrder" class="grow">
            Guardar cambios
        </x-forms.button>
    </div>
</section>

@can('update', $route)
    <script>

        //Change the pickups order with drag and drop
        // Note: for this to work, the pickups have to be order by order in the view. It doesnt make sense to begin that i dont order them by
        document.addEventListener("DOMContentLoaded", () => {
            const draggables = document.querySelectorAll("[draggable='true']");
            const container = document.getElementById("drag-container");
            const orderActionButtonsContainer = document.getElementById("orderActionButtonsContainer");
            const btnSaveOrder = document.getElementById('btnSaveOrder');
            const btnUndoOrderChanges = document.getElementById('btnUndoOrderChanges');


            let db_pickups_order = @json($route->pickups->pluck('id'));
            let pickupsElementsInDbOrder = getPickupsElementsInDbOrder();

            //only get this on page load or changes saved
            function getPickupsElementsInDbOrder(){
                return container.querySelectorAll("[draggable='true']")
            }

            //revert the changes
            function undoChanges(){
                container.innerHTML = '';
                pickupsElementsInDbOrder.forEach(pickupElement => {
                    container.appendChild(pickupElement)
                })
                checkOrderStateAndShowOrHideButtons();
            }
            btnUndoOrderChanges.addEventListener('click', undoChanges);


            function checkOrderStateAndShowOrHideButtons(){
                if(orderChanged()){
                    orderActionButtonsContainer.classList.remove('hidden');
                }else{
                    orderActionButtonsContainer.classList.add('hidden');
                }
            }

            //get the ids of the pickups containers in order
            function getCurrentOrder(){
                return [...container.querySelectorAll("[draggable='true']")].map(pickupContainer => {
                    return parseInt(pickupContainer.dataset.pickupId);
                });
            }

            function orderChanged(){
                let current_order = getCurrentOrder();
                if(current_order.length !== db_pickups_order.length){
                    return false;
                }
                return !current_order.every((value, index) => value === db_pickups_order[index]);
            }


            draggables.forEach((item) => {
                item.addEventListener("dragstart", () => {
                    item.classList.add("opacity-50");
                });

                //on dragend i check if the order changed to show the save button
                item.addEventListener("dragend", () => {
                    item.classList.remove("opacity-50");
                    checkOrderStateAndShowOrHideButtons();
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

            btnSaveOrder.addEventListener('click', ()=>{
                const currentOrder = getCurrentOrder();
                console.log(JSON.stringify({
                    pickups_ids: currentOrder
                }));

                fetch("{{ route('routes.pickups.order', $route->id) }}",{
                    method: "PATCH",
                    credentials: 'same-origin',
                    headers:{
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        pickups_ids: currentOrder
                    })
                }).then(response => {
                    if(!response.ok){
                        return response.json().then(err => { throw err; });
                    }
                    return response.json();
                }).then(data => {
                    showPopUpNotification(data.message); //global function from app.blade

                    //reset the page state
                    db_pickups_order = getCurrentOrder();
                    pickupsElementsInDbOrder = getPickupsElementsInDbOrder();
                    checkOrderStateAndShowOrHideButtons();
                }).catch(err => {
                    showPopUpNotification(err.error, true);
                })
            });
        });
    </script>
@endcan
