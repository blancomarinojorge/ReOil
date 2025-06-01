<?php

namespace App\Http\Middleware\Auth;

class Authenticate extends \Illuminate\Auth\Middleware\Authenticate
{
    protected function unauthenticated($request, array $guards): void
    {
        session()->flash('error',__('messages.unauthenticated_error'));
        parent::unauthenticated($request, $guards);
    }
}
