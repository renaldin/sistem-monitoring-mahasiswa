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
            </div>
            <div class="card-header">
              <div class="row">
            <form action="{{ route('filter-rekap-laporan-kehadiran') }}" method="POST">
                @csrf
                <div  class="row"> 
                    <div class="col-md-3">
                        <label for="">Kelas</label>
                        <select type="text" name="kelas" class="form-control" required>
                            <option value="">Pilih Kelas</option>
                            @foreach($kelas as $row)
                            <option value="{{ $row->id }}" {{ $val_kelas == $row->id ? 'selected' : '' }}>{{ $row->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="">Mata Kuliah</label>
                        <select type="text" name="matkul" class="form-control" required>
                            <option value="">Pilih Mata Kuliah</option>
                            @foreach($matkul as $row)
                            <option value="{{ $row->id }}" {{ $val_matkul == $row->id ? 'selected' : '' }}>{{ $row->nama_mata_kuliah }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mt-4">
                        <button class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
          </div>
        </div>
            <div class="card-body ">
              <div class="table-responsive">
                <table id="table-rekap-laporan" class="w-100" border="1">
                  <thead>
                    <tr>
                      <th width="200px" rowspan="2" class="text-uppercase text-sm font-weight-bolder text-center">Nama</th>
                      <th width="100px" rowspan="2" class="text-uppercase text-sm font-weight-bolder text-center">NIM</th>
                      <th colspan="16" class="text-uppercase text-sm font-weight-bolder text-center">Pertemuan</th>
                      <th colspan="3" class="text-uppercase text-sm font-weight-bolder text-center">Keterangan</th>
                      <th width="60px" rowspan="2" class="text-uppercase text-sm font-weight-bolder text-center">Jumlah Tidak Hadir</th>
                      <th width="60px" rowspan="2" class="text-uppercase text-sm font-weight-bolder text-center">Jumlah Hadir</th>
                      <th width="60px" rowspan="2" class="text-uppercase text-sm font-weight-bolder text-center">Presentasi</th>
                    </tr>
                    <tr>
                      <th width="10px" class="text-uppercase text-sm font-weight-bolder text-center">1</th>
                      <th width="10px" class="text-uppercase text-sm font-weight-bolder text-center">2</th>
                      <th width="10px" class="text-uppercase text-sm font-weight-bolder text-center">3</th>
                      <th width="10px" class="text-uppercase text-sm font-weight-bolder text-center">4</th>
                      <th width="10px" class="text-uppercase text-sm font-weight-bolder text-center">5</th>
                      <th width="10px" class="text-uppercase text-sm font-weight-bolder text-center">6</th>
                      <th width="10px" class="text-uppercase text-sm font-weight-bolder text-center">7</th>
                      <th width="10px" class="text-uppercase text-sm font-weight-bolder text-center">6</th>
                      <th width="10px" class="text-uppercase text-sm font-weight-bolder text-center">9</th>
                      <th width="10px" class="text-uppercase text-sm font-weight-bolder text-center">10</th>
                      <th width="10px" class="text-uppercase text-sm font-weight-bolder text-center">11</th>
                      <th width="10px" class="text-uppercase text-sm font-weight-bolder text-center">12</th>
                      <th width="10px" class="text-uppercase text-sm font-weight-bolder text-center">13</th>
                      <th width="10px" class="text-uppercase text-sm font-weight-bolder text-center">14</th>
                      <th width="10px" class="text-uppercase text-sm font-weight-bolder text-center">15</th>
                      <th width="10px" class="text-uppercase text-sm font-weight-bolder text-center">16</th>
                      <th width="10px" class="text-uppercase text-sm font-weight-bolder text-center">Sakit</th>
                      <th width="10px" class="text-uppercase text-sm font-weight-bolder text-center">Izin</th>
                      <th width="10px" class="text-uppercase text-sm font-weight-bolder text-center">Alpha</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($laporan_kehadiran as $index => $row)
                    <tr>
                      <td class="text-xs">{{ $row['nama'] }}</td>
                      <td class="text-xs">{{ $row['nim'] }}</td>
                      @foreach($row['pertemuan'] as $rowP)
                      <td class="text-xs text-center">{{ $rowP[0] }}</td>
                      @endforeach
                      <td class="text-xs text-center">{{ $row['jum_sakit'] }}</td>
                      <td class="text-xs text-center">{{ $row['jum_izin'] }}</td>
                      <td class="text-xs text-center">{{ $row['jum_alpha'] }}</td>
                      <td class="text-xs text-center">{{ $row['jum_tidak_hadir'] }}</td>
                      <td class="text-xs text-center">{{ $row['jum_hadir'] }}</td>
                      <td class="text-xs text-center">{{ $row['presentasi'] }} %</td>
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
