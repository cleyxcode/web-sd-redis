<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Pengguna Terdaftar';

    protected static ?string $navigationGroup = 'Manajemen';

    protected static ?int $navigationSort = 1;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('role', 'orangtua')
            ->latest();
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Informasi Akun')
                    ->schema([
                        Infolists\Components\TextEntry::make('name')
                            ->label('Nama Lengkap'),
                        Infolists\Components\TextEntry::make('email')
                            ->label('Email'),
                        Infolists\Components\TextEntry::make('no_hp')
                            ->label('No. HP')
                            ->default('-'),
                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Tanggal Daftar')
                            ->dateTime('d M Y, H:i'),
                    ])->columns(2),

                Infolists\Components\Section::make('Riwayat Pendaftaran')
                    ->schema([
                        Infolists\Components\RepeatableEntry::make('pendaftaran')
                            ->label('')
                            ->schema([
                                Infolists\Components\TextEntry::make('nama_anak')
                                    ->label('Nama Anak'),
                                Infolists\Components\TextEntry::make('status')
                                    ->label('Status')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'diterima' => 'success',
                                        'ditolak'  => 'danger',
                                        default    => 'warning',
                                    }),
                                Infolists\Components\TextEntry::make('created_at')
                                    ->label('Tanggal')
                                    ->date('d M Y'),
                            ])
                            ->columns(3),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('no_hp')
                    ->label('No. HP')
                    ->searchable()
                    ->default('-'),
                Tables\Columns\TextColumn::make('pendaftaran_count')
                    ->label('Jml Pendaftaran')
                    ->counts('pendaftaran')
                    ->badge()
                    ->color('info'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Daftar')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->headerActions([
                ExportAction::make()->exports([
                    ExcelExport::make()
                        ->withFilename(date('Y-m-d') . '_data-pengguna')
                        ->withColumns([
                            Column::make('name')->heading('Nama'),
                            Column::make('email')->heading('Email'),
                            Column::make('no_hp')->heading('No. HP'),
                            Column::make('created_at')->heading('Tanggal Daftar'),
                        ]),
                ]),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                ExportBulkAction::make()->exports([
                    ExcelExport::make()
                        ->withFilename(date('Y-m-d') . '_data-pengguna-terpilih')
                        ->withColumns([
                            Column::make('name')->heading('Nama'),
                            Column::make('email')->heading('Email'),
                            Column::make('no_hp')->heading('No. HP'),
                            Column::make('created_at')->heading('Tanggal Daftar'),
                        ]),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'view'  => Pages\ViewUser::route('/{record}'),
        ];
    }
}
