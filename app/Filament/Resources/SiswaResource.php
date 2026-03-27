<?php

namespace App\Filament\Resources;

use AhmedAbdelrhman\FilamentMediaGallery\Infolists\Components\MediaGalleryEntry;
use App\Enums\StatusSiswa;
use App\Filament\Resources\SiswaResource\Pages;
use Guava\FilamentIconSelectColumn\Tables\Columns\IconSelectColumn;
use App\Models\Siswa;
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

class SiswaResource extends Resource
{
    protected static ?string $model = Siswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Siswa';
    protected static ?string $navigationGroup = 'Data Sekolah';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Siswa')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->required(),
                        Forms\Components\TextInput::make('nis'),
                        Forms\Components\TextInput::make('kelas'),
                        Forms\Components\Select::make('jenis_kelamin')
                            ->options([
                                'L' => 'Laki-laki',
                                'P' => 'Perempuan',
                            ]),
                        Forms\Components\TextInput::make('tahun_ajaran'),
                        Forms\Components\Select::make('status')
                            ->options([
                                'aktif' => 'Aktif',
                                'nonaktif' => 'Non Aktif',
                                'lulus' => 'Lulus',
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
            Infolists\Components\Section::make('Data Siswa')
                ->schema([
                    Infolists\Components\TextEntry::make('nama')->label('Nama'),
                    Infolists\Components\TextEntry::make('nis')->label('NIS')->default('-'),
                    Infolists\Components\TextEntry::make('kelas')->label('Kelas')->default('-'),
                    Infolists\Components\TextEntry::make('jenis_kelamin')->label('Jenis Kelamin')->default('-'),
                    Infolists\Components\TextEntry::make('tahun_ajaran')->label('Tahun Ajaran')->default('-'),
                    Infolists\Components\TextEntry::make('status')
                        ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'aktif'    => 'success',
                            'lulus'    => 'info',
                            default    => 'warning',
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
                Tables\Columns\TextColumn::make('nis')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kelas')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenis_kelamin'),
                Tables\Columns\TextColumn::make('tahun_ajaran')
                    ->searchable(),
                IconSelectColumn::make('status')
                    ->options(StatusSiswa::class)
                    ->closeOnSelection(),
            ])
            ->defaultSort('created_at', 'desc')
            ->headerActions([
                ExportAction::make()->exports([
                    ExcelExport::make()
                        ->withFilename(date('Y-m-d') . '_data-siswa')
                        ->withColumns([
                            Column::make('nama')->heading('Nama'),
                            Column::make('nis')->heading('NIS'),
                            Column::make('kelas')->heading('Kelas'),
                            Column::make('jenis_kelamin')->heading('Jenis Kelamin'),
                            Column::make('tahun_ajaran')->heading('Tahun Ajaran'),
                            Column::make('status')->heading('Status'),
                        ]),
                ]),
            ])
            ->filters([
                SelectFilter::make('kelas'),
                SelectFilter::make('status')
                    ->options([
                        'aktif' => 'Aktif',
                        'nonaktif' => 'Non Aktif',
                        'lulus' => 'Lulus',
                    ]),
                SelectFilter::make('tahun_ajaran'),
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
                            ->withFilename(date('Y-m-d') . '_data-siswa-terpilih')
                            ->withColumns([
                                Column::make('nama')->heading('Nama'),
                                Column::make('nis')->heading('NIS'),
                                Column::make('kelas')->heading('Kelas'),
                                Column::make('jenis_kelamin')->heading('Jenis Kelamin'),
                                Column::make('tahun_ajaran')->heading('Tahun Ajaran'),
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
            'index'  => Pages\ListSiswas::route('/'),
            'create' => Pages\CreateSiswa::route('/create'),
            'view'   => Pages\ViewSiswa::route('/{record}'),
            'edit'   => Pages\EditSiswa::route('/{record}/edit'),
        ];
    }
}
