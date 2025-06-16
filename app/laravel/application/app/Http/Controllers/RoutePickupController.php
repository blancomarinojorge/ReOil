<?php

namespace App\Http\Controllers;

use App\Enums\PickupState;
use App\Http\Requests\RoutePickup\StoreRoutePickupRequest;
use App\Http\Requests\RoutePickup\UpdateRoutePickupRequest;
use App\Models\Client;
use App\Models\Route;
use App\Models\RoutePickup;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RoutePickupController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Route $route)
    {
        $this->authorize('view-any', $route);

        $route->load(['truck', 'driver']);
        $pickups = $route->pickups()->with(['client']);

        return view('routes.pickups.index', compact('route', 'pickups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Route $route)
    {
        $this->authorize('create', [RoutePickup::class, $route]);

        $route->load(['truck', 'driver']);
        $pickups = $route->pickups()->with(['client'])->get();
        //clients
        $clients = Client::where('company_id', Auth::user()->company_id)
            ->whereNotIn('id', $pickups->pluck('client_id'))
            ->orderBy('name')
            ->get();

        return view('routes.pickups.create', compact('route', 'pickups', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoutePickupRequest $request, Route $route)
    {
        $this->authorize('create', [RoutePickup::class, $route]);

        $lastOrder = $route->pickups->max('order') ?? 0;
        $newPickupOrder = $lastOrder + 1;

        try{
            /** @var RoutePickup $pickup */
            $pickup = $route->pickups()->create(array_merge($request->validated(), [
                'creator_id' => Auth::user()->id,
                'order' => $newPickupOrder,
                'state' => PickupState::PENDING->value,
            ]));
        }catch (\Exception $e){
            Log::error('Action failed', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.route_pickup_creation_error'));
        }

        return redirect()
            ->route('pickups.show', $pickup->id)
            ->with('success', __('messages.route_pickup_creation_success'));
    }

    /**
     * Display the specified resource.
     */
    public function show(RoutePickup $pickup)
    {
        $this->authorize('view', $pickup);

        $pickup->load(['client', 'route.truck', 'route.driver', 'route.pickups','route.pickups.client']);
        $route = $pickup->route;

        return view('routes.pickups.show', compact('pickup', 'route'));
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoutePickup $pickup)
    {
        //
    }
}
