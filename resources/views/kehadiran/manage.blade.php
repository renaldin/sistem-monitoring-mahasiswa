@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                  <p class="mb-0">{{ !empty($data) ? 'Edit Kehadiran' : 'Add Kehadiran'}}</p>
                </div>
              </div>
              @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif
              <div class="card-body">
                <div class="row">
                    <form action="{{ !empty($pertemuan_kelas) ? route('kehadiran.pertemuan.update', ['id_jadwal' => $id_jadwal, 'pertemuan' => $pertemuan_kelas->pertemuan]) : route('kehadiran.store', ['id_jadwal' => $id_jadwal]) }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-control-label">Pertemuan</label>
                                <select name="pertemuan" id="" class="form-control">
                                    @foreach ($pertemuans as $item)
                                    <option value="{{ $item }}" {{ old('pertemuan', @$item == @$pertemuan_kelas->pertemuan ? 'selected' : '')}}>Pertemuan {{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Tanggal</label>
                                <input class="form-control" required name="tanggal" value="{{ old('tanggal', @$pertemuan_kelas->tanggal) }}" type="date">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Deskripsi</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="deskripsi" rows="3">{{ old('tanggal', @$pertemuan_kelas->deskripsi) }}</textarea>
                            </div>
                        </div>
                        {{-- <div class="col">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Tanggal</label>
                                <input class="form-control" name="tanggal" value="{{old('tanggal',@$data->tanggal)}}" type="date">
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
