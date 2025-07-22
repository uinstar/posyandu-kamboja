<?php

namespace App\Http\Controllers;

use App\Models\{Balita, IbuHamil, Lansia, PendaftaranPeserta, JadwalPosyandu};
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        $count = DB::table('balita')->selectRaw('COUNT(*) as total')->value('total');
        $jumlahIbuHamil = IbuHamil::count();
        $jumlahLansia = Lansia::count();

        return view('home', compact('jumlahBalita', 'jumlahIbuHamil', 'jumlahLansia'));
    }

    public function jadwal()
    {
        $jadwal = JadwalPosyandu::orderBy('tanggal', 'asc')->get();
        return view('jadwal', compact('jadwal'));
    }

    public function profil()
    {
        return view('profil');
    }

    public function form()
    {
        return view('form');
    }

    public function formSuccess()
    {
        return view('form_success');
    }

    public function submitPendaftaran(Request $request)
{
    $validated = $request->validate([
        'kategori' => 'required|string|in:balita,ibu_hamil,lansia',
    ]);

    $dataTambahan = match ($validated['kategori']) {
        'balita' => $this->validateAndGetBalitaData($request),
        'ibu_hamil' => $this->validateAndGetIbuHamilData($request),
        'lansia' => $this->validateAndGetLansiaData($request),
    };

    $kategoriFormatted = ucfirst(str_replace('_', ' ', $validated['kategori']));

    PendaftaranPeserta::create([
        'kategori' => $kategoriFormatted,
        'data_tambahan' => $dataTambahan,
        'status' => 'pending',
    ]);

    return redirect()->route('form.success')->with('success', 'Pendaftaran berhasil dikirim.');
}


    public function formBalita() { return view('form_kategori.balita'); }
    public function formIbuHamil() { return view('form_kategori.ibu_hamil'); }
    public function formLansia() { return view('form_kategori.lansia'); }

    public function submitBalita(Request $request)
    {
        $request->merge(['kategori' => 'balita']);
        return $this->submitPendaftaran($request);
    }

    public function submitIbuHamil(Request $request)
    {
        $request->merge(['kategori' => 'ibu_hamil']);
        return $this->submitPendaftaran($request);
    }

    public function submitLansia(Request $request)
    {
        $request->merge(['kategori' => 'lansia']);
        return $this->submitPendaftaran($request);
    }

    private function validateAndGetBalitaData(Request $request)
    {
        $request->validate([
            'nama_balita' => 'required|string|max:255',
            'nik' => 'required|string|size:16|regex:/^\d{16}$/',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string|in:Laki-laki,Perempuan',
            'bb_lahir' => 'required|numeric|min:0',
            'panjang_badan_lahir' => 'required|numeric|min:0',
            'nama_ibu' => 'required|string|max:255',
            'no_hp' => 'required|numeric|digits_between:10,15',
            'alamat' => 'required|string|max:1000',
        ]);

        return [
            'nama_balita' => $request->input('nama_balita'),
            'nik' => $request->input('nik'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'bb_lahir' => $request->input('bb_lahir'),
            'panjang_badan_lahir' => $request->input('panjang_badan_lahir'),
            'nama_ibu' => $request->input('nama_ibu'),
            'no_hp' => $request->input('no_hp'),
            'alamat' => $request->input('alamat'),
        ];
    }

    private function validateAndGetIbuHamilData(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|size:16|regex:/^\d{16}$/',
            'tanggal_lahir' => 'required|date',
            'nama_suami' => 'required|string|max:255',
            'alamat' => 'required|string|max:1000',
            'no_hp' => 'required|numeric|digits_between:10,15',
            'hamil_ke' => 'required|integer|min:1',
            'berat_badan' => 'required|numeric|min:0',
            'tinggi_badan' => 'required|numeric|min:0',
        ]);

        return [
            'nama' => $request->input('nama'),
            'nik' => $request->input('nik'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'nama_suami' => $request->input('nama_suami'),
            'alamat' => $request->input('alamat'),
            'no_hp' => $request->input('no_hp'),
            'hamil_ke' => $request->input('hamil_ke'),
            'berat_badan' => $request->input('berat_badan'),
            'tinggi_badan' => $request->input('tinggi_badan'),
        ];
    }

    private function validateAndGetLansiaData(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|size:16|regex:/^\d{16}$/',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string|in:Laki-laki,Perempuan',
            'pekerjaan' => 'required|string|max:255',
            'alamat' => 'required|string|max:1000',
            'no_hp' => 'required|numeric|digits_between:10,15',
        ]);

        return [
            'nama' => $request->input('nama'),
            'nik' => $request->input('nik'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'pekerjaan' => $request->input('pekerjaan'),
            'alamat' => $request->input('alamat'),
            'no_hp' => $request->input('no_hp'),
        ];
    }

    public function getFormData(Request $request)
    {
        return response()->json([
            'kategori' => $request->input('kategori'),
            'all_data' => $request->all()
        ]);
    }
}
