@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                  <p class="mb-0">{{ !empty($data) ? 'Edit Program Studi' : 'Add Program Studi'}}</p>
                </div>
              </div>
              <div class="card-body">
                <p class="text-uppercase text-sm">Program Studi Information</p>
                <div class="row">
                    <form action="{{ !empty($data) ? url('program-studi/'.@$data->id.'/update') : url('program-studi/store')}}" method="POST">
                        @method('POST')
                        @csrf
                        <div class="col">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Nama Prodi</label>
                                <input class="form-control" required name="nama_prodi" value="{{old('nama_prodi',@$data->nama_prodi)}}" type="text">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-control-label">Jurusan</label>
                                <select name="id_jurusan" id="" class="form-control" required>
                                    @foreach ($jurusan as $item)
                                    <option value="{{ $item->id }}" {{ old('id_jurusan', @$item->id == @$prodi->id_jurusan ? 'selected' : '')}}>{{ $item->nama_jurusan }}</option>
                                    @endforeach
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
