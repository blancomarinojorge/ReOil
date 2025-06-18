<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Residue\StoreResidueRequest;
use App\Http\Requests\Residue\UpdateResidueRequest;
use App\Models\Residue;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class ResidueController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(Residue::class, 'residue');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $residues = Auth::user()->company->residues()->latest()->paginate(15);
        return view('residues.index', compact('residues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('residues.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreResidueRequest $request)
    {
        return $this->tryAction(
            fn() => Auth::user()->company->residues()->create($request->validated()),
            __('messages.residue_creation_success'),
            __('messages.residue_creation_error'),
            route('residues.index')
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Residue $residue)
    {
        return view('residues.show', compact('residue'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Residue $residue)
    {
        return view('residues.edit', compact('residue'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateResidueRequest $request, Residue $residue)
    {
        return $this->tryAction(
            fn() => $residue->update($request->validated()),
            __('messages.residue_update_success'),
            __('messages.residue_update_error'),
            route('residues.show', compact('residue'))
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Residue $residue)
    {
        return $this->tryAction(
            fn() => $residue->delete(),
            __('messages.residue_deletion_success'),
            __('messages.residue_deletion_error'),
            route('residues.index')
        );
    }
}
