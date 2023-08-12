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
              <p class="mb-0">Mata Kuliah Detail</p>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
                <p class="font-weight-bold col">Nama Mata Kuliah</p>
                <p class="col">{{ $mahasiswa->mataKuliahEnroll->mataKuliah->nama_mata_kuliah }}</p>
            </div>
          </div>
        </div>
        <div class="card mb-5">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Daftar Absensi</p>
              </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0" id="example">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pertemuan</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Absensi</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Keterlambatan</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                            $total=0;
                        @endphp
                        @foreach ($absensi as $item)
                        <tr>
                            <td>{{ $item->pertemuan }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->terlambat }} Menit</td>
                        </tr>
                        @php
                            $total = $total + $item->terlambat;
                        @endphp
                        @endforeach
                      </tbody>
                      <td> <strong>Total Terlambat </strong></td>
                      <td> </td>
                      <td> </td>
                     
                      <td><strong>{{ $total }} Menit </strong></td>  
                    </table>
                  </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Daftar Nilai</p>
              </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0" id="example2">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kategori Nilai</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nilai</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($nilai as $item)
                        <tr>
                            <td>{{ $item->daftarNilai->judul_kategori }}</td>
                            <td>{{ $item->nilai }}</td>
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
        $('#example2').DataTable();
    });
</script>
@endsection

