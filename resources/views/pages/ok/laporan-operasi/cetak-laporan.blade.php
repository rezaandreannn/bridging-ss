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
                <td colspan="3">Ruang : {{ $biodata->ruangan->nama_ruang }}</td>
                <td colspan="3">Nomor Register :  {{ $cetak->kode_register}}</td>
            </tr>
            <tr>
                <td colspan="3">Nama : <br>{{ ucwords($biodata->pendaftaran->registerPasien->Nama_Pasien) }}</td>
                <td colspan="3">Umur : {{ \Carbon\Carbon::parse($biodata->pendaftaran->registerPasien->TGL_LAHIR)->age }} tahun</td>
            </tr>
            <tr>
                <td colspan="2">Nama Operator : <br>
                    @foreach ($operators as $operator)
                       {{ $operator }}
                    @endforeach
                </td>
                <td colspan="2">Nama Asisten : <br>
                    <ol style="padding: 0; margin: 0;">
                        @foreach ($assistens as $asisten)
                            <li style="list-style-position: inside;">{{ $asisten }}</li>
                        @endforeach
                    </ol>
                </td>
                <td colspan="3">Nama Perawat : <br>
                    <ol style="padding: 0; margin: 0;">
                        @foreach ($perawats as $perawat)
                            <li style="list-style-position: inside;">{{ $perawat }}</li>
                        @endforeach
                    </ol>
                </td>
            </tr>
            <tr>
                <td colspan="3">Nama Ahli Anestesi : <br>
                    @foreach ($dokters as $dokter)
                        {{ $dokter }}<br>
                    @endforeach
                </td>
                <td colspan="4">Nama Anestesi : <br>
                    @foreach ($anastesis as $anastesi)
                        {{ $anastesi }}<br>
                    @endforeach
            </td>
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
                <td colspan="7">
                    Dikirim untuk pemeriksa PA: <br>
                    <label>
                        <input type="radio" name="pemeriksa_pa" value="1" {{ ($cetak->permintaan_pa =='1') ? 'checked' : '' }}> Ya
                    </label>
                    &nbsp;&nbsp;&nbsp;
                    <label>
                        <input type="radio" name="pemeriksa_pa" value="0" {{ ($cetak->permintaan_pa =='0') ? 'checked' : '' }}> Tidak
                    </label>
                </td>
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
