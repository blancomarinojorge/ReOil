<?php

namespace App\Http\Controllers\Web;

use App\Enums\Auth\Role;
use App\Enums\PickupState;
use App\Enums\RouteState;
use App\Http\Controllers\Controller;
use App\Http\Requests\Route\StoreRouteRequest;
use App\Http\Requests\Route\UpdateRouteRequest;
use App\Models\Route;
use App\Models\RoutePickup;
use App\Models\Truck;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RouteController extends Controller
{
    use AuthorizesRequests;

    public function __construct(Request $request)
    {
        $this->authorizeResource(Route::class, 'route');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var Builder $routes */
        $routes = match (Auth::user()->role) {
            Role::Admin => Route::whereHas('creator', function ($query) { $query->where('company_id', Auth::user()->company_id); }),
            Role::OfficeStaff => Route::where('creator_id', Auth::user()->id)->latest(),
            Role::Driver => Route::where('driver_id', Auth::user()->id)->latest(),
        };

        $routes = $routes
            ->with(['driver', 'creator', 'truck'])
            ->withCount('pickups')
            ->latest()
            ->paginate();

        return view('routes.index', compact('routes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $trucks = Truck::where('company_id', Auth::user()->company_id)->get();
        $drivers = User::where('company_id', Auth::user()->company_id)->where('role', Role::Driver)->get();
        return view('routes.create', compact('trucks', 'drivers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRouteRequest $request)
    {
        try{
            $route = Route::create(array_merge(
                $request->validated(),
                ['creator_id' => Auth::user()->id, 'state' => RouteState::DRAFT->value]
            ));
        }catch (\Exception $e){
            Log::error('Action failed', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.route_creation_error'));
        }

        return redirect()
            ->route('routes.pickups.index', $route->id)
            ->with('success', __('messages.route_creation_success'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Route $route)
    {
        $route = $route->load(['driver', 'truck']);
        return view('routes.show', compact('route'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Route $route)
    {
        $trucks = Truck::where('company_id', Auth::user()->company_id)->get();
        $drivers = User::where('company_id', Auth::user()->company_id)->where('role', Role::Driver)->get();
        return view('routes.edit', compact('trucks', 'drivers','route'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRouteRequest $request, Route $route)
    {
        return $this->tryAction(
            fn() => $route->update($request->validated()),
            __('messages.route_update_success'),
            __('messages.route_update_error'),
            route('routes.show', $route->id)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Route $route)
    {
        return $this->tryAction(
            fn() => $route->delete(),
            __('messages.route_deletion_success'),
            __('messages.route_deletion_error'),
            route('routes.index')
        );
    }
}
