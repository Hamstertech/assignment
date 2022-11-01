<?php

namespace App\Enums;

enum EnumStatus: int {
    case UNDERGOING = 0;
    case COMPLETED = 1;

    
    public function toString(): string {
        return match ($this) {
            EnumStatus::UNDERGOING => 'To Do',
            EnumStatus::COMPLETED => 'Completed',
        };
    }

    public function toColor(): string {
        return match ($this) {
            EnumStatus::UNDERGOING => 'bg-amber-600',
            EnumStatus::COMPLETED => 'bg-emerald-600',
        };
    }
    
}
