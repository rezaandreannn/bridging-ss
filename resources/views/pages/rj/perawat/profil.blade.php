<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Profil Ringkas</title>
    <style>
        table tr td {
            font-size: 13px;
        }

        table tr .text3 {
            font-size: 15px;
            border: none;
        }

        table tr .text1 {
            font-size: 12px;
            border: none;
        }

        table tr .text5 {
            font-size: 15px;
            border: none;
        }

        table,
        td,
        th {
            border: 1px solid;
            border-collapse: collapse;
            font-weight: normal;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <?php date_default_timezone_set('Asia/Jakarta'); ?>
    <center>
        <table width="100%" style="border: none">
            <tr>
                <td class="text5"><img src="img/logo.png" alt="" width="90" height="90" /></td>
                <td class="text5">
                    <center>
                        <font size="4"><b>MAJELIS PEMBINA KESEHATAN UMUM</b></font><br />
                        <font size="4"><b>RSU MUHAMMADIYAH METRO </b></font><br />
                        <font size="1">JL Soekarno Hatta No. 42 Mulyojati 16B, Fax: (0725) 47760 Metro Barat - Kota Metro 34125</font><br />
                        <font size="1">Email : info.rsumm@gmail.com , Telp: (0721) 49490-7850378 , Website : www.rsumm.co.id</font>
                    </center>
                </td>
                <td class="text5"><img src="img/larsibaru.png" alt="" width="90" height="90" /></td>
            </tr>
            <tr>
                <td colspan="3" style="border: none">
                    <hr />
                </td>
            </tr>
        </table>
        <table width="100%" style="border: none">
            <tr>
                <td width="100" class="text1">Nama</td>
                <td width="100" class="text1">: {{ $pasien->NAMA_PASIEN}}</td>
                <td width="100" class="text1">No MR</td>
                <td width="100" class="text1">: {{ $pasien->NO_MR}}</td>
            </tr>
            <tr>
                <td width="100" class="text1">Tanggal Lahir</td>
                <td width="100" class="text1">: {{ $pasien->TGL_LAHIR}}</td>
                <td width="100" class="text1">Alamat</td>
                <td width="100" class="text1">: {{ $pasien->ALAMAT}}</td>
            </tr>
            <tr>
                <td colspan="4" style="border: none">
                    <hr />
                </td>
            </tr>
        </table>
        <table width="100%" style="border: none">
            <tr>
                <th class="text3" colspan="7" style="background-color: black; color: white; text-align:center">PROFIL RINGKAS MEDIS RAWAT JALAN</th>
            </tr>
            <tr style="text-align: center;">
                <th width="50">Tanggal</th>
                <th width="60">Dokter</th>
                <th width="60">Uraian Klinis</th>
                <th width="50">Diagnosa</th>
                <th width="50">Hasil Echo</th>
                <th width="50">Rencana</th>
                <th width="100">Terapi</th>
            </tr>
            @foreach ($data as $item)
            <tr>
                <td width="50">{{ date('d-m-Y', strtotime($item->TANGGAL)) }}</td>
                <td width="60">{{ $item->NAMA_DOKTER }}({{ $item->SPESIALIS }})</td>
                <td width="60">TD: {{ str_replace("-", "", $item->FS_TD) }} mmHg
                    keluhan: {{ str_replace("-", "", $item->FS_ANAMNESA) }}</td>
                <td width="50">{{ $item->FS_DIAGNOSA }}</td>
                <td width="50">{{ $item->HASIL_ECHO }}</td>
                <td width="50">{{ $item->FS_PLANNING }}</td>
                <td width="100">{{ $item->FS_TERAPI }}</td>
            </tr>
            @endforeach
        </table>
    </center>
</body>

</html>