<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum StatusSiswa: string implements HasLabel, HasIcon, HasColor
{
    case Aktif    = 'aktif';
    case Nonaktif = 'nonaktif';
    case Lulus    = 'lulus';

    public function getLabel(): string
    {
        return match ($this) {
            self::Aktif    => 'Aktif',
            self::Nonaktif => 'Non Aktif',
            self::Lulus    => 'Lulus',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::Aktif    => 'heroicon-o-check-circle',
            self::Nonaktif => 'heroicon-o-pause-circle',
            self::Lulus    => 'heroicon-o-academic-cap',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Aktif    => 'success',
            self::Nonaktif => 'warning',
            self::Lulus    => 'info',
        };
    }
}
