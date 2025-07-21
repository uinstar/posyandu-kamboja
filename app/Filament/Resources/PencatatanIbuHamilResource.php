<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PencatatanIbuHamilResource\Pages;
use App\Models\IbuHamil;
use App\Models\PencatatanIbuHamil;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Filament\Facades\Filament;

class PencatatanIbuHamilResource extends Resource
{
    protected static ?string $model = PencatatanIbuHamil::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function getNavigationGroup(): ?string
    {
        return 'Pencatatan';
    }

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
        return $form
            ->schema([
                Select::make('ibu_hamil_id')
                    ->relationship('ibuHamil', 'nama')
                    ->searchable()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, Set $set) {
                        if (!$state) return;
                        $ibu = IbuHamil::find($state);
                        if ($ibu) {
                            $set('nik', $ibu->nik);
                            $set('tanggal_lahir', $ibu->tanggal_lahir->format('d-m-Y'));
                            $set('berat_badan_awal', $ibu->berat_badan);
                        }
                    }),

                TextInput::make('nik')->disabled()->dehydrated(false),
                TextInput::make('tanggal_lahir')->disabled()->dehydrated(false),
                TextInput::make('berat_badan_awal')->label('BB Sebelum Hamil')->disabled()->dehydrated(false),

                DatePicker::make('tanggal_posyandu')->required(),
                TextInput::make('usia_kehamilan')->label('Usia Kehamilan (minggu)')->numeric()->required(),
                TextInput::make('berat_badan')->numeric()->required(),
                TextInput::make('tinggi_badan')->numeric()->required(),
                TextInput::make('lingkar_lengan')->numeric()->nullable(),
                TextInput::make('tekanan_darah')->nullable(),
                Select::make('tablet_tambah_darah')
                    ->options(['Ya' => 'Ya', 'Tidak' => 'Tidak'])->required(),
                Select::make('kelas_ibu_hamil')
                    ->options(['Ya' => 'Ya', 'Tidak' => 'Tidak'])->required(),
                Textarea::make('gejala_sakit')->nullable(),
                Textarea::make('saran')->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ibuHamil.nama')
                    ->label('Nama Ibu')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('tanggal_posyandu')
                    ->label('Tanggal Pemeriksaan')
                    ->date('d-m-Y'),
                TextColumn::make('usia_kehamilan')
                    ->label('Usia (Minggu)'),
                TextColumn::make('berat_badan')
                    ->suffix(' kg'),
            ])
            ->filters([
        Filter::make('filter_tanggal_posyandu')
        ->form([
            DatePicker::make('tanggal')->label('Tanggal Posyandu'),
        ])
        ->query(function ($query, array $data) {
            return $query->when(
                $data['tanggal'],
                fn ($q) => $q->whereDate('tanggal_posyandu', $data['tanggal'])
            );
        }),
        Tables\Filters\SelectFilter::make('kelas_ibu_hamil')
        ->label('Kelas Ibu Hamil')
        ->options([
            'Ya' => 'Ya',
            'Tidak' => 'Tidak',
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

    public static function getRelations(): array
    {
        return [];
    }

    public function getNamaAttribute($value)
    {
    return ucwords(strtolower($value));
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPencatatanIbuHamils::route('/'),
            'create' => Pages\CreatePencatatanIbuHamil::route('/create'),
            'edit' => Pages\EditPencatatanIbuHamil::route('/{record}/edit'),
        ];
    }
}
