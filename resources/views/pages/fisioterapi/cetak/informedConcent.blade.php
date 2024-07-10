<html lang="en">
    <head>
     
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <style>
            table {
                border-collapse: collapse;
            }

            .text1 {
                font-size: 15px;
                padding-left: 20px;
                padding-top: 20px;
            }

            .text2 {
                font-size: 15px;
                padding-left: 20px;
                padding-top: 10px;
            }

            .text3 {
                font-size: 15px;
                padding-left: 40px;
                padding-top: 10px;
            }

            .text5 {
                font-size: 15px;
                text-align: center;
            }

            .table-css {
                padding-top: 20px;
            }
        </style>
    </head>
    <body>
        <table class="header-row" width="100%">
            <tr>
                <td><img src="img/logo.png" width="50" height="50" /></td>
                <td>
                    <center>
                        <font size="2"><b>MAJELIS PEMBINA KESEHATAN UMUM</b></font><br />
                        <font size="2"><b>RSU MUHAMMADIYAH METRO </b></font><br />
                        <font style="font-size: 8px;">JL Soekarno Hatta No. 42 Mulyojati 16B, Fax: (0725) 47760 Metro Barat - Kota Metro 34125</font><br />
                        <font style="font-size: 8px;">Email : info.rsumm@gmail.com , Telp: (0721) 49490-7850378 , Website : www.rsumm.co.id</font>
                    </center>
                </td>
                <td><img src="img/larsibaru.png" width="50" height="50" /></td>
            </tr>
            <tr>
                <td colspan="3">
                    <hr />
                </td>
            </tr>
        </table>
        <table width="100%">
            <tr>
                <td class="text2">Informed consent pelayanan rehabilitasi medik (fisioterapi)</td>
                <td class="text2" colspan="2"></td>
            </tr>
            <tr>
                <td class="text2">Yang bertanda tangan dibawah ini :</td>
                <td class="text2" colspan="2"></td>
            </tr>
            <tr>
                <td class="text2">Nama : {{$biodata->NAMA_PASIEN}}</td>
                <td class="text2" colspan="2"> </td>
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
                <td class="text2">Umur/Jenis : {{$usia}} Tahun / {{$jenis_kelamin}}</td>
                <td class="text2" colspan="2"> </td>
            </tr>
            <tr>
                <td class="text2">Alamat : {{$biodata->ALAMAT}}</td>
                <td class="text2" colspan="2"> </td>
            </tr>
            <tr>
                <td class="text1">Telah menerima dan memahami informasi yang diberikan mencakup :</td>
                <td class="text2" colspan="2"> </td>
            </tr>
            <tr>
                <td class="text3">a. Tata cara tindakan pelayanan rehabilitasi medik (fisioterapi)</td>
                <td class="text2" colspan="2"> </td>
            </tr>
            <tr>
                <td class="text3">b. Tujuan tindakan pelayanan rehabilitasi medik (fisioterapi) yang dilakukan </td>
                <td class="text2" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">c. Alternative tindakan lain </td>
                <td class="text2" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">d. Resiko dan komplikasi yang mungkin terjadi </td>
                <td class="text2" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">e. Prognosis terhadap tindakan yang dilakukan </td>
                <td class="text2" colspan="2"></td>
            </tr>
            <tr>
                <td class="text1">Dengan ini menyatakan sesungguhnya memberikan PERSETUJUAN/PENOLAKAN, untuk dilakukan tindakan fisioterapi : </td>
                <td class="text2" colspan="2"></td>
            </tr>
            <tr>
                <td class="text2">Terhadap : {{$informed_concent->IDENTIFIKASI}}</td>
                <td class="text2" colspan="2"> </td>
            </tr>
            <tr>
                <td class="text2">Nama : {{$biodata->NAMA_PASIEN}}</td>
                <td class="text2" colspan="2"> </td>
            </tr>
            <tr>
                <td class="text2">Umur / Jenis : {{$usia}} Tahun / {{$jenis_kelamin}}</td>
                <td class="text2" colspan="2"> </td>
            </tr>
            <tr>
                <td class="text2">Alamat : {{$biodata->ALAMAT}}</td>
                <td class="text2" colspan="2"> </td>
            </tr>
            <tr>
                <td class="text2">Ruangan / Kamar : {{$informed_concent->RUANGAN}}</td>
                <td class="text2" colspan="2"> </td>
            </tr>
            <tr>
                <td class="text2">No Rekam Medis : {{$biodata->NO_MR}}</td>
                <td class="text2" colspan="2"> </td>
            </tr>
        </table>
        <table width="100%">
            <tr>
                <td style="padding-top: 100px;" class="text5"></td>
                <td style="padding-top: 100px;" class="text5">Metro, {{$informed_concent->CREATE_AT}}</td>
            </tr>
            <tr>
                <td class="text5">Fisioterapis</td>
                <td class="text5">Yang membuat pertanyaan</td>
            </tr>
            <tr>
                <td class="text5"><img src="storage/ttd/{{$informed_concent->IMAGE}}" width="80" height="100" /></td>
                <td class="text5">
                    @if($ttdPasien != null)
                    <img src="storage/ttd/{{$ttdPasien->IMAGE}}" width="80" height="100" />
                    @endif
                </td>
            </tr>
            <tr>
                <td width="50%" class="text5">( {{$informed_concent->name}} )</td>
                <td class="text5">( {{$biodata->NAMA_PASIEN}} )</td>
            </tr>
        </table>
    </body>
</html>