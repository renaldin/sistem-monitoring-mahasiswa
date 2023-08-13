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
                  <p class="col">{{ $kelas->status }} </p>
              </div>
            </div>
          </div>
        <div class="card mb-5">
          <div class="card-header pb-0">
            <div class="d-flex align-items-center">
        
              <p class="mb-0">Jadwal {{ $jadwal->mataKuliahEnroll->mataKuliah->nama_mata_kuliah }} ({{ $jadwal->mataKuliahEnroll->mataKuliah->sks }} Sks)</p>
              <a  href="{{ route('rekap-kehadiran2.download-pdf',  ['id_kelas' => $kelas->id, 'id_matkul_enroll' => $jadwal->id_mata_kuliah_enroll]) }}" class="d-relative ms-auto btn btn-success btn-sm ml-auto">Export PDF</a>
            </div>
          </div>
          <input type="hidden" name="id_jadwal" id="hidden-id_jadwal" value="{{ $jadwal->id }}">
          <div class="card-body">
            <div class="row">
                <p class="font-weight-bold col">Nama Mata Kuliah</p>
                <p class="col">{{ $jadwal->mataKuliahEnroll->mataKuliah->nama_mata_kuliah }}</p>
            </div>
            <div class="row">
                <p class="font-weight-bold col">Program Studi</p>
                <p class="col">{{ $jadwal->mataKuliahEnroll->kelas->prodi->nama_prodi }}</p>
            </div>
            <div class="row">
                <p class="font-weight-bold col">Kelas</p>
                <p class="col">{{ $jadwal->mataKuliahEnroll->kelas->nama_kelas }}</p>
            </div>
            <div class="row">
                <p class="font-weight-bold col">Kode Mata Kuliah</p>
                <p class="col">{{ $jadwal->mataKuliahEnroll->mataKuliah->kode_mata_kuliah }}</p>
            </div>
            <div class="row">
                <p class="font-weight-bold col">Dosen Pengajar</p>
                <p class="col">{{ $jadwal->mataKuliahEnroll->dosen->name}}</p>
            </div>
            <div class="row">
                <p class="font-weight-bold col">Hari</p>
                <p class="col">{{ $jadwal->hari }}</p>
            </div>
            <div class="row">
                <p class="font-weight-bold col">Jam Mulai</p>
                <p class="col">{{ $jadwal->jam_mulai }}</p>
            </div>
            <div class="row">
                <p class="font-weight-bold col">Jam Selesai</p>
                <p class="col">{{ $jadwal->jam_selesai }}</p>
            </div>
          </div>
        </div>
        @if (Auth::user()->role->role_name !== 'admin jurusan')
        <div class="d-flex justify-content-end">
            <a href="{{ route('kehadiran.create', ['id_jadwal' => $jadwal->id]) }}" class="d-relative ms-auto btn btn-outline-primary btn-sm ml-auto">Tambah</a>
        </div>
        @endif
        @foreach ($kehadiran as $item)
        <div class="col-md-12 mb-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <h5 class="card-title">Pertemuan {{ $item->pertemuan }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $item->getHari() }}</h6>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $item->getTanggal() }}</h6>
                        <p class="card-text">{{ $item->deskripsi }}</p>
                    </div>
                    <div class="row">
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('rekap.kehadiran.detail', ['id_kelas' => $kelas->id, 'id_jadwal' => $jadwal->id, 'pertemuan' => $item->pertemuan]) }}" class="d-relative ms-auto btn btn-primary btn-sm ml-auto">Detail</a>
                          </div>
                    </div>
                </div>
              </div>
        </div>
        @endforeach
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

