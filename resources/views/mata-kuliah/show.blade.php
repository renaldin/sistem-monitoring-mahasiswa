@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
        @endif
        <div class="card mb-5">
          <div class="card-header pb-0">
            <div class="d-flex align-items-center">
              <p class="mb-0">Mata Kuliah {{ $data->nama_mata_kuliah }}</p>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
                <p class="font-weight-bold col">Nama Mata Kuliah</p>
                <p class="col">{{ $data->nama_mata_kuliah }}</p>
            </div>
            <div class="row">
                <p class="font-weight-bold col">Program Studi</p>
                <p class="col">{{ $data->prodi->nama_prodi }}</p>
            </div>
            <div class="row">
                <p class="font-weight-bold col">Kode Mata Kuliah</p>
                <p class="col">{{ $data->kode_mata_kuliah }}</p>
            </div>
            <div class="row">
                <p class="font-weight-bold col">Sks</p>
                <p class="col">{{ $data->sks }}</p>
            </div>
          </div>
        </div>
        <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Kelas dengan Mata Kuliah {{ $data->nama_mata_kuliah }}</p>
                <a href="{{ route('mata-kuliah-enroll.create', ['id' => $data->id]) }}" class="d-relative ms-auto btn btn-outline-primary btn-sm">Tambah</a>
              </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0" id="example">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kelas</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode Kelas</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dosen</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($mata_kuliah_enroll as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $item->kelas->nama_kelas }}</td>
                            <td>{{ $item->kelas->kode_kelas }}</td>
                            <td>{{ $item->dosen->name }}</td>
                            <td>
                                <a href="{{ route('rekap.detail', ['id_kelas' => $item->kelas->id, 'id_mata_kuliah_enroll' => $item->id]) }}"><i class='bx bx-sm text-info bx-detail'></i></a>
                                @if (Auth::user()->role->role_name == 'admin jurusan')
                                <a href="{{ route('mata-kuliah-enroll.edit', ['id' => $data->id , 'mata_kuliah_enroll' => $item->id]) }}"><i class='bx bx-sm text-info bx-edit'></i></a>
                                <a href="{{ route('mata-kuliah-enroll.delete', ['id' => $data->id, 'mata_kuliah_enroll' => $item->id]) }}"><i class='bx bx-sm bx-trash text-danger'></i></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
            </div>
          </div>

    </div>
</div>


@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>
@endsection
