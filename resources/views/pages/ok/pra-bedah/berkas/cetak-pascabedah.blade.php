<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cetak Assesmen Pra Bedah</title>
    <style>
        table {
            border-collapse: collapse;
        }

        .text9 {
            font-size: 10px;
            text-align: center;
        }

        .text-3 {
            margin-bottom: 10px;
        }

        .text5 {
            font-size: 15px;
            text-align: center;
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
            padding-top: 5px;
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
            font-size: 12px;
            padding-right: 10px;
            margin: auto;
        }

        .table-kop,
        .table-kop td,
        .table-nama,
        .table-nama td {
            border: none;
        }

        .table-nama {
            border-collapse: collapse;
            width: 100%;
        }

        .table-nama td {
            padding: 4px;
        }

        .table-kop td {
            font-size: 6px;
            padding: 4px;
        }

        .patient-info {
            margin: auto;
            width: 60%;
        }

        .patient-info td {
            font-size: 10px;
            padding-top: 2px;
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

        .section-title {
            font-weight: bold;
            text-align: center;
        }
        .section-title-lab {
            font-weight: bold;
            text-align: left;
        }

        .checkbox {
            margin-right: 3px;
        }

        .area-1 {
            height: 80px;
            width: 300px;
        }

        td,
        th {
            border: 1px solid black;
            padding: 10px;
            vertical-align: top;
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
                <table class="table-kop">
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
                <table class="table-nama">
                    <tr>
                        <td>No. RM </td>
                        <td>: {{ $pasien->No_MR ?? '' }} </td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>: {{ $pasien->Nama_Pasien ?? ''}}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>: {{ date('d-m-Y', strtotime($pasien->TGL_LAHIR))}}</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>: {{ $pasien->JENIS_KELAMIN ?? '' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td colspan="3" class="section-title">Perencanaan Medis Pasca Bedah</td>
        </tr>
        <tr>
            <td colspan="2">
                <label>Dokter Operator: {{ $cetak->nama_dokter ?? ''}}</label>
            </td>
            <td>
                <label>Tanggal Pembedahan: {{ optional($cetak)->tanggal ? date('d-m-Y', strtotime($cetak->tanggal)) : '' }}</label>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <span>1. Tingkat Perawatan Medis :</span>
                <input type="checkbox" >Tinggi<br>
                <input type="checkbox"> Sedang<br>
                <input type="checkbox" > Rendah<br>
                <label>2. Monitor dan Terapi lanjutan :</label><br>
                <label>a. Monitor TD, Nadi, RR, Suhu Setiap :</label><br>
                <label>b. Konsultasi pemberi pelayanan lain:</label>
               
                 {{-- Rencana Tindakan --}}
                 <br>
                 <label>3. Pengobatan yang diperlukan:</label>
                 <textarea rows="2" style="width: 100%;">{{ optional($cetak)->rencana_tindakan ?? '' }}</textarea>
            </td>
        </tr>
    </table>
    <table style="border: 1px solid black; border-top:none" width="100%">
        <tr>
            <td width="30%" class="text5"> </td>
            <td width="40%" class="text5"> Dokter Bedah</td>
            <td width="30%" class="text5"> </td>
        </tr>
        <tr>
            <td width="30%" class="text5" ></td>
            <td width="40%" class="text5" style="padding-right: 30px;">{!! DNS2D::getBarcodeHTML($cetak->nama_dokter, 'QRCODE', 3, 3) !!}</td>
            <td width="30%" class="text5"></td>
        </tr>
        <tr>
            <td width="30%" class="text5"></td>
            <td width="40%" class="text9">({{ $cetak->nama_dokter}})</td>
            <td width="30%" class="text5"></td>
        </tr>
    </table>
</body>
</html>
