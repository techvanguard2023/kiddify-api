<?php

namespace App\Enums;

enum TaskType: string
{
    case Single = 'single';
    case Recurring = 'recurring';

    public function label(): string
    {
        return match($this) {
            self::Single => 'Única',
            self::Recurring => 'Recorrente',
        };
    }
}
