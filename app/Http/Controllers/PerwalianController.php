<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\KelasEnroll;
use App\Models\Perwalian;
use App\Models\User;
use App\Models\JadwalPerwalian;
use Illuminate\Http\Request;
use Auth;
use DB;

class PerwalianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role->role_name == 'dosen') {
            $perwalian = KelasEnroll::whereHas('kelas',function($query){
                $query->where('id_dosen_wali', auth()->user()->id);
            })
            ->get()
            ->groupBy('mahasiswa.name');
            // dd($perwalian);
            return view('perwalian.index', compact('perwalian'));
        } elseif (auth()->user()->role->role_name == 'mahasiswa') {
            $perwalian = KelasEnroll::where('id_mahasiswa', auth()->user()->id)
            ->get();
            return view('perwalian.index2', compact('perwalian'));
        }
  

    }


    public function listPerwalian($id)
    {
        $perwalian = DB::table('perwalians')
                    ->selectRaw("perwalians.*, users.name")
                    ->join('users', 'perwalians.id_mahasiswa', '=', 'users.id')
                    ->where('perwalians.id_jadwal_perwalian', $id)
                    ->get();

        return view('perwalian.list-perwalian', compact('perwalian'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $id_jadwal_perwalian = $id;
        return view('perwalian.manage', compact('id_jadwal_perwalian'));
    }

    public function createBalasan($id)
    {
        $id_perwalian = $id;
        return view('perwalian.form-balasan', compact('id_perwalian'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        
        if (auth()->user()->role->role_name == 'dosen') {
            $this->validate($request, [
                'keluhan' => ['required']
            ]);
        }

        $perwalian = JadwalPerwalian::findorFail($id);

        $data = $request->except('_token');
        $data['id_jadwal_perwalian'] = $perwalian->id;
        $data['id_mahasiswa'] = auth()->user()->id;
        $data['id_kelas'] = $perwalian->id_kelas;

        Perwalian::create($data);

        return redirect()->route('perwalian.show', $id);
    }
    
    public function storeBalasan(Request $request, $id)
    {

        $data = $request->except('_token');
    
        $jadwal = Perwalian::findorFail($id);
        $jadwal->balasan = $data['balasan'];

        $jadwal->update($data);

        return redirect()->route('perwalian.list-perwalian', $id);
    }

    public function show($id)
    {

        $perwalian = Perwalian::where('id_jadwal_perwalian', $id)
                    ->where('id_mahasiswa', Auth::user()->id)
                    ->get();

        $data = array(
            'perwalian' => $perwalian
        );


        return view('perwalian.show', $data);
    }

    public function edit($id)
    {
        $perwalian = Perwalian::findorFail($id);

        $data = array(
            'data' => $perwalian
        );

        return view('perwalian.manage', $data);
    }

    public function editBalasan($id)
    {
        $perwalian = Perwalian::findorFail($id);

        $data = array(
            'data' => $perwalian
        );

        return view('perwalian.form-balasan', $data);
    }

    public function update(Request $request,$id)
    {
        // $this->validate($request, [
        //     'balasan' => ['required']
        // ]);

        $data = $request->except('_token');

        $perwalian = Perwalian::findOrfail($id);

        $perwalian->update($data);

        return redirect()->route('perwalian.show', $id);
    }

    public function updateBalasan(Request $request,$id)
    {
        // $this->validate($request, [
        //     'balasan' => ['required']
        // ]);

        $data = $request->except('_token');

        $perwalian = Perwalian::findOrfail($id);

        $perwalian->update($data);

        return redirect()->route('perwalian.list-perwalian', $id);
    }

    public function destroy($id)
    {
        //
    }
    
    public function showNew($id_kelas,$id_mahasiswa){
        $perwalian = Perwalian::where('id_mahasiswa',$id_mahasiswa)
        ->get();

        $id_kelas = $id_kelas;

        return view('perwalian.show',compact('perwalian','id_kelas'));
    }
}
