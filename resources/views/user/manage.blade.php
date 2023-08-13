@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
              <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                  <p class="mb-0">{{ !empty($data) ? 'Edit User' : 'Add User'}}</p>
                </div>
              </div>
              <div class="card-body">
                <p class="text-uppercase text-sm">User Information</p>
                <div class="row">
                    <form action="{{ !empty($data) ? url('user/'.@$data->id.'/update') : url('user/store')}}" method="POST">
                        @method('POST')
                        @csrf
                        <div class="col">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Name</label>
                                <input class="form-control" required name="name" value="{{old('name',@$data->name)}}" type="text">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Email address</label>
                                <input class="form-control" required name="email" value="{{old('email',@$data->email)}}" type="email">
                            </div>
                        </div>
                        @if (empty($data))
                        <div class="col">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Password</label>
                                <input class="form-control" required name="password" type="password">
                            </div>
                        </div>
                        @endif
                        <div class="col">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Nomor Identitas</label>
                                <input class="form-control" required name="identity_number" value="{{old('identity_number',@$data->identity_number)}}" type="number">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">No Telephone</label>
                                <input class="form-control" required name="phone_number" value="{{old('phone_number',@$data->phone_number)}}" type="number">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Alamat</label>
                                <input class="form-control" required name="address" value="{{old('address',@$data->address)}}" type="text">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-control-label">Jenis Kelamin</label>
                                <select name="gender" id="" class="form-control" required>
                                    <option value="Laki-laki" {{ old('gender', @$data->gender == 'Laki-laki' ? 'selected' : '')}}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('gender', @$data->gender == 'Perempuan' ? 'selected' : '')}}>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-control-label">Role</label>
                                <select name="id_role" id="" class="form-control" required>
                                    @foreach ($role as $item)
                                    <option value="{{ $item->id }}" {{ old('id_role', @$item->id == @$data->id_role ? 'selected' : '')}}>{{ $item->role_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-control-label">Prodi</label>
                                <select name="id_prodi" id="" class="form-control" required>
                                    @foreach ($prodi as $item)
                                    <option value="{{ $item->id }}" {{ old('id_prodi', @$item->id == @$data->id_prodi ? 'selected' : '')}}>{{ $item->nama_prodi }} | {{ $item->jurusan->nama_jurusan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @if (!empty($data))
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-control-label">Status</label>
                                <select name="status" id="" class="form-control" required>
                                    <option value="{{ $data->status }}">{{$data->status}}</option>
                                    <option value="aktif">aktif</option>
                                    <option value="tidak aktif">tidak aktif</option>
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

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {

    })
</script>
@endsection
