<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kehadiran;
use App\Models\Kelas;
use App\Models\KelasEnroll;
use App\Models\MahasiswaMataKuliahEnroll;
use App\Models\MataKuliah;
use App\Models\MataKuliahEnroll;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role->role_name == 'dosen') {
            $jadwal = Jadwal::join('mata_kuliah_enrolls', 'jadwals.id_mata_kuliah_enroll','=','mata_kuliah_enrolls.id')
            ->where('id_dosen', auth()->user()->id)
            ->get();
        } else {
            $jadwal = Jadwal::all();
        }

        return view('jadwal.index', compact('jadwal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_kelas)
    {
        $kelas = Kelas::findorFail($id_kelas);

        $matkul_enroll = MataKuliahEnroll::whereHas('mataKuliah',function($query) use ($kelas){
            $query->where('semester', $kelas->tahunAjaran->semester);
        })
        ->where('id_kelas', $kelas->id)
        ->get();


        return view('jadwal.manage', compact('matkul_enroll'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id_mata_kuliah_enroll' => ['required'],
            'hari' => ['required'],
            'jam_mulai' => ['required'],
            'jam_selesai' => ['required'],
        ]);

        $data = $request->except('_token');
        $mata_kuliah_enroll = MataKuliahEnroll::findorFail($data['id_mata_kuliah_enroll']);

        $mahasiswa = KelasEnroll::where('id_kelas', $mata_kuliah_enroll->id_kelas)
        ->get();
        $today = Carbon::today();
        $tanggal = $today->toDateString();

        $jadwal_exists = Jadwal::with('mataKuliahEnroll')
        ->whereHas('mataKuliahEnroll', function($query) use ($mata_kuliah_enroll) {
            $query->where('id_kelas', $mata_kuliah_enroll->id_kelas);
        })
        ->where('id_mata_kuliah_enroll', $mata_kuliah_enroll->id)
        ->exists();



        if ($jadwal_exists) {
            return redirect()->back()->with('error','Jadwal sudah ada');
        } else {
            try {
                Jadwal::create($data);
    
                foreach ($mahasiswa as $key => $value) {
    
                    $data_mahasiswa = array(
                        'id_mata_kuliah_enroll' => $mata_kuliah_enroll->id,
                        'id_mahasiswa' => $value->id_mahasiswa
                    );
    
                    MahasiswaMataKuliahEnroll::create($data_mahasiswa);
                }

                Session::flash('swal', [
                    'title' => 'Add Data',
                    'text' => 'Success',
                    'icon' => 'success',
                    'timer' => 1500,
                    'showConfirmButton' => false,
                ]);
            } catch (\Throwable $th) {
                //throw $th;
                Session::flash('swal', [
                    'title' => 'Add Data',
                    'text' => 'error',
                    'icon' => 'error',
                    'timer' => 1500,
                    'showConfirmButton' => false,
                ]);
            }

            $path = parse_url($request->path)['path'];
            $desiredPart = substr($path, 1);

            return redirect($desiredPart);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jadwal = Jadwal::findorFail($id);
        $mahasiswa = MahasiswaMataKuliahEnroll::join('mata_kuliah_enrolls', 'mahasiswa_mata_kuliah_enrolls.id_mata_kuliah_enroll', '=', 'mata_kuliah_enrolls.id')
        ->where('id_mata_kuliah_enroll', $jadwal->mataKuliahEnroll->id)
        ->get();

        $kehadiran = Kehadiran::where('id_jadwal', $jadwal->id)
        ->select('pertemuan', DB::raw('count(*) as total'), 'tanggal', 'deskripsi')
        ->groupBy('pertemuan','tanggal','deskripsi')
        ->get();

        $mahasiswas = User::with('kehadiran')
        ->whereHas('kehadiran', function($query) use ($jadwal) {
            $query->where('id_jadwal', $jadwal->id);
        })->get();


        $data = array(
            'data' => $jadwal,
            'mahasiswa' => $mahasiswas,
            'kehadiran' => $kehadiran,
        );


        return view('jadwal.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $id_kelas)
    {
        $kelas = Kelas::findorFail($id_kelas);

        $matkul_enroll = MataKuliahEnroll::whereHas('mataKuliah',function($query) use ($kelas){
            $query->where('semester', $kelas->tahunAjaran->semester);
        })->get();
        $jadwal = Jadwal::findorFail($id);

        $data = array(
            'matkul_enroll' => $matkul_enroll,
            'data' => $jadwal
        );

        return view('jadwal.manage', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'id_mata_kuliah_enroll' => ['required'],
                'hari' => ['required'],
                'jam_mulai' => ['required'],
                'jam_selesai' => ['required'],
            ]);
    
            $data = $request->except('_token');
    
            $jadwal = Jadwal::findorFail($id);
    
            $jadwal->update($data);
            
            Session::flash('swal', [
                'title' => 'Update Data',
                'text' => 'Success',
                'icon' => 'success',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            Session::flash('swal', [
                'title' => 'Update Data',
                'text' => 'error',
                'icon' => 'error',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);
        }

        $path = parse_url($request->path)['path'];
        $desiredPart = substr($path, 1);

        return redirect($desiredPart);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $jadwal = Jadwal::findorFail($id);
            Session::flash('swal', [
                'title' => 'Delete Data',
                'text' => 'Success',
                'icon' => 'success',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);
            $jadwal->delete();
        } catch (\Throwable $th) {
            //throw $th;
        }

        return redirect()->back();
    }


    public function newIndex(){
        if(Auth::user()->role->role_name == 'dosen'){
            $jadwal = Jadwal::with('mataKuliahEnroll')
            ->whereHas('mataKuliahEnroll',function($query){
                $query->where('id_dosen',Auth::user()->id);
            })
            ->get();
        }else{
            $jadwal = Kelas::where('id_prodi', Auth::user()->id_prodi)
            ->where('status','aktif')
            ->get();
        }
        return view('jadwal.index2',compact('jadwal'));
    }

    public function detailNew($id){
        $jadwal = Jadwal::whereHas('mataKuliahEnroll',function($query) use ($id){
            $query->whereHas('kelas',function($value) use ($id){
                $value->where('id',$id);
                $value->where('status','aktif');
            });
        })->get();

        if(Auth::user()->role->role_name == 'admin jurusan'){
            $kelas = kelas::where('id_prodi', Auth::user()->id_prodi)
            ->where('id', $id)
            ->first();

            $data = array(
                'kelas' => $kelas,
                'jadwal' => $jadwal
            );
            return view('jadwal.index',$data);
        } else {
            return view('jadwal.index',compact('jadwal'));

        }
    }

    public function indexUbahJadwal(){
        $jadwal = Jadwal::with('mataKuliahEnroll')
        ->whereHas('mataKuliahEnroll',function($query){
            $query->where('id_dosen',Auth::user()->id);
        })
        ->get();
        return view('ubah-jadwal.index',compact('jadwal'));
    }

    public function editUbahJadwal($id)
    {
        $matkul_enroll = MataKuliahEnroll::all();
        $jadwal = Jadwal::findorFail($id);

        $data = array(
            'matkul_enroll' => $matkul_enroll,
            'data' => $jadwal
        );

        return view('ubah-jadwal.manage', $data);
    }

    public function updateUbahJadwal(Request $request, $id)
    {
        try {
            //code...
            $this->validate($request, [
                'hari' => ['required'],
                'jam_mulai' => ['required'],
                'jam_selesai' => ['required'],
            ]);
    
            $data = $request->except('_token');
    
            $jadwal = Jadwal::findorFail($id);
    
            $jadwal->update($data);
            
            Session::flash('swal', [
                'title' => 'Update Data',
                'text' => 'Success',
                'icon' => 'success',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            Session::flash('swal', [
                'title' => 'Update Data',
                'text' => 'error',
                'icon' => 'error',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);
        }

        return redirect('ubah-jadwal');
    }
}
