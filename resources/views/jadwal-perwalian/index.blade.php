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
              @if(auth()->user()->role->role_name == 'dosen')
              <a href="{{ route('jadwal-perwalian.create') }}" class="d-relative ms-auto btn btn-outline-primary btn-sm">Tambah</a>
              @endif
            </div>
            <div class="card-body ">
              <div class="table-responsive">
                <table class="table table-custom align-items-center mb-0" id="example1">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Keterangan</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kelas</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($perwalian as $key => $item)
                      <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{ $item->keterangan }}</td>
                          <td>{{ $item->nama_kelas }}</td>
                          <td>{{ $item->tanggal }}</td>
                          <td style="display : flex;">
                            @if(auth()->user()->role->role_name == 'dosen')
                            <a href="{{ route('perwalian.list-perwalian', $item->id) }}"><i class='bx bx-sm text-info bx-detail'></i></a>
                            <a href="{{ route('jadwal-perwalian.edit', $item->id) }}"><i class='bx bx-sm text-info bx-edit'></i></a>
                            <a href="#" class="delete-btn" data-url="{{ route('jadwal-perwalian.delete', ['jadwal_perwalian' => $item->id]) }}"><i class='bx bx-sm bx-trash text-danger'></i></a>
                            @else
                              @if($array[$key] == 0)
                              <a href="{{ route('perwalian.create', ['jadwal_perwalian' => $item->id]) }}" class="btn btn-primary btn-sm">Buat Keluhan</a>
                              @else
                              <a href="{{ route('perwalian.show', ['jadwal_perwalian' => $item->id]) }}" class="btn btn-info btn-sm">Lihat Keluhan</a>
                              @endif
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

        $(document).on('click', '.delete-btn', function() {
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
