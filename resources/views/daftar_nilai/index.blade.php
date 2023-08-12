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
              <p class="mb-0">Transkrip Nilai</p>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-6">
                <div class="d-flex justify-content-between">
                  <p class="font-weight-bold">NIM</p>
                  <p class="">{{ $mahasiswa->identity_number }}</p>
                </div>
                <div class="d-flex justify-content-between">
                  <p class="font-weight-bold">Nama Mahasiswa</p>
                  <p class="">{{ $mahasiswa->name }}</p>
                </div>
                <div class="d-flex justify-content-between">
                  <p class="font-weight-bold">{{request()->path() == 'daftar-nilai' ? 'IPK' : 'IPS'}}</p>
                  <p class="" id="ips">{{ $ips }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                {{-- <p class="mb-0">Kelas dengan Mata Kuliah </p> --}}
              </div>
            </div>
            <div class="card-body">
                @if(request()->path() != 'daftar-nilai')
                <div class="col-3">
                  <div class="form-group">
                    <label for="" class="form-control-label">Semester</label>
                    <select name="semester" id="semester" class="form-control" required>
                        <option value="1">Semester 1</option>
                        <option value="2">Semester 2</option>
                        <option value="3">Semester 3</option>
                        <option value="4">Semester 4</option>
                        <option value="5">Semester 5</option>
                        <option value="6">Semester 6</option>
                    </select>
                  </div>
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table align-items-center mb-0" id="example">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode Mata Kuliah</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Mata Kuliah</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Semester</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nilai Akhir</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nilai Mutu</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Grade</th>
                          {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th> --}}
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item['kodeMataKuliah']}}</td>
                            <td>{{$item['namaMataKuliah']}}</td>
                            <td>{{$item['semester']}}</td>
                            <td>{{$item['nilaiAngkaNilaiTotal']}}</td>
                            <td>{{$item['nilaiAngka']}}</td>
                            <td>{{$item['nilaiRataRata']}}</td>
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
        if(window.location.pathname != 'daftar-nilai'){
          $('#semester').change(() => {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
              // Make an AJAX request to retrieve updated data
              $.ajax({
              url: 'daftar-nilai-semester',
              method: 'GET',
              data:{
                semester:$('#semester').val()
              },
              headers: {
                  'X-CSRF-TOKEN': csrfToken,
              },
              success: function(response) {
                  $('#example').DataTable().clear();

                  var newRowData = []
                  if(response.data.length > 0){
                      response.data.map((value,index) => {
                          // console.log(value);
                          newRowData.push(
                              index+1,
                              value.kodeMataKuliah,
                              value.namaMataKuliah,
                              value.semester,
                              value.nilaiAngkaNilaiTotal,
                              value.nilaiAngka,
                              value.nilaiRataRata
                          )
                          $('#example').DataTable().row.add(newRowData).draw();
                          $('#ips').text(response.ips);
                          newRowData = [];
                      })
                  }else{
                      $('#example').DataTable().clear().draw();
                  }
              },
              error: function(xhr, status, error) {
                  // Handle the error if necessary
              }
              });
          });
        }
    });
</script>
@endsection
