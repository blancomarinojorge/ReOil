<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Container\StoreContainerRequest;
use App\Http\Requests\Container\UpdateContainerRequest;
use App\Models\Client;
use App\Models\Container;
use App\Models\ContainerType;
use Illuminate\Support\Facades\Auth;

class ContainerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $containers = Container::with(['containerType', 'client'])
            ->whereHas('client', function($query){
                $query->where('company_id', Auth::user()->company_id);
            })
            ->latest()
            ->paginate();

        return view('container.index', compact('containers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::where('company_id', Auth::user()->company_id)->get();
        $containerTypes = ContainerType::where('company_id', Auth::user()->company_id)->get();
        return view('container.create', compact('clients', 'containerTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContainerRequest $request)
    {
        return $this->tryAction(
            fn() => Container::create($request->validated()),
            __('messages.client_container_creation_success'),
            __('messages.client_container_creation_error'),
            route('containers.index')
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Container $container)
    {
        $container->load(['containerType', 'client']);
        return view('container.show', compact('container'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Container $container)
    {
        $clients = Client::where('company_id', Auth::user()->company_id)->get();
        $containerTypes = ContainerType::where('company_id', Auth::user()->company_id)->get();
        return view('container.edit', compact('container', 'clients', 'containerTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContainerRequest $request, Container $container)
    {
        return $this->tryAction(
            fn() => $container->update($request->validated()),
            __('messages.client_container_update_success'),
            __('messages.client_container_update_error'),
            route('containers.show', $container->id)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Container $container)
    {
        return $this->tryAction(
            fn()=>$container->delete(),
            __('messages.client_container_deletion_success'),
            __('messages.client_container_deletion_error'),
            route('containers.index')
        );
    }
}
