<?php

use Illuminate\Support\Facades\Route;

//memanggil santri controller
use App\Http\Controllers\SantriController;

//memanggil pegawai controller
use App\Http\Controllers\PegawaiController;

//memanggil anggota controller
use App\Http\Controllers\anggotacontroller;

//memanggil Pengarang controller
use App\Http\Controllers\PengarangController;

//memanggil Penerbit controller
use App\Http\Controllers\PenerbitController;

//memanggil Kategori controller
use App\Http\Controllers\KategoriController;

//memanggil Buku controller
use App\Http\Controllers\BukuController;

//memanggil dosen controller
use App\Http\Controllers\DosenController;

//memanggil matakuliah controller
use App\Http\Controllers\MatakuliahController;

//memanggil jurusan controller
use App\Http\Controllers\JurusanController;

//memanggil mahasantri controller
use App\Http\Controllers\MahasantriController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/salam', function () {
    return "Assalamu'alaikum, Selamat Belajar Laravel Di PeTIK Jombang Angkatan III";
});

//routing parameter
Route::get('/pegawai/{nama}/{divisi}', function ($nama,$divisi) {
    return "Nama Pegawai : ".$nama."<br>Depatemen : ".$divisi;
});

//tambahkan routes baru di routes/web.php
Route::get('/kabar', function () {
    return view('kondisi');
});

Route::get('/santri',
[SantriController::class, 'datasantri']
);

//route hello (pertemuan 4)
Route::get('/hello', function () {
    return view('hello',['name'=>'inaya']);
});

Route::get('/nilai', function () {
    return view('nilai');
});

Route::get('/daftarnilai', function () {
    return view('daftar_nilai');
});

Route::get('/templating', function ()
{ return view('layouts.index');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/pegawai',
    [PegawaiController::class, 'index']
    )->name('pegawai.index');

Route::get('/pegawai/create',
    [PegawaiController::class, 'create']
    )->name('pegawai.create');

Route::post('/pegawai',
    [PegawaiController::class, 'store']
    )->name('pegawai.store');

Route::get('/anggota',
    [anggotaController::class, 'index']
    )->name('anggota.index');

Route::get('/anggota/create',
    [anggotaController::class, 'create']
    )->name('anggota.create');

Route::post('/anggota',
    [anggotaController::class, 'store']
    )->name('anggota.store');
    
Route::resource('anggota', anggotaController::class);

// routing pengarang/penerbit/kategori/buku

Route::resource('pengarang', PengarangController::class); 
Route::resource('penerbit', PenerbitController::class); 
Route::resource('kategori', KategoriController::class); 
Route::resource('buku', BukuController::class);

// routing dosen/matakuliah/jurusan/mahasantri

Route::resource('dosen', DosenController::class); 
Route::resource('matakuliah', MatakuliahController::class); 
Route::resource('jurusan', JurusanController::class); 
Route::resource('mahasantri', MahasantriController::class);


Route::get('bukupdf',[BukuController::class,'bukuPDF']);



