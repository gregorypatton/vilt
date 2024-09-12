<?php
namespace App\Enums;

Enum WorkOrderPriorityEnum: int{
    case HIGH = 1;
    case MEDIUM = 2;
    case NORMAL = 3;
    case LOW = 4;

    // Returns a string for the frontend
    public function label(): string
    {
        return match($this) {
            self::HIGH => 'High',
            self::MEDIUM => 'Medium',
            self::NORMAL => 'Normal',
            self::LOW => 'Low',
        };
    }
}