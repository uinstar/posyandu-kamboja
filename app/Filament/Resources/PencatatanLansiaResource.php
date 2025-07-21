<?php

namespace App\Filament\Resources;
use App\Filament\Resources\PencatatanLansiaResource\Pages;
use App\Models\PencatatanLansia;
use App\Models\Lansia;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\CheckboxList;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Facades\Filament;

class PencatatanLansiaResource extends Resource
{
    protected static ?string $model = PencatatanLansia::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

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
        return $form->schema([
            Section::make()
                ->schema([
                    Select::make('lansia_id')
                        ->relationship('lansia', 'nama')
                        ->searchable()
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(fn ($state, Forms\Set $set) => tap(Lansia::find($state), function ($lansia) use ($set) {
                            if ($lansia) {
                                $set('nik', $lansia->nik);
                                $set('tanggal_lahir', $lansia->tanggal_lahir->format('d-m-Y'));
                                $set('usia', \Carbon\Carbon::parse($lansia->tanggal_lahir)->age);
                            }
                        })),

                    TextInput::make('nik')->disabled()->dehydrated(false),
                    TextInput::make('tanggal_lahir')->disabled()->dehydrated(false),
                    TextInput::make('usia')->disabled()->dehydrated(false),
                ])->columns(4)->compact(),

            Section::make()
                ->schema([
                    DatePicker::make('tanggal_posyandu')->required(),

                    TextInput::make('berat_badan')->numeric()->required(),
                    TextInput::make('tinggi_badan')->numeric()->required(),
                    TextInput::make('lingkar_perut')->numeric()->nullable(),

                    TextInput::make('tekanan_darah')->label('Tekanan Darah (mmHg)')->nullable(),
                    TextInput::make('gula_darah')->label('Gula Darah (mg/dL)')->nullable(),

                    CheckboxList::make('riwayat_penyakit')
                        ->label('Riwayat Penyakit')
                        ->options([
                            'Diabetes' => 'Diabetes',
                            'Hipertensi' => 'Hipertensi',
                            'Jantung' => 'Jantung',
                            'Stroke' => 'Stroke',
                            'Asma' => 'Asma',
                            'Gangguan Penglihatan' => 'Gangguan Penglihatan',
                            'Gangguan Pendengaran' => 'Gangguan Pendengaran',
                            'Gangguan Mental' => 'Gangguan Mental',
                            'Gangguan Emosional' => 'Gangguan Emosional',
                            'Lainnya' => 'Lainnya',
                            'Tidak Ada' => 'Tidak Ada',
                        ])
                        ->columns(2),

                    Select::make('merokok')
                        ->options([
                            'Ya' => 'Ya',
                            'Tidak' => 'Tidak',
                        ])
                        ->required(),
                ])->columns(2)->compact(),
        ]);
    }

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('lansia.nama')->label('Nama Lansia')->searchable()->sortable(),
            TextColumn::make('tanggal_posyandu')->label('Tanggal')->date('d-m-Y')->sortable(),
            TextColumn::make('berat_badan')->label('BB')->suffix(' kg'),
            TextColumn::make('tinggi_badan')->label('TB')->suffix(' cm'),
            TextColumn::make('tekanan_darah')->label('TD'),
            TextColumn::make('merokok')->label('Merokok'),
        ])
        ->filters([

            // Filter berdasarkan tanggal posyandu
            Filter::make('tanggal_posyandu')
            ->form([
            DatePicker::make('tanggal')->label('Tanggal Posyandu'),
             ])
            ->query(function (Builder $query, array $data) {
            return $query->when(
            $data['tanggal'],
            fn (Builder $q) => $q->whereDate('tanggal_posyandu', $data['tanggal'])
        );
    }),
        ])
        ->actions([
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
}

    public function getNamaAttribute($value)
    {
    return ucwords(strtolower($value));
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPencatatanLansias::route('/'),
            'create' => Pages\CreatePencatatanLansia::route('/create'),
            'edit' => Pages\EditPencatatanLansia::route('/{record}/edit'),
        ];
    }
}
