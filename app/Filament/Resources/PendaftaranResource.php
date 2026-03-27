<?php

namespace App\Filament\Resources;

use AhmedAbdelrhman\FilamentMediaGallery\Infolists\Components\MediaGalleryEntry;
use App\Enums\StatusPendaftaran;
use App\Filament\Resources\PendaftaranResource\Pages;
use App\Models\Pendaftaran;
use Guava\FilamentIconSelectColumn\Tables\Columns\IconSelectColumn;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class PendaftaranResource extends Resource
{
    protected static ?string $model = Pendaftaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Pendaftaran';
    protected static ?string $navigationGroup = 'Pendaftaran (PPDB)';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Status Pendaftaran')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'diterima' => 'Diterima',
                                'ditolak' => 'Ditolak',
                            ])
                            ->required(),
                    ]),

                Forms\Components\Section::make('Dokumen')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('dokumen')
                            ->collection('dokumen')
                            ->acceptedFileTypes(['application/pdf', 'image/*'])
                            ->label('Upload Dokumen (PDF / Gambar)'),
                    ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Data Anak')
                    ->schema([
                        Infolists\Components\TextEntry::make('nama_anak'),
                        Infolists\Components\TextEntry::make('tempat_lahir'),
                        Infolists\Components\TextEntry::make('tanggal_lahir')->date(),
                        Infolists\Components\TextEntry::make('jenis_kelamin'),
                        Infolists\Components\TextEntry::make('agama'),
                        Infolists\Components\TextEntry::make('anak_ke'),
                        Infolists\Components\TextEntry::make('asal_sekolah'),
                        Infolists\Components\TextEntry::make('nik'),
                        Infolists\Components\TextEntry::make('no_kk'),
                    ])->columns(3),

                Infolists\Components\Section::make('Alamat')
                    ->schema([
                        Infolists\Components\TextEntry::make('alamat')->columnSpanFull(),
                    ]),

                Infolists\Components\Section::make('Data Orang Tua')
                    ->schema([
                        Infolists\Components\TextEntry::make('nama_ayah'),
                        Infolists\Components\TextEntry::make('pekerjaan_ayah'),
                        Infolists\Components\TextEntry::make('nama_ibu'),
                        Infolists\Components\TextEntry::make('pekerjaan_ibu'),
                        Infolists\Components\TextEntry::make('nama_wali'),
                        Infolists\Components\TextEntry::make('no_hp'),
                    ])->columns(3),

                Infolists\Components\Section::make('Dokumen')
                    ->schema([
                        MediaGalleryEntry::make('dokumen')
                            ->collection('dokumen')
                            ->size(200)
                            ->label(''),
                    ]),

                Infolists\Components\Section::make('Status Pendaftaran')
                    ->schema([
                        Infolists\Components\TextEntry::make('status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'diterima' => 'success',
                                'ditolak'  => 'danger',
                                default    => 'warning',
                            }),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_anak')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_ayah')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_hp')
                    ->searchable(),
                Tables\Columns\TextColumn::make('asal_sekolah')
                    ->searchable(),
                IconSelectColumn::make('status')
                    ->options(StatusPendaftaran::class)
                    ->closeOnSelection(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'diterima' => 'Diterima',
                        'ditolak' => 'Ditolak',
                    ]),
            ])
            ->headerActions([
                ExportAction::make()->exports([
                    ExcelExport::make()
                        ->withFilename(date('Y-m-d') . '_data-pendaftaran')
                        ->withColumns([
                            Column::make('nama_anak')->heading('Nama Anak'),
                            Column::make('tempat_lahir')->heading('Tempat Lahir'),
                            Column::make('tanggal_lahir')->heading('Tanggal Lahir'),
                            Column::make('jenis_kelamin')->heading('Jenis Kelamin'),
                            Column::make('agama')->heading('Agama'),
                            Column::make('anak_ke')->heading('Anak Ke'),
                            Column::make('asal_sekolah')->heading('Asal Sekolah'),
                            Column::make('nik')->heading('NIK'),
                            Column::make('no_kk')->heading('No. KK'),
                            Column::make('alamat')->heading('Alamat'),
                            Column::make('nama_ayah')->heading('Nama Ayah'),
                            Column::make('pekerjaan_ayah')->heading('Pekerjaan Ayah'),
                            Column::make('nama_ibu')->heading('Nama Ibu'),
                            Column::make('pekerjaan_ibu')->heading('Pekerjaan Ibu'),
                            Column::make('nama_wali')->heading('Nama Wali'),
                            Column::make('no_hp')->heading('No. HP'),
                            Column::make('status')->heading('Status'),
                            Column::make('created_at')->heading('Tanggal Daftar'),
                        ]),
                ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                ExportBulkAction::make()->exports([
                    ExcelExport::make()
                        ->withFilename(date('Y-m-d') . '_data-pendaftaran-terpilih')
                        ->withColumns([
                            Column::make('nama_anak')->heading('Nama Anak'),
                            Column::make('tempat_lahir')->heading('Tempat Lahir'),
                            Column::make('tanggal_lahir')->heading('Tanggal Lahir'),
                            Column::make('jenis_kelamin')->heading('Jenis Kelamin'),
                            Column::make('agama')->heading('Agama'),
                            Column::make('asal_sekolah')->heading('Asal Sekolah'),
                            Column::make('alamat')->heading('Alamat'),
                            Column::make('nama_ayah')->heading('Nama Ayah'),
                            Column::make('nama_ibu')->heading('Nama Ibu'),
                            Column::make('no_hp')->heading('No. HP'),
                            Column::make('status')->heading('Status'),
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
            'index' => Pages\ListPendaftarans::route('/'),
            'view' => Pages\ViewPendaftaran::route('/{record}'),
            'edit' => Pages\EditPendaftaran::route('/{record}/edit'),
        ];
    }
}
