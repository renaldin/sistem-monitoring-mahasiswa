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
           
            <h4 style="font-weight:bold; font-size:16px;" >LAPORAN NILAI AKHIR MAHASISWA </h4> <br> <br> <br> <br>
            <h4 style="font-weight:bold; font-size:16px; text-transform: uppercase;"></h4> <br> <br> <br> <br>
            {{-- <h4 style="font-weight:bold; font-size:16px;" > SEMESTER @if($kelas->tahunAjaran->semester % 2 === 1)  GANJIL @else GENAP @endif TAHUN AKADEMIK {{ $kelas->tahunAjaran->tahun }}</h4> --}}
      </div>

      <div class="isi" style="font-size:14px">
            <table width="100%" class="mt-2">
            <br>
                  <tr>
                        <td style="width:20%"><p>Kelas</p></td>
                        <td style="width:2%"><p>:</p></td>
                        <td style="width:78%">{{$matkul->kelas->nama_kelas}}<p> 
                        </p></td>
                  </tr>
                  <tr>
                        <td style="width:20%"><p>Mata Kuliah</p></td>
                        <td style="width:2%"><p>:</p></td>
                        <td style="width:78%">{{$matkul->mataKuliah->nama_mata_kuliah}}<p>
                        
                        </p></td>
                  </tr>
                  <tr>
                        <td style="width:20%"><p>Dosen Pengampu</p></td>
                        <td style="width:2%"><p>:</p></td>
                        <td style="width:78%"><p>{{$matkul->dosen->name}}</p></td>
                  </tr>
            
            </table>

            
            <br>
            <br>
            <br>

            <table style="width:100%" class="list" id="example">
                  <thead>
                        <tr>
                              {{-- <th class="th">Nim</th> --}}
                              <th class="th">Nama</th>
                              <th class="th">Lain - lain (30%)</th>
                              <th class="th">UTS (30%)</th>
                              <th class="th">UAS (40%)</th>
                        </tr>
                  </thead>
                  <tbody>
                        @php
                         $index = 0;   
                        @endphp
                        @foreach ($kategori_nilai as $key => $value)   
                        @php
                            $index += 1;
                        @endphp                   
                        <tr>
                              <td style="text-align:center;" class="td">{{ $key }}</td>
                              @if($value[0]->kategori_tugas == 'nilai lain lain')
                                @foreach ($value->where('kategori_tugas','nilai lain lain') as $num => $item)
                                    <td style="text-align:center;" class="td">{{ $item->nilai[$index-1]->nilai }}</td>
                                @endforeach
                              @else
                                  <td style="text-align:center;" class="td"></td>
                              @endif
                              @if($value[1]->kategori_tugas == 'UTS')
                                @foreach ($value->where('kategori_tugas','UTS') as $num => $item)
                                    <td style="text-align:center;" class="td">{{ $item->nilai[$index-1]->nilai }}</td>
                                @endforeach
                              @else
                                  <td style="text-align:center;" class="td"></td>
                              @endif
                              @if($value[2]->kategori_tugas == 'UAS')
                                @foreach ($value->where('kategori_tugas','UAS') as $num => $item)
                                    <td style="text-align:center;" class="td">{{ $item->nilai[$index-1]->nilai }}</td>
                                @endforeach
                              @else
                                  <td style="text-align:center;" class="td"></td>
                              @endif
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
                              <td>{{$matkul->dosen->name}}</td>
                        </tr>
                        <tr>
                              <td>NIP {{ $matkul->dosen->identity_number}}</td>
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