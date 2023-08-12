@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                  <p class="mb-0">{{ !empty($data) ? 'Edit Keluhan' : 'Add Keluhan'}}</p>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                    <form action="" method="POST">
                        @method('POST')
                        @csrf

                        <div class="col">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Keterangan</label>
                                <input class="form-control" required name="keterangan"  type="text">{{old('keterangan',@$data->keterangan)}} />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Kelas</label>
                                <input class="form-control" required name="id_kelas"  type="text">{{old('id_kelas',@$data->id_kelas)}} />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Tanggal</label>
                                <input type="date" class="form-control" required name="tanggal"  type="text">{{old('tanggal',@$data->tanggal)}} />
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
