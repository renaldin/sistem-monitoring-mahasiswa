@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                  <p class="mb-0">Add Nilai</p>
                </div>
              </div>
              <div class="card-body">
                <p class="text-uppercase text-sm">Matkul Information</p>
                <div class="row">
                    <form action="{{ route('nilai.update', ['mata_kuliah' => $matkul->id , 'nilai' => $daftar_nilai->id]) }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-control-label">Mahasiswa</label>
                                <select name="id_mahasiswa" id="" class="form-control">
                                    @foreach ($mahasiswa as $item)
                                    <option value="{{ $item->id_mahasiswa }}" {{ old('id_mahasiswa', @$data->id_mahasiswa == $item->id_mahasiswa ? 'selected' : '') }}>{{ $item->mahasiswa->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Nilai</label>
                                <input class="form-control" name="nilai" value="{{old('nilai',@$data->nilai)}}" placeholder="0 - 100" type="text">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-primary w-100 d-block btn-md">Submit</button>
                    </form>
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection
