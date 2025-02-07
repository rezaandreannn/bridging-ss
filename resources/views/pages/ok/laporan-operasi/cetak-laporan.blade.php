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

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .header {
            text-align: center;
            font-weight: bold;
            font-size: 18px;
        }

        .section-title {
            text-align: left;
            padding: 0 10px;
        }

        .signature {
            margin-top: 80px;
            text-align: right;
        }

        .sign {
            padding-right: 50px;
            padding-bottom: 20px;
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
                <td colspan="3">Ruang : {{ $biodata->asal_ruangan }}</td>
                <td colspan="3">No MR : {{ $biodata->pendaftaran->registerPasien->No_MR}}</td>
            </tr>
            <tr>
                <td colspan="3">Nama : {{ ucwords(strtolower(trim($biodata->pendaftaran->registerPasien->Nama_Pasien))) }}</td>
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
                        <li style="list-style-position: inside;">{{ ucwords(strtolower(trim($asisten))) }}</li>
                        @endforeach
                    </ol>
                </td>
                <td colspan="3">Nama Perawat : <br>
                    <ol style="padding: 0; margin: 0;">
                        @foreach ($perawats as $perawat)
                        <li style="list-style-position: inside;">{{ ucwords(strtolower(trim($perawat))) }}</li>
                        @endforeach
                    </ol>
                </td>
            </tr>
            <tr>
                <td colspan="2">Nama Ahli Anestesi : <br>
                    @foreach ($dokters as $dokter)
                    {{ $dokter }}<br>
                    @endforeach
                </td>
                <td colspan="3">Nama Penata Anestesi : <br>
                    <ol style="padding: 0; margin: 0;">
                        @foreach ($anastesis as $anastesi)
                        <li style="list-style-position: inside;">{{ ucwords(strtolower(trim($anastesi))) }}</li>
                        @endforeach
                    </ol>
                </td>
                <td colspan="2">Jenis Anastesi : <br>{{ $cetak->jenis_anastesi}}</td>
            </tr>
            <tr>
                <td colspan="7" class="diagnosa">Diagnosis Pre-Operatif : <br>{{ $cetak->diagnosa_pre_op}}</td>
            </tr>
            <tr>
                <td colspan="7" class="diagnosa">Diagnosis Post-Operatif : <br>{{ $cetak->diagnosa_post_op}}</td>
            </tr>
            <tr>
                <td colspan="2">Jaringan yang Dieksisi/Insisi : <br>{{ $cetak->jaringan_dieksekusi}}</td>
                <td colspan="3">
                    Dikirim untuk pemeriksa PA: <br>
                    <label>
                        <input type="radio" name="pemeriksa_pa" value="1" {{ ($cetak->permintaan_pa =='1') ? 'checked' : '' }}> Ya
                    </label>
                    &nbsp;&nbsp;&nbsp;
                    <label>
                        <input type="radio" name="pemeriksa_pa" value="0" {{ ($cetak->permintaan_pa =='0') ? 'checked' : '' }}> Tidak
                    </label>
                </td>
                <td colspan="2">Pendarahan : <br> {{ $cetak->pendarahan }} CC</td>
            </tr>
            <tr>
              <td colspan="7">Nama/Macam Operasi : {{ $cetak->macam_operasi }}</td>
            </tr>
            <tr>
                <td>Tgl Operasi <br>{{ date('d-m-Y', strtotime($cetak->tanggal))}}</td>
                <td colspan="2">Jam operasi mulai <br>{{ date('H:i', strtotime($cetak->mulai_operasi))}} WIB</td>
                <td colspan="2">Jam operasi selesai <br>{{ date('H:i', strtotime($cetak->selesai_operasi))}} WIB</td>
                <td colspan="2">Lama operasi berlangsung <br>{{ $cetak->lama_operasi}}</td>
            </tr>
        </table>
        <div class="section-title" style="white-space: pre-wrap;"><b>Laporan Operasi :</b> <br> {!! e($cetak->laporan_operasi) !!}</div>
        <div class="signature">
            <p class="sign">Operator,</p>
            <p></p>
            <p>{{ $biodata->dokter->Nama_Dokter}}</p>
        </div>
    </div>
</body>
</html>