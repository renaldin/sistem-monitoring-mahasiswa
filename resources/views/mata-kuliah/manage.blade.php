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
              <div class="card-body">
                <p class="text-uppercase text-sm">Matkul Information</p>
                <div class="row">
                    <form action="{{ !empty($data) ? url('mata-kuliah/'.@$data->id.'/update') : url('mata-kuliah/store')}}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="col">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Nama Mata Kuliah</label>
                                <input class="form-control" required name="nama_mata_kuliah" value="{{old('nama_mata_kuliah',@$data->nama_mata_kuliah)}}" type="text">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-control-label">Prodi</label>
                                <select name="id_prodi" id="" class="form-control" required>
                                    @foreach ($prodi as $item)
                                    <option value="{{ $item->id }}" {{ old('id_prodi', @$item->id == @$data->id_prodi ? 'selected' : '')}}>{{ $item->nama_prodi }}|{{ $item->jurusan->nama_jurusan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Kode Mata Kuliah</label>
                                <input class="form-control" required name="kode_mata_kuliah" value="{{old('email',@$data->kode_mata_kuliah)}}" type="text">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">SKS</label>
                                <input class="form-control" required name="sks" type="text" value="{{old('sks',@$data->sks)}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Semester</label>
                                <input class="form-control" required name="semester" type="number" value="{{old('sks',@$data->semester)}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-control-label">Status Mata Kuliah</label>
                                <select name="status" id="" class="form-control" required>
                                    <option value="aktif" {{ old('status', @$data->status == 'aktif' ? 'selected' : '')}}>Aktif</option>
                                    <option value="tidak aktif" {{ old('gender', @$data->status == 'tidak aktif' ? 'selected' : '')}}>Tidak Aktif</option>
                                </select>
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
