@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex pb-0">
              <h6>Jadwal table</h6>
            </div>
            <div class="card-body ">
              <div class="row">
                @if(Auth::user()->role->role_name == 'admin jurusan')
                  @foreach ($jadwal as $key => $item)
                    <div class="card w-25 m-3 shadow-lg">
                      <div class="card-body text-center d-flex justify-content-center align-content-center flex-column">
                        <h5>{{$item->nama_kelas}}</h5>
                        <p>Semester : {{$item->tahunAjaran->semester}}</p>
                        {{-- <p>Mata Kuliah : {{ $item->mataKuliahEnroll }}</p> --}}
                        <p>Wali Kelas : {{$item->dosenWali->name}}</p>
                        <a href="{{ url('jadwal-new/'.$item->id) }}" class="btn btn-primary w-50 mx-auto">Detail</a>
                      </div>
                    </div>
                  @endforeach
                @else
                    <h5 class="">{{\Carbon\Carbon::now()->locale('id')->isoFormat('dddd')}}</h5>
                    <p>Jadwal Sedang Berlangsung</p>
                    <hr class="border-primary border-top" />
                    @php
                      $now = \Carbon\Carbon::now()->format('H:i');
                      $formatted = $now.':00';
                    @endphp
                    @foreach ($jadwal as $item)
                      @if($item->jam_mulai < $formatted && $item->jam_selesai > $formatted  && $item->hari == strtolower(\Carbon\Carbon::now()->locale('id')->isoFormat('dddd')))
                      <div class="card w-25 m-3 col-3 shadow-lg">
                        <div class="card-body text-center d-flex justify-content-center align-content-center flex-column">
                          <h5>{{$item->mataKuliahEnroll->kelas->nama_kelas}}</h5>
                          <p>Semester : {{$item->mataKuliahEnroll->kelas->tahunAjaran->semester}}</p>
                          <p>Mata Kuliah : {{ $item->mataKuliahEnroll->mataKuliah->nama_mata_kuliah }}</p>
                          <p>Wali Kelas : {{$item->mataKuliahEnroll->kelas->dosenWali->name}}</p>
                          <a href="{{ url('jadwal/'.$item->id) }}" class="btn btn-primary w-50 mx-auto">Detail</a>
                        </div>
                      </div>
                      @endif
                    @endforeach
                    <p>Sudah Terlewatkan</p>
                    <hr class="border-primary border-top" />
                    @foreach ($jadwal as $item)
                      @if($item->jam_selesai < $formatted && $item->hari == strtolower(\Carbon\Carbon::now()->locale('id')->isoFormat('dddd')))
                        <div class="card w-25 m-3 col-3 shadow-lg">
                          <div class="card-body text-center d-flex justify-content-center align-content-center flex-column">
                            <h5>{{$item->mataKuliahEnroll->kelas->nama_kelas}}</h5>
                            <p>Semester : {{$item->mataKuliahEnroll->kelas->tahunAjaran->semester}}</p>
                            <p>Mata Kuliah : {{ $item->mataKuliahEnroll->mataKuliah->nama_mata_kuliah }}</p>
                            <p>Wali Kelas : {{$item->mataKuliahEnroll->kelas->dosenWali->name}}</p>
                            {{-- <a href="{{ url('jadwal/'.$item->id) }}" class="btn btn-primary w-50 mx-auto">Detail</a> --}}
                          </div>
                        </div>
                      @endif
                    @endforeach
                    <p>Yang Akan Datang</p>
                    <hr class="border-primary border-top" />
                    @foreach ($jadwal as $item)
                      @if($item->jam_mulai > $formatted == strtolower(\Carbon\Carbon::now()->locale('id')->isoFormat('dddd')))
                        <div class="card w-25 m-3 col-3 shadow-lg">
                          <div class="card-body text-center d-flex justify-content-center align-content-center flex-column">
                            <h5>{{$item->mataKuliahEnroll->kelas->nama_kelas}}</h5>
                            <p>Semester : {{$item->mataKuliahEnroll->kelas->tahunAjaran->semester}}</p>
                            <p>Mata Kuliah : {{ $item->mataKuliahEnroll->mataKuliah->nama_mata_kuliah }}</p>
                            <p>Wali Kelas : {{$item->mataKuliahEnroll->kelas->dosenWali->name}}</p>
                            {{-- <a href="{{ url('jadwal/'.$item->id) }}" class="btn btn-primary w-50 mx-auto">Detail</a> --}}
                          </div>
                        </div>
                      @endif
                    @endforeach
                  @endif
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
