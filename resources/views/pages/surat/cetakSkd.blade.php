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
    <title>Surat Keterangan Dokter</title>
    <style>
        table tr td {
            font-size: 13px;
        }

        table tr .text {
            text-align: center;
            font-size: 15px;
            text-decoration: underline;
        }

        table tr .text2 {
            text-align: center;
        }

        table tr .text3 {
            font-size: 15px;
        }

        table .ttd {
            padding-top: 50px;
        }

        table .barcode {
            float: right;
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
                <td class="text" style="font-size: 12px;">
                    <u><b>SURAT KETERANGAN DOKTER</b></u>
                    <br>
                    No:{{ $skd->NO_SURAT ?? ''}}/SKD/III.6.AU/{{ date('Y') }}
                    <hr />
                </td>
            </tr>
        </table>
        <table width="100%">
            <tr>
                <td>Yang bertanda tangan dibawah ini, <b>{{ $skd->NAMA_DOKTER ?? ''}}</b>, menerangkan
                    dengan mengingat Sumpah/Perjanjian sewaktu menerima jabatan, bahwa :</td>
            </tr>
        </table>
        <table width="100%">
            <tr>
                <td width="100">Nama</td>
                <td width="175">: {{ $biodata->NAMA_PASIEN ?? ''}}</td>
            </tr>
            <tr>
                <td width="100">Tanggal Lahir</td>
                <td width="175">: {{ date('d M Y', strtotime($biodata->TGL_LAHIR))}}</td>
            </tr>
            <tr>
                <td width="100">Pekerjaan</td>
                <td width="175">: {{ $skd->PEKERJAAN ?? ''}}</td>
            </tr>
            <tr>
                <td width="100">Alamat</td>
                <td width="175">: {{ $biodata->ALAMAT ?? ''}}</td>
            </tr>
            <tr>
                <td colspan="4"></td>
            </tr>
        </table>
        <table width="100%">
                <tr>
                    <td>
                        Hasil pemeriksaan yang dilakukan meliputi : <br>
                        Berat Badan:<b> {{ $skd->FS_BB }} Kg. </b>Tinggi Badan :<b> {{ $skd->FS_TB }} cm. </b>Tensi :<b> {{ $skd->FS_TD }} mmHg. </b><br>
                        Buta Warna : <b>{{ $skd->BUTA_WARNA }}</b><br>
                        Menggunakan Kacamata : <b>{{ $skd->KACAMATA }}</b>
                        <br>
                        Surat keterangan ini dipergunakan untuk : <b>{{ $skd->TUJUANSURAT }}</b>
                    </td>
                </tr>
        </table>
        <table width="100%">
            <tr>
                <td></td>
                <td class="ttd">Metro, {{ date('d-m-Y', strtotime($skd->mdd)) }}</td>
            </tr>
            <tr>
                <td></td>
                <td style="padding-top:40px;">
                    <!-- Menampilkan barcode dengan lebar 200px dan tinggi 200px -->
                    
                </td>
            </tr>
            <tr>
                <td></td>
                <td>{{ $skd->NAMA_DOKTER ?? ''}}</td>
            </tr>
        </table>
    </center>
</body>

</html>