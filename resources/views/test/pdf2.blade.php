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
            <h4 style="font-weight:bold; font-size:16px;" >LAPORAN PRESENTASE PRESENSI MAHASISWA </h4> <br> <br> <br> <br>
            <h4 style="font-weight:bold; font-size:16px; text-transform: uppercase;">{{$jadwal->mataKuliahEnroll->kelas->prodi->nama_prodi }} </h4> <br> <br> <br> <br>
            <h4 style="font-weight:bold; font-size:16px;" > SEMESTER @if($kelas->tahunAjaran->semester % 2 === 1)  GANJIL @else GENAP @endif TAHUN AKADEMIK {{ $kelas->tahunAjaran->tahun }}</h4>
      </div>

      <div class="isi" style="font-size:14px">
            <table width="100%" class="mt-2">
            <br>
                  <tr>
                        <td style="width:20%"><p>Total Pertemuan</p></td>
                        <td style="width:2%"><p>:</p></td>
                        <td style="width:78%">{{$count}}<p> 
                        </p></td>
                  </tr>
                  <tr>
                        <td style="width:20%"><p>Mata Kuliah</p></td>
                        <td style="width:2%"><p>:</p></td>
                        <td style="width:78%">{{$jadwal->mataKuliahEnroll->mataKuliah->nama_mata_kuliah}}<p>
                        
                        </p></td>
                  </tr>
                  <tr>
                        <td style="width:20%"><p>Dosen Pengampu</p></td>
                        <td style="width:2%"><p>:</p></td>
                        <td style="width:78%"><p>{{$jadwal->mataKuliahEnroll->dosen->name}}</p></td>
                  </tr>
            
            </table>

            
            <br>
            <br>
            <br>

            @foreach ($kehadiran as $key => $item)
                  <td style="width:20%"><p>Pertemuan <td>{{$loop->iteration}}</td></p></td>
            <table style="width:100%" class="list" id="example">
                  <thead>
                        <tr>
                              <th colspan="4" style="background-color:darkslateblue;color:white;text-align: center">{{$key}}</th>
                        </tr>
                        <tr>
                              <th class="th">Nim</th>
                              <th class="th">Nama</th>
                              <th class="th">Kehadiran</th>
                              {{-- <th class="th">Jam Masuk</th> --}}
                              <th class="th">Terlambat (Menit)</th>
                        </tr>
                  </thead>
                  <tbody>
                        @foreach ($item as $value)                      
                        <tr>
                              <td style="text-align:center;" class="td">{{ $value->mahasiswa->identity_number }}</td>
                              <td style="text-align:center;" class="td">{{ $value->mahasiswa->name }}</td>
                              <td style="text-align:center;" class="td"> {{ $value->status}}
                              </td>
                              {{-- <td class="td">
                              jam {{ $value->getJamMasukMahasiswa() }}
                              </td> --}}
                              <td style="text-align:center;" class="td">{{ $value->terlambat }}  </td>
                        </tr>
                        @endforeach
                  </tbody>
            </table>
            <br>
            @endforeach
      </div>

</div>

</body>

<script>
    $(document).ready(function() {
            window.print()
        });
</script>
</html>