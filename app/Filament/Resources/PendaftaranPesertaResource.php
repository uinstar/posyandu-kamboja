<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendaftaranPesertaResource\Pages;
use App\Models\PendaftaranPeserta;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\KeyValue;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Facades\Filament;

class PendaftaranPesertaResource extends Resource
{
    protected static ?string $model = PendaftaranPeserta::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationLabel = 'Pendaftaran Peserta';

    public static function shouldRegisterNavigation(): bool
    {
        return Filament::auth()?->user()?->role === 'kader';
    }

    public static function canViewAny(): bool
    {
        return Filament::auth()?->user()?->role === 'kader';
    }

    public static function canView(Model $record): bool
    {
        return Filament::auth()?->user()?->role === 'kader';
    }

    public static function canCreate(): bool
    {
        return Filament::auth()?->user()?->role === 'kader';
    }

    public static function canEdit(Model $record): bool
    {
        return Filament::auth()?->user()?->role === 'kader';
    }

    public static function canDelete(Model $record): bool
    {
        return Filament::auth()?->user()?->role === 'kader';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('kategori')
                ->options([
                    'Balita' => 'Balita',
                    'Ibu Hamil' => 'Ibu Hamil',
                    'Lansia' => 'Lansia',
                ])
                ->required(),

            Select::make('status')
                ->options([
                    'pending' => 'Pending',
                    'disetujui' => 'Disetujui',
                    'ditolak' => 'Ditolak',
                ])
                ->default('pending')
                ->required(),

            Forms\Components\Placeholder::make('data_tambahan_display')
                ->label('Data Tambahan')
                ->content(fn ($record) => $record ? new \Illuminate\Support\HtmlString($record->getDataTambahanFormatted()) : 'Tidak ada data'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kategori')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Balita' => 'success',
                        'Ibu Hamil' => 'warning',
                        'Lansia' => 'info',
                        default => 'gray',
                    }),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'disetujui' => 'success',
                        'ditolak' => 'danger',
                    }),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Tanggal Daftar'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori')
                    ->options([
                        'Balita' => 'Balita',
                        'Ibu Hamil' => 'Ibu Hamil',
                        'Lansia' => 'Lansia',
                    ]),

                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'disetujui' => 'Disetujui',
                        'ditolak' => 'Ditolak',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPendaftaranPesertas::route('/'),
            'create' => Pages\CreatePendaftaranPeserta::route('/create'),
            'edit' => Pages\EditPendaftaranPeserta::route('/{record}/edit'),
        ];
    }
}
