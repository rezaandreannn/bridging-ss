<!DOCTYPE html>
<?php
date_default_timezone_set('Asia/Jakarta');
$dayList = array(
    'Sun' => 'Minggu',
    'Mon' => 'Senin',
    'Tue' => 'Selasa',
    'Wed' => 'Rabu',
    'Thu' => 'Kamis',
    'Fri' => 'Jumat',
    'Sat' => 'Sabtu'
);
?>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hasil Echo</title>
    <style>
        table tr td {
            font-size: 13px;
        }

        table tr .text {
            text-align: center;
            font-size: 15px;
        }

        table tr .text2 {
            text-align: center;
        }

        table .ttd {
            padding-top: 50px;
        }
    </style>
</head>

<body>
    <center>
        <table width="100%">
            <tr>
                <td><img src="img/logo.png" width="50" height="50" /></td>
                <td>
                    <center>
                        <font size="2"><b>MAJELIS PEMBINAAN KESEHATAN UMUM</b></font><br />
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
                <td class="text">
                    <b>SURAT KETERANGAN HASIL ECHOCARDIOGRAFI</b>
                    <hr />
                </td>
            </tr>
        </table>
        <table width="100%">
            <tr>
                <td width="80" style="font-size: 12px;">Nama</td>
                <td width="300" style="font-size: 12px;">: {{ $biodata->NAMA_PASIEN ?? ''}}</td>

            </tr>
            <tr>
                <td width="80" style="font-size: 12px;">No RM</td>
                <td width="300" style="font-size: 12px;">: {{ $biodata->NO_MR ?? ''}}</td>
            </tr>
            <tr>
                <td width="80" style="font-size: 12px;">Tanggal Lahir</td>
                <td width="300" style="font-size: 12px;">: {{ $biodata->TGL_LAHIR ?? ''}}</td>
            </tr>
            <tr>
                <td width="80" style="font-size: 12px;">Jenis Kelamin</td>
                <td width="300" style="font-size: 12px;">: {{ $biodata->JENIS_KELAMIN ?? ''}}</td>
            </tr>
            <tr>
                <td width="80" style="font-size: 12px;">Alamat</td>
                <td width="300" style="font-size: 12px;">: {{ $biodata->ALAMAT ?? ''}}</td>
            </tr>
            <tr>
                <td width="80" style="font-size: 12px;">Bagian</td>
                <td width="300" style="font-size: 12px;">: {{ $biodata->SPESIALIS ?? ''}}</td>
            </tr>
        </table>
        <table width="100%">
            <tr>
                <td width="100" style="font-size: 12px;">Berikut merupakan hasil pemeriksaan echocardiografi :</td>
            </tr>
            <tr>
                <td>
                    <font size="2">{{ $resep->HASIL_ECHO ?? ''}}</font>
                </td>
            </tr>
        </table>
        <table width="100%">
            <tr>
                <td style="padding-top:50px;text-decoration:underline">
                   
                </td>
                <td class="ttd" style="text-align: left; padding-left:420px;">Metro, {{ date('d-m-Y', strtotime($resep->mdd)) }}</td>
                
            </tr>
            <tr>
                <td></td>
                <td style="float: left; padding-left:450px;">
                    <!-- Menampilkan barcode dengan lebar 200px dan tinggi 200px -->
                    {!! DNS2D::getBarcodeHTML($resep->NAMALENGKAP, 'QRCODE', 2, 2) !!}
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: left; padding-left:400px;">{{ $resep->NAMALENGKAP ?? ''}}</td>
            </tr>
        </table>
    </center>
</body>

</html>