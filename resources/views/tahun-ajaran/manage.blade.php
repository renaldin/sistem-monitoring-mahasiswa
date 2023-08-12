@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                  <p class="mb-0">{{ !empty($data) ? 'Edit Tahun Ajaran' : 'Add Tahun Ajaran'}}</p>
                </div>
              </div>
              <div class="card-body">
                <p class="text-uppercase text-sm">Tahun Ajaran Information</p>
                <div class="row">
                    <form action="{{ !empty($data) ? url('tahun-ajaran/'.@$data->id.'/update') : url('tahun-ajaran/store')}}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="col">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">tahun</label>
                                <input class="form-control" required name="tahun" value="{{old('tahun',@$data->tahun)}}" type="number">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Semester</label>
                                <input class="form-control" required name="semester" value="{{old('semester',@$data->semester)}}" type="number">
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
