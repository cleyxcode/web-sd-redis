<?php

namespace App\Filament\Resources;

use AhmedAbdelrhman\FilamentMediaGallery\Infolists\Components\MediaGalleryEntry;
use App\Enums\StatusAktif;
use App\Filament\Resources\GuruResource\Pages;
use Guava\FilamentIconSelectColumn\Tables\Columns\IconSelectColumn;
use App\Models\Guru;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class GuruResource extends Resource
{
    protected static ?string $model = Guru::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = 'Guru';
    protected static ?string $navigationGroup = 'Data Sekolah';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Guru')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->required(),
                        Forms\Components\TextInput::make('nip'),
                        Forms\Components\TextInput::make('jabatan'),
                        Forms\Components\TextInput::make('mata_pelajaran'),
                        Forms\Components\TextInput::make('no_hp'),
                        Forms\Components\Select::make('status')
                            ->options([
                                'aktif' => 'Aktif',
                                'nonaktif' => 'Non Aktif',
                            ])
                            ->default('aktif')
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('Foto')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('foto')
                            ->collection('foto')
                            ->image()
                            ->imageEditor(),
                    ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Infolists\Components\Section::make('Data Guru')
                ->schema([
                    Infolists\Components\TextEntry::make('nama')->label('Nama'),
                    Infolists\Components\TextEntry::make('nip')->label('NIP')->default('-'),
                    Infolists\Components\TextEntry::make('jabatan')->label('Jabatan')->default('-'),
                    Infolists\Components\TextEntry::make('mata_pelajaran')->label('Mata Pelajaran')->default('-'),
                    Infolists\Components\TextEntry::make('no_hp')->label('No. HP')->default('-'),
                    Infolists\Components\TextEntry::make('status')
                        ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'aktif' => 'success',
                            default => 'danger',
                        }),
                ])->columns(2),

            Infolists\Components\Section::make('Foto')
                ->schema([
                    MediaGalleryEntry::make('foto')
                        ->collection('foto')
                        ->size(200)
                        ->rounded()
                        ->label(''),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('foto')
                    ->collection('foto')
                    ->circular(),
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nip')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jabatan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mata_pelajaran')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_hp')
                    ->searchable(),
                IconSelectColumn::make('status')
                    ->options(StatusAktif::class)
                    ->closeOnSelection(),
            ])
            ->defaultSort('created_at', 'desc')
            ->headerActions([
                ExportAction::make()->exports([
                    ExcelExport::make()
                        ->withFilename(date('Y-m-d') . '_data-guru')
                        ->withColumns([
                            Column::make('nama')->heading('Nama'),
                            Column::make('nip')->heading('NIP'),
                            Column::make('jabatan')->heading('Jabatan'),
                            Column::make('mata_pelajaran')->heading('Mata Pelajaran'),
                            Column::make('no_hp')->heading('No. HP'),
                            Column::make('status')->heading('Status'),
                        ]),
                ]),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'aktif' => 'Aktif',
                        'nonaktif' => 'Non Aktif',
                    ]),
                TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make()->exports([
                        ExcelExport::make()
                            ->withFilename(date('Y-m-d') . '_data-guru-terpilih')
                            ->withColumns([
                                Column::make('nama')->heading('Nama'),
                                Column::make('nip')->heading('NIP'),
                                Column::make('jabatan')->heading('Jabatan'),
                                Column::make('mata_pelajaran')->heading('Mata Pelajaran'),
                                Column::make('no_hp')->heading('No. HP'),
                                Column::make('status')->heading('Status'),
                            ]),
                    ]),
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([SoftDeletingScope::class]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListGurus::route('/'),
            'create' => Pages\CreateGuru::route('/create'),
            'view'   => Pages\ViewGuru::route('/{record}'),
            'edit'   => Pages\EditGuru::route('/{record}/edit'),
        ];
    }
}
