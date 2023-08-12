@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card mb-5">
          <div class="card-header pb-0">
            <div class="d-flex align-items-center">
              <p class="mb-0">Profile</p>
            </div>
          </div>
          <div class="card-body">
                @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif
              <div class="row">
                <form action="{{ Auth::guard('orang_tua')->user() ? route('profile.update', ['id' => $ortu->id_mahasiswa]) : route('profile.update', ['id' => $user->id])}}" method="POST">
                    @method('post')
                    @csrf
                    @if (!Auth::guard('orang_tua')->user())
                    <div class="col">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Nama</label>
                            <input class="form-control" name="name" value="{{old('name',@$user->name)}}" type="text">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Email</label>
                            <input class="form-control" name="email" value="{{old('email',@$user->email)}}" type="email">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Password</label>
                            <input class="form-control" name="password"  type="password">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Alamat</label>
                            <Textarea class="form-control" name="address">{{ $user->address }}</Textarea>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">No Handphone</label>
                            <input class="form-control" name="phone_number" value="{{$user->phone_number}}" type="number">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-control-label">Jenis Kelamin</label>
                            <select name="gender" id="" class="form-control">
                                <option value="Laki-laki" {{ old('gender', @$user->gender == 'Laki-laki' ? 'selected' : '')}}>Laki-laki</option>
                                <option value="Perempuan" {{ old('gender', @$user->gender == 'Perempuan' ? 'selected' : '')}}>Perempuan</option>
                            </select>
                        </div>
                    </div>
                    
                    @endif

                    @if (Auth::guard('orang_tua')->user())
                    <div>OrangTua Mahasiswa</div>
                    <hr class="my-4">
                    <div class="col">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Nama Orang Tua</label>
                            <input class="form-control" name="name_ortu" value="{{old('name_ortu',@$ortu->name)}}" type="text">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Password</label>
                            <input class="form-control" name="password_ortu"  type="password">
                        </div>
                    </div>
                    
                    <div class="col">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Email Orang Tua</label>
                            <input class="form-control" name="email_ortu" value="{{old('email_ortu',@$ortu->email)}}" type="email">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Alamat Orang Tua</label>
                            <Textarea class="form-control" name="address_ortu">{{ old('address',@$ortu->address) }}</Textarea>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">No Handphone Orang Tua</label>
                            <input class="form-control" name="phone_number_ortu" value="{{old('email',@$ortu->phone_number)}}" type="number">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-control-label">Jenis Kelamin Orang Tua</label>
                            <select name="gender_ortu" id="" class="form-control">
                                <option value="Laki-laki" {{ old('gender', @$ortu->gender == 'Laki-laki' ? 'selected' : '')}}>Laki-laki</option>
                                <option value="Perempuan" {{ old('gender', @$ortu->gender == 'Perempuan' ? 'selected' : '')}}>Perempuan</option>
                            </select>
                        </div>
                    </div>
                    @endif
                    <button type="submit" class="btn btn-outline-primary w-100 d-block btn-md">Submit</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
