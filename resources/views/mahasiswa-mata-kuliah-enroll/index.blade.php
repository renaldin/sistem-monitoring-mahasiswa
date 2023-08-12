@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex pb-0">
              <h6>Mata Kuliah table</h6>
            </div>
            <div class="card-body ">
              <div class="table-responsive">
                <table class="table align-items-center mb-0" id="example">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Mata Kuliah</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kelas</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dosen Pengajar</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Semester</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($mahasiswa_matkul_enroll as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $item->MataKuliahEnroll->mataKuliah->nama_mata_kuliah }}</td>
                        <td>{{ $item->MataKuliahEnroll->kelas->nama_kelas }}</td>
                        <td>{{ $item->MataKuliahEnroll->dosen->name }}</td>
                        <td>{{ $item->MataKuliahEnroll->kelas->tahunAjaran->semester }}</td>
                        <td>
                            <a href="{{ route('mahasiswa-mata-kuliah.show', ['mahasiswa_mata_kuliah' => $item->id]) }}"><i class='bx bx-sm text-info bx-detail'></i></a>
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
