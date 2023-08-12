@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex pb-0">
              <h6>Monitoring Kehadiran</h6>
            </div>
            <div class="card-body ">
              <div class="table-responsive">
                <table class="table align-items-center mb-0" id="example">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Mahasiswa</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mata Kuliah</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pertemuan</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Kehadiran</th>
                      @if($jenis_kehadiran == 'terlambat')
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Terlambat</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($kehadiran as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $item->mahasiswa }}</td>
                        <td>{{ $item->nama_mata_kuliah }}</td>
                        <td>{{ $item->pertemuan }}</td>
                        <td>{{ $item->status }}</td>
                        @if($jenis_kehadiran == 'terlambat')
                        <td>{{ $item->terlambat }}</td>
                        @endif
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
