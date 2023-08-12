@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                  <p class="mb-0">{{ !empty($data) ? 'Edit User' : 'Add User'}}</p>
                </div>
              </div>
              @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif
              <div class="card-body">
                <p class="text-uppercase text-sm">User Information</p>
                <div class="row">
                    <form action="{{ !empty($data) ? url('jadwal/'.@$data->id.'/update') : url('jadwal/store')}}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-control-label">Mata Kuliah</label>
                                <select name="id_mata_kuliah_enroll" id="" class="form-control">
                                    @foreach ($matkul_enroll as $item)
                                    <option value="{{ $item->id }}" {{ old('id_mata_kuliah', @$item->id == @$data->id_mata_kuliah_enroll ? 'selected' : '')}}>{{ $item->mataKuliah->kode_mata_kuliah }} - {{ $item->mataKuliah->nama_mata_kuliah }} - {{ $item->dosen->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-control-label">Hari</label>
                                <select name="hari" id="" class="form-control">
                                    <option value="senin" {{ old('hari', @$data->hari == 'senin' ? 'selected' : '') }}>Senin</option>
                                    <option value="selasa" {{ old('hari', @$data->hari == 'selasa' ? 'selected' : '') }}>Selasa</option>
                                    <option value="rabu" {{ old('hari', @$data->hari == 'rabu' ? 'selected' : '') }}>Rabu</option>
                                    <option value="kamis" {{ old('hari', @$data->hari == 'kamis' ? 'selected' : '') }}>Kamis</option>
                                    <option value="jumat" {{ old('hari', @$data->hari == 'jumat' ? 'selected' : '') }}>Jumat</option>
                                    <option value="sabtu" {{ old('hari', @$data->hari == 'sabtu' ? 'selected' : '') }}>Sabtu</option>
                                    <option value="minggu" {{ old('hari', @$data->hari == 'minggu' ? 'selected' : '') }}>Minggu</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Jam Mulai</label>
                                <input class="form-control" required name="jam_mulai" value="{{old('name',@$data->jam_mulai)}}" type="time">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Jam Selesai</label>
                                <input class="form-control" required name="jam_selesai" value="Z" type="time">
                            </div>
                        </div>
                        <input type="hidden" name="path" value="{{ url()->previous() }}">
                        <button type="submit" class="btn btn-outline-primary w-100 d-block btn-md">Submit</button>
                    </form>
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection
