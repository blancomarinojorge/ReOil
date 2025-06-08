<?php

namespace App\Http\Controllers;

use App\Traits\HandlesResourceActions;
use Barryvdh\Debugbar\Controllers\BaseController;

abstract class Controller extends BaseController
{
    use HandlesResourceActions;
}
