@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                  <p class="mb-0">{{ !empty($data) ? 'Edit Kelas' : 'Add Kelas'}}</p>
                </div>
              </div>
              <div class="card-body">
                <p class="text-uppercase text-sm">Kelas Information</p>
                <div class="row">
                    <form action="{{ !empty($data) ? url('kelas/'.@$data->id.'/update') : route('kelas.enroll.store', ['id' => $kelas->id])}}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-control-label">Mahasiswa</label>
                                <select name="id_mahasiswa" id="" class="form-control" required>
                                    @foreach ($list_mahasiswa as $item)
                                    <option value="{{ $item->id }}" {{ old('id_mahasiswa', @$item->id == @$mahasiswa->id_mahasiswa ? 'selected' : '')}}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- <div class="col">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Kode Kelas</label>
                                <input class="form-control" name="kode_kelas" value="{{old('kode_kelas',@$data->id_kelas)}}" type="text">
                            </div>
                        </div> --}}
                        <button type="submit" class="btn btn-outline-primary w-100 d-block btn-md">Submit</button>
                    </form>
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection
