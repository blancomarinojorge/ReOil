<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Truck\StoreTruckRequest;
use App\Http\Requests\Truck\UpdateTruckRequest;
use App\Models\Truck;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class TruckController extends Controller
{
    Use AuthorizesRequests;

    public function __construct()
    {
        //following naming conventions, it authorizes the resource routes (CRUD operations) using TruckPolicy
        $this->authorizeResource(Truck::class, 'truck');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trucks = Truck::where('company_id', auth()->user()->company_id)
            ->orderBy('id', 'desc')
            ->paginate(15);
        return view('trucks.index', compact('trucks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('trucks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTruckRequest $request)
    {
        return $this->tryAction(
            fn() => Auth::user()->company->trucks()->create($request->validated()),
            __('messages.truck_creation_success'),
            __('messages.truck_creation_error'),
            route('trucks.index')
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Truck $truck)
    {
        return view('trucks.show', compact('truck'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Truck $truck)
    {
        return view('trucks.edit', compact('truck'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTruckRequest $request, Truck $truck)
    {
        return $this->tryAction(
            fn() => $truck->update($request->validated()),
            __('messages.truck_update_success'),
            __('messages.truck_update_error'),
            route('trucks.show', compact('truck'))
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Truck $truck)
    {
        return $this->tryAction(
            fn() => $truck->delete(),
            __('messages.truck_deletion_success'),
            __('messages.truck_deletion_error'),
            route('trucks.index')
        );
    }
}
