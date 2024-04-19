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
    <title>Surat</title>
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
            padding-top: 100px;
        }
    </style>
</head>

<body>
    <center>
        <table width="100%">
            <tr>
                <td><img src="" width="50" height="50" /></td>
                <td>
                    <center>
                        <font size="2"><b>MAJELIS PEMBINA KESEHATAN UMUM</b></font><br />
                        <font size="2"><b>RSU MUHAMMADIYAH METRO </b></font><br />
                        <font style="font-size: 8px;">JL Soekarno Hatta No. 42 Mulyojati 16B, Fax: (0725) 47760 Metro Barat - Kota Metro 34125</font><br />
                        <font style="font-size: 8px;">Email : info.rsumm@gmail.com , Telp: (0721) 49490-7850378 , Website : www.rsumm.co.id</font>
                    </center>
                </td>
                <td><img src="" width="50" height="50" /></td>
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


                    <hr />
                </td>
            </tr>
        </table>
        <table width="100%">
            <tr>
                <td width="100" style="font-size: 10px;">Nama</td>
                <td width="175" style="font-size: 10px;">: {{ $biodata['NAMA_PASIEN'] ?? ''}}</td>
            </tr>
            <tr>
                <td width="100" style="font-size: 10px;">No MR</td>
                <td width="175" style="font-size: 10px;">: {{ $biodata['NO_MR'] ?? ''}}</td>
            </tr>
            <tr>
                <td width="100" style="font-size: 10px;">Diagnosa</td>
                <td width="175" style="font-size: 10px;">: Tidak Ada</td>
            </tr>
            <tr>
                <td width="100" style="font-size: 10px;">Terapi</td>
                <td width="175" style="font-size: 10px;">:</td>
            </tr>
            <tr>
                <td colspan="4"></td>
            </tr>
        </table>
        <table width="100%" style="border: 1px solid">
            <tr>
                <td style="font-size: 10px;">Terapi</td>
            </tr>

        </table>
        <table width="100%">

        </table>
        <table width="100%" style="text-align:right">
            <tr>
                <td width="100"></td>
                <td class="ttd">Bandar Lampung, 111</td>
            </tr>
            <tr>
                <td width="100"></td>
                <td><img src="barcode.png" alt="" width="70" height="70" /></td>
            </tr>
            <tr>
                <td width="100"></td>
                <td>Dr KK</td>
            </tr>
        </table>
    </center>
</body>

</html>