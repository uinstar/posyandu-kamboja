<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LansiaResource\Pages;
use App\Models\Lansia;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\Model;
use Filament\Facades\Filament;

class LansiaResource extends Resource
{
    protected static ?string $model = Lansia::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $navigationLabel = 'Data Lansia';

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
            Select::make('jenis_kelamin')
                ->options([
                    'Laki-laki' => 'Laki-laki',
                    'Perempuan' => 'Perempuan',
                ])
                ->required()
                ->label('Jenis Kelamin'),
            TextInput::make('pekerjaan')->required()->label('Pekerjaan'),
            TextInput::make('alamat')->required()->label('Alamat'),
            TextInput::make('no_hp')
                ->label('No HP')
                ->numeric()
                ->minLength(10)
                ->maxLength(15)
                ->rule('regex:/^[0-9]{10,15}$/'),
        ]);
    }

    public static function table(Table $table): Table
{
    return $table->columns([
        TextColumn::make('nama')->searchable()->label('Nama'),
        TextColumn::make('nik')->label('NIK'),
        TextColumn::make('tanggal_lahir')->date('d-m-Y')->label('Tanggal Lahir'),
        TextColumn::make('usia')->label('Usia')->formatStateUsing(function ($record) {
            return \Carbon\Carbon::parse($record->tanggal_lahir)->age . ' tahun';
        }),
        TextColumn::make('jenis_kelamin')->label('Jenis Kelamin'),
        TextColumn::make('pekerjaan')->label('Pekerjaan'),
        TextColumn::make('alamat')->label('Alamat')->limit(30),
        TextColumn::make('no_hp')->label('No HP'),
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
        ]),
    ]);
}

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLansias::route('/'),
            'create' => Pages\CreateLansia::route('/create'),
            'edit' => Pages\EditLansia::route('/{record}/edit'),
        ];
    }

    public function getNamaAttribute($value)
    {
    return ucwords(strtolower($value));
    }
    
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
