@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                  <p class="mb-0">{{ !empty($data) ? 'Edit Jadwal Perwalian' : 'Add Jadwal Perwalian'}}</p>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                    <form action="{{ !empty($data) ? route('jadwal-perwalian.update', $data->id) : route('jadwal-perwalian.store')}}" method="POST">

                        @if(!empty($data))
                            @method('PUT')
                        @endif

                        @csrf

                        <div class="col">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Keterangan</label>
                                <input class="form-control" required name="keterangan"  type="text" value="{{old('keterangan',@$data->keterangan)}}" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Kelas</label>
                                <input type="hidden" name="id_kelas" value="{{ empty($data) ? $kelas->id : $data->id_kelas }}" readonly />
                                <input class="form-control" required type="text" value="{{ empty($data) ? $kelas->nama_kelas.' Semester '. $kelas->semester: @$data->nama_kelas.', Semester '.$data->semester }}" readonly />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Tanggal</label>
                                <input type="date" class="form-control" required name="tanggal" value="{{old('tanggal',@$data->tanggal)}}" />
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
