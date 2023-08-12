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
                <table class="table table-custom align-items-center mb-0" id="example1">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mahasiswa</th>
                      <th style="white-space:break-spaces!important" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Keluhan</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Balasan</th>
                      <th width="20%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($perwalian as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->name }}</td>
                        <td style="width: 200px">{{ $item->keluhan }}</td>
                        <td>{{ $item->balasan }}</td>
                        <td style="display : flex; justify-content : center">
                          @if($item->balasan == '')
                          <a href="{{ route('perwalian.create-balasan', ['perwalian' => $item->id]) }}" class="btn btn-primary btn-sm">Balas</a>
                          @else
                          <a href="{{ route('perwalian.edit-balasan', ['perwalian' => $item->id]) }}" class="btn btn-info btn-sm">Edit Balasan</a>
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
    $('#example').dataTable( {
      "columns": [
        null,
        null,
        { "width": "100px" },
        null,
        null
      ]
    } );
</script>
@endsection
