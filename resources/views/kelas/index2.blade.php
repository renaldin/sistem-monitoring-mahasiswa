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
                <p class="font-weight-bold col">Semester</p>
                <p class="col">{{ $kelas->tahunAjaran->semester  }}</p>
            </div>
            <div class="row">
                <p class="font-weight-bold col">Angkatan</p>
                <p class="col">{{ $kelas->angkatan  }}</p>
            </div>
            <div class="row">
                <p class="font-weight-bold col">Tahun Ajaran</p>
                <p class="col">Semester @if($kelas->tahunAjaran->semester % 2 === 1) Ganjil @else Genap @endif Tahun {{ $kelas->tahunAjaran->tahun }}</p>
            </div>
            <div class="row">
                <p class="font-weight-bold col">Dosen Wali</p>
                <p class="col">{{ $kelas->dosenWali->name  }}</p>
            </div>
            <div class="row">
                <p class="font-weight-bold col">Status Kelas</p>
                <p class="col">{{ $kelas->status }}</p>
            </div>
          </div>
        </div>
        <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Daftar Mata Kuliah</p>
              </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0" id="example">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Mata Kuliah</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode Mata Kuliah</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Semester</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dosen Pengajar</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Mata Kuliah</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($jadwal as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->mataKuliahEnroll->mataKuliah->nama_mata_kuliah }}</td>
                            <td>{{ $item->mataKuliahEnroll->mataKuliah->kode_mata_kuliah }}</td>
                            <td>{{ $item->mataKuliahEnroll->kelas->tahunAjaran->semester }}</td>
                            <td>{{ $item->mataKuliahEnroll->dosen->name }}</td>
                            <td>{{ $item->mataKuliahEnroll->mataKuliah->status }}</td>
                            <td>
                                <a href="{{ route('index.kelas.kehadiran', ['id_kelas' => $kelas->id, 'id_jadwal' => $item->id]) }}" class="btn btn-primary w-50 mx-auto">Kehadiran</a>
                                <a href="{{ route('index.kelas.nilai', ['id_kelas' => $kelas->id, 'id_matkul' => $item->mataKuliahEnroll->id]) }}" class="btn btn-success w-50 mx-auto">Nilai</a>
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
