@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
              <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                  <p class="mb-0">{{ !empty($data) ? 'Edit Orang Tua' : 'Add Orang Tua'}}</p>
                </div>
              </div>
              <div class="card-body">
                <p class="text-uppercase text-sm">Orang Tua Information</p>
                <div class="row">
                    <form action="{{ !empty($data) ? url('orang-tua/'.@$data->id.'/update') : url('orang-tua/store')}}" method="POST">
                        @method('POST')
                        @csrf
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-control-label">Mahasiswa</label>
                                <select name="id_mahasiswa" id="" class="form-control" required>
                                    <option value="">Pilih Mahasiswa</option>
                                    @foreach ($mahasiswa as $item)
                                    <option value="{{ $item->id }}" {{ old('id_mahasiswa', @$item->id == @$data->id_mahasiswa ? 'selected' : '')}}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Nama Orang Tua</label>
                                <input class="form-control" name="name_ortu" value="{{old('name_ortu',@$data->name)}}" type="text">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Email Orang Tua</label>
                                <input class="form-control" name="email_ortu" value="{{old('email_ortu',@$data->email)}}" type="email">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Alamat Orang Tua</label>
                                <Textarea class="form-control" name="address_ortu">{{ old('address',@$data->address) }}</Textarea>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">No Handphone Orang Tua</label>
                                <input class="form-control" name="phone_number_ortu" value="{{old('email',@$data->phone_number)}}" type="number">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-control-label">Jenis Kelamin Orang Tua</label>
                                <select name="gender_ortu" id="" class="form-control">
                                    <option value="Laki-laki" {{ old('gender', @$data->gender == 'Laki-laki' ? 'selected' : '')}}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('gender', @$data->gender == 'Perempuan' ? 'selected' : '')}}>Perempuan</option>
                                </select>
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

    })
</script>
@endsection
