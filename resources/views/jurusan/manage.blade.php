@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                  <p class="mb-0">{{ !empty($data) ? 'Edit Jurusan' : 'Add Jurusan'}}</p>
                </div>
              </div>
              <div class="card-body">
                <p class="text-uppercase text-sm">Jurusan Information</p>
                <div class="row">
                    <form action="{{ !empty($data) ? url('jurusan/'.@$data->id.'/update') : url('jurusan/store/')}}" method="POST">
                        @method('POST')
                        @csrf
                        <div class="col">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Name</label>
                                <input class="form-control" required name="nama_jurusan" value="{{old('nama_jurusan',@$data->nama_jurusan)}}" type="text">
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
