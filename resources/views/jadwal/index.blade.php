@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Kelas {{ $kelas->nama_kelas }}</p>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                  <p class="font-weight-bold col">Nama Kelas</p>
                  <p class="col">{{ $kelas->nama_kelas }}</p>
              </div>
              <div class="row">
                  <p class="font-weight-bold col">Kode Kelas</p>
                  <p class="col">{{ $kelas->kode_kelas  }}</p>
              </div>
              <div class="row">
                  <p class="font-weight-bold col">Semester</p>
                  <p class="col">{{ $kelas->tahunAjaran->semester  }}</p>
              </div>
              <div class="row">
                  <p class="font-weight-bold col">Angkatan</p>
                  <p class="col">{{ $kelas->angkatan  }}</p>
              </div>
              <div class="row">
                  <p class="font-weight-bold col">Tahun Ajaran</p>
                  <p class="col">Semester @if($kelas->tahunAjaran->semester % 2 === 1) Ganjil @else Genap @endif Tahun {{ $kelas->tahunAjaran->tahun }}</p>
              </div>
              <div class="row">
                  <p class="font-weight-bold col">Dosen Wali</p>
                  <p class="col">{{ $kelas->dosenWali->name  }}</p>
              </div>
              <div class="row">
                  <p class="font-weight-bold col">Status Kelas</p>
                  <p class="col">{{ $kelas->status }}</p>
              </div>
            </div>
          </div>
        <div class="card mb-4">
            <div class="card-header d-flex pb-0">
              <h6>Jadwal table</h6>
              <a href="{{ route('jadwal.create', ['id_kelas' => $kelas->id]) }}" class="d-relative ms-auto btn btn-outline-primary btn-sm">Tambah</a>
            </div>
            <div class="card-body ">
              <h6>Senin</h6>
              <div class="table-responsive">
                <table class="table align-items-center mb-0 example" id="example">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mata Kuliah</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Dosen</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hari</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam Mulai</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam Selesai</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($jadwal as $key => $item)
                      @if($item->hari == 'senin')
                      <tr>
                          <td>{{ $item->mataKuliahEnroll->mataKuliah->nama_mata_kuliah }}</td>
                          <td>{{ $item->mataKuliahEnroll->mataKuliah->kode_mata_kuliah }}</td>
                          <td>{{ $item->mataKuliahEnroll->dosen->name }}</td>
                          <td>{{ $item->hari }}</td>
                          <td>{{ $item->jam_mulai }}</td>
                          <td>{{ $item->jam_selesai }}</td>
                          <td>
                              <a href="{{ route('jadwal.show', ['jadwal' => $item->id]) }}"><i class='bx bx-sm text-info bx-detail'></i></a>
                              <a href="{{ route('jadwal.edit', ['jadwal' => $item->id, 'id_kelas' => $kelas->id]) }}"><i class='bx bx-sm text-info bx-edit'></i></a>
                              @if (Auth::user()->role->role_name == 'dosen')
                              <a href="{{ route('jadwal.delete', ['jadwal' => $item->id]) }}"><i class='bx bx-sm bx-trash text-danger'></i></a>
                              @endif
                          </td>
                      </tr>
                      @endif
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-body ">
              <h6>Selasa</h6>
              <div class="table-responsive">
                <table class="table align-items-center mb-0 example" id="example">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mata Kuliah</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Dosen</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hari</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam Mulai</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam Selesai</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($jadwal as $item)
                      @if($item->hari == 'selasa')
                      <tr>
                          <td>{{ $item->mataKuliahEnroll->mataKuliah->nama_mata_kuliah }}</td>
                          <td>{{ $item->mataKuliahEnroll->mataKuliah->kode_mata_kuliah }}</td>
                          <td>{{ $item->mataKuliahEnroll->dosen->name }}</td>
                          <td>{{ $item->hari }}</td>
                          <td>{{ $item->jam_mulai }}</td>
                          <td>{{ $item->jam_selesai }}</td>
                          <td>
                              <a href="{{ route('jadwal.show', ['jadwal' => $item->id]) }}"><i class='bx bx-sm text-info bx-detail'></i></a>
                              <a href="{{ route('jadwal.edit', ['jadwal' => $item->id, 'id_kelas' => $kelas->id]) }}"><i class='bx bx-sm text-info bx-edit'></i></a>
                              @if (Auth::user()->role->role_name == 'dosen')
                              <a href="{{ route('jadwal.delete', ['jadwal' => $item->id]) }}"><i class='bx bx-sm bx-trash text-danger'></i></a>
                              @endif
                          </td>
                      </tr>
                      @endif
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-body ">
              <h6>Rabu</h6>
              <div class="table-responsive">
                <table class="table align-items-center mb-0 example" id="example">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mata Kuliah</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Dosen</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hari</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam Mulai</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam Selesai</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($jadwal as $item)
                      @if($item->hari == 'rabu')
                      <tr>
                          <td>{{ $item->mataKuliahEnroll->mataKuliah->nama_mata_kuliah }}</td>
                          <td>{{ $item->mataKuliahEnroll->mataKuliah->kode_mata_kuliah }}</td>
                          <td>{{ $item->mataKuliahEnroll->dosen->name }}</td>
                          <td>{{ $item->hari }}</td>
                          <td>{{ $item->jam_mulai }}</td>
                          <td>{{ $item->jam_selesai }}</td>
                          <td>
                              <a href="{{ route('jadwal.show', ['jadwal' => $item->id]) }}"><i class='bx bx-sm text-info bx-detail'></i></a>
                              <a href="{{ route('jadwal.edit', ['jadwal' => $item->id, 'id_kelas' => $kelas->id]) }}"><i class='bx bx-sm text-info bx-edit'></i></a>
                              @if (Auth::user()->role->role_name == 'dosen')
                              <a href="{{ route('jadwal.delete', ['jadwal' => $item->id]) }}"><i class='bx bx-sm bx-trash text-danger'></i></a>
                              @endif
                          </td>
                      </tr>
                      @endif
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-body ">
              <h6>Kamis</h6>
              <div class="table-responsive">
                <table class="table align-items-center mb-0 example" id="example">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mata Kuliah</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Dosen</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hari</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam Mulai</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam Selesai</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($jadwal as $item)
                      @if($item->hari == 'kamis')
                      <tr>
                          <td>{{ $item->mataKuliahEnroll->mataKuliah->nama_mata_kuliah }}</td>
                          <td>{{ $item->mataKuliahEnroll->mataKuliah->kode_mata_kuliah }}</td>
                          <td>{{ $item->mataKuliahEnroll->dosen->name }}</td>
                          <td>{{ $item->hari }}</td>
                          <td>{{ $item->jam_mulai }}</td>
                          <td>{{ $item->jam_selesai }}</td>
                          <td>
                              <a href="{{ route('jadwal.show', ['jadwal' => $item->id]) }}"><i class='bx bx-sm text-info bx-detail'></i></a>
                              <a href="{{ route('jadwal.edit', ['jadwal' => $item->id, 'id_kelas' => $kelas->id]) }}"><i class='bx bx-sm text-info bx-edit'></i></a>
                              @if (Auth::user()->role->role_name == 'dosen')
                              <a href="{{ route('jadwal.delete', ['jadwal' => $item->id]) }}"><i class='bx bx-sm bx-trash text-danger'></i></a>
                              @endif
                          </td>
                      </tr>
                      @endif
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-body ">
              <h6>Jumat</h6>
              <div class="table-responsive">
                <table class="table align-items-center mb-0 example" id="example">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mata Kuliah</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Dosen</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hari</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam Mulai</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam Selesai</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($jadwal as $item)
                      @if($item->hari == 'jumat')
                      <tr>
                          <td>{{ $item->mataKuliahEnroll->mataKuliah->nama_mata_kuliah }}</td>
                          <td>{{ $item->mataKuliahEnroll->mataKuliah->kode_mata_kuliah }}</td>
                          <td>{{ $item->mataKuliahEnroll->dosen->name }}</td>
                          <td>{{ $item->hari }}</td>
                          <td>{{ $item->jam_mulai }}</td>
                          <td>{{ $item->jam_selesai }}</td>
                          <td>
                              <a href="{{ route('jadwal.show', ['jadwal' => $item->id]) }}"><i class='bx bx-sm text-info bx-detail'></i></a>
                              <a href="{{ route('jadwal.edit', ['jadwal' => $item->id, 'id_kelas' => $kelas->id]) }}"><i class='bx bx-sm text-info bx-edit'></i></a>
                              @if (Auth::user()->role->role_name == 'dosen')
                              <a href="{{ route('jadwal.delete', ['jadwal' => $item->id]) }}"><i class='bx bx-sm bx-trash text-danger'></i></a>
                              @endif
                          </td>
                      </tr>
                      @endif
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-body ">
              <h6>Sabtu</h6>
              <div class="table-responsive">
                <table class="table align-items-center mb-0 example" id="example">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mata Kuliah</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Dosen</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hari</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam Mulai</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam Selesai</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($jadwal as $item)
                      @if($item->hari == 'sabtu')
                      <tr>
                          <td>{{ $item->mataKuliahEnroll->mataKuliah->nama_mata_kuliah }}</td>
                          <td>{{ $item->mataKuliahEnroll->mataKuliah->kode_mata_kuliah }}</td>
                          <td>{{ $item->mataKuliahEnroll->dosen->name }}</td>
                          <td>{{ $item->hari }}</td>
                          <td>{{ $item->jam_mulai }}</td>
                          <td>{{ $item->jam_selesai }}</td>
                          <td>
                              <a href="{{ url('jadwal/'.$item->id) }}"><i class='bx bx-sm text-info bx-edit'></i></a>
                          </td>
                      </tr>
                      @endif
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-body ">
              <h6>Minggu</h6>
              <div class="table-responsive">
                <table class="table align-items-center mb-0 example" id="example">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mata Kuliah</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Dosen</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hari</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam Mulai</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam Selesai</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($jadwal as $item)
                      @if($item->hari == 'minggu')
                      <tr>
                          <td>{{ $item->mataKuliahEnroll->mataKuliah->nama_mata_kuliah }}</td>
                          <td>{{ $item->mataKuliahEnroll->mataKuliah->kode_mata_kuliah }}</td>
                          <td>{{ $item->mataKuliahEnroll->dosen->name }}</td>
                          <td>{{ $item->hari }}</td>
                          <td>{{ $item->jam_mulai }}</td>
                          <td>{{ $item->jam_selesai }}</td>
                          <td>
                              <a href="{{ url('jadwal/'.$item->id) }}"><i class='bx bx-sm text-info bx-edit'></i></a>
                          </td>
                      </tr>
                      @endif
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
    });
</script>
@endsection
