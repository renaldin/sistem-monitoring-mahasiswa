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
                <p class="mb-0">Detail kelas</p>
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
              <p class="mb-0">Jadwal {{ $jadwal->mataKuliahEnroll->mataKuliah->nama_mata_kuliah }} ({{ $jadwal->mataKuliahEnroll->mataKuliah->sks }} Sks)</p>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
                <p class="font-w eight-bold col">Pertemuan</p>
                <p class="col">{{ $kehadiran->pertemuan }}</p>
            </div>
            <div class="row">
                <p class="font-w eight-bold col">Hari</p>
                <p class="col">{{ $kehadiran->getHari() }}</p>
            </div>
            <div class="row">
                <p class="font-w eight-bold col">Tanggal</p>
                <p class="col">{{ $kehadiran->getTanggal() }}</p>
            </div>
            <div class="row">
                <p class="font-w eight-bold col">Deskripsi</p>
                <p class="col">{{ $kehadiran->deskripsi }}</p>
            </div>
          </div>
        </div>
        <form action="{{ route('kehadiran.update', ['id_jadwal' => $jadwal->id, 'pertemuan' => $kehadiran->pertemuan]) }}" method="post">
            @method('post')
            @csrf
            <div class="card">
                <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                    <p class="mb-0">kehadiran Mahasiswa</p>
                    {{-- <a href="{{ route('kehadiran.create', ['id' => $jadwal_matkul->id, 'id_kelas_enroll' => $mahasiswa->id]) }}" class="d-relative ms-auto btn btn-outline-primary btn-sm">Tambah</a> --}}
                </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0" id="example">
                        <thead>
                            <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nim</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">keterangan</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Terlambat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kehadiran_mahasiswa as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $item->mahasiswa->identity_number }}</td>
                                <td>{{ $item->mahasiswa->name }}</td>
                                <td>
                                    {{ $item->status }}
                                </td>
                                <td>
                                    @if ($item->terlambat != 0)
                                    {{ $item->terlambat }} Menit
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                {{-- <button type="submit" class="d-relative ms-auto mt-3 btn btn-primary btn-sm ">Absen</button> --}}
            </div>
        </form>
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

