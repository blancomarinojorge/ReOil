<x-layout class="overflow-x-visible">
    <x-global.top-bar :title=" __('Route pickups')" :breadcrumbs-items="[
        ['label'=>__('Routes'), 'href'=>route('routes.index')],
        ['label'=> $route->id, 'href'=>route('routes.show', $route->id)],
        ['label'=>__('Pickups'), 'href'=>route('routes.pickups.index', $route->id)],
        ['label'=> $pickup->client->name],
    ]">
    </x-global.top-bar>
    <article class="p-5">
        <div class="flex flex-col xl:flex-row gap-5">
            <x-routes.route-pickups-info :route="$route" :pickup="$pickup"/>
            <section class="p-8 bg-tertiary/5 grow self-start">
                <div class="flex justify-between">
                    <x-global.top-bar.page-title class="text-xl">{{ __('Pickup data') }}</x-global.top-bar.page-title>
                    <div class="flex items-center">
                        <x-link-button href="{{ route('pickups.edit', $pickup->id) }}" icon-name="edit">{{ __('Edit pickup') }}</x-link-button>
                    </div>
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
                <div class="flex flex-col gap-5">
                    <div class="grid grid-cols-1 xl:grid-cols-2 gap-5">
                        <x-show-views.show-text-xl :label="__('delivery note notes')">
                            {{ $pickup->delivery_note_notes }}
                        </x-show-views.show-text-xl>
                        <x-show-views.show-text-xl :label="__('observations')">
                            {{ $pickup->observations }}
                        </x-show-views.show-text-xl>
                    </div>
                    <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">
                        <x-show-views.show-text-sm :label="__('client signature')" :icon-name="$pickup->signature ? 'signature' : null" @endif>
                            @if($pickup->signature)
                                {{ __('client signature') }}
                            @else
                                <span class="text-muted">{{ __('no signature') }}</span>
                            @endif
                        </x-show-views.show-text-sm>
                        <x-show-views.show-text-sm :label="__('started at')">{{ $pickup->start_time }}</x-show-views.show-text-sm>
                        <x-show-views.show-text-sm :label="__('ended at')">{{ $pickup->end_time }}</x-show-views.show-text-sm>
                    </div>
                </div>
                <article class="mt-15">
                    <div class="flex justify-between">
                        <x-global.top-bar.page-title class="text-">{{ __('Pickup residues') }}</x-global.top-bar.page-title>
                        <x-link-button id="btn-add-container" role="button" class="hover:cursor-pointer" type="secondary" icon-name="plus">{{ __('Add container pickup') }}</x-link-button>
                    </div>
                    <x-forms.separator class="mt-2 mb-4"/>
                    <div class="grid gap-3.5 grid-cols-[repeat(auto-fit,_minmax(400px,_1fr))]">
                        @foreach($pickupContainersWithResidues as $pickupContainerWithResidues)
                            @php($container = $pickupContainerWithResidues->first()->container)
                            <div class="pickup-container p-4 bg-tertiary/5 rounded-sm flex flex-col gap-7 hover:cursor-pointer hover:opacity-85" data-container-id="{{ $container->id }}" data-pickup-id="{{ $pickup->id }}">
                                <div class="flex flex-col gap-2">
                                    <div class="flex justify-between">
                                        <h6 class="text-xs text-muted">Container data</h6>
                                        <x-global.tables.delete-button action="{{ route('pickups.containers.residues.destroy', [$pickup->id, $container->id]) }}" :value="null"/>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-lg">{{ $container->containerType->name }}</span>
                                        <span class="text-muted text-sm">{{ $container->containerType->un_code }}</span>
                                    </div>
                                    <div class="flex gap-2 items-center">
                                        <x-global.unit-tag class="self-start" :unit="$container->containerType->unit"/>
                                        {{ $container->containerType->capacity }}
                                        <span class="text-muted text-xs self-start">max</span>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <h6 class="text-xs text-muted">Residues</h6>
                                    <div class="grid gap-3 grid-cols-[repeat(auto-fit,_minmax(20rem,_1fr))]">
                                        @foreach($pickupContainerWithResidues as $pickupContainerWithResidue)
                                            <div class="bg-secondary-soft p-2 rounded-sm">
                                                <div class="flex justify-between">
                                                    <span>{{ $pickupContainerWithResidue->residue->name }}</span>
                                                    <span>{{ $pickupContainerWithResidue->quantity }} {{ $pickupContainerWithResidue->residue->unit->value }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </article>
            </section>
        </div>
    </article>

    <div id="page-blocker-container" class="fixed inset-0 bg-secondary-soft/90 z-100 flex justify-center items-center px-3 hidden">
        <div class="p-7 bg-secondary-soft rounded-sm flex flex-col gap-7 grow md:max-w-200">
            <div class="flex flex-col gap-2">
                <div class="flex justify-between">
                    <h6 class="text-xs text-muted self-end">Container data</h6>
                    <div id="pu-close-x-btn" class="hover:text-error hover:cursor-pointer p-3" role="button" aria-label="close window">
                        <x-global.icons.svg-close class="w-6 transition-colors duration-150"></x-global.icons.svg-close>
                    </div>
                </div>
                <div class="flex justify-between">
                    <span class="text-lg" id="pu-container-name">Contenedor de aceite</span>
                    <span class="text-muted text-sm" id="pu-container-un-code">I5384</span>
                </div>
                <div class="flex items-center">
                    <span class="text-muted text-xs self-start mr-2">max</span>
                    <span id="pu-container-capacity">345</span>
                    <span class="pu-container-unit">kg</span>
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <h6 class="text-xs text-muted">Residues</h6>
                <div class="flex items-end gap-3">
                    <span>Total: <span id="pu-container-total">432</span> <span class="pu-container-unit">kg</span></span>
                    <span id="pu-exceeding-capacity" class="text-error text-xs">Exceeding container capacity</span>
                </div>
                <div id="pu-residues-container" class="grid gap-3 grid-cols-[repeat(auto-fit,_minmax(20rem,_1fr))] max-h-80 overflow-y-scroll">
                    <div class="bg-tertiary/5 p-2 rounded-sm flex justify-between">
                        <span>oil</span>
                        <span>5 kg</span>
                    </div>
                    <div class="bg-tertiary/5 p-2 rounded-sm">
                        <div class="flex justify-between">
                            <span>oil</span>
                            <span>5 kg</span>
                        </div>
                    </div>
                </div>

                <div id="pu-btn-add-residue" class="flex pt-5 pb-8">
                    <x-link-button id="pu-btn-add-residue" type="secondary" icon-name="plus" class="grow hover:bg-primary hover:cursor-pointer hover:text-secondary py-5">
                        {{ __('Add residue') }}
                    </x-link-button>
                </div>

                <div id="pu-add-residue-form" class="flex flex-col gap-3 mx-10 bg-tertiary/5 p-5 rounded-sm">
                    <div class="grid grid-cols-7 gap-4">
                        <x-forms.field class="col-span-4" :label="__('residue')" name="residue" id="residue" :required="true">
                            <select class="py-3 pl-5 border-1 border-tertiary/40 focus:border-tertiary/70" name="residue" id="popup-residue-selector" data-placeholder="{{ __('Select a residue...') }}">
                                <!-- complete with js -->
                            </select>
                        </x-forms.field>
                        <x-forms.input :label="__('quantity')" name="quantity" id="pu-quantity-input" :required="true" class="col-span-2"/>
                        <div id="pu-btn-confirm-new-residue" role="button" class="bg-primary hover:bg-primary/85 hover:cursor-pointer flex py-3 text-secondary self-end rounded-sm items-center justify-center">
                            <x-global.icons.svg-up class="w-6 transition-colors duration-150"></x-global.icons.svg-up>
                        </div>
                    </div>
                </div>
                <div id="pu-save-cancel-container" class="flex gap-3 justify-end mt-4 px-7">
                    <x-link-button id="btn-close-popup" class="hover:cursor-pointer" type="secondary">{{ __('Cancel') }}</x-link-button>
                    <x-forms.button id="pu-btn-submit-container-changes" class="px-10">{{ __('Save') }}</x-forms.button>
                </div>
            </div>
        </div>
    </div>


    <!--
     seleccion de contedor en creacion
    <div id="page-blocker-container-creation" class="fixed inset-0 bg-secondary-soft/90 z-100 flex justify-center items-center px-3">
        <div class="p-7 bg-secondary-soft rounded-sm flex flex-col gap-7 grow md:max-w-200">
            <div class="flex flex-col gap-2">
                <div class="flex justify-end">
                    <div id="pu-close-x-btn-creation" class="hover:text-error hover:cursor-pointer p-3" role="button" aria-label="close window">
                        <x-global.icons.svg-close class="w-6 transition-colors duration-150"></x-global.icons.svg-close>
                    </div>
                </div>
            </div>
            <div id="pu-save-cancel-container" class="flex gap-3 justify-end mt-4 px-7">
                <x-link-button id="btn-close-popup-creation" class="hover:cursor-pointer" type="secondary">{{ __('Cancel') }}</x-link-button>
                <x-forms.button id="pu-btn-select-container" class="px-10">{{ __('Pick residues') }}</x-forms.button>
            </div>
        </div>
    </div>
-->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let currentContainerId = null;

            const pageBlockerContainer = document.getElementById('page-blocker-container');
            const contenedorResiduosPopUp = document.getElementById('pu-residues-container');

            //add residue
            const containerResidueSelect = document.getElementById('popup-residue-selector');
            const quantityInput =  document.getElementById('pu-quantity-input').querySelector('input');
            const btnConfirmNewResidue = document.getElementById('pu-btn-confirm-new-residue');

            const saveBtnContainer = document.getElementById('pu-save-cancel-container');
            const btnAddResidue = document.getElementById('pu-btn-add-residue');
            const formAddResidue = document.getElementById('pu-add-residue-form');
            const btnSubmit = document.getElementById('pu-btn-submit-container-changes');

            //all the residues available for the current container, so i can compare them to the already picked ones
            let allPopUpContainerResidues = []
            let currentPopUpContainerAvailableResidues = [];
            //initial container residues data
            let initialData = {}
            let modifiedData = {}

            const btnAddContainer = document.getElementById('btn-add-container');
            btnAddContainer.addEventListener('click', () => {
                pageBlockerContainer.classList.remove('hidden');
            });

            //open container details
            const containers = document.querySelectorAll('.pickup-container');
            containers.forEach(container => {
                const containerId = container.dataset.containerId;
                const pickupId = container.dataset.pickupId;

                container.addEventListener('click', () => {
                    showEditContainerPopUp(pickupId, containerId);
                });
            });

            //open de popup
            function openPopUp(){
                document.body.classList.add('overflow-hidden');
                pageBlockerContainer.classList.remove('hidden');
            }

            //close the popup
            const btnClosePopUp = document.getElementById('btn-close-popup');
            btnClosePopUp.addEventListener('click', closePopUp);
            const btnClosePopupXbtn = document.getElementById('pu-close-x-btn');
            btnClosePopupXbtn.addEventListener('click', closePopUp);
            function closePopUp(){
                pageBlockerContainer.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }

            //show popup
            function showEditContainerPopUp(pickupId, containerId){
                const routeTemplate = "{{ route('pickups.containers.residues.index', ['pickup' => '__pickup__', 'container' => '__container__']) }}";
                //I generate the url dinamically
                const apiUrl = routeTemplate
                    .replace('__pickup__', pickupId)
                    .replace('__container__', containerId);

                fetch(apiUrl,{
                    credentials: 'same-origin',
                    headers:{
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                })
                .then(res => {
                    if (!res.ok){
                        return res.json().then(err => { throw err; })
                    }
                    return res.json()
                })
                .then(data => {
                    currentContainerId = containerId;
                    //all the residues
                    allPopUpContainerResidues = data.residues;
                    currentPopUpContainerAvailableResidues = data.residues;
                    //initial residues in container
                    initialData = {
                        ...data.containerResidues
                    }
                    modifiedData = {
                        ...data.containerResidues
                    }

                    //container data
                    const containerCapacity = data.container.container_type.capacity;
                    document.getElementById('pu-container-name').textContent = data.container.container_type.name;
                    document.getElementById('pu-container-un-code').textContent = data.container.container_type.un_code;
                    document.getElementById('pu-container-capacity').textContent = containerCapacity;
                    document.querySelectorAll('.pu-container-unit').forEach(e => e.textContent = data.container.container_type.unit);

                    //residues
                    let totalResidueAmount = 0;
                    contenedorResiduosPopUp.innerHTML = '';
                    data.containerResidues.forEach(pickupResidueContainer => {
                        addResidueToContainer(pickupResidueContainer);
                    });

                    //show popup
                    openPopUp();
                }).catch(err => {
                    console.log(err)
                    showPopUpNotification(err.error, true);
                });
            }

            function addResidueToContainer(pickupResidueContainer){
                const totalEl = document.getElementById('pu-container-total');
                const currentValue = parseFloat(totalEl.textContent) || 0;
                totalEl.textContent = (currentValue + pickupResidueContainer.quantity ?? 0).toFixed(2);

                const div = document.createElement('div');
                div.className = 'container-residue bg-tertiary/5 p-2 rounded-sm flex justify-between';
                div.id = 'popup-container-residue-'+pickupResidueContainer.residue.id;
                div.setAttribute('data-id-residue', pickupResidueContainer.residue.id);

                div.innerHTML = `
                    <span>${pickupResidueContainer.residue.name}</span>
                    <div>
                        <span>${pickupResidueContainer.quantity} ${pickupResidueContainer.residue.unit}</span>
                        <span role="button" class="btn-delete-residue-container hover:text-error hover:text-bold hover:cursor-pointer p-2 rounded-xs grow-0">-</span>
                    </div>
                `;

                contenedorResiduosPopUp.appendChild(div);

                //delete event
                const deleteBtn = div.querySelector('.btn-delete-residue-container');
                deleteBtn.addEventListener('click', () => {
                    deleteResidueFromContainer(pickupResidueContainer.residue.id);
                })

                updatePopUpScreen();
            }

            //delete residues from container
            function deleteResidueFromContainer(residueId){
                const residueElement = document.getElementById('popup-container-residue-'+residueId);
                if (residueElement && contenedorResiduosPopUp.contains(residueElement)) {
                    contenedorResiduosPopUp.removeChild(residueElement);
                }else {
                    return;
                }

                // Loop over keys to find the one that matches the residueId
                for (const key in modifiedData) {
                    if (modifiedData[key].residue_id == residueId) {
                        console.log('yep')
                        delete modifiedData[key];
                        break;
                    }
                }

                updatePopUpScreen();
            }

            //compare all residues with the ones that are in the container, return the ones that are not in it
            function getAvailableContainerResidues(){
                const idsResiduesInContainer = [...contenedorResiduosPopUp.querySelectorAll('.container-residue')].map(con => con.dataset.idResidue);
                return allPopUpContainerResidues.filter(residue => {
                    return !idsResiduesInContainer.includes(String(residue.id));
                })
            }

            function populateResiduesSelector(){
                const placeholderText = containerResidueSelect.dataset.placeholder;
                const currentSelectedId = containerResidueSelect.value;

                containerResidueSelect.innerHTML = `<option value="">${placeholderText}</option>`

                const availableResidues = getAvailableContainerResidues();
                for(let residue of availableResidues){
                    const option = document.createElement('option');
                    option.value = residue.id;
                    option.textContent = residue.name;
                    if (residue.id == currentSelectedId){
                        option.selected = true;
                    }
                    containerResidueSelect.appendChild(option);
                }
            }

            function updatePopUpScreen(){
                populateResiduesSelector();

                //enable or disable save button based on changes
                if (compareResidueCollections(modifiedData, initialData)) {
                    hideSaveCancelButtons();
                } else {
                    showSaveCancelButtons();
                }

                //enable add residue based on the residues available
                if(Object.keys(getAvailableContainerResidues()).length<1){
                    disableAddingResidue();
                }else{
                    enableAddingResidue();
                }
            }

            function showSaveCancelButtons(){
                saveBtnContainer.classList.remove('hidden');
            }

            function hideSaveCancelButtons(){
                saveBtnContainer.classList.add('hidden');
            }

            function enableAddingResidue(){
                btnAddResidue.classList.remove('hidden');
            }

            function disableAddingResidue(){
                btnAddResidue.classList.add('hidden');
                hiddeFormAddResidue();
            }

            btnAddResidue.addEventListener('click', showFormAddResidue);
            function showFormAddResidue(){
                formAddResidue.classList.remove('hidden')
            }

            function hiddeFormAddResidue(){
                formAddResidue.classList.add('hidden')
            }


            /**
             * Returns true if objects are equal based on the residue_id and quantity
             * @param a
             * @param b
             * @returns {boolean}
             */
            function compareResidueCollections(a, b) {
                const aArray = Object.values(a);
                const bArray = Object.values(b);

                if (aArray.length !== bArray.length) return false;

                // Sort both arrays by residue_id to ensure consistent comparison
                aArray.sort((x, y) => x.residue_id - y.residue_id);
                bArray.sort((x, y) => x.residue_id - y.residue_id);

                for (let i = 0; i < aArray.length; i++) {
                    const resA = aArray[i];
                    const resB = bArray[i];

                    if (resA.residue_id !== resB.residue_id || resA.quantity !== resB.quantity) {
                        return false;
                    }
                }

                return true;
            }

            btnConfirmNewResidue.addEventListener('click', confirmNewResidue);
            function confirmNewResidue() {
                const idResidue = containerResidueSelect.value;
                const quantity = quantityInput.value.trim();

                if (!idResidue) {
                    alert("Please select a residue.");
                    return;
                }

                if (!quantity || isNaN(quantity) || Number(quantity) <= 0) {
                    alert("Please enter a valid quantity greater than 0.");
                    return;
                }

                const residue = allPopUpContainerResidues.find(r => r.id == idResidue);

                if (!residue) {
                    alert("Selected residue not found.");
                    return;
                }

                const newResidue = {
                    residue_id: residue.id,
                    quantity: Number(quantity),
                    residue: residue
                };

                modifiedData[newResidue.residue_id+getRandomInt(1, 100)] = newResidue;

                addResidueToContainer(newResidue);
            }

            btnSubmit.addEventListener('click', () => {
                data = Object.values(modifiedData).map(item => ({
                    residue_id: item.residue_id,
                    quantity: item.quantity,
                }));

                const routeTemplate = "{{ route('pickups.containers.residues.update', ['pickup' => '__pickup__', 'container' => '__container__']) }}";
                //I generate the url dinamically
                const apiUrl = routeTemplate
                    .replace('__pickup__', {{ $pickup->id }})
                    .replace('__container__', currentContainerId);

                fetch(apiUrl,{
                    method: 'PUT',
                    credentials: 'same-origin',
                    headers:{
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        'residues': data
                    })
                })
                .then(res => {
                    if (!res.ok){
                        return res.json().then(err => { throw err; })
                    }
                    return res.json()
                })
                .then(data => {
                    window.location.reload();
                }).catch(err => {
                    showPopUpNotification("An error ocurred", true);
                });
            })

            //just accept numbers
            quantityInput.addEventListener('input', () => {
                quantityInput.value = quantityInput.value.replace(/[^0-9.]/g, '');
            });

            function getRandomInt(min, max) {
                min = Math.ceil(min);
                max = Math.floor(max);
                return Math.floor(Math.random() * (max - min + 1)) + min;
            }
        });
    </script>
</x-layout>
