<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Auth\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RedirectHomeController extends Controller
{
    public function __invoke(){
        return match (Auth::user()->role){
            Role::Admin => redirect(route('admin.index')),
            Role::Driver => redirect('/driver'),
            Role::OfficeStaff => redirect('/office'),
        };
    }
}
