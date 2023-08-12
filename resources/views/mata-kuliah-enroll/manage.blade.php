@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                  <p class="mb-0">{{ !empty($data) ? 'Edit Matkul' : 'Add Matkul'}}</p>
                </div>
              </div>
              @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif
              <div class="card-body">
                <p class="text-uppercase text-sm">Matkul Information</p>
                <div class="row">
                    <form action="{{ !empty($data) ? route('mata-kuliah-enroll.update', ['id' => $id_mata_kuliah, 'mata_kuliah_enroll' => $data->id]) : route('mata-kuliah-enroll.store', ['id' => $id_mata_kuliah])}}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-control-label">Kelas</label>
                                <select name="id_kelas" id="" class="form-control">
                                    @foreach ($kelas as $item)
                                    <option value="{{ $item->id }}" {{ old('id_kelas', @$item->id == @$data->id_kelas ? 'selected' : '')}}>{{ $item->kode_kelas }} {{$item->tahunAjaran->semester}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @if (Auth::user()->role->role_name == 'admin jurusan')
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-control-label">Dosen</label>
                                <select name="id_dosen" id="" class="form-control">
                                    @foreach ($dosen as $item)
                                    <option value="{{ $item->id }}" {{ old('id_dosen', @$item->id == @$data->id_dosen ? 'selected' : '')}}>{{ $item->name }}</option>
                                    @endforeach
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
