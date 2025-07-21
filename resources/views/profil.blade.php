@extends('layouts.app')

@section('title', 'Profil Posyandu')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-blue-50 py-8">
    <div class="w-full">
        <!-- Header Section -->
        <div class="text-center">
    <h1 class="text-4xl font-bold text-green-700 mb-2">Posyandu Kamboja</h1>
    <p class="text-gray-700 text-lg max-w-4xl mx-auto mb-8">
       Posyandu Kamboja adalah pusat pelayanan kesehatan berbasis masyarakat yang berkomitmen untuk memberikan pelayanan kesehatan di wilayah Desa Panggungrejo, Kecamatan Sukoharjo, Kabupaten Pringsewu.
    </p>
</div>

     <!--Sejarah-->  
     <div class="max-w-7xl mx-auto px-4 py-12">
  <div class="flex flex-col md:flex-row items-stretch gap-8">
    
    <!-- Gambar (menyesuaikan tinggi teks) -->
    <div class="w-full md:w-1/2 flex">
      <img src="bg/building.jpeg"
           alt="Gambar Posyandu"
           class="w-full object-cover rounded-xl shadow-md h-full">
    </div>

    <!-- Teks -->
    <div class="w-full md:w-1/2 flex flex-col justify-between">
      <div>
        <h2 class="text-4xl font-bold text-green-700 mb-4">
          Sejarah <br>
          <span class="text-green-800">Posyandu Kamboja</span>
        </h2>
        <p class="text-gray-700 text-justify">
          Posyandu Kamboja berdiri sejak 2010 di atas lahan seluas 120 m² atas inisiatif warga RT 10/RW 05 Desa Panggungrejo. Berperan sebagai pusat pelayanan imunisasi, penimbangan, penyuluhan gizi, dan pemeriksaan ibu hamil, Posyandu ini dikelola secara gotong royong oleh kader dan bekerja sama dengan bidan desa.
          <br><br>
          Seiring berjalannya waktu, Posyandu Kamboja terus berkembang dan mendapat dukungan dari puskesmas serta pemerintah desa. Kini, Posyandu ini telah menjadi pusat kegiatan terpadu yang rutin memberikan layanan kesehatan ibu hamil, balita, dan lansia. Pelayanan dilakukan secara gotong royong oleh para kader yang telah dibekali pelatihan kesehatan, serta berkolaborasi dengan bidan desa dan petugas medis lainnya.
          <br><br>
          Dalam perjalanannya, Posyandu ini tidak hanya menjadi tempat pelayanan kesehatan, tetapi juga pusat edukasi bagi keluarga tentang pentingnya pola hidup sehat dan gizi seimbang. Kegiatan-kegiatan seperti kelas ibu hamil, pemantauan pertumbuhan balita, dan penyuluhan lansia dilakukan secara berkala dengan dukungan Bidan Desa dan kader terlatih.
        </p>
      </div>
    </div>

  </div>
</div>

<!-- VISI MISI SECTION -->
<section class="py-16 bg-green-100">
    <div class="container mx-auto px-4 max-w-7xl text-center space-y-16">
        <!-- Visi -->
        <div class="bg-white rounded-xl shadow-lg p-8 max-w-4xl mx-auto transform transition duration-300 ease-in-out hover:scale-105 hover:shadow-2xl">
            <h2 class="text-3xl font-bold text-green-800 mb-4">Visi</h2>
            <p class="text-gray-700 text-lg leading-relaxed">
                "Menjadi Posyandu yang aktif, mandiri, dan berdaya dalam mendukung tumbuh kembang anak dan kesehatan ibu secara menyeluruh."
            </p>
        </div>

        <!-- Misi -->
        <div class="bg-white rounded-xl shadow-lg p-8 max-w-4xl mx-auto transform transition duration-300 ease-in-out hover:scale-105 hover:shadow-2xl">
            <h2 class="text-3xl font-bold text-green-800 mb-4">Misi</h2>
            <ol class="list-decimal list-inside text-left text-gray-700 text-lg space-y-2">
                <li>
                    Meningkatkan kualitas kesehatan masyarakat
                </li>
                <li>
                    Memastikan ketersediaan pelayanan kesehatan dasar yang berkualitas dan terjangkau
                </li>
                <li>
                    Meningkatkan kualitas Posyandu sebagai pusat pelayanan terpadu
                </li>
                <li>
                    Meningkatkan kesadaran masyarakat tentang pentingnya kesehatan ibu dan anak, termasuk ASI ekslusif dan pemeriksaan kehamilan
                </li>
                <li>
                    Menciptakan keluarga sehat melalui pembiasaan pola hidup bersih dan sehat, peningkatan kelestarian lingkungan hidup, dan perencanaan sehat,
                </li>
            </ol>
        </div>
    </div>
</section>
@endsection