<html>
<head>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <title>Kehadiran Pertemuan </title>
    <style type= "text/css">
    *{
            margin: 0;
        }
    body {font-family: 'Times New Roman', Times, serif; background-color : #fff }
    .rangkasurat {margin:auto ;background-color : #fff;padding: 10px}
   .header {border-bottom : 3px solid black; padding: 0px;margin-top:0em;line-height: 1.5}
    .tengah {text-align : center;font-size:16px;}
    .judul{
      text-align:center;line-height:5px;font-size:12px;margin-top:1em;}
     .isi{
      margin-left:2em;margin-top:1em;margin-right:2em;font-size:12px;
     }

     .list{
      margin-top:1em;
     }

     .list, .th, .td {
      border: 1px solid black;
      border-collapse: collapse;
      font-size:12pt;
      margin-top:1.5em;
      margin-left:0.4em;
      }

      .kegiatan{
            margin-top:1.5em;
      }
      .persyaratan{
            margin-top:1.5em;
            line-height:1;
      }

      h6{
            font-size:12pt;
            font-weight:400;
            line-height:1.5;
      }
      p{
            font-size:12pt;
      }

      .koordinator{
            margin-left:auto;
            margin-right:auto;
            line-height:1;
      }

      .staff{
            line-height:1;
      }
      


    
     </style >
</head>
<body>




<div class = "rangkasurat">
     <table class="header" width = "100%">
           <tr>
                 <td> <img src="{{asset('img')}}/logo-polsub.png" width="120px"> </td>
                 <td style="width:99%" class = "tengah">
                  <br>
                       <h2 style="line-height:1px;font-weight:50">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN,</h2>
                       <h2 style="line-height:50px;font-weight:50">RISET DAN TEKNOLOGI</h2>
                       <h2 style="margin-top:0.2em;margin-bottom:1em">POLITEKNIK NEGERI SUBANG</h2>
                       <h4 style="font-weight:1;line-height:1px;">Jl. Brigjen Katamso No.37(Belakang RSUD), Dangdeur, Subang, Jawa Barat 41211</h4>
                       <h4 style="font-weight:1;line-height:30px;">Telp. (0260) 417658 Laman: <span style="color:blue">https://www.polsub.ac.id</span></h4>
                 </td>
            </tr>
      </table>
     <div class="judul">
        <br>
        <br>
      <h4 style="font-weight:bold; font-size:16px;" >DAFTAR HADIR PERKULIAHAN</h4> <br> <br> <br> <br>
      <h4 style="font-weight:bold; font-size:16px;" > SEMESTER @if($kelas->tahunAjaran->semester % 2 === 1)  GANJIL @else GENAP @endif TAHUN AKADEMIK {{ $kelas->tahunAjaran->tahun }}</h4>
   
     
      </div>

      <div class="isi" style="font-size:14px">
      <table width="100%" class="mt-2">
        <br>
            <tr>
                  <td style="width:20%"><p>Hari, Tanggal</p></td>
                  <td style="width:2%"><p>:</p></td>
                  <td style="width:78%"><p>
                    {{ $kehadiran->getHari() }}</p></td>
            </tr>
            <tr>
                  <td style="width:20%"><p>Waktu</p></td>
                  <td style="width:2%"><p>:</p></td>
                  <td style="width:78%"><p>
                    {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->translatedFormat('H:i') }} -  {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->translatedFormat('H:i') }}
                    </p></td>
            </tr>
            <tr>
                  <td style="width:20%"><p>Pertemuan</p></td>
                  <td style="width:2%"><p>:</p></td>
                  <td style="width:78%"><p>{{ $kehadiran->pertemuan }}</p></td>
            </tr>
            <tr>
                <td style="width:20%"><p>Program Studi</p></td>
                <td style="width:2%"><p>:</p></td>
                <td style="width:78%"><p>{{$jadwal->mataKuliahEnroll->kelas->prodi->nama_prodi }}</p></td>
          </tr>
          <tr>
            <td style="width:20%"><p>Kelas</p></td>
            <td style="width:2%"><p>:</p></td>
            <td style="width:78%"><p>{{ $jadwal->mataKuliahEnroll->kelas->nama_kelas }}</p></td>
      </tr>
      <tr>
        <td style="width:20%"><p>Mata Kuliah</p></td>
        <td style="width:2%"><p>:</p></td>
        <td style="width:78%"><p style="text-transform: capitalize">{{ $jadwal->mataKuliahEnroll->mataKuliah->nama_mata_kuliah }}</p></td>
  </tr>
  <tr>
    <td style="width:20%"><p>Dosen Pengampu</p></td>
    <td style="width:2%"><p>:</p></td>
    <td style="width:78%"><p>{{ $jadwal->mataKuliahEnroll->dosen->name}}</p></td>
</tr>
      </table>

      <table style="width:100%" class="list" id="example">
        <thead>
            <tr>
            <th class="th">No</th>
            <th class="th">Nim</th>
            <th class="th">Nama</th>
            <th class="th">keterangan</th>
            {{-- <th class="th">Jam Masuk</th> --}}
            <th class="th">Terlambat (Menit)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kehadiran_mahasiswa as $item)
            <tr>
                <td style="width:5%;text-align:center;" class="td">{{$loop->iteration}}</td>
                <td style="width:20%;text-align:center;" class="td">{{ $item->mahasiswa->identity_number }}</td>
                <td style="width:40%;text-align:center;" class="td">{{ $item->mahasiswa->name }}</td>
                <td style="width:25%;text-align:center;" class="td"> {{ $item->status}}
                </td>
                {{-- <td class="td">
                    jam {{ $item->getJamMasukMahasiswa() }}
                </td> --}}
                <td style="width:10%;text-align:center;" class="td">{{ $item->terlambat }}  </td>
            </tr>
            @endforeach
        </tbody>
      </table>
<br>
<br>
<br>


      <div style="float:right" class="ttd">
                        <table class="staff" width="100%">
                              <tr>
                                    <td><p>Subang, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p></td>
                              </tr>
                            
                              <tr>
                                    <td style="height:50px"></td>
                              </tr>
                              <tr>
                                    <td>{{ $jadwal->mataKuliahEnroll->dosen->name}}</td>
                              </tr>
                              <tr>
                                    <td>NIP {{ $jadwal->mataKuliahEnroll->dosen->identity_number}}</td>
                              </tr>
                        </table>
      </div>
    
      

      </div>
</div>



</body>

<script>
    $(document).ready(function() {
            window.print()
        });
</script>
</html>