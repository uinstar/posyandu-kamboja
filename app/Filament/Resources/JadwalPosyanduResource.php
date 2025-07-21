<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JadwalPosyanduResource\Pages;
use App\Models\JadwalPosyandu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Facades\Filament;

class JadwalPosyanduResource extends Resource
{
    protected static ?string $model = JadwalPosyandu::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'Jadwal Posyandu';

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
            DatePicker::make('tanggal')->required(),
            TextInput::make('hari')->required(),
            TextInput::make('waktu')->required(),
            TextInput::make('lokasi')->required(),
            TextInput::make('jenis_kegiatan')->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('tanggal')->date(),
            TextColumn::make('hari'),
            TextColumn::make('waktu'),
            TextColumn::make('lokasi'),
            TextColumn::make('jenis_kegiatan'),
        ])
        ->actions([
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
            'index' => Pages\ListJadwalPosyandus::route('/'),
            'create' => Pages\CreateJadwalPosyandu::route('/create'),
            'edit' => Pages\EditJadwalPosyandu::route('/{record}/edit'),
        ];
    }
}
