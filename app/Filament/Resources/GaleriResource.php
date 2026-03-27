<?php

namespace App\Filament\Resources;

use AhmedAbdelrhman\FilamentMediaGallery\Infolists\Components\MediaGalleryEntry;
use App\Filament\Resources\GaleriResource\Pages;
use App\Models\Galeri;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class GaleriResource extends Resource
{
    protected static ?string $model = Galeri::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationLabel = 'Galeri';
    protected static ?string $navigationGroup = 'Konten Website';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('judul')
                    ->required(),
                SpatieMediaLibraryFileUpload::make('foto')
                    ->collection('foto')
                    ->image()
                    ->required()
                    ->imageEditor(),
                Forms\Components\Textarea::make('keterangan'),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Infolists\Components\Section::make('Informasi')
                ->schema([
                    Infolists\Components\TextEntry::make('judul')->label('Judul'),
                    Infolists\Components\TextEntry::make('keterangan')->label('Keterangan'),
                ])->columns(2),

            Infolists\Components\Section::make('Foto')
                ->schema([
                    MediaGalleryEntry::make('foto')
                        ->collection('foto')
                        ->size(300)
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
                    ->square()
                    ->defaultImageUrl(asset('images/no-image.png')),
                Tables\Columns\TextColumn::make('judul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('keterangan')
                    ->limit(50),
            ])
            ->defaultSort('created_at', 'desc')
            ->headerActions([
                ExportAction::make()->exports([
                    ExcelExport::make()
                        ->withFilename(date('Y-m-d') . '_data-galeri')
                        ->withColumns([
                            Column::make('judul')->heading('Judul'),
                            Column::make('keterangan')->heading('Keterangan'),
                            Column::make('created_at')->heading('Tanggal Upload'),
                        ]),
                ]),
            ])
            ->filters([
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
                            ->withFilename(date('Y-m-d') . '_data-galeri-terpilih')
                            ->withColumns([
                                Column::make('judul')->heading('Judul'),
                                Column::make('keterangan')->heading('Keterangan'),
                                Column::make('created_at')->heading('Tanggal Upload'),
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
            'index'  => Pages\ListGaleris::route('/'),
            'create' => Pages\CreateGaleri::route('/create'),
            'view'   => Pages\ViewGaleri::route('/{record}'),
            'edit'   => Pages\EditGaleri::route('/{record}/edit'),
        ];
    }
}
