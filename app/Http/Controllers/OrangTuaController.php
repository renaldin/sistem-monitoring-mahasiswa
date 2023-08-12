<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use DB;

use App\Models\OrangTua;
use App\Models\User;

class OrangTuaController extends Controller
{

    public function index()
    {
        $ortu = DB::table('orang_tua')
                ->selectRaw("orang_tua.*, users.name as mahasiswa_name")
                ->join('users', 'orang_tua.id_mahasiswa', '=', 'users.id')
                ->get();

        return view('orang-tua.index', compact('ortu'));
    }


    public function create()
    {
        $data['mahasiswa'] = User::where('id_role', 4)->get();
        
        return view('orang-tua.manage', $data);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'id_mahasiswa' => ['required','unique:orang_tua,id_mahasiswa'],
            'name_ortu' => ['required'],
            'email_ortu' => ['required','email'],
            'address_ortu' => ['required'],
            'phone_number_ortu' => ['required', 'numeric'],
            'gender_ortu' => ['required'],
        ]);

        $data = $request->except('_token');

        $mahasiswa = User::find($data['id_mahasiswa']);
        $orang_tua_data = array(
            'id_mahasiswa' => $data['id_mahasiswa'],
            'name' => $data['name_ortu'],
            'email' => $data['email_ortu'],
            'nim_mahasiswa' => 'P'.$mahasiswa['identity_number'],
            'password' => bcrypt($mahasiswa['identity_number']),
            'address' => $data['address_ortu'],
            'phone_number' => $data['phone_number_ortu'],
            'gender' => $data['gender_ortu'],
        );

        OrangTua::create($orang_tua_data);

        return redirect('/orang-tua');
    }


    public function edit($id)
    {
        $mahasiswa = $data['mahasiswa'] = User::where('id_role', 4)->get();
        $ortu = OrangTua::findorFail($id);

        $data = array(
            'mahasiswa' => $mahasiswa,
            'data' => $ortu,
        );

        return view('orang-tua.manage', $data);
    }


    public function update(Request $request, $id)
    {
        $orang_tua = OrangTua::findorFail($id);
        $data = $request->except('_token');

        $validatedData = [
            'name_ortu' => 'required',
            'email_ortu' => 'required|email',
            'address_ortu' => 'required',
            'phone_number_ortu' => 'required|numeric',
            'gender_ortu' => 'required',
        ];

        if($data['id_mahasiswa'] != $orang_tua->id_mahasiswa) {
            $validatedData['id_mahasiswa'] = 'required|unique:orang_tua,id_mahasiswa';
        }

        $this->validate($request, $validatedData);
        
        $mahasiswa = User::find($data['id_mahasiswa']);

        $orang_tua->id_mahasiswa = $data['id_mahasiswa'];
        $orang_tua->name = $data['name_ortu'];
        $orang_tua->email = $data['email_ortu'];
        $orang_tua->nim_mahasiswa = 'P'.$mahasiswa['identity_number'];
        $orang_tua->address = $data['address_ortu'];
        $orang_tua->phone_number = $data['phone_number_ortu'];
        $orang_tua->gender = $data['gender_ortu'];
        $orang_tua->update();

        Session::flash('swal', [
            'title' => 'Update Data',
            'text' => 'success',
            'icon' => 'success',
            'timer' => 1500,
            'showConfirmButton' => false,
        ]);

        return redirect('/orang-tua');
    }

    public function destroy($id)
    {
        try {
            //code...
            $ortu = OrangTua::findorFail($id);
            Session::flash('swal', [
                'title' => 'Delete Data',
                'text' => 'success',
                'icon' => 'success',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);

            $ortu->delete();
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
