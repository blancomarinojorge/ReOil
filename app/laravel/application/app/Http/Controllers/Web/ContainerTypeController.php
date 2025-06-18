<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContainerType\StoreContainerTypeRequest;
use App\Http\Requests\ContainerType\UpdateContainerTypeRequest;
use App\Models\ContainerType;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class ContainerTypeController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(ContainerType::class, 'container_type');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $container_types = ContainerType::where('company_id', Auth::user()->company_id)->latest()->paginate();
        return view('container_types.index', compact('container_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('container_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContainerTypeRequest $request)
    {
        return $this->tryAction(
            fn()=>Auth::user()->company->containerTypes()->create($request->validated()),
            __('messages.container_type_creation_success'),
            __('messages.container_type_creation_error'),
            route('container_types.index')
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(ContainerType $containerType)
    {
        return view('container_types.show', compact('containerType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContainerType $containerType)
    {
        return view('container_types.edit', compact('containerType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContainerTypeRequest $request, ContainerType $containerType)
    {
        return $this->tryAction(
            fn() => $containerType->update($request->validated()),
            __('messages.container_type_update_success'),
            __('messages.container_type_update_error'),
            route('container_types.show', ['container_type' => $containerType->id])
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContainerType $containerType)
    {
        return $this->tryAction(
            fn() => $containerType->delete(),
            __('messages.container_type_deletion_success'),
            __('messages.container_type_deletion_error'),
            route('container_types.index')
        );
    }
}
