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
                    <form action="{{ !empty($data) ? url('kelas/'.@$data->id.'/update') : route('mahasiswa-mata-kuliah.store')}}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-control-label">Kelas</label>
                                <select name="id_kelas" id="" class="form-control kelas-selects">
                                    <option value="" selected disabled>Pilih Kelas</option>
                                    @foreach ($kelas_enroll as $item)
                                    <option value="{{ $item->id_kelas }}" {{ old('id_prodi', @$item->id == @$data->id_kelas ? 'selected' : '')}}>{{ $item->kelas->kode_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div id="kode-matkul">
                            <div class="col">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Kode Mata Kuliah</label>
                                    <select name="id_mata_kuliah_enroll" id="kode_mata_kuliah" class="form-control kelas-selects">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-primary w-100 d-block btn-md">Submit</button>
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
    $("#kode-matkul").hide();
    $(".kelas-selects").change(function(){
            var selectedKelas = $(this).val();

            var url = '{{ url("/mahasiswa-mata-kuliah/get-matkul/{id_kelas}") }}'
            url = url.replace("{id_kelas}", selectedKelas);

            $.ajax({
                url: url,
                method: 'get',
                success: (response) => {
                    $("#kode-matkul").show();
                    response.data.forEach(element => {
                        console.log(element);
                        $('#kode_mata_kuliah').append('<option value="'+element.id+'">'+element.mata_kuliah.nama_mata_kuliah+'</option>')
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
