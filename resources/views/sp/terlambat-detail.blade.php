@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex pb-0">
              <h6>Terlambat Detail</h6>
            </div>
            <div class="card-body ">
              <div class="table-responsive">
                <table class="table align-items-center mb-0 example" id="example">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mata Kuliah</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pertemuan</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Terlambat</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($terlambat as $item)
                        <tr>
                          <td>{{$item->mahasiswa}}</td>
                          <td>{{$item->nama_mata_kuliah}}</td>
                          <td>{{$item->pertemuan}}</td>
                          <td>{{$item->terlambat}}</td>
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
