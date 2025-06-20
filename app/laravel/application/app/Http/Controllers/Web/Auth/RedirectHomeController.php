<?php

namespace App\Http\Controllers\Web\Auth;

use App\Enums\Auth\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RedirectHomeController extends Controller
{
    public function __invoke(){
        return match (Auth::user()->role){
            Role::Admin => redirect(route('routes.index')),
            Role::Driver => redirect(route('routes.index')),
            Role::OfficeStaff => redirect(route('routes.index')),
        };
    }
}
