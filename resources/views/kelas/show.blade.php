@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card mb-5">
          <div class="card-header pb-0">
            <div class="d-flex align-items-center">
              <p class="mb-0">Kelas {{ $kelas->nama_kelas }}</p>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
                <p class="font-weight-bold col">Nama Kelas</p>
                <p class="col">{{ $kelas->nama_kelas }}</p>
            </div>
            <div class="row">
                <p class="font-weight-bold col">Kode Kelas</p>
                <p class="col">{{ $kelas->kode_kelas  }}</p>
            </div>
            <div class="row">
                <p class="font-weight-bold col">Dosen Wali</p>
                <p class="col">{{ $kelas->dosenWali->name  }}</p>
            </div>
            <div class="row">
                <p class="font-weight-bold col">Tahun Ajaran</p>
                <p class="col">Tahun {{ $kelas->tahunAjaran->tahun }} Semester {{ $kelas->tahunAjaran->semester }}</p>
            </div>
          </div>
        </div>
        <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">List Mahasiswa</p>
              </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0" id="example">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Mahasiswa</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nim</th>
                          {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th> --}}
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($mahasiswa as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $item->mahasiswa->name }}</td>
                            <td>{{ $item->mahasiswa->identity_number }}</td>
                            {{-- <td>
                                <a href="{{ route('mata-kuliah-enroll.edit', ['id' => $data->id , 'mata_kuliah_enroll' => $item->id]) }}"><i class='bx bx-sm text-info bx-edit'></i></a>
                                <a href="{{ route('mata-kuliah-enroll.delete', ['id' => $data->id, 'mata_kuliah_enroll' => $item->id]) }}"><i class='bx bx-sm bx-trash text-danger'></i></a>
                            </td> --}}
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
