@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        {{-- @foreach ($perwalian as $item) --}}
        <div class="card mb-4">
            <div class="card-header d-flex pb-0">
              <h6>Perwalian table</h6>
              @if (Auth::user()->role->role_name == 'mahasiswa')
              <a href="{{ route('perwalian.create', ['kelas' => $id_kelas]) }}" class="d-relative ms-auto btn btn-outline-primary btn-sm">Tambah</a>
              @endif
            </div>
            <div class="card-body ">
              <div class="table-responsive">
                <table class="table table-custom align-items-center mb-0" id="example1">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NIM</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mahasiswa</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($perwalian as $key => $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $item[0]->mahasiswa->identity_number }}</td>
                        <td>{{ $key }}</td>
                        <td class="text-center">
                            <a href="{{ route('perwalian.showNew', ['kelas' => $item[0]->kelas->id, 'mahasiswa' => $item[0]->mahasiswa->id]) }}"><i class='bx bx-sm text-info bx-edit'></i></a>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        {{-- @endforeach --}}
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
