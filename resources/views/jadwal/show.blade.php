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
              <p class="mb-0">Jadwal {{ $data->mataKuliahEnroll->mataKuliah->nama_mata_kuliah }} ({{ $data->mataKuliahEnroll->mataKuliah->sks }} Sks)</p>
            </div>
          </div>
          <input type="hidden" name="id_jadwal" id="hidden-id_jadwal" value="{{ $data->id }}">
          <div class="card-body">
            <div class="row">
                <p class="font-weight-bold col">Nama Mata Kuliah</p>
                <p class="col">{{ $data->mataKuliahEnroll->mataKuliah->nama_mata_kuliah }}</p>
            </div>
            <div class="row">
                <p class="font-weight-bold col">Kelas</p>
                <p class="col">{{ $data->mataKuliahEnroll->kelas->nama_kelas }}</p>
            </div>
            <div class="row">
                <p class="font-weight-bold col">Kode Mata Kuliah</p>
                <p class="col">{{ $data->mataKuliahEnroll->mataKuliah->kode_mata_kuliah }}</p>
            </div>
            <div class="row">
                <p class="font-weight-bold col">Dosen Pengajar</p>
                <p class="col">{{ $data->mataKuliahEnroll->dosen->name}}</p>
            </div>
            <div class="row">
                <p class="font-weight-bold col">Hari</p>
                <p class="col">{{ $data->hari }}</p>
            </div>
            <div class="row">
                <p class="font-weight-bold col">Jam Mulai</p>
                <p class="col">{{ $data->jam_mulai }}</p>
            </div>
            <div class="row">
                <p class="font-weight-bold col">Jam Selesai</p>
                <p class="col">{{ $data->jam_selesai }}</p>
            </div>
          </div>
        </div>
        <div class="d-flex justify-content-end">
            <a href="{{ route('kehadiran.create', ['id_jadwal' => $data->id]) }}" class="d-relative ms-auto btn btn-outline-primary btn-sm ml-auto">Tambah</a>
          </div>
        @foreach ($kehadiran as $item)
        <div class="col-md-12 mb-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <h5 class="card-title">Pertemuan {{ $item->pertemuan }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $item->getHari() }}</h6>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $item->getTanggal() }}</h6>
                        <p class="card-text">{{ $item->deskripsi }}</p>
                    </div>
                    <div class="row">
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('kehadiran.edit', ['id_jadwal' => $data->id, 'pertemuan' => $item->pertemuan]) }}" class="d-relative ms-auto btn btn-secondary btn-sm ml-auto">Edit</a>
                            <a href="{{ route('kehadiran.show', ['id_jadwal' => $data->id, 'pertemuan' => $item->pertemuan]) }}" class="d-relative ms-2 btn btn-primary btn-sm ml-auto">Detail</a>
                        </div>
                    </div>
                </div>
              </div>
        </div>
        @endforeach
    </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="myForm" action="" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Menambah Keterlambatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                            @csrf
                            @method('POST')
                            <div class="col">
                                <div class="form-group">
                                    <label for="" class="form-control-label">Pertemuan</label>
                                    <select name="pertemuan" id="pertemuan" class="form-control">
                                        @for ($i = 1; $i < 17; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="terlambat-btn" class="btn bg-gradient-primary">Save changes</button>
                    </div>
            </div>
        </form>
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
<script>
    $(document).ready(function() {
        $('.kehadiran-checkBox').change(function() {
            // var checkedData = [];
            var isChecked = $(this).is(':checked');
            var value = $(this).val();
            kehadiranPerPertemuan(value, isChecked);
        });

        terlambat();


        function kehadiranPerPertemuan(id_kehadiran, isChecked) {
            var id_jadwal = $("#hidden-id_jadwal").val();
            console.log(id_jadwal);
            var url = '{{ url("/jadwal/{id_jadwal}/update_kehadiran") }}';
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            url = url.replace("{id_jadwal}", id_jadwal);

            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    id_kehadiran: id_kehadiran,
                    isChecked: isChecked,
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
                success: (response) => {
                    console.log(response);
                },
                error: function(xhr, status, error) {
                        console.log(error);
                }
            });
        }



        function terlambat() {
            $("#exampleModal").on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id_jadwal = button.data('jadwal-id');
            var mahasiswa = button.data('mahasiswa');



            $(".myForm").submit(function(event) {
                event.preventDefault();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var url = '{{ url("/jadwal/{id_jadwal}/add_keterlambatan") }}';

                url = url.replace("{id_jadwal}", id_jadwal);
                var data = $('#pertemuan').val();


                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        pertemuan: data,
                        mahasiswa: mahasiswa,

                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    success: function(response) {
                        console.log(response);
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });

        });
        }
    });
</script>
@endsection

