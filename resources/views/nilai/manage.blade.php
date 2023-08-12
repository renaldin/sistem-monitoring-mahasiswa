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
                    <form action="{{ !empty($data) ? url('mata-kuliah/'.@$data->id.'/update') : route('nilai.store', ['mata_kuliah' => $matkul->id])}}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="col">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Judul Kategori</label>
                                <input class="form-control" required name="judul_kategori" value="{{old('judul_kategori',@$data->judul_kategori)}}" placeholder="Tugas 1 / Kuis 1" type="text">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-control-label">Kategori Nilai</label>
                                <select name="kategori_tugas" id="" class="form-control">
                                    {{-- <option value="tugas/kuis" {{ old('kategori_tugas', @$data->kategori_tugas == 'tugas/kuis' ? 'selected' : '') }}>tugas/kuis</option> --}}
                                    <option value="UTS" {{ old('kategori_tugas', @$data->kategori_tugas == 'UTS' ? 'selected' : '') }}>UTS</option>
                                    <option value="UAS" {{ old('kategori_tugas', @$data->kategori_tugas == 'UAS' ? 'selected' : '') }}>UAS</option>
                                    <option value="nilai lain lain" {{ old('kategori_tugas', @$data->kategori_tugas == 'nilai lain lain' ? 'selected' : '') }}>Nilai Lain-Lain</option>
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
