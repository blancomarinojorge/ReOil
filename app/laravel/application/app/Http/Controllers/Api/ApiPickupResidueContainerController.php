<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePickupResidueContainerRequest;
use App\Http\Requests\UpdatePickupResidueContainerRequest;
use App\Models\Container;
use App\Models\PickupResidueContainer;
use App\Models\Residue;
use App\Models\RoutePickup;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApiPickupResidueContainerController extends Controller
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

    public function updateContainerResidues(Request $request, RoutePickup $pickup, Container $container)
    {
        $this->authorize('update', $pickup);
        $data = $request->validate([
            'residues' => 'required|array',
            'residues.*.residue_id' => 'required|exists:residues,id',
            'residues.*.quantity' => 'required|numeric|min:0.01',
        ]);

        $residues = $data['residues'];

        return $this->tryApiAction(
            function() use ($residues, $pickup, $container) {
                DB::transaction(function () use ($pickup, $container, $residues) {
                    // Delete all existing residues for this pickup and container
                    PickupResidueContainer::where('route_pickup_id', $pickup->id)
                        ->where('container_id', $container->id)
                        ->forceDelete();

                    // Insert new residues
                    foreach ($residues as $residue) {
                        PickupResidueContainer::create([
                            'route_pickup_id' => $pickup->id,
                            'container_id' => $container->id,
                            'residue_id' => $residue['residue_id'],
                            'quantity' => $residue['quantity'],
                        ]);
                    }
                });
            },
            __('Container residues successfully updated'),
            __('Error updating container residues'),
            ResponseCode::OK->value
        );
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
            return response()->json(['message' => 'Container does not belong to this pickup.'], 403);
        }

        return $this->tryApiAction(
            function () use ($pickup, $container) {
                PickupResidueContainer::where('route_pickup_id', $pickup->id)
                    ->where('container_id', $container->id)
                    ->delete();
            },
            __('All residues for the container deleted successfully'),
            __('Error deleting residues for the container'),
            ResponseCode::OK->value
        );
    }

    /**
     * Returns all the PickupResidueContainer by pickup and container
     * @return JsonResponse
     */
    public function getResiduesByContainerAndPickup(RoutePickup $pickup, Container $container){

        $this->authorize('view', $pickup->route);
        $containerResidues = PickupResidueContainer::with('residue','container')
            ->where('container_id', $container->id)
            ->where('route_pickup_id', $pickup->id)
            ->get();
        $residuesAvailable = Residue::where('unit', $container->containerType->unit)
            ->where('company_id', Auth::user()->company_id)
            ->get();
        $container = $containerResidues->first()->container->load('containerType');
        return response()->json([
            "residues" => $residuesAvailable,
            "containerResidues" => $containerResidues,
            "container" => $container,
        ]);
    }
}
