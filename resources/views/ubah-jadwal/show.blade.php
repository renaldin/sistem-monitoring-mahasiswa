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
              <p class="mb-0">Jadwal {{ $data->mataKuliahEnroll->mataKuliah->nama_mata_kuliah }} ({{ $data->mataKuliahEnroll->mataKuliah->sks }} Sks)</p>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
                <p class="font-weight-bold col">Nama Mata Kuliah</p>
                <p class="col">{{ $data->mataKuliahEnroll->mataKuliah->nama_mata_kuliah }}</p>
            </div>
            <div class="row">
                <p class="font-weight-bold col">Kelas</p>
                <p class="col">{{ $data->mataKuliahEnroll->kelas->nama_kelas }}</p>
            </div>
            <div class="row">
                <p class="font-weight-bold col">Kode Mata Kuliah</p>
                <p class="col">{{ $data->mataKuliahEnroll->mataKuliah->kode_mata_kuliah }}</p>
            </div>
            <div class="row">
                <p class="font-weight-bold col">Dosen Pengajar</p>
                <p class="col">{{ $data->mataKuliahEnroll->dosen->name}}</p>
            </div>
            <div class="row">
                <p class="font-weight-bold col">Hari</p>
                <p class="col">{{ $data->hari }}</p>
            </div>
            <div class="row">
                <p class="font-weight-bold col">Jam Mulai</p>
                <p class="col">{{ $data->jam_mulai }}</p>
            </div>
            <div class="row">
                <p class="font-weight-bold col">Jam Selesai</p>
                <p class="col">{{ $data->jam_selesai }}</p>
            </div>
          </div>
        </div>
        <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Mahasiswa Kelas {{ $data->mataKuliahEnroll->kelas->nama_kelas }}</p>
                {{-- <a href="{{ route('mata-kuliah-enroll.create', ['id' => $data->id]) }}" class="d-relative ms-auto btn btn-outline-primary btn-sm">Tambah</a> --}}
              </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0" id="example">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Mahasiswa</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nomor Identitas</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($mahasiswa as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $item->mahasiswa->name }}</td>
                            <td>{{ $item->mahasiswa->identity_number }}</td>
                            <td>
                                <a href="{{ route('kehadiran.show', ['id' => $data->id,'id_kelas_enroll' => $item->id]) }}"><button class="btn btn-info">Lihat Kehadiran</button></a>
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

