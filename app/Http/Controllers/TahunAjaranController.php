<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TahunAjaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahun_ajaran = TahunAjaran::all();

        return view('tahun-ajaran.index', compact('tahun_ajaran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tahun-ajaran.manage');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            //code...
            $this->validate($request, [
                'tahun' => ['required'],
                'semester' => ['required'],
            ]);
    
            $data = $request->except('_token');
    
            TahunAjaran::create($data);
    
            Session::flash('swal', [
                'title' => 'Add Data',
                'text' => 'success',
                'icon' => 'success',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);

            return redirect('/tahun-ajaran');
        } catch (\Throwable $th) {
            //throw $th;
            Session::flash('swal', [
                'title' => 'Add Data',
                'text' => 'error',
                'icon' => 'error',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);

            return redirect()->back();
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = TahunAjaran::findorFail($id);

        return view('tahun-ajaran.manage', compact('data'));
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
            //code...
            $this->validate($request, [
                'tahun' => ['required'],
                'semester' => ['required'],
            ]);
    
            $data = $request->except('_token');
    
            $tahun_ajaran = TahunAjaran::findorFail($id);
    
            $tahun_ajaran->update($data);
    
            Session::flash('swal', [
                'title' => 'Update Data',
                'text' => 'success',
                'icon' => 'success',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);

            return redirect('/tahun-ajaran');
        } catch (\Throwable $th) {
            //throw $th;
            Session::flash('swal', [
                'title' => 'Update Data',
                'text' => 'error',
                'icon' => 'error',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);
            return redirect()->back();
        }
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
            //code...
            Session::flash('swal', [
                'title' => 'Delete Data',
                'text' => 'success',
                'icon' => 'success',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);
            $tahun_ajaran = TahunAjaran::findorFail($id);
            $tahun_ajaran->delete();
        } catch (\Throwable $th) {
            //throw $th;
            Session::flash('swal', [
                'title' => 'Delete Data',
                'text' => 'error',
                'icon' => 'error',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);
        }

        return redirect()->back();
    }
}
