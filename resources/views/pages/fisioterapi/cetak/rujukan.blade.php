<html lang="en">
    <head>
        <style>
            table {
                border-collapse: collapse;
            }

            .text1 {
                font-size: 14px;
                text-align: right;
                padding-top: 5px;
            }

            .text6 {
                font-size: 14px;
                padding-left: 100px;
            }



            .text2 {
                font-size: 14px;
                padding-left: 10px;
                padding-top: 5px;
            }


            .text3 {
                font-size: 15px;
                padding-left: 40px;
                padding-top: 10px;
            }
            
            .text4 {
                font-size: 13px;
                padding-right: 30px;
            }

            .text5 {
                font-size: 15px;
                text-align: center;
            }

            .text8 {
                padding-left: 300px;
            }

            .text6 {
                font-size: 15px;
                padding-left: 40px;
                padding-top: 30px;
            }

            .tindakan1 {
                border: 1px solid black;
                border-right: none;
                border-bottom: none;
            }
            .tindakan2 {
                border: 1px solid black;
                border-right: none;
                border-left: none;
                border-bottom: none;
            }
            .tindakan3 {
                border: 1px solid black;
                border-left: none;
                border-bottom: none;
            }

            .table-css {
                padding-top: 20px;
            }
        </style>
    </head>
    <body>
        <table class="header-row" width="100%">
            <tr>
                <td class="tindakan1"><img src="img/logo.png" width="50" height="50" /></td>
                <td class="tindakan2">
                    <center>
                        <font size="2"><b>MAJELIS PEMBINA KESEHATAN UMUM</b></font><br />
                        <font size="2"><b>RSU MUHAMMADIYAH METRO </b></font><br />
                        <font style="font-size: 8px;">JL Soekarno Hatta No. 42 Mulyojati 16B, Fax: (0725) 47760 Metro Barat - Kota Metro 34125</font><br />
                        <font style="font-size: 8px;">Email : info.rsumm@gmail.com , Telp: (0721) 49490-7850378 , Website : www.rsumm.co.id</font>
                    </center>
                </td>
                <td class="tindakan3"><img src="img/larsibaru.png" width="50" height="50" /></td>
            </tr>
        </table>
        <table style="border: 1px solid black; border-top: none;border-bottom: none;" width="100%">
            <tr>
                <td class="text5" colspan="3" style="text-align: center;border: 1px solid black;"><b>SURAT surat_rujukan</b></td>
            </tr>
            <tr>
                <td class="text8"></td>
                <td class="text2" colspan="2">Kepada Yth ,</td>
            </tr>
            <tr>
                <td class="text8"></td>
                <td class="text2" colspan="2">{{$surat_rujukan->tujuan_rujukan}} </td>
            </tr>
            <tr>
                <td class="text8"></td>
                <td class="text2" colspan="2">Di {{$surat_rujukan->alamat_rujukan}} </td>
            </tr>
        </table>
        <table style="border: 1px solid black; border-top: none;border-bottom: none;" width="100%">
            <tr>
                <td class="text2">Dengan Hormat</td>
                <td class="text2" colspan="2"></td>
            </tr>
            <tr>
                <td class="text2">Mohon Perawatan atau penanganan selanjutnya terhadap pasien :</td>
                <td class="text2" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">Nama : {{$biodata->NAMA_PASIEN}}</td>
                <td class="text4" colspan="2"> </td>
            </tr>
            <tr>
                <td class="text3">Tanggal Lahir : {{ date('Y-m-d', strtotime($biodata->TGL_LAHIR))}}</td>
                <td class="text4" colspan="2"> </td>
            </tr>
            @if($biodata->JENIS_KELAMIN=='L')
            @php
                $jenis_kelamin = 'Laki-laki';
                @endphp
                @else
                @php
                $jenis_kelamin = 'Perempuan';
                @endphp
            @endif
            <tr>
                <td class="text3">Jenis Kelamin : {{$jenis_kelamin}}</td>
                <td class="text4" colspan="2"> </td>
            </tr>
            <tr>
                <td class="text3">Alamat : {{$biodata->ALAMAT}}</td>
                <td class="text4" colspan="2"> </td>
            </tr>
            <tr>
                <td class="text3">Lama Perawatan : {{$surat_rujukan->lama_perawatan}}</td>
                <td class="text4" colspan="2"> </td>
            </tr>
            <tr>
                <td class="text6">Anamnesa : {{$surat_rujukan->anamnesa}}</td>
                <td class="text4" colspan="2"></td>
            </tr>
            <tr>
                <td class="text6">Pemeriksaan Fisik : {{$surat_rujukan->pemeriksaan_fisik}}</td>
                <td class="text4" colspan="2"></td>
            </tr>
            <tr>
                <td class="text6">Hasil Pemeriksaan Penunjang : {{$surat_rujukan->hasil_pemeriksaan_penunjang}}</td>
                <td class="text4" colspan="2"></td>
            </tr>
            <tr>
                <td class="text6">Diagnosa : {{$surat_rujukan->diagnosa}}</td>
                <td class="text4" colspan="2"></td>
            </tr>
            <tr>
                <td class="text6">Terapi /Tindakan yang sudah diberikan : {{$surat_rujukan->terapi_yang_diberikan}}</td>
                <td class="text4" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">Alasan Dirujuk : {{$surat_rujukan->alasan_rujuk}}</td>
                <td class="text4" colspan="2"> </td>
            </tr>
            <tr>
                <td class="text3">Penerima telepon di RS Tujuan : {{$surat_rujukan->nohp_tujuan}}</td>
                <td class="text4" colspan="2"> </td>
            </tr>
            <tr>
                <td class="text3">Atas bantuannya kami ucapkan terimakasih</td>
                <td class="text4" colspan="2"> </td>
            </tr>
        </table>
        <table style="border: 1px solid black; border-top: none;" width="100%">
            <tr>
                <td style="padding-top: 100px;" class="text5">Jam : {{ date('G:i', strtotime($surat_rujukan->created_at))}} WIB</td>
                <td style="padding-top: 100px;" class="text5">Metro, {{ date('Y-m-d', strtotime($surat_rujukan->created_at))}}</td>
            </tr>
            <tr>
                <td class="text5">Penerima Rujukan</td>
                <td class="text5">Dokter yang merujuk</td>
            </tr>
            <tr>
                <td class="text5"><img src="img/larsibaru.png" width="80" height="100" /></td>
                <td class="text5"><img src="storage/ttd/{{$surat_rujukan->IMAGE}}" width="80" height="100" /></td>
            </tr>
            <tr>
                <td width="50%" class="text5">(Yusuf)</td>
                <td class="text5">({{$surat_rujukan->name}})</td>
            </tr>
        </table>
    </body>
</html>