<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum StatusAktif: string implements HasLabel, HasIcon, HasColor
{
    case Aktif    = 'aktif';
    case Nonaktif = 'nonaktif';

    public function getLabel(): string
    {
        return match ($this) {
            self::Aktif    => 'Aktif',
            self::Nonaktif => 'Non Aktif',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::Aktif    => 'heroicon-o-check-circle',
            self::Nonaktif => 'heroicon-o-pause-circle',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Aktif    => 'success',
            self::Nonaktif => 'danger',
        };
    }
}
