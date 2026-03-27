<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum StatusPendaftaran: string implements HasLabel, HasIcon, HasColor
{
    case Pending  = 'pending';
    case Diterima = 'diterima';
    case Ditolak  = 'ditolak';

    public function getLabel(): string
    {
        return match ($this) {
            self::Pending  => 'Pending',
            self::Diterima => 'Diterima',
            self::Ditolak  => 'Ditolak',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::Pending  => 'heroicon-o-clock',
            self::Diterima => 'heroicon-o-check-circle',
            self::Ditolak  => 'heroicon-o-x-circle',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Pending  => 'warning',
            self::Diterima => 'success',
            self::Ditolak  => 'danger',
        };
    }
}
