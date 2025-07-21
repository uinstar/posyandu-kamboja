<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PencatatanBalitaResource\Pages;
use App\Models\Balita;
use App\Models\PencatatanBalita;
use Filament\Forms;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Section;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Filament\Facades\Filament;

class PencatatanBalitaResource extends Resource
{
    protected static ?string $model = PencatatanBalita::class;
    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function getNavigationGroup(): ?string
    {
        return 'Pencatatan';
    }

    // ✅ Hanya kader yang bisa melihat menu
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
            Section::make()->schema([
                Select::make('balita_id')
                    ->relationship('balita', 'nama')
                    ->searchable()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, Set $set) {
                        $balita = Balita::find($state);
                        if ($balita) {
                            $set('nik', $balita->nik);
                            $set('tanggal_lahir', $balita->tanggal_lahir->format('d-m-Y'));
                        }
                    }),

                TextInput::make('nik')->disabled()->dehydrated(false),
                TextInput::make('tanggal_lahir')->disabled()->dehydrated(false),
            ])->columns(3)->compact(),

            Section::make()->schema([
                DatePicker::make('tanggal_posyandu')->required(),
                TextInput::make('berat_badan')->numeric()->minValue(1)->maxValue(30)->required(),
                TextInput::make('tinggi_badan')->numeric()->minValue(30)->maxValue(150)->required(),
                TextInput::make('lingkar_kepala')->numeric()->nullable(),
                TextInput::make('lingkar_lengan')->numeric()->nullable(),
                TextInput::make('status_gizi')->disabled()->dehydrated(false),
                TextInput::make('usia_bulan')->disabled()->dehydrated(false),
                Select::make('jenis_imunisasi')->options([
                    'BCG' => 'BCG',
                    'DPT' => 'DPT',
                    'Polio' => 'Polio',
                    'Campak' => 'Campak',
                    'Hepatitis B' => 'Hepatitis B',
                    'DPT-HB-Hib' => 'DPT-HB-Hib',
                    'MMR' => 'MMR',
                    'Rotavirus' => 'Rotavirus',
                    'PCV' => 'PCV',
                    'TBC' => 'TBC',
                ])->nullable()
                  ->placeholder('Pilih jenis imunisasi'),
                Textarea::make('gejala_sakit')->nullable(),
                Textarea::make('saran')->nullable(),
            ])->columns(2)->compact(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('balita.nama')->label('Balita')->sortable()->searchable(),
                TextColumn::make('tanggal_posyandu')->label('Tanggal posyandu')->date('d-m-Y'),
                TextColumn::make('berat_badan')->label('Berat badan')->suffix(' kg'),
                TextColumn::make('tinggi_badan')->label('Tinggi badan')->suffix(' cm'),
                TextColumn::make('status_gizi')->label('Status gizi'),
                TextColumn::make('usia_bulan')->label('Usia bulan'),
            ])
            ->filters([

                Filter::make('tanggal_posyandu')
                    ->form([
                        DatePicker::make('tanggal_posyandu')->label('Tanggal Posyandu'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['tanggal_posyandu'], fn ($q) => $q->whereDate('tanggal_posyandu', $data['tanggal_posyandu']));
                    }),

                SelectFilter::make('status_gizi')
                    ->label('Status Gizi')
                    ->options([
                        'Gizi Buruk' => 'Gizi Buruk',
                        'Gizi Kurang' => 'Gizi Kurang',
                        'Normal' => 'Normal',
                        'Risiko Gizi Lebih' => 'Risiko Gizi Lebih',
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
            'index' => Pages\ListPencatatanBalitas::route('/'),
            'create' => Pages\CreatePencatatanBalita::route('/create'),
            'edit' => Pages\EditPencatatanBalita::route('/{record}/edit'),
        ];
    }
}
