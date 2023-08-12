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
              @if (Auth::user()->role->role_name == 'admin jurusan')
              <a href="/mata-kuliah/create" class="d-relative ms-auto btn btn-outline-primary btn-sm">Tambah</a>
              @endif
            </div>
            <div class="card-body ">
              <div class="table-responsive">
                <table class="table align-items-center mb-0" id="example">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Mata Kuliah</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Semester</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Prodi</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jurusan</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode Matkul</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">SKS</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Mata Kuliah</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($mata_kuliah as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $item->nama_mata_kuliah }}</td>
                        <td>{{ $item->semester }}</td>
                        <td>{{ $item->prodi->nama_prodi }}</td>
                        <td>{{ $item->prodi->jurusan->nama_jurusan }}</td>
                        <td>{{ $item->kode_mata_kuliah }}</td>
                        <td>{{ $item->sks }}</td>
                        <td>{{ $item->status }}</td>
                        <td>
                            <a href="{{ route('mata-kuliah.show', ['mata_kuliah' => $item->id]) }}"><i class='bx bx-sm text-info bx-detail'></i></a>
                            @if (Auth::user()->role->role_name == 'admin jurusan')
                            <a href="{{ route('mata-kuliah.edit', ['mata_kuliah' => $item->id]) }}"><i class='bx bx-sm text-info bx-edit'></i></a>
                            <a href="#" class="deleteBtn" data-url="{{ route('mata-kuliah.delete', ['mata_kuliah' => $item->id]) }}"><i class='bx bx-sm bx-trash text-danger'></i></a>
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

        $(document).on('click', '.deleteBtn', function() {
            var deleteUrl = $(this).data('url');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this data!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = deleteUrl;
                }
            });
        });
    });
</script>
@endsection
