<?php

namespace App\Enums;

enum OrderStatus: string
{
    case START = 'start';
    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    public function color(): string
    {
        return match ($this) {
            OrderStatus::START => 'primary',
            OrderStatus::PENDING => 'warning',
            OrderStatus::IN_PROGRESS => 'info',
            OrderStatus::COMPLETED => 'success',
            OrderStatus::CANCELLED => 'danger',
        };
    }
}
