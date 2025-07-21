<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BalitaResource\Pages;
use App\Models\Balita;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Facades\Filament;

class BalitaResource extends Resource
{
    protected static ?string $model = Balita::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Data Balita';
    protected static ?string $pluralModelLabel = 'Balita';

    public static function getNavigationGroup(): ?string
    {
        return 'Data Individu';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('nama')
                ->required()
                ->label('Nama Balita'),

            TextInput::make('nik')
             ->label('NIK Balita/Ibu')
             ->required()
             ->minLength(16)
             ->maxLength(16)
             ->rule('digits:16')
                 ->inputMode('numeric') // tampilkan keyboard angka, TAPI tetap type="text"
                 ->extraInputAttributes(['inputmode' => 'numeric', 'pattern' => '[0-9]*'])
                  ->unique(ignoreRecord: true),

            DatePicker::make('tanggal_lahir')
                ->required()
                ->label('Tanggal Lahir'),
            
            Select::make('jenis_kelamin')
             ->options([
             'laki-laki' => 'Laki-laki',
             'perempuan' => 'Perempuan',
             ])
             ->required()
            ->label('Jenis Kelamin'),

            // BB lahir (kg) pakai koma
            TextInput::make('bb_lahir')
                ->required()
                ->label('Berat Badan Lahir (kg)')
                ->afterStateHydrated(fn($component, $state) => $component->state(str_replace('.', ',', $state)))
                ->dehydrateStateUsing(fn($state) => str_replace(',', '.', $state))
                ->rule('regex:/^\d+([\,\.]\d{1,2})?$/')
                ->placeholder('contoh: 3,2'),

            // PB lahir (cm) pakai koma
            TextInput::make('panjang_badan_lahir')
                ->required()
                ->label('Panjang Badan Lahir (cm)')
                ->afterStateHydrated(fn($component, $state) => $component->state(str_replace('.', ',', $state)))
                ->dehydrateStateUsing(fn($state) => str_replace(',', '.', $state))
                ->rule('regex:/^\d+([\,\.]\d{1,2})?$/')
                ->placeholder('contoh: 49,5'),

            TextInput::make('nama_ibu')
                ->required()
                ->label('Nama Ibu'),

            TextInput::make('no_hp')
                     ->label('No HP')
                     ->numeric()
                      ->minLength(10)
                      ->maxLength(15)
                      ->rule('regex:/^[0-9]{10,15}$/'),

            Textarea::make('alamat')
                ->required()
                ->label('Alamat'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')->searchable()->sortable()->label('Nama Balita'),
                TextColumn::make('nik')->label('NIK'),
                TextColumn::make('tanggal_lahir')->date('d-m-Y')->label('Tanggal Lahir'),
                TextColumn::make('jenis_kelamin')->label('Jenis Kelamin')->sortable(),

                TextColumn::make('bb_lahir')
                    ->label('BB Lahir (kg)')
                    ->formatStateUsing(fn($state) => number_format($state, 1, ',', '')),

                TextColumn::make('panjang_badan_lahir')
                    ->label('PB Lahir (cm)')
                    ->formatStateUsing(fn($state) => number_format($state, 1, ',', '')),

                TextColumn::make('nama_ibu')->label('Nama Ibu'),
                TextColumn::make('no_hp')->label('No HP'),
                TextColumn::make('alamat')->label('Alamat')->limit(30),
            ])

            ->filters([
    \Filament\Tables\Filters\SelectFilter::make('jenis_kelamin')
        ->label('Jenis Kelamin')
        ->options([
            'Laki-laki' => 'Laki-laki',
            'Perempuan' => 'Perempuan',
        ]),
])
            ->actions([
                \Filament\Tables\Actions\EditAction::make(),
                \Filament\Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Tables\Actions\BulkActionGroup::make([
                    \Filament\Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListBalitas::route('/'),
            'create' => Pages\CreateBalita::route('/create'),
            'edit' => Pages\EditBalita::route('/{record}/edit'),
        ];
    }

    public function getNamaAttribute($value)
    {
    return ucwords(strtolower($value));
    }

    public function getNamaIbuAttribute($value)
    {
    return ucwords(strtolower($value));
    }


    // 🔒 Role Permissions
    public static function canCreate(): bool
    {
        return auth()->user()?->role === 'kader';
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()?->role === 'kader';
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()?->role === 'kader';
    }

    public static function canViewAny(): bool
    {
        return auth()->check(); // semua user login bisa lihat
    }

    public static function canView(Model $record): bool
    {
        return auth()->check(); // semua user login bisa lihat
    }
}

