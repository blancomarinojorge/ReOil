<?php

namespace App\Enums\Auth;

enum Role: int
{
    case Admin = 1;
    case Driver = 2;
    case OfficeStaff = 3;

    public function label(): string{
        return match ($this){
            self::Admin => 'Admin',
            self::Driver => 'Camionero',
            self::OfficeStaff => 'Oficinista',
        };
    }
}
