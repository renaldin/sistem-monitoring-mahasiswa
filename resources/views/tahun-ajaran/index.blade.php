@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex pb-0">
              <h6>Tahun Ajaran table</h6>
              <a href="/tahun-ajaran/create" class="d-relative ms-auto btn btn-outline-primary btn-sm">Tambah</a>
            </div>
            <div class="card-body ">
              <div class="table-responsive">
                <table class="table align-items-center mb-0" id="example">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tahun</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Semester</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($tahun_ajaran as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $item->tahun }}</td>
                        <td>{{ $item->semester }}</td>
                        <td>
                            <a href="{{ route('tahun-ajaran.edit', ['tahun_ajaran' => $item->id]) }}"><i class='bx bx-sm text-info bx-edit'></i></a>
                            {{-- <a href="{{ route('tahun-ajaran.delete', ['tahun_ajaran' => $item->id]) }}"><i class='bx bx-sm bx-trash text-danger'></i></a> --}}
                            <a href="#" class="delete-btn" data-url="{{ route('tahun-ajaran.delete', ['tahun_ajaran' => $item->id]) }}"><i class='bx bx-sm bx-trash text-danger'></i></a>
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
