@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
@endsection

@section('content')
<input type="text" id="auths" value="{{ Auth::user()->role->role_name }}">
<div class="row">
    <div class="col-md-12">
        <div class="card mb-5">
          <div class="card-header pb-0">
            <div class="d-flex align-items-center">
              <p class="mb-0">Jadwal {{ $jadwal->mataKuliahEnroll->mataKuliah->nama_mata_kuliah }} ({{ $jadwal->mataKuliahEnroll->mataKuliah->sks }} Sks)</p>
              <a  href="{{ route('rekap-kehadiran.download-pdf',  ['id_kelas' => $kelas->id, 'id_jadwal' => $jadwal->id, 'pertemuan' => $kehadiran->pertemuan]) }}" class="d-relative ms-auto btn btn-success btn-sm ml-auto">Export PDF</a>
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
                            {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam Masuk</th> --}}
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Terlambat (Menit)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kehadiran_mahasiswa as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $item->mahasiswa->identity_number }}</td>
                                <td>{{ $item->mahasiswa->name }}</td>
                                <td>
                                    <input type="hidden" name="id_kehadiran[{{ $item->id }}]" value="{{ $item->id }}">
                                    <select name="status[{{ $item->id }}]" id="" class="status form-control">
                                        <option value="" disabled selected>Pilih Keterangan</option>
                                        <option value="hadir" {{ old('status', @$item->status == 'hadir' ? 'selected' : '') }}>Hadir</option>
                                        @if (Auth::user()->role->role_name == 'admin jurusan')
                                        <option value="sakit" {{ old('status', @$item->status == 'sakit' ? 'selected' : '') }}>Sakit</option>
                                        <option value="ijin" {{ old('status', @$item->status == 'ijin' ? 'selected' : '') }}>Ijin</option>
                                        @endif
                                        <option value="tanpa keterangan" {{ old('status', @$item->status == 'tanpa keterangan' ? 'selected' : '') }}>Tanpa Keterangan</option>
                                    </select>
                                </td>
                                {{-- <td>
                                    jam {{ $item->getJamMasukMahasiswa() }}
                                </td> --}}
                                <td>
                                    <input class="form-control" id="time-input" required name="terlambat[{{ $item->id }}]" value="{{old('terlambat',@$item->terlambat)}}" placeholder="Per menit" type="text">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <button type="submit" class="d-relative ms-auto mt-3 btn btn-primary btn-sm ">Submit</button>
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
        var auth = $("#auths").val();
        
        $('#example').DataTable();
        $('.status').on('change', function() {
            var inputField = $(this).closest('td').next().find('input');
            if(auth == "dosen")
            {
                if ($(this).val() === 'ijin' || $(this).val() === 'sakit' || $(this).val() === 'tanpa keterangan') {
                inputField.val(0);
                inputField.prop('disabled', true);
                } else {
                    inputField.prop('disabled', false);
                }
            }else{
                if ($(this).val() === 'ijin' || $(this).val() === 'sakit') {
                inputField.val(0);
                inputField.prop('disabled', true);
                } else {
                    inputField.prop('disabled', false);
                }
            }
          
        });

        // Ensure that the input fields are initialized correctly on page load
        $('.status').trigger('change');

        // Enable disabled input fields before form submission
        $('form').on('submit', function() {
            $('input:disabled').prop('disabled', false);
        });
    });
</script>
@endsection

