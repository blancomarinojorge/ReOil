<?php

namespace App\Enums\RouteState;

use phpDocumentor\Reflection\Types\Integer;

enum RouteState: Integer
{
    case DRAFT = 0;
    case PENDING = 1;
    case IN_PROGRESS = 2;
    case COMPLETED = 3;
    case CANCELLED = 4;

    public function getLabel(): string{
        return match ($this) {
            self::DRAFT => 'Draft',
            self::PENDING => 'Pending',
            self::IN_PROGRESS => 'In Progress',
            self::COMPLETED => 'Completed',
            self::CANCELLED => 'Cancelled',
        };
    }
}
