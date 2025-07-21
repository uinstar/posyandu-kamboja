<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;

class Pengaturan extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationLabel = 'Pengaturan';
    protected static ?string $title = 'Pengaturan';
    protected static string $view = 'filament.pages.pengaturan';

    public static function getNavigationGroup(): ?string
    {
    return 'Setting';
    }

    public static function getNavigationSort(): ?int
    {
    return 1000; // Supaya tetap paling bawah di dalam grup
}
    public static function canAccess(): bool
    {
        return Auth::user()?->name === 'Primayanti';
    }
}
