<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company\UpdateCompanyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    /**
     * Display the resource.
     */
    public function show()
    {
        $company = Auth::user()->company;
        return view('company.show', compact('company'));
    }

    /**
     * Show the form for editing the resource.
     */
    public function edit()
    {
        $company = Auth::user()->company;
        return view('company.edit', compact('company'));
    }

    /**
     * Update the resource in storage.
     */
    public function update(UpdateCompanyRequest $request)
    {
        return $this->tryAction(
            fn() => Auth::user()->company->update($request->validated()),
            __('messages.company_update_success'),
            __('messages.company_update_error'),
            route('company.show')
        );
    }
}
