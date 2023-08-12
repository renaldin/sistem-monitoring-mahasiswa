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
                {{-- <p class="text-uppercase text-sm">Program Studi Information</p> --}}
                <div class="row">
                    <form action="{{ !empty($data) ? route('perwalian.update', ['perwalian' => $data->id]) : route('perwalian.store', ['jadwal_perwalian' => $id_jadwal_perwalian])}}" method="POST">
                        @method('POST')
                        @csrf
                        @if (Auth::user()->role->role_name == 'mahasiswa')
                        <div class="col">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Keluhan</label>
                                <textarea class="form-control" required name="keluhan"  type="text">{{old('keluhan',@$data->keluhan)}}</textarea>
                            </div>
                        </div>
                        @elseif (Auth::user()->role->role_name == 'dosen')
                        <div class="col">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Balasan</label>
                                <textarea class="form-control" required name="balasan"  type="text">{{old('balasan',@$data->balasan)}}</textarea>
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
