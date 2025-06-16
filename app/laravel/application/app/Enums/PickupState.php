<?php

namespace App\Enums;

enum PickupState: int{
    case PENDING = 0;
    case COMPLETED = 1;
    case CANCELLED = 2;

    public function getLabel(): string{
        return match ($this) {
            self::PENDING => 'Pending',
            self::COMPLETED => 'Completed',
            self::CANCELLED => 'Cancelled',
        };
    }
}
