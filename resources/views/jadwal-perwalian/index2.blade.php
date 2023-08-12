@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex pb-0">
              <h6>Perwalian table</h6>
              {{-- <a href="/perwalian/create" class="d-relative ms-auto btn btn-outline-primary btn-sm">Tambah</a> --}}
            </div>
            <div class="card-body ">
              <div class="table-responsive">
                <table class="table align-items-center mb-0" id="example">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode Kelas</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kelas</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Semester</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Angkatan</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($perwalian as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ Auth::user()->role->role_name == 'dosen' ? $item->kode_kelas :  $item->kelas->kode_kelas}}</td>
                        <td>{{ Auth::user()->role->role_name == 'dosen' ? $item->nama_kelas :  $item->kelas->nama_kelas}}</td>
                        <td>{{ Auth::user()->role->role_name == 'dosen' ? $item->nama_kelas :  $item->kelas->tahunAjaran->semester}}</td>
                        <td>{{ Auth::user()->role->role_name == 'dosen' ? $item->nama_kelas :  $item->kelas->angkatan}}</td>
                        
                        <td>
                            @if($item->kelas->status == "aktif")
                            <a href="{{ Auth::user()->role->role_name == 'mahasiswa' ? route('perwalian.show', ['kelas' => $item->id_kelas]) : route('perwalian.show', ['kelas' => $item->id]) }}"><i class='bx bx-sm text-info bx-detail'></i></a>
                            @endif
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
