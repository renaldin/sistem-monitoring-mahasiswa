@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header pb-0">
            <div class="d-flex align-items-center">
              <p class="mb-0">{{ !empty($data) ? 'Edit Sp' : 'Add Sp'}}</p>
            </div>
          </div>
          <div class="card-body">
            <p class="text-uppercase text-sm">User Information</p>
            <div class="row">
                <form action="{{ !empty($data) ? url('sp/'.@$data->id.'/update') : url('sp/store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="col">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Mahasiswa</label>
                            <input type="hidden" name="id_user_penerima" value="{{ $mahasiswa->id }}" />
                            <input class="form-control" value="{{ $mahasiswa->name }}" readonly />
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Deskripsi</label>
                            <input class="form-control" name="deskripsi" value="{{old('deskripsi',@$data->deskripsi)}}" type="text">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">File</label>
                            <input class="form-control" name="file" value="{{old('file',@$data->file)}}" type="file">
                        </div>
                    </div>
                    <button type="submit" class="save-button btn btn-outline-primary w-100  btn-md">Submit</button>
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
    // $("#id-mahasiswa").hide();
    // $(".save-button").hide();
    // $(".kelas-selects").on('click' ,function(){
    //         var selectedKelas = $(this).val();

    //         var url = '{{ url("/sp/get-mahasiswa/{id_kelas}") }}'
    //         url = url.replace("{id_kelas}", selectedKelas);

    //         $.ajax({
    //             url: url,
    //             method: 'get',
    //             success: (response) => {
    //                 $('#id_mahasiswa').empty();
    //                 $("#id-mahasiswa").show();
    //                 $(".save-button").show();
    //                 response.data.forEach(element => {
    //                     console.log(element);
    //                     $('#id_mahasiswa').append('<option value="'+element.id+'">'+element.name+'</option>')
    //                 });
    //             },
    //             error: (err) => {
    //                 console.log(err)
    //             }
    //         })
    //     })
 })
</script>
@endsection
