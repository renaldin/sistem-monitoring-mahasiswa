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
        <div class="card mb-5">
          <div class="card-header pb-0">
            <div class="d-flex align-items-center">
              <p class="mb-0">Detail Nilai</p>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
                <p class="font-weight-bold col">Nama Mata Kuliah</p>
                <p class="col">{{ $matkul->mataKuliah->nama_mata_kuliah }}</p>
            </div>
            <div class="row">
                <p class="font-weight-bold col">Kelas</p>
                <p class="col">{{ $matkul->kelas->nama_kelas }}</p>
            </div>
            <div class="row">
                <p class="font-weight-bold col">Semester</p>
                <p class="col">{{ $matkul->kelas->tahunAjaran->semester }}</p>
            </div>
          </div>
        </div>
        <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Kategori Nilai</p>
                {{-- <a href="{{ route('nilai.create.kategori', ['mata_kuliah' => $matkul->id]) }}" class="d-relative ms-auto btn btn-outline-primary btn-sm">Tambah</a> --}}
              </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0" id="example">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Judul Kategori</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kategori Nilai</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($kategori_nilai as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $item->judul_kategori }}</td>
                            <td>{{ $item->kategori_tugas }}</td>
                            <td>
                                <a href="{{ route('show.kelas.nilai', ['id_kelas' => $kelas->id , 'id_matkul' => $matkul->id, 'id_kategori' => $item->id]) }}"><i class='bx bx-sm text-info bx-search-alt'></i></a>
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
