<?php

namespace App\Http\Controllers\Api;

use App\Enums\PickupState;
use App\Enums\ResponseCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoutePickup\StoreRoutePickupRequest;
use App\Http\Requests\RoutePickup\UpdateRoutePickupRequest;
use App\Models\Client;
use App\Models\Route;
use App\Models\RoutePickup;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use function Pest\Laravel\json;

class ApiRoutePickupController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Route $route)
    {
        $this->authorize('view-any', $route);

        $route
            ->load(['truck', 'driver'])
            ->loadCount('pickups');
        $pickups = $route->pickups()
            ->orderBy('order')
            ->with(['client']);

        return view('routes.pickups.index', compact('route', 'pickups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Route $route)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoutePickupRequest $request, Route $route)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(RoutePickup $pickup)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoutePickup $pickup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoutePickupRequest $request, RoutePickup $pickup)
    {
        //
    }

    public function updatePickupsOrder(Request $request, Route $route)
    {
        $this->authorize('update',  $route);

        $validated = $request->validate([
            'pickups_ids' => 'required|array',
            'pickups_ids.*' => 'integer',
        ]);
        $newOrder = $validated['pickups_ids'];

        //check if the pickups id in the request are the same as the route pickups
        $requestPickupsCollection = collect($newOrder)->sort()->values();
        $routePickups = $route->pickups()->pluck('id')->sort()->values();
        if (!$routePickups->diff($requestPickupsCollection)->isEmpty()) {
            return response()->json(['message' => __('Pickups ids do not match the route')], ResponseCode::UNPROCESSABLE_ENTITY->value);
        }

        return $this->tryApiAction(
            function () use ($route, $newOrder) {
                DB::transaction(function () use ($newOrder, $route) {
                    foreach ($newOrder as $index => $pickup) {
                        $updated = RoutePickup::where('id', $pickup)
                            ->where('route_id', $route->id)
                            ->update(['order' => $index]);
                        if($updated === 0) {
                            throw new \Exception(__('Pickups ids do not match the route'));
                        }
                    }
                });
            },
            __('Route pickups order updated successfully'),
            __('Error updating route pickups order'),
            ResponseCode::OK->value
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoutePickup $pickup)
    {
        //
    }
}
