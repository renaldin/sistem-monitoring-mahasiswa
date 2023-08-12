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
                      <th style="white-space:break-spaces!important" class="w-50 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Keluhan</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Balasan</th>
                      <th width="200px" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($perwalian as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $item->created_at->format('Y-m-d') }}</td>
                        <td style="width: 200px">{{ $item->keluhan }}</td>
                        <td>{{ $item->balasan }}</td>
                        <td class="text-center">
                          <a href="{{ route('perwalian.edit', ['perwalian' => $item->id]) }}"><i class='bx bx-sm text-info bx-edit'></i></a>
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
