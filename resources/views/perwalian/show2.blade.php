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
            </div>
            <div class="card-body ">
              <div class="table-responsive">
                <table class="table table-custom align-items-center mb-0" id="example">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Mahasiswa</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Keluhan</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Balasan</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($perwalian as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $item->mahasiswa->name }}</td>
                        <td>{{ $item->getTanggal() }}</td>
                        <td>{{ $item->keluhan }}</td>
                        <td>{{ $item->balasan }}</td>
                        <td>
                            <a href="{{ route('perwalian.edit', ['kelas' => $item->kelas, 'perwalian' => $item->id]) }}"><i class='bx bx-sm text-info bx-edit'></i></a>
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
