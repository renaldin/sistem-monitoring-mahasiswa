<?php

namespace App\Http\Controllers;

use App\Models\OrangTua;
use App\Models\ProgramStudi;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();

        return view('user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::all();
        $prodi = ProgramStudi::all();

        $data = array(
            'role' => $role,
            'prodi' => $prodi
        );

        return view('user.manage', $data);
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
                'name' => ['required'],
                'email' => ['required', 'email', 'unique:users'],
                'identity_number' => ['required', 'unique:users'],
                'id_role' => ['required'],
                'password' => ['required'],
                'address' => ['required'],
                'phone_number' => ['required', 'numeric'],
                'gender' => ['required'],
                'id_prodi' => ['required'],
            ]);

            $data = array(
                'name' => $request->name,
                'email' => $request->email,
                'identity_number' => $request->identity_number,
                'id_role' => $request->id_role,
                'password' => bcrypt($request->password),
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'gender' => $request->gender,
                'id_prodi' => $request->id_prodi,
            );

            User::create($data);

            Session::flash('swal', [
                'title' => 'Add Data',
                'text' => 'success',
                'icon' => 'success',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);

            return redirect('/user');
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
        $role = Role::all();
        $prodi = ProgramStudi::all();
        $user = User::findorFail($id);

        $data = array(
            'role' => $role,
            'prodi' => $prodi,
            'data' => $user,
        );

        return view('user.manage', $data);
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
                'name' => ['required'],
                'email' => ['required', 'email'],
                'identity_number' => ['required'],
                'id_role' => ['required'],
                // 'password' => ['required'],
                'address' => ['required'],
                'phone_number' => ['required', 'numeric'],
                'gender' => ['required'],
                'id_prodi' => ['required'],
                'status' => ['required'],
            ]);

            $data = $request->except('_token');

            $user = User::findorFail($id);
            $user->update($data);

            Session::flash('swal', [
                'title' => 'Update Data',
                'text' => 'success',
                'icon' => 'success',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);

            return redirect('/user');
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
            $user = User::findorFail($id);
            Session::flash('swal', [
                'title' => 'Delete Data',
                'text' => 'success',
                'icon' => 'success',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);

            $user->delete();
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

    public function profile()
    {
        if (Auth::guard('web')->user()) {
            # code...
            $user = User::findorFail(auth()->user()->id);
            $ortu = OrangTua::where('id_mahasiswa', $user->id)
                ->first();

            $data = array(
                'user' => $user,
                'ortu' => $ortu,
            );
        } else {
            $ortu = OrangTua::findorFail(Auth::guard('orang_tua')->user()->id);

            $data = array(
                'ortu' => $ortu,
            );
        }

        return view('profile.index', $data);
    }

    public function profileUpdate(Request $request, $id)
    {
        try {
            //code...
            if (Auth::guard('web')->user()) {
                $this->validate($request, [
                    'name' => ['required'],
                    'email' => ['required', 'email'],
                    // 'identity_number' => ['required'],
                    // 'id_role' => ['required'],
                    // 'password' => ['required'],
                    'address' => ['required'],
                    'phone_number' => ['required', 'numeric'],
                    'gender' => ['required'],
                ]);
            } else {
                $this->validate($request, [
                    'name_ortu' => ['required'],
                    'email_ortu' => ['required', 'email'],
                    // 'identity_number' => ['required'],
                    // 'id_role' => ['required'],
                    // 'password' => ['required'],
                    'address_ortu' => ['required'],
                    'phone_number_ortu' => ['required', 'numeric'],
                    'gender_ortu' => ['required'],
                ]);
            }

            $data = $request->except('_token');

            $mahasiswa = User::findorFail($id);
            $orang_tua = OrangTua::where('id_mahasiswa', $mahasiswa->id)
                ->first();

            if (Auth::guard('web')->user()) {
                $mahasiswa->name = $data['name'];
                $mahasiswa->email = $data['email'];
                $mahasiswa->address = $data['address'];
                $mahasiswa->phone_number = $data['phone_number'];
                $mahasiswa->gender = $data['gender'];

                if (!empty($data['password'])) {
                    if ($data['password'] == $mahasiswa->identity_number) {
                        return redirect()->route('profile')->with('error', 'Password tidak boleh nim');
                    } else {
                        $mahasiswa->password = bcrypt($data['password']);
                    }
                }
                $mahasiswa->update();


                if ($orang_tua) {
                    $orang_tua->name = $data['name_ortu'];
                    $orang_tua->email = $data['email_ortu'];
                    $orang_tua->address = $data['address_ortu'];
                    $orang_tua->phone_number = $data['phone_number_ortu'];
                    $orang_tua->gender = $data['gender_ortu'];
                    $orang_tua->update();
                } else {
                    if (!empty($data['name_ortu'])) {
                        $orang_tua_data = array(
                            'id_mahasiswa' => $mahasiswa->id,
                            'name' => $data['name_ortu'],
                            'email' => $data['email_ortu'],
                            'nim_mahasiswa' => 'P' . $mahasiswa->identity_number,
                            'password' => bcrypt($mahasiswa->identity_number),
                            'address' => $data['address_ortu'],
                            'phone_number' => $data['phone_number_ortu'],
                            'gender' => $data['gender_ortu'],
                        );
                        // dd($orang_tua_data);
                        OrangTua::create($orang_tua_data);
                    }
                }
            } else {
                $orang_tua->name = $data['name_ortu'];
                $orang_tua->email = $data['email_ortu'];
                $orang_tua->address = $data['address_ortu'];
                $orang_tua->phone_number = $data['phone_number_ortu'];
                $orang_tua->gender = $data['gender_ortu'];

                if (!empty($data['password_ortu'])) {
                    $orang_tua->password = bcrypt($data['password_ortu']);
                }

                $orang_tua->update();
            }

            Session::flash('swal', [
                'title' => 'Update Data',
                'text' => 'success',
                'icon' => 'success',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);

            return redirect()->route('profile');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
