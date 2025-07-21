<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IbuHamilResource\Pages;
use App\Models\IbuHamil;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\Model;
use Filament\Facades\Filament;

class IbuHamilResource extends Resource
{
    protected static ?string $model = IbuHamil::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Data Ibu Hamil';

    public static function getNavigationGroup(): ?string
    {
        return 'Data Individu';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('nama')->required()->label('Nama'),
            TextInput::make('nik')
                ->label('NIK')
                ->required()
                ->minLength(16)
                ->maxLength(16)
                ->rule('digits:16')
                ->inputMode('numeric')
                ->extraInputAttributes(['inputmode' => 'numeric', 'pattern' => '[0-9]*'])
                ->unique(ignoreRecord: true),
            DatePicker::make('tanggal_lahir')->required()->label('Tanggal Lahir'),
            TextInput::make('nama_suami')->required()->label('Nama Suami'),
            TextInput::make('alamat')->required()->label('Alamat'),
            TextInput::make('no_hp')
                ->label('No HP')
                ->numeric()
                ->minLength(10)
                ->maxLength(15)
                ->rule('regex:/^[0-9]{10,15}$/'),
            TextInput::make('hamil_ke')->required()->numeric()->label('Hamil Anak Ke'),
            TextInput::make('berat_badan')
                ->required()
                ->label('Berat Badan (kg)')
                ->afterStateHydrated(fn($component, $state) => $component->state(str_replace('.', ',', $state)))
                ->dehydrateStateUsing(fn($state) => str_replace(',', '.', $state))
                ->rule('regex:/^\d+([\,\.]\d{1,2})?$/')
                ->placeholder('contoh: 60,5'),
            TextInput::make('tinggi_badan')
                ->required()
                ->label('Tinggi Badan (cm)')
                ->afterStateHydrated(fn($component, $state) => $component->state(str_replace('.', ',', $state)))
                ->dehydrateStateUsing(fn($state) => str_replace(',', '.', $state))
                ->rule('regex:/^\d+([\,\.]\d{1,2})?$/')
                ->placeholder('contoh: 155,3'),
        ]);
    }

    public static function table(Table $table): Table
    {
    return $table
        ->columns([
            TextColumn::make('nama')->searchable()->label('Nama'),
            TextColumn::make('nik')->label('NIK'),
            TextColumn::make('tanggal_lahir')->date('d-m-Y')->label('Tanggal Lahir'),
            TextColumn::make('nama_suami')->label('Nama Suami'),
            TextColumn::make('alamat')->label('Alamat')->limit(30),
            TextColumn::make('no_hp')->label('No HP'),
            TextColumn::make('hamil_ke')->label('Hamil Anak Ke'),
            TextColumn::make('berat_badan')
                ->label('Berat Badan (kg)')
                ->formatStateUsing(fn ($state) => number_format($state, 1, ',', '')),
            TextColumn::make('tinggi_badan')
                ->label('Tinggi Badan (cm)')
                ->formatStateUsing(fn ($state) => number_format($state, 1, ',', '')),
        ])
        ->actions([
            ViewAction::make()
                ->visible(fn () => Filament::auth()?->user()?->role === 'bidan'),

            EditAction::make()
                ->visible(fn () => Filament::auth()?->user()?->role === 'kader'),

            DeleteAction::make()
                ->visible(fn () => Filament::auth()?->user()?->role === 'kader'),
        ])
        ->bulkActions([
            BulkActionGroup::make([
                DeleteBulkAction::make()
                    ->visible(fn () => Filament::auth()?->user()?->role === 'kader'),
            ])
        ]);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIbuHamils::route('/'),
            'create' => Pages\CreateIbuHamil::route('/create'),
            'edit' => Pages\EditIbuHamil::route('/{record}/edit'),
        ];
    }

    public function getNamaAttribute($value)
    {
    return ucwords(strtolower($value));
    }

    // Hak akses untuk setiap aksi:
    public static function shouldRegisterNavigation(): bool
    {
        return in_array(Filament::auth()?->user()?->role, ['kader', 'bidan']);
    }

    public static function canViewAny(): bool
    {
        return in_array(Filament::auth()?->user()?->role, ['kader', 'bidan']);
    }

    public static function canView(Model $record): bool
    {
        return in_array(Filament::auth()?->user()?->role, ['kader', 'bidan']);
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
}
