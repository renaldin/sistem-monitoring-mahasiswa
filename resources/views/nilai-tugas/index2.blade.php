@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card mb-5">
          <div class="card-header pb-0">
            <div class="d-flex align-items-center">
              <p class="mb-0">Detail Nilai</p>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
                <p class="font-weight-bold col">Nama Mata Kuliah</p>
                <p class="col">{{ $matkul->mataKuliah->nama_mata_kuliah }}</p>
            </div>
            <div class="row">
                <p class="font-weight-bold col">Judul Nilai</p>
                <p class="col">{{ $daftar_nilai->judul_kategori }}</p>
            </div>
            <div class="row">
                <p class="font-weight-bold col">Kategori</p>
                <p class="col">{{ $daftar_nilai->kategori_tugas }}</p>
            </div>
          </div>
        </div>
        <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Mahasiswa</p>
                {{-- <a href="{{ route('nilai.create.nilai', ['mata_kuliah' => $matkul->id , 'nilai' => $daftar_nilai->id]) }}" class="d-relative ms-auto btn btn-outline-primary btn-sm">Tambah</a> --}}
              </div>
            </div>
            <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0" id="example">
                          <thead>
                            <tr>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NIM</th>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Mahasiswa</th>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nilai</th>
                              {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th> --}}
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($nilai as $key => $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $item->mahasiswa->identity_number }}</td>
                                <td>{{ $item->mahasiswa->name }}</td>
                                <td>
                                  <input type="text" name="{{$item->id_daftar_nilai}}" placeholder="0 - 100" class="nilai-{{$item->id}}" id="{{$item->id}}" value="{{ $item->nilai }}"/>
                                  <input type="hidden" name="" class="id-nilai-${{$item->id}}" value="{{$item->id}}"/>
                                </td>
                                {{-- <td>
                                    <a href="{{ route('nilai.edit.nilai', ['mata_kuliah' => $matkul->id , 'nilai' => $daftar_nilai->id, 'id' => $item->id]) }}"><i class='bx bx-sm text-info bx-edit'></i></a>
                                    <a href="{{ route('nilai.delete.nilai', ['mata_kuliah' => $matkul->id , 'nilai' => $daftar_nilai->id, 'id' => $item->id]) }}"><i class='bx bx-sm bx-trash text-danger'></i></a>
                                </td> --}}
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                      <button class="w-100 mt-3 btn-sbmt btn btn-outline-primary">Masukan Nilai</button>
            </div>
          </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable();

        var values = [];
        $('.btn-sbmt').click(() => {
          var id_nilai = '';
          $('[class^="nilai-"]').each(function() {
            var value = $(this).val();
            var id = $(this).attr('id');
            id_daftar_nilai = $(this).attr('name');
            // values.push({id:id,value:value});
            if (value <= 100) {
              values.push({ id: id, value: value });
            } else {
              // Handle validation error
              Swal.fire(
                'Error!',
                'Maksimal nilai 100',
                'error'
              )
              values = [];
              return false; // Stop the loop
            }
          });

          var csrfToken = $('meta[name="csrf-token"]').attr('content');
          var url = '/nilai/update-all';

          $.ajax({
              url: url,
              method: 'POST',
              data: {
                nilai: values,
                id_daftar_nilai: id_nilai,
              },
              headers: {
                  'X-CSRF-TOKEN': csrfToken,
              },
              success: function(response) {
                  Swal.fire(
                    'Success!',
                    response.message,
                    'success'
                  ).then(() => {
                    location.reload();
                  })
              },
              error: function(xhr, status, error) {
                  console.log(error);
              }
          });
        });
    });
</script>
@endsection

