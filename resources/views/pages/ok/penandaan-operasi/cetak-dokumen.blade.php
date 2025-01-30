<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cetak Penandaan Operasi</title>
    <style>
        table {
            border-collapse: collapse;
        }

        .text2 {
            font-size: 15px;
            padding-left: 5px;
        }

        .text3 {
            font-size: 13px;
            padding-left: 5px;
        }

        .text5 {
            font-size: 15px;
            text-align: center;
        }

        .text7 {
            font-size: 14px;
            margin: 5px;
            padding: 0;
        }

        .text8 {
            font-size: 12px;
            border: 1px solid black;
            text-align: left;
        }

        .gambar-mata {
            font-size: 15px;
            border: 1px solid black;
            text-align: center;
        }

        .text-mata {
            font-size: 12px;
            border: 1px solid black;
        }

        .logo-cell {
            border-right: none;
            width: 10%;
            padding-left: 20px;
        }

        .logo-cell-2 {
            border-left: none;
            width: 10%;
            padding-right: 20px;
        }

        .info-cell {
            text-align: center;
            border-left: none;
            border-right: none;
            width: 40%;
            padding-top: 10px;
        }

        .info-cell td {
            font-size: 5px;
            padding-left: 40px;
        }

        .info-cell h5 {
            font-size: 8px;
            padding-right: 10px;
            margin: auto;
        }

        .info-cell h4 {
            font-size: 14px;
            padding-right: 50px;
            padding: 10px;
            margin: auto;
        }

        .table-css {
            padding-top: 20px;
        }

        .patient-info {
            margin: auto;
            width: 60%;
        }

        .patient-info td {
            font-size: 12px;
            padding-top: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .tabel1 {
            border: 1px solid black;
            padding: 2px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

    </style>
</head>

<body>
    <table class="header-row" width="100%">
        <tr>
            <td class="logo-cell">
                <img src="img/logo.png" width="50" height="50" />
            </td>
            <td class="info-cell">
                <h5>MAJELIS PEMBINAAN KESEHATAN UMUM<br /></h5>
                <h4>RSU MUHAMMADIYAH METRO</h4>
                <table class="table-css">
                    <tr>
                        <td>Jl Soekarno Hatta No. 42 Mulyojati 16 B</td>
                        <td>Fax : (0725) 47760</td>
                    </tr>
                    <tr>
                        <td>Metro Barat - Kota Metro 34125</td>
                        <td>e-mail : info.rsumm@gmail.com</td>
                    </tr>
                    <tr>
                        <td>Telp : (0725) 49490 - 7850378</td>
                        <td>website : www.rsumm.co.id</td>
                    </tr>
                </table>
            </td>
            <td class="logo-cell-2">
                <img src="img/larsibaru.png" width="50" height="50" />
            </td>
            <td class="patient-info">
                <table>
                    <tr>
                        <td>No. RM </td>
                        <td>: {{ $penandaan->no_mr }} </td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>: {{ $penandaan->nama_pasien}}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>: {{ date('d-m-Y', strtotime($penandaan->tanggal_lahir))}}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <hr />
            </td>
        </tr>
    </table>
    <table style="border: 1px solid black;" width="100%">
        <tr>
            <td class="text2" colspan="4" style="text-align: center; border: 1px solid black"><b>FORMULIR PENANDAAN LOKASI OPERASI</b></td>
        </tr>
        <tr>
            <td colspan="2" style="vertical-align: top;">
                <table width="100%">
                    <tr>
                        <td class="text3"><b>Ruangan</b></td>
                        <td class="text3">: {{$penandaan->asal_ruangan}}</td>
                    </tr>
                    <tr>
                        <td class="text3"><b>Tanggal </b></td>
                        <td class="text3">: {{date('d-m-Y', strtotime($penandaan->created_at))}}</td>
                    </tr>
                </table>
            </td>
            <td colspan="2" style="vertical-align: top;">
                <table width="100%">
                    <tr>
                        <td class="text3"><b>Waktu</b></td>
                        <td class="text3">: {{ \Carbon\Carbon::parse($penandaan->created_at)->timezone('Asia/Jakarta')->format('H:i') }} WIB</td>
                    </tr>
                    <tr>
                        <td class="text3"><b>Jenis Operasi</b></td>
                        <td class="text3">: {{$penandaan->jenis_operasi}}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table style="border: 1px solid black; border-bottom:none " width="100%">
        <tr>
            <td><img src="storage/operasi/penandaan-pasien/image/{{$penandaan->gambar}}" width="100%" height="650" /></td>
        </tr>
    </table>
    <table style="border: 1px solid black; border-bottom:none " width="100%">
        <tr>
            <td>Saya menyatakan bahwa lokasi operasi gambar yang telah ditetapkan pada diagram adalah benar</td>
        </tr>
    </table>
    <table style="border: 1px solid black; border-top:none" width="100%">
        <tr>
            <td width="50%" class="text5"> Nama Pasien/Keluarga</td>
            <td width="50%" class="text5">Dokter</td>
        </tr>
        <tr>
            <td width="50%" class="text5" style="padding-left:140px;">{!! DNS2D::getBarcodeHTML($penandaan->nama_pasien, 'QRCODE', 3, 3) !!}</td>
            <td width="50%" class="text5" style="padding-left:140px;">
                {!! DNS2D::getBarcodeHTML($penandaan->nama_dokter, 'QRCODE', 3, 3) !!}
            </td>
        </tr>
        <tr>
            <td width="50%" class="text5">({{ $penandaan->nama_pasien}})</td>
            <td width="50%" class="text5">({{ $penandaan->nama_dokter}})</td>
        </tr>
    </table>
</body>
</html>
