@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex pb-0">
              <h6>Kelas table</h6>
              {{-- <a href="/kelas/create" class="d-relative ms-auto btn btn-outline-primary btn-sm">Tambah</a> --}}
            </div>
            <div class="card-header">
              <div class="row">
            <form action="{{ route('rekap.filter') }}">
              <div  class="row"> 
            <div class="col-md-3">
                <label for="">Tahun Ajaran</label>
                <select type="text" name="tahun" class="form-control">
                  <option value=" ">Semua Tahun Ajaran</option>
                  @foreach($tahun_ajaran as $item)
                  <option value="{{ $item->tahun }}" @if($tahun == $item->tahun) selected @endif> {{ $item->tahun }}</option>
                  @endforeach
                </select>
            </div>
            <div class="col-md-3">
              <label for="">Semester</label>
              <select type="text" name="semester" class="form-control">
                <option value="">Semua Semester</option>
                <option value="1" @if($semester == "1") selected @endif>Semester 1</option>
                <option value="2" @if($semester == "2")  selected @endif>Semester 2</option>
                <option value="3" @if($semester == "3") selected @endif>Semester 3</option>
                <option value="4" @if($semester == "4") selected @endif>Semester 4</option>
                <option value="5" @if($semester == "5") selected @endif>Semester 5</option>
                <option value="6" @if($semester == "6") selected @endif>Semester 6</option>
              </select>
            </div>
            <div class="col-md-3">
              <label for="">Angkatan</label>
              <select type="text" name="angkatan" class="form-control">
                <option value="">Semua Angkatan</option>
                @foreach($angkatan as $item)
                <option value="{{ $item->angkatan }}"> {{ $item->angkatan }}</option>
                @endforeach
              </select>
          </div>
            <div class="col-md-3 mt-4">
              <button class="btn btn-primary">Filter</button>
              <a class="btn btn-warning" href="/rekap-kehadiran">Reset Filter</a>
            </div>
            
          </div>
          </form>
          </div>
        </div>
            <div class="card-body ">
              <div class="table-responsive">
                <table class="table align-items-center mb-0" id="example">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tahun Ajaran</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Semester</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Angkatan</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Kelas</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode Kelas</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dosen Wali</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Prodi</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Kelas</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($kelas as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td> {{ $item->tahunAjaran->tahun }}</td>
                        <td>{{ $item->tahunAjaran->semester }}</td>
                        <td>{{ $item->angkatan }}</td>
                        <td>{{ $item->nama_kelas }}</td>
                        <td>{{ $item->kode_kelas }}</td>
                        <td>{{ $item->dosenWali->name }}</td>
                        <td>{{ $item->prodi->nama_prodi }}</td>
                        <td>{{ $item->status }}</td>
                        <td>
                            <a href="{{ route('rekap.show', ['id' => $item->id]) }}"><i class='bx bx-sm text-info bx-detail'></i></a>
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
