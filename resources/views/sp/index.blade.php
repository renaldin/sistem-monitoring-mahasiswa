@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      @if (Auth::user() && auth()->user()->id_role == '2')
        <div class="card mb-4">
            <div class="card-header d-flex pb-0">
              <h6>Rekomendasi Sp</h6>
            </div>
            <div class="card-body ">
              <div class="table-responsive">
                <table class="table align-items-center mb-0 example" id="example">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Terlambat</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rekomen SP</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($rekomendasi as $item)
                      @if($item['sum_terlambat'] >= 120)
                        @if($item['is_done'] == 0)
                          <tr>
                            <td>{{$item['mahasiswa']}}</td>
                            <td>{{$item['sum_terlambat']}}</td>
                            <td>{{$item['rekomen_sp']}}</td>
                            <td>
                              <a href="{{ route('sp.check-terlambat', $item['mahasiswa_id']) }}" class="btn btn-primary btn-sm">Cek Telat</a>
                              @if($item['is_done'] == 0)
                              <a href="{{ route('sp.kirim-peringatan', $item['mahasiswa_id']) }}" class="btn btn-info btn-sm">Kirim Peringatan</a>
                              @endif
                            </td>
                          </tr>
                        @endif
                      @endif
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
        </div>
      @endif

        <div class="card mb-4">
            <div class="card-header d-flex pb-0">
              <h6>Sp table</h6>
            </div>
            <div class="card-body ">
              <div class="table-responsive">
                <table class="table align-items-center mb-0 example" id="example">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Penerima</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama File</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Deskripsi</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis SP</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($sp as $item)
                    <tr>
                        <td>{{ $item->penerima->name }}</td>
                        <td>{{ $item->created_at->format('Y-m-d') }}</td>
                        <td>{{ $item->file }}</td>
                        <td>{{ $item->deskripsi }}</td>
                        <td>{{ $item->jenis_sp }}</td>
                        <td>
                            <a href="{{ asset(Storage::url('sp/'.$item->file)) }}" type="_blank"><i class="bx bx-sm bx-download"></i></a>
                            @if (Auth::user() && Auth::user()->id_role == 2)
                            <a href="{{ route('sp.edit', ['sp' => $item->id]) }}"><i class='bx bx-sm text-info bx-edit'></i></a>
                            <a href="#" class="delete-btn" data-url="{{ route('sp.delete', ['sp' => $item->id]) }}"><i class='bx bx-sm bx-trash text-danger'></i></a>
                             <a href="{{ route('sp.kirim') }}" class="btn btn-success" ><i class='bx bx-sm  text-danger'></i>Kirim</a>
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
        $('.example').DataTable();

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
