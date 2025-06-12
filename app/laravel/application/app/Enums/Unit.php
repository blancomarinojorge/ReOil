<?php

namespace App\Enums;

enum Unit: string {
    case Liters = 'lt';
    case Pieces = 'pcs';
    case Kilograms = 'kg';

    public function getLabel(): string{
        return match ($this) {
            self::Liters => 'Liters',
            self::Pieces => 'Pieces',
            self::Kilograms => 'Kilograms',
        };
    }
}
