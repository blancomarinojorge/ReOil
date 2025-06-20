<?php

namespace App\Http\Controllers;

use App\Enums\ResponseCode;
use App\Http\Requests\StorePickupResidueContainerRequest;
use App\Http\Requests\UpdatePickupResidueContainerRequest;
use App\Models\Container;
use App\Models\PickupResidueContainer;
use App\Models\RoutePickup;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PickupResidueContainerController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePickupResidueContainerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PickupResidueContainer $pickupResidueContainer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PickupResidueContainer $pickupResidueContainer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePickupResidueContainerRequest $request, PickupResidueContainer $pickupResidueContainer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoutePickup $pickup, Container $container)
    {
        $this->authorize('update', $pickup);

        // Check if the container belongs to the pickup's route (adjust according to your relationships)
        $containerBelongsToPickup = $pickup->containers()->where('containers.id', $container->id)->exists();

        if (!$containerBelongsToPickup) {
            redirect()->back(ResponseCode::BAD_REQUEST->value)->with('error', __('Container does not belong to this pickup'));
        }

        return $this->tryAction(
            function () use ($pickup, $container) {
                PickupResidueContainer::where('route_pickup_id', $pickup->id)
                    ->where('container_id', $container->id)
                    ->delete();
            },
            __('All residues for the container deleted successfully'),
            __('Error deleting residues for the container'),
            route('pickups.show',  $pickup->id)
        );
    }
}
