<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Operasi</title>
    <style>
        .container {
            width: 100%;
            max-width: 800px;
            margin: 20px auto;
            background: white;
            border: 1px solid black;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        .header {
            text-align: center;
            font-weight: bold;
            font-size: 18px;
        }
        .diagnosa {
            padding-bottom: 50px;
        }
        .laporan {
            padding-bottom: 30px;
        }
        .section-title {
            text-align: left;
            padding: 10px 10px;
        }
        .signature {
            margin-top: 100px;
            text-align: right;
        }
        .sign {
            padding-right: 50px;
        }
        .no-border {
            border: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <table>
            <tr>
                <th colspan="7">RUMAH SAKIT UMUM MUHAMMADIYAH METRO</th>
            </tr>
            <tr>
                <td rowspan="2">LAPORAN OPERASI</td>
                <td colspan="3">Ruang : </td>
                <td colspan="3">Nomor Register :  {{ $cetak->kode_register}}</td>
            </tr>
            <tr>
                <td colspan="3">Nama : {{ $biodata->nama_pasien}}</td>
                <td colspan="3">Umur : </td>
            </tr>
            <tr>
                <td colspan="2">Nama Operator : <br>dr. Aji Yudho Prabowo, Sp.BS</td>
                <td colspan="2">Nama Asisten : <br>HARDIANSYAH PUTRA</td>
                <td colspan="3">Nama Perawat : <br>WULAN</td>
            </tr>
            <tr>
                <td colspan="3">Nama Ahli Anestesi : <br>TRI SETIABUDI</td>
                <td colspan="4">Nama Anestesi : <br>TRI SETIABUDI</td>
            </tr>
            <tr>
                <td colspan="7" class="diagnosa">Diagnosis Pre-Operatif : <br>{{ $cetak->diagnosa_pre_op}}</td>
            </tr>
            <tr>
                <td colspan="7" class="diagnosa">Diagnosis Post-Operatif : <br>{{ $cetak->diagnosa_post_op}}</td>
            </tr>
            <tr>
                <td colspan="7" class="diagnosa">Jaringan yang Dieksisi/Insisi : <br>{{ $cetak->jaringan_dieksekusi}}</td>
            </tr>
            <tr>
                <td colspan="7" class="laporan">Dikirim untuk pemeriksa PA : <br> [ ] Ya &nbsp;&nbsp;&nbsp; [ ] Tidak</td>
            </tr>
            <tr>
                <td colspan="3">Tgl Operasi : {{ date('d-m-Y', strtotime($cetak->tanggal))}}</td>
                <td colspan="2">Jam Operasi Mulai <br>{{ date('h:i', strtotime($cetak->mulai_operasi))}} WIB</td>
                <td colspan="2">Jam Operasi Selesai <br>{{ date('h:i', strtotime($cetak->selesai_operasi))}} WIB</td>
            </tr>
            <tr>
                <td colspan="7">Lama Operasi Berlangsung : {{ $cetak->lama_operasi}}</td>
            </tr>
        </table>
        <div class="section-title"><b>Laporan Operasi :</b> <br>{{ $cetak->laporan_operasi}}</div>
        <div class="signature">
            <p class="sign">Operator,</p>
            <p></p>
            <p>Tanda Tangan & Nama Jelas</p>
        </div>
    </div>
</body>
</html>
