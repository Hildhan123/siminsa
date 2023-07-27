<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::group(['domain' => '{kelurahan_slug}.localhost', 'middleware' => 'get.kelurahan'], function () {
    
//     Route::get('/', 'HomeController@index')->name('home.index');
//     Route::get('/organisasi', 'OrganisasiController@show')->name('organisasi.show');
//     Route::get('/organisasi/{organisai}', 'OrganisasiController@detail')->name('organisasi.detail');
//     Route::get('/perangkat-kelurahan', 'PegawaiController@show')->name('pegawai.show');
//     Route::get('/perangkat-kelurahan/{pegawai}', 'PegawaiController@detail')->name('pegawai.detail');
//     Route::get('/lembaga-kelurahan', 'LembagaController@show')->name('lembaga.show');
//     Route::get('/lembaga-kelurahan/{lembaga}/{slug}', 'LembagaController@detail')->name('lembaga.detail');
//     Route::get('/layanan-kelurahan', 'LayananController@show')->name('layanan.show');
//     Route::get('/layanan-kelurahan/{layanan}/{slug}', 'LayananController@detail')->name('layanan.detail');
//     Route::get('/pengumuman-kelurahan', 'PengumumanController@show')->name('pengumuman.show');
//     Route::get('/pengumuman-kelurahan/{pengumuman}/{slug}', 'PengumumanController@detail')->name('pengumuman.detail');
//     Route::get('/agenda-kelurahan', 'AgendaController@show')->name('agenda.show');
//     Route::get('/agenda-kelurahan/{agenda}/{slug}', 'AgendaController@detail')->name('agenda.detail');
//     Route::get('/download-kelurahan', 'DownloadController@show')->name('download.show');
//     //Route::get('/download-kelurahan/detail/1', 'DownloadController@detail')->name('download.detail');
//     Route::get('/potensi-kelurahan', 'PotensiController@show')->name('potensi.show');
//     Route::get('/potensi-kelurahan/{potensi}/{slug}', 'PotensiController@detail')->name('potensi.detail');
//     Route::get('/produk-kelurahan', 'ProdukController@show')->name('produk.show');
//     //Route::get('/tautan-kelurahan', 'TautanController@show')->name('tautan.show');
//     //Route::get('/produk-kelurahan/detail/{produk}/{slug}', 'ProdukController@detail')->name('produk.detail');
    
    
//     Route::get('/laporan-apbdes', 'AnggaranRealisasiController@laporan_apbdes')->name('laporan-apbdes');
//     //Route::get('/layanan-surat', 'SuratController@layanan_surat')->name('layanan-surat');
//     Route::get('/p', function (){return abort(404);})->name('pemerintahan-desa');
//     Route::get('/p/{pemerintahan_desa}', function (){return abort(404);});
//     Route::get('/p/{pemerintahan_desa}/{slug}', 'PemerintahanDesaController@show')->name('pemerintahan-desa.show');
//     Route::get('/berita', 'BeritaController@berita')->name('berita');
//     Route::get('/berita/{berita}/{slug}', 'BeritaController@show')->name('berita.show');
//     //Route::get('/berita/{berita}', function (){return abort(404);});
//     Route::get('/gallery', 'GalleryController@gallery')->name('gallery');
//     //Route::get('/buat-surat/{id}/{slug}', 'CetakSuratController@create')->name('buat-surat');
//     //Route::get('/statistik-penduduk', 'GrafikController@index')->name('statistik-penduduk');
//     //Route::get('/statistik-penduduk/show', 'GrafikController@show')->name('statistik-penduduk.show');
//     //Route::get('/anggaran-realisasi-cart', 'AnggaranRealisasiController@cart')->name('anggaran-realisasi.cart');
//     //Route::post('/cetak-surat/{id}/{slug}', 'CetakSuratController@store')->name('cetak-surat.store');
// });


// Route::get('/', 'HomeController@index2')->name('home.index2');
// Route::get('/panduan', 'HomeController@panduan')->name('panduan');

Route::group(['middleware' => ['get.kelurahan']], function () {
        // Ambil data Desa/Kelurahan berdasarkan 'nama'
        // $desa = DB::table('kelurahan')->find(1);

        // if ($desa) {
        //     // Bagikan data 'desa' ke semua controller
        //     app()->instance('desa', $desa);
        //     app()->instance('kelurahan', $desa);

        //     View::share('desa', $desa);
        // } else {
        //     return abort(404);
        // }

    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/organisasi', 'OrganisasiController@show')->name('organisasi.show');
    Route::get('/organisasi/{organisai}', 'OrganisasiController@detail')->name('organisasi.detail');
    Route::get('/perangkat-kelurahan', 'PegawaiController@show')->name('pegawai.show');
    Route::get('/perangkat-kelurahan/{pegawai}', 'PegawaiController@detail')->name('pegawai.detail');
    Route::get('/lembaga-kelurahan', 'LembagaController@show')->name('lembaga.show');
    Route::get('/lembaga-kelurahan/{lembaga}/{slug}', 'LembagaController@detail')->name('lembaga.detail');
    Route::get('/layanan-kelurahan', 'LayananController@show')->name('layanan.show');
    Route::get('/layanan-kelurahan/{layanan}/{slug}', 'LayananController@detail')->name('layanan.detail');
    Route::get('/pengumuman-kelurahan', 'PengumumanController@show')->name('pengumuman.show');
    Route::get('/pengumuman-kelurahan/{pengumuman}/{slug}', 'PengumumanController@detail')->name('pengumuman.detail');
    Route::get('/agenda-kelurahan', 'AgendaController@show')->name('agenda.show');
    Route::get('/agenda-kelurahan/{agenda}/{slug}', 'AgendaController@detail')->name('agenda.detail');
    Route::get('/download-kelurahan', 'DownloadController@show')->name('download.show');
    //Route::get('/download-kelurahan/detail/1', 'DownloadController@detail')->name('download.detail');
    Route::get('/potensi-kelurahan', 'PotensiController@show')->name('potensi.show');
    Route::get('/potensi-kelurahan/{potensi}/{slug}', 'PotensiController@detail')->name('potensi.detail');
    Route::get('/produk-kelurahan', 'ProdukController@show')->name('produk.show');
    //Route::get('/tautan-kelurahan', 'TautanController@show')->name('tautan.show');
    //Route::get('/produk-kelurahan/detail/{produk}/{slug}', 'ProdukController@detail')->name('produk.detail');
    
    
    Route::get('/laporan-apbdes', 'AnggaranRealisasiController@laporan_apbdes')->name('laporan-apbdes');
    //Route::get('/layanan-surat', 'SuratController@layanan_surat')->name('layanan-surat');
    Route::get('/p', function (){return abort(404);})->name('pemerintahan-desa');
    Route::get('/p/{pemerintahan_desa}', function (){return abort(404);});
    Route::get('/p/{pemerintahan_desa}/{slug}', 'PemerintahanDesaController@show')->name('pemerintahan-desa.show');
    Route::get('/berita', 'BeritaController@berita')->name('berita');
    Route::get('/berita/{berita}/{slug}', 'BeritaController@show')->name('berita.show');
    //Route::get('/berita/{berita}', function (){return abort(404);});
    Route::get('/gallery', 'GalleryController@gallery')->name('gallery');
    //Route::get('/buat-surat/{id}/{slug}', 'CetakSuratController@create')->name('buat-surat');
    //Route::get('/statistik-penduduk', 'GrafikController@index')->name('statistik-penduduk');
    //Route::get('/statistik-penduduk/show', 'GrafikController@show')->name('statistik-penduduk.show');
    //Route::get('/anggaran-realisasi-cart', 'AnggaranRealisasiController@cart')->name('anggaran-realisasi.cart');
    //Route::post('/cetak-surat/{id}/{slug}', 'CetakSuratController@store')->name('cetak-surat.store');
});

Route::group(['middleware' => ['web', 'guest']], function () {
    Route::get('/masuk', 'AuthController@index')->name('masuk');
    Route::post('/masuk', 'AuthController@masuk');
    // Route::get('/register', 'AuthController@register')->name('register');
    // Route::post('/register', 'AuthController@daftar');
});


Route::group(['middleware' => ['web', 'auth','kelurahan']], function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', function () {
            return redirect()->route('dashboard');
        });
        Route::post('/keluar', 'AuthController@keluar')->name('keluar');
        Route::get('/pengaturan', 'UserController@pengaturan')->name('pengaturan');
        Route::get('/profil', 'UserController@profil')->name('profil');
        Route::patch('/update-pengaturan/{user}', 'UserController@updatePengaturan')->name('update-pengaturan');
        Route::patch('/update-profil/{user}', 'UserController@updateProfil')->name('update-profil');
    
        Route::get('/profil-kelurahan', 'DesaController@index')->name('profil-desa');
        Route::patch('/update-kelurahan/{desa}', 'DesaController@update')->name('update-desa');
        Route::resource('/profil-kelurahan', 'DesaController')->except('index','update','edit');

        Route::patch('/iframe/{desa}', 'DesaController@iframe')->name('iframe');
        
        Route::get('/selayang-pandang', 'TemplateController@selayang')->name('selayang-pandang');
        Route::patch('/selayang-pandang/{template}', 'TemplateController@updateSelayang')->name('selayang-pandang.update');
        Route::get('/sambutan', 'TemplateController@sambutan')->name('sambutan');
        Route::patch('/sambutan/{template}', 'TemplateController@updateSambutan')->name('sambutan.update');
    
        // Route::get('/tambah-surat', 'SuratController@create')->name('surat.create');
        // Route::patch('/cetakSurat/{cetak_surat}/arsip', 'CetakSuratController@arsip')->name('cetakSurat.arsip');
        // Route::resource('/cetakSurat', 'CetakSuratController')->except('create','store','index');
        // Route::resource('/surat', 'SuratController')->except('create');
    
        //pages
        // Route::get('/pages', 'PemerintahanDesaController@index')->name('pemerintahan-desa.index');
        Route::get('/tambah-pages', 'PemerintahanDesaController@create')->name('pages.create');
        Route::get('/edit-pages/{page}', 'PemerintahanDesaController@edit')->name('pages.edit');
        Route::resource('/pages', 'PemerintahanDesaController')->except('create','edit','show');
    
        Route::get('/kelola-berita', 'BeritaController@index')->name('berita.index');
        Route::get('/tambah-berita', 'BeritaController@create')->name('berita.create');
        Route::get('/edit-berita/{berita}', 'BeritaController@edit')->name('berita.edit');
        Route::resource('/berita', 'BeritaController')->except('create','show','index','edit');
    
        Route::resource('/isiSurat', 'IsiSuratController')->except('index', 'create', 'edit', 'show');
    
        Route::post('/gallery/store', 'GalleryController@storeGallery')->name('gallery.storeGallery');
        Route::get('/kelola-gallery', 'GalleryController@index')->name('gallery.index');
        Route::resource('/gallery', 'GalleryController')->except('index','show', 'edit', 'update', 'create');
    
        Route::get('/tambah-slider', 'GalleryController@create')->name('slider.create');
        Route::get('/slider', 'GalleryController@indexSlider')->name('slider.index');
    
        Route::post('/video', 'VideoController@store')->name('video.store');
        Route::patch('/video/update', 'VideoController@update')->name('video.update');
    
        // Route::get('/surat-harian', 'HomeController@suratHarian')->name('surat-harian');
        // Route::get('/surat-bulanan', 'HomeController@suratBulanan')->name('surat-bulanan');
        // Route::get('/surat-tahunan', 'HomeController@suratTahunan')->name('surat-tahunan');
        Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
    
        // Route::get('/tambah-penduduk', 'PendudukController@create')->name('penduduk.create');
        // Route::get('/penduduk/{penduduk}', function (){return abort(404);});
        // Route::resource('penduduk', 'PendudukController')->except('create','show');
    
        Route::get('/kelompok-jenis-anggaran/{kelompokJenisAnggaran}', 'AnggaranRealisasiController@kelompokJenisAnggaran');
        Route::get('/detail-jenis-anggaran/{id}', 'AnggaranRealisasiController@show')->name('detail-jenis-anggaran.show');
        Route::get('/tambah-anggaran-realisasi', 'AnggaranRealisasiController@create')->name('anggaran-realisasi.create');
        Route::get('/anggaran-realisasi/{anggaran_realisasi}', function (){return abort(404);});
        Route::resource('anggaran-realisasi', 'AnggaranRealisasiController')->except('create','show');
    
        // Route::get('/tambah-dusun', 'DusunController@create')->name('dusun.create');
        // Route::resource('dusun', 'DusunController')->except('create','show');
        // Route::resource('detailDusun', 'DetailDusunController')->except('create','edit');
    
        // Route::get('/chart-surat/{id}', 'SuratController@chartSurat')->name('chart-surat');
    
        Route::get('/tambah-organisasi', 'OrganisasiController@create')->name('organisasi.create');
        Route::resource('organisasi', 'OrganisasiController')->except('create','show');
    
        Route::get('/tambah-pegawai', 'PegawaiController@create')->name('pegawai.create');
        Route::resource('pegawai', 'PegawaiController')->except('create','show');

        Route::get('/tambah-lembaga', 'LembagaController@create')->name('lembaga.create');
        Route::resource('lembaga', 'LembagaController')->except('create','show');
    
        Route::get('/tambah-pengumuman', 'PengumumanController@create')->name('pengumuman.create');
        Route::resource('pengumuman', 'PengumumanController')->except('create','show');
    
        Route::get('/tambah-agenda', 'AgendaController@create')->name('agenda.create');
        Route::resource('agenda', 'AgendaController')->except('create','show');
    
        Route::get('/tambah-layanan', 'LayananController@create')->name('layanan.create');
        Route::resource('layanan', 'LayananController')->except('create','show');
    
        // Route::get('/tambah-tautan', 'TautanController@create')->name('tautan.create');
        // Route::resource('tautan', 'TautanController')->except('create','show');
    
        Route::get('/tambah-download', 'DownloadController@create')->name('download.create');
        Route::resource('download', 'DownloadController')->except('create','show');
    
        Route::get('/tambah-produk', 'ProdukController@create')->name('produk.create');
        Route::resource('produk', 'ProdukController')->except('create','show');
    
        Route::get('/tambah-potensi', 'PotensiController@create')->name('potensi.create');
        Route::resource('potensi', 'PotensiController')->except('create','show');

        Route::resource('navbar', 'navbarController')->except('show');
    });
    
});

Route::group(['middleware' => ['admin']], function () {
    Route::prefix('super-admin')->group(function () {
        Route::get('/', function () {
            if(session()->has('hakAkses'))
            {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('admin.login');
        });

        Route::get('/login', 'adminController@login')->name('admin.login')->withoutMiddleware('admin');
        Route::post('/login', 'adminController@loginProses')->withoutMiddleware('admin');
        Route::post('/logout','adminController@logout')->name('admin.logout');

        Route::get('/dashboard', 'adminController@dashboard')->name('admin.dashboard');

        Route::get('/users', 'adminController@users')->name('admin.users');
        Route::get('/kelurahan', 'adminController@kelurahan')->name('admin.kelurahan');
        //Route::post('/users', 'adminController@usersCreate');
        Route::get('/user/{user}', 'adminController@user')->name('admin.user');
        Route::patch('/user/{user}', 'adminController@userUpdate');
        Route::delete('/user/{user}', 'adminController@userDelete')->name('admin.user.delete');

        Route::get('/tambah-data','adminController@dataCreate')->name('admin.tambah-data');
        Route::post('/tambah-data','adminController@dataStore');
        Route::get('/dump-data','adminController@dump')->name('admin.dump');
        Route::post('/dump-data','adminController@makeDump');

        Route::get('/profil','adminController@profil')->name('admin.profil');
        Route::post('/profil','adminController@profilStore');
        
    });
    
});

// Route::group(['middleware' => []], function () {
//     Route::prefix('{kelurahan_slug}')->middleware(['get.kelurahan'])->group(function () {
//         Route::get('/', 'HomeController@index')->name('home.index');
//         Route::get('/organisasi', 'OrganisasiController@show')->name('organisasi.show');
//         Route::get('/organisasi/{organisai}', 'OrganisasiController@detail')->name('organisasi.detail');
//         Route::get('/perangkat-kelurahan', 'PegawaiController@show')->name('pegawai.show');
//         Route::get('/perangkat-kelurahan/{pegawai}', 'PegawaiController@detail')->name('pegawai.detail');
//         Route::get('/lembaga-kelurahan', 'LembagaController@show')->name('lembaga.show');
//         Route::get('/lembaga-kelurahan/{lembaga}/{slug}', 'LembagaController@detail')->name('lembaga.detail');
//         Route::get('/layanan-kelurahan', 'LayananController@show')->name('layanan.show');
//         Route::get('/layanan-kelurahan/{layanan}/{slug}', 'LayananController@detail')->name('layanan.detail');
//         Route::get('/pengumuman-kelurahan', 'PengumumanController@show')->name('pengumuman.show');
//         Route::get('/pengumuman-kelurahan/{pengumuman}/{slug}', 'PengumumanController@detail')->name('pengumuman.detail');
//         Route::get('/agenda-kelurahan', 'AgendaController@show')->name('agenda.show');
//         Route::get('/agenda-kelurahan/{agenda}/{slug}', 'AgendaController@detail')->name('agenda.detail');
//         Route::get('/download-kelurahan', 'DownloadController@show')->name('download.show');
//         //Route::get('/download-kelurahan/detail/1', 'DownloadController@detail')->name('download.detail');
//         Route::get('/potensi-kelurahan', 'PotensiController@show')->name('potensi.show');
//         Route::get('/potensi-kelurahan/{potensi}/{slug}', 'PotensiController@detail')->name('potensi.detail');
//         Route::get('/produk-kelurahan', 'ProdukController@show')->name('produk.show');
//         //Route::get('/tautan-kelurahan', 'TautanController@show')->name('tautan.show');
//         //Route::get('/produk-kelurahan/detail/{produk}/{slug}', 'ProdukController@detail')->name('produk.detail');
        
        
//         Route::get('/laporan-apbdes', 'AnggaranRealisasiController@laporan_apbdes')->name('laporan-apbdes');
//         //Route::get('/layanan-surat', 'SuratController@layanan_surat')->name('layanan-surat');
//         Route::get('/p', function (){return abort(404);})->name('pemerintahan-desa');
//         Route::get('/p/{pemerintahan_desa}', function (){return abort(404);});
//         Route::get('/p/{pemerintahan_desa}/{slug}', 'PemerintahanDesaController@show')->name('pemerintahan-desa.show');
//         Route::get('/berita', 'BeritaController@berita')->name('berita');
//         Route::get('/berita/{berita}/{slug}', 'BeritaController@show')->name('berita.show');
//         //Route::get('/berita/{berita}', function (){return abort(404);});
//         Route::get('/gallery', 'GalleryController@gallery')->name('gallery');
//         //Route::get('/buat-surat/{id}/{slug}', 'CetakSuratController@create')->name('buat-surat');
//         //Route::get('/statistik-penduduk', 'GrafikController@index')->name('statistik-penduduk');
//         //Route::get('/statistik-penduduk/show', 'GrafikController@show')->name('statistik-penduduk.show');
//         //Route::get('/anggaran-realisasi-cart', 'AnggaranRealisasiController@cart')->name('anggaran-realisasi.cart');
//         //Route::post('/cetak-surat/{id}/{slug}', 'CetakSuratController@store')->name('cetak-surat.store');
// });
// });

Route::fallback(function () {
    abort(404);
});