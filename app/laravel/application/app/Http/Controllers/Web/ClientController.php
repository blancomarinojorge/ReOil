<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\StoreClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    Use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(Client::class, 'client');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::where('company_id', auth()->user()->company_id)
            ->orderBy('id', 'desc')
            ->paginate(15);
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
        return $this->tryAction(
            fn() => Auth::user()->company->clients()->create($request->validated()),
            __('messages.client_creation_success'),
            __('messages.client_creation_error'),
            route('clients.index')
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        return $this->tryAction(
            fn() => $client->update($request->validated()),
            __('messages.client_update_success'),
            __('messages.client_update_error'),
            route('clients.show', compact('client'))
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        return $this->tryAction(
            fn() => $client->delete(),
            __('messages.client_deletion_success'),
            __('messages.client_deletion_error'),
            route('clients.index')
        );
    }
}
