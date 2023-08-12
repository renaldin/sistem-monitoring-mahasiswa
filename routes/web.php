<?php

use App\Http\Controllers\DaftarNilaiController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KelasDetailController;
use App\Http\Controllers\KelasEnrollController;
use App\Http\Controllers\MahasiswaMataKuliahEnrollController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\MataKuliahEnrollController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\PerwalianController;
use App\Http\Controllers\JadwalPerwalianController;
use App\Http\Controllers\ProgramStudiController;
use App\Http\Controllers\RekapKehadiranController;
use App\Http\Controllers\SpController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\RekapLaporanKehadiranController;
use App\Models\Kehadiran;
use App\Models\MataKuliahEnroll;
use Illuminate\Support\Facades\Route;
// use \App\Http\Middleware\OrangTua;
use App\Models\KelasEnroll;
use Illuminate\Support\Facades\Artisan;

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




Auth::routes();

// for Cron Job
Route::get('/schedule', function(){
    Artisan::call('schedule:run');
    echo 'Schedule run success';
});


Route::group(['middleware' => 'auth.parent'], function(){
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dashboard/kehadiran/{kehadiran}', [App\Http\Controllers\HomeController::class, 'checkKehadiran'])->name('check-kehadiran');
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    // Route::get('/', function () {
    //     return view('welcome');
    // });

    // nilai tugas
    Route::group(['prefix' => 'nilai-tugas'], function() {
        Route::get('/', [NilaiController::class, 'indexTugas'])->name('nilai.tugas.index');
        Route::get('/{id}', [NilaiController::class, 'showTugas'])->name('nilai.tugas.show');
        Route::get('/{id}/create-kategori-tugas',[NilaiController::class, 'createTugas'])->name('nilai.tugas.create.kategori');
        Route::post('/{id}/store-kategori-tugas',[NilaiController::class, 'storeTugas'])->name('nilai.tugas.store.kategori');
        Route::get('/{id_matkul}/{id_kategori}', [NilaiController::class, 'showNilaiTugas'])->name('nilai.tugas.detail');
        Route::post('/{id_matkul}/{id_kategori}/update', [NilaiController::class, 'updateNilaiTugas'])->name('nilai.tugas.update');
    });

    //rekap absen
    Route::get('/{id_kelas}/{id_matkul_enroll}/pdff', [RekapKehadiranController::class, 'downloadPDF2'])->name('rekap-kehadiran2.download-pdf');
    Route::get('/filter-rekap', [RekapKehadiranController::class, 'filter'])->name('rekap.filter');
    Route::group(['prefix' => 'absensi'], function() {
        Route::get('/', [RekapKehadiranController::class, 'indexRekap'])->name('rekap.index');
        Route::get('/{id}', [RekapKehadiranController::class, 'showRekap'])->name('rekap.show');
        Route::get('/{id_kelas}/{id_mata_kuliah_enroll}', [RekapKehadiranController::class, 'detailRekap'])->name('rekap.detail');
        Route::get('/{id_kelas}/{id_jadwal}/{pertemuan}', [RekapKehadiranController::class, 'detailRekapKehadiran'])->name('rekap.kehadiran.detail');
        Route::get('/{id_kelas}/{id_jadwal}/{pertemuan}/pdf', [RekapKehadiranController::class, 'downloadPDF'])->name('rekap-kehadiran.download-pdf');
     
     
    });

    // perwalian
    Route::resource('perwalian', PerwalianController::class);
    Route::group(['prefix'=>'perwalian'], function() {
        Route::get('/{jadwal_perwalian}',[PerwalianController::class, 'show'])->name('perwalian.show');
        Route::get('/{kelas}/{mahasiswa}/show',[PerwalianController::class, 'showNew'])->name('perwalian.showNew');
        Route::get('create/{jadwal_perwalian}', [PerwalianController::class, 'create'])->name('perwalian.create');
        Route::post('/{jadwal_perwalian}/store',[PerwalianController::class, 'store'])->name('perwalian.store');
        Route::get('/edit/{perwalian}', [PerwalianController::class, 'edit'])->name('perwalian.edit');
        Route::post('/update/{perwalian}', [PerwalianController::class, 'update'])->name('perwalian.update');
        Route::get('/list-perwalian/{jadwal_perwalian}', [PerwalianController::class, 'listPerwalian'])->name('perwalian.list-perwalian');
        Route::get('create-balasan/{perwalian}', [PerwalianController::class, 'createBalasan'])->name('perwalian.create-balasan');
        Route::post('/{perwalian}/store-balasan',[PerwalianController::class, 'storeBalasan'])->name('perwalian.store-balasan');
        Route::get('/edit-balasan/{perwalian}', [PerwalianController::class, 'editBalasan'])->name('perwalian.edit-balasan');
        Route::post('/update-balasan/{perwalian}', [PerwalianController::class, 'updateBalasan'])->name('perwalian.update-balasan');
    });

    Route::resource('jadwal-perwalian', JadwalPerwalianController::class);
    Route::group(['prefix' => 'jadwal-perwalian'], function(){
        Route::get('/{jadwal_perwalian}/delete', [JadwalPerwalianController::class, 'destroy'])->name('jadwal-perwalian.delete');
    });


    // jurusan
    Route::resource('jurusan', JurusanController::class);
    Route::group(['prefix' => 'jurusan'], function(){
        Route::post('/store', [JurusanController::class, 'store']);
        Route::post('/{id}/update', [JurusanController::class, 'update']);
        Route::get('/{jurusan}/delete', [JurusanController::class, 'destroy'])->name('jurusan.delete');
    });

    // Program Studi
    Route::resource('program-studi', ProgramStudiController::class);
    Route::group(['prefix' => 'program-studi'], function(){
        Route::post('/store', [ProgramStudiController::class, 'store']);
        Route::post('/{id}/update', [ProgramStudiController::class, 'update']);
        Route::get('/{program_studi}/delete', [ProgramStudiController::class, 'destroy'])->name('program-studi.delete');
    });

    //Tahun Ajaran
    Route::resource('tahun-ajaran', TahunAjaranController::class);
    Route::group(['prefix' => 'tahun-ajaran'], function(){
        Route::post('/store', [TahunAjaranController::class, 'store']);
        Route::post('/{id}/update', [TahunAjaranController::class, 'update']);
        Route::get('/{tahun_ajaran}/delete', [TahunAjaranController::class, 'destroy'])->name('tahun-ajaran.delete');
    });

    //Kelas
    Route::get('/filter-kelas-admin', [KelasController::class, 'filterAdmin'])->name('kelas.filter.admin');
    Route::get('/filter-kelas', [KelasController::class, 'filter'])->name('kelas.filter');
    Route::resource('kelas', KelasController::class);
    Route::group(['prefix' => 'kelas'], function(){
        Route::post('/store', [KelasController::class, 'store']);
        Route::post('/{id}/update', [KelasController::class, 'update']);
        Route::get('/{kelas}/delete', [KelasController::class, 'destroy'])->name('kelas.delete');
        Route::get('/get-dosen/{id_prodi}', [KelasController::class, 'getDosen']);
        Route::get('/{id}/add-mahasiswa', [KelasEnrollController::class, 'create'])->name('kelas.enroll.create');
        Route::post('/{id}/store-mahasiswa', [KelasEnrollController::class, 'store'])->name('kelas.enroll.store');
        Route::get('/{id}/detail', [KelasController::class, 'showDetail'])->name('kelas.show.detail');
        Route::get('/{id_kelas}/detail/{id_jadwal}/kehadiran', [KelasDetailController::class, 'indexDetailKehadiran'])->name('index.kelas.kehadiran');
        Route::get('/{id_kelas}/detail/{id_jadwal}/kehadiran/{pertemuan}', [KelasDetailController::class, 'showDetailKehadiran'])->name('show.kelas.kehadiran');
        Route::get('/{id_kelas}/detail/{id_matkul}/nilai', [KelasDetailController::class, 'indexDetailNilai'])->name('index.kelas.nilai');
        Route::get('/{id_kelas}/detail/{id_matkul}/nilai/{id_kategori}', [KelasDetailController::class, 'showDetailNilai'])->name('show.kelas.nilai');
    });

    //Mata Kuliah
    Route::get('/filter', [MataKuliahController::class, 'filter'])->name('mata-kuliah.filter');
    Route::resource('mata-kuliah', MataKuliahController::class);
    Route::group(['prefix' => 'mata-kuliah'], function(){
        Route::post('/store', [MataKuliahController::class, 'store']);
        Route::post('/{id}/update', [MataKuliahController::class, 'update']);
        Route::get('/{mata_kuliah}/delete', [MataKuliahController::class, 'destroy'])->name('mata-kuliah.delete');
       

        // Mata Kuliah Enroll
        Route::get('/{id}/mata-kuliah-enroll/create', [MataKuliahEnrollController::class, 'create'])->name('mata-kuliah-enroll.create');
        Route::post('/{id}/mata-kuliah-enroll/store', [MataKuliahEnrollController::class, 'store'])->name('mata-kuliah-enroll.store');
        Route::get('/{id}/mata-kuliah-enroll/{mata_kuliah_enroll}/edit', [MataKuliahEnrollController::class, 'edit'])->name('mata-kuliah-enroll.edit');
        Route::post('/{id}/mata-kuliah-enroll/{mata_kuliah_enroll}/update', [MataKuliahEnrollController::class, 'update'])->name('mata-kuliah-enroll.update');
        Route::get('/{id}/mata-kuliah-enroll/{mata_kuliah_enroll}/delete', [MataKuliahEnrollController::class, 'destroy'])->name('mata-kuliah-enroll.delete');
        
    });

    //Jadwal
    Route::resource('jadwal', JadwalController::class);
    Route::get('/jadwal-new',[JadwalController::class,'newIndex']);
    Route::get('/jadwal-new/{id}',[JadwalController::class,'detailNew']);
    Route::group(['prefix' => 'jadwal'], function(){
        Route::get('/{id_kelas}/create', [JadwalController::class, 'create'])->name('jadwal.create');
        Route::post('/store', [JadwalController::class, 'store']);
        Route::get('/{jadwal}/{id_kelas}/edit', [JadwalController::class, 'edit'])->name('jadwal.edit');
        Route::post('/{id}/update', [JadwalController::class, 'update']);
        Route::get('/{jadwal}/delete', [JadwalController::class, 'destroy'])->name('jadwal.delete');
        Route::post('/{id_jadwal}/add_keterlambatan', [KehadiranController::class, 'addKeterlambatan'])->name('kehadiran.keterlambatan.add');
        Route::post('/{id_jadwal}/update_kehadiran', [KehadiranController::class, 'updateKehadiran'])->name('kehadiran.update.single');
        Route::get('/{id_jadwal}/create-pertemuan', [KehadiranController::class, 'create'])->name('kehadiran.create');
        Route::post('/{id_jadwal}store', [KehadiranController::class, 'store'])->name('kehadiran.store');
        Route::get('/{id_jadwal}/{pertemuan}', [KehadiranController::class, 'show'])->name('kehadiran.show');
        Route::post('/{id_jadwal}/{pertemuan}/update', [KehadiranController::class, 'update'])->name('kehadiran.update');
        Route::get('/{id_jadwal}/{pertemuan}/pertemuan/edit', [KehadiranController::class, 'edit'])->name('kehadiran.edit');
        Route::post('/{id_jadwal}/{pertemuan}/update-pertemuan', [KehadiranController::class, 'updatePertemuan'])->name('kehadiran.pertemuan.update');
    });

    // sp
    Route::get('/kirim', [SpController::class, 'kirim'])->name('sp.kirim');
    Route::resource('sp', SpController::class);
    Route::group(['prefix' => 'sp'], function(){
        Route::post('/store', [SpController::class, 'store']);
        Route::post('/{id}/update', [SpController::class, 'update']);
        Route::get('/{sp}/delete', [SpController::class, 'destroy'])->name('sp.delete');
        Route::get('/get-mahasiswa/{id_kelas}', [SpController::class, 'getMahasiswa']);
        Route::get('/check-terlambat/{id_mahasiswa}', [SpController::class, 'checkTerlambat'])->name('sp.check-terlambat');
        Route::get('/kirim-peringatan/{id_mahasiswa}', [SpController::class, 'kirimPeringatan'])->name('sp.kirim-peringatan');
    });

    // User
    Route::resource('user', UserController::class);
    Route::group(['prefix' => 'user'], function(){
        Route::post('/store', [UserController::class, 'store']);
        Route::post('/{id}/update', [UserController::class, 'update']);
        Route::get('/{user}/delete', [UserController::class, 'destroy'])->name('user.delete');
    });

    //Orang Tua
    Route::resource('orang-tua', OrangTuaController::class);
    Route::group(['prefix' => 'orang-tua'], function(){
        Route::post('/store', [OrangTuaController::class, 'store']);
        Route::post('/{id}/update', [OrangTuaController::class, 'update']);
        Route::get('/{orang_tua}/delete', [OrangTuaController::class, 'destroy'])->name('orang-tua.delete');
    });

    // Nilai
    Route::get('/filter-nilai-tugas', [NilaiController::class, 'filterTugas'])->name('nilai.tugas.filter');
    Route::get('/filter-nilai', [NilaiController::class, 'filter'])->name('nilai.filter');
    Route::resource('nilai', NilaiController::class);
    Route::group(['prefix' => 'nilai'], function() {
        Route::get('/{mata_kuliah}/create', [NilaiController::class, 'create'])->name('nilai.create');
        Route::get('generate/{mata_kuliah}', [NilaiController::class, 'generateNilai'])->name('nilai.generate');
        Route::get('/{mata_kuliah}/create/kategori', [NilaiController::class, 'createKategori'])->name('nilai.create.kategori');
        Route::post('/{mata_kuliah}/store/kategori', [NilaiController::class, 'store'])->name('nilai.store');
        Route::get('/{mata_kuliah}/{nilai}', [NilaiController::class, 'show'])->name('nilai.show');
        Route::get('/{mata_kuliah}/{nilai}/create', [NilaiController::class, 'createNilai'])->name('nilai.create.nilai');
        Route::get('/{mata_kuliah}/{nilai}/{id}/edit', [NilaiController::class, 'editNilai'])->name('nilai.edit.nilai');
        Route::get('/{mata_kuliah}/{nilai}/{id}/destroy', [NilaiController::class, 'destroyNilai'])->name('nilai.delete.nilai');
        Route::post('/{mata_kuliah}/{nilai}/update', [NilaiController::class, 'update'])->name('nilai.update');
        Route::post('/update-all', [NilaiController::class, 'updated'])->name('nilai.updated');
    });

    // daftar nilai mahasiswa
    Route::resource('daftar-nilai', DaftarNilaiController::class);
    Route::get('daftar-nilai-semester',[DaftarNilaiController::class,'indexSemester']);

    // Kelas Mahasiswa
    Route::resource('mahasiswa-kelas', KelasEnrollController::class);
    Route::group(['prefix' => 'mahasiswa-kelas'], function() {
        Route::get('/create', [KelasEnrollController::class, 'createMahasiswaKelasEnroll'])->name('mahasiswa.kelas.create');
        Route::post('/store', [KelasEnrollController::class, 'storeMahasiswaKelasEnroll'])->name('mahasiswa.kelas.store');
    });
    // Mata Kuliah Mahasiswa
    Route::resource('mahasiswa-mata-kuliah', MahasiswaMataKuliahEnrollController::class);
    Route::group(['prefix' => 'mahasiswa-mata-kuliah'], function() {
        Route::get('/get-matkul/{id_kelas}', [MahasiswaMataKuliahEnrollController::class, 'getMatkul'])->name('mahasiswa-mata-kuliah.get.matkul');
    });

    Route::get('/ubah-jadwal',[JadwalController::class,'indexUbahJadwal']);
    Route::get('/ubah-jadwal/{id}',[JadwalController::class,'editUbahJadwal']);
    Route::post('/ubah-jadwal/{id}/update', [JadwalController::class, 'updateUbahJadwal']);

    // profile
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile/{id}', [UserController::class, 'profileUpdate'])->name('profile.update');

    Route::group(['prefix'=>'rekap-laporan-kehadiran'], function() {
        Route::get('/',[RekapLaporanKehadiranController::class,'index']);
        Route::post('/',[RekapLaporanKehadiranController::class,'index'])->name('filter-rekap-laporan-kehadiran');
    });

});

