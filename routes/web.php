<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BalitaExportController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LaporanBalitaController;
use App\Http\Controllers\LaporanIbuHamilController;
use App\Http\Controllers\LaporanLansiaController;
use App\Filament\Widgets\StatusGiziChart;
use App\Filament\Widgets\DistribusiUmurBalitaChart;
use Livewire\Livewire;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



Route::get('/laporan/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.pdf');

Route::get('/laporan/balita/pdf', [LaporanBalitaController::class, 'exportBalitaPdf'])->name('laporan.balita.pdf');
Route::get('/laporan/ibu-hamil/pdf', [LaporanIbuHamilController::class, 'exportIbuHamilPdf'])->name('laporan.ibu_hamil.pdf');
Route::get('/laporan/lansia/pdf', [LaporanLansiaController::class, 'exportLansiaPdf'])->name('laporan.lansia.pdf');

Livewire::component('status-gizi-chart', StatusGiziChart::class);
Livewire::component('distribusi-umur-balita-chart', DistribusiUmurBalitaChart::class);

Route::post('/pendaftaran/submit', [FrontendController::class, 'submitPendaftaran'])->name('form.submit');

// ===================
// FRONTEND PUBLIK
// ===================
Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/jadwal', [FrontendController::class, 'jadwal'])->name('jadwal');
Route::get('/profil', [FrontendController::class, 'profil'])->name('profil');

// Halaman pilihan form pendaftaran umum
Route::get('/pendaftaran', [FrontendController::class, 'form'])->name('form');
// Jika kamu tidak punya method submitForm di FrontendController, hapus ini:
// Route::post('/pendaftaran', [FrontendController::class, 'submitForm'])->name('form.submit');
Route::get('/pendaftaran/sukses', [FrontendController::class, 'formSuccess'])->name('form.success');

// ===================
// FORM SPESIFIK PER KATEGORI
// ===================
Route::get('/daftar/balita', [FrontendController::class, 'formBalita'])->name('form.balita');
Route::post('/daftar/balita', [FrontendController::class, 'submitBalita'])->name('form.balita.submit');

Route::get('/daftar/ibu-hamil', [FrontendController::class, 'formIbuHamil'])->name('form.ibu_hamil');
Route::post('/daftar/ibu-hamil', [FrontendController::class, 'submitIbuHamil'])->name('form.ibu_hamil.submit');

Route::get('/daftar/lansia', [FrontendController::class, 'formLansia'])->name('form.lansia');
Route::post('/daftar/lansia', [FrontendController::class, 'submitLansia'])->name('form.lansia.submit');

// ===================
// EXPORT DATA
// ===================
Route::get('/balita/export', [BalitaExportController::class, 'export'])->name('balita.export');

// ===================
// REDIRECT DASHBOARD SESUAI ROLE
// ===================
Route::get('/dashboard', function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $user = Auth::user();

    return match ($user->role) {
        'kader' => redirect()->route('filament.admin.pages.dashboard'),
        'bidan' => redirect()->route('filament.bidan.pages.dashboard'),
        default => abort(403, 'Role tidak dikenali.'),
    };
})->middleware(['auth'])->name('dashboard');

// ===================
// PROFILE USER (UMUM)
// ===================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//pengaturan//
Route::middleware('auth')->group(function () {

    // Tambah user
    Route::post('/pengaturan', function (Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:kader,bidan',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->back()->with('success', 'User berhasil ditambahkan.');
    })->name('pengaturan.tambah-user');

    // Update user
    Route::post('/pengaturan/{user}/update', function (Request $request, User $user) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:kader,bidan',
        ]);

        $user->update($validated);

        return redirect()->route('filament.admin.pages.pengaturan')->with('success', 'User berhasil diperbarui.');
    })->name('pengaturan.update-user');

    // Hapus user
    Route::delete('/pengaturan/{user}/hapus', function (User $user) {
        $user->delete();
        return redirect()->back()->with('success', 'User berhasil dihapus.');
    })->name('pengaturan.hapus-user');
});
// ===================
// PANEL NON-FILAMENT BIDAN (OPSIONAL)
// ===================
Route::middleware(['auth', 'bidan'])->prefix('bidan')->group(function () {
    Route::get('/dashboard', fn () => view('bidan.dashboard'))->name('bidan.dashboard');
});

// ===================
// AUTH ROUTES
// ===================
require __DIR__.'/auth.php';


