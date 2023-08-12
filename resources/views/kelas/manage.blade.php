@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                  <p class="mb-0">{{ !empty($data) ? 'Edit Kelas' : 'Add Kelas'}}</p>
                </div>
              </div>
              <div class="card-body">
                <p class="text-uppercase text-sm">Kelas Information</p>
                <div class="row">
                    <form action="{{ !empty($data) ? url('kelas/'.@$data->id.'/update') : url('kelas/store')}}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-control-label">Tahun Ajaran</label>
                                <select name="id_tahun_ajaran" id="" class="form-control" required>
                                    @foreach ($tahun_ajaran as $item)
                                    <option value="{{ $item->id }}" {{ old('id_tahun_ajaran', @$item->id == @$data->id_tahun_ajaran ? 'selected' : '')}}>Semester {{ $item->semester }} Tahun {{ $item->tahun }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Nama Kelas</label>
                                <input class="form-control" required name="nama_kelas" value="{{old('nama_kelas',@$data->nama_kelas)}}" type="text">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Kode Kelas</label>
                                <input class="form-control" required name="kode_kelas" value="{{old('kode_kelas',@$data->kode_kelas)}}" type="text">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Angkatan</label>
                                <input class="form-control" required name="angkatan" value="{{old('angkatan',@$data->angkatan)}}" type="text">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-control-label">Prodi</label>
                                <select name="id_prodi" id="" class="form-control prodi-select" required>
                                    <option value="" selected disabled>Pilih Program Studi</option>
                                    @foreach ($prodi as $item)
                                    <option value="{{ $item->id }}" {{ old('id_prodi', @$item->id == @$data->id_prodi ? 'selected' : '')}}>{{ $item->nama_prodi }}|{{ $item->jurusan->nama_jurusan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div id="list-dosen">
                            <div class="col">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Dosen Wali</label>
                                    <select name="id_dosen_wali" id="dosen_wali" class="form-control">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-control-label">Status Mata Kuliah</label>
                                <select name="status" id="" class="form-control" required>
                                    <option value="aktif" {{ old('status', @$data->status == 'aktif' ? 'selected' : '')}}>Aktif</option>
                                    <option value="tidak aktif" {{ old('gender', @$data->status == 'tidak aktif' ? 'selected' : '')}}>Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-primary w-100 btn-md save-button">Submit</button>
                    </form>
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $("#list-dosen").hide();
    $(".save-button").hide();
    $(".prodi-select").on('click' ,function(){
            var selectedProdi = $(this).val();

            var url = '{{ url("/kelas/get-dosen/{id_prodi}") }}'
            url = url.replace("{id_prodi}", selectedProdi);

            $.ajax({
                url: url,
                method: 'get',
                success: (response) => {
                    $('#dosen_wali').empty();
                    $("#list-dosen").show();
                    $(".save-button").show();
                    response.data.forEach(element => {
                        console.log(element);
                        $('#dosen_wali').append('<option value="'+element.id+'">'+element.name+'</option>')
                    });

                },
                error: (err) => {
                    console.log(err)
                }
            })
        })
 })
</script>
@endsection
