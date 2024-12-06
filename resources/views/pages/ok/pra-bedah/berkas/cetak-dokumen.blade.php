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
            margin-bottom:10px;
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
        .checkbox {
            margin-right: 3px;
        }
        .area-1 {
            height: 150px;
            width: 300px;
        }
        td, th {
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
                        <td>: {{ $cetak->no_mr }} </td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>: {{ $cetak->nama_pasien}}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>: {{ date('d-m-Y', strtotime($cetak->tanggal_lahir))}}</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>: {{ $cetak->jenis_kelamin }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td colspan="3" class="section-title">Assesmen Pra Bedah</td>
        </tr>
        <tr>
            <td colspan="2">
                <label>Dokter Operator: {{ $cetak->nama_dokter}}</label>
            </td>
            <td>
                <label>Perawat: Fiki</label>
                <label>Tgl: {{date('d-m-Y', strtotime($cetak->tanggal))}}</label>
                <label>Jam: {{date('h:i', strtotime($cetak->jam_mulai))}} - {{date('h:i', strtotime($cetak->jam_selesai))}} WIB</label>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>Asesmen Pra Bedah</strong><br>
                <label>Data Subjektif (Anamnesis):</label>
                <textarea class="area-1"> {{ $cetak->anamnesa}}</textarea><br>
                <label>Data Objektif (Pemeriksaan Fisik):</label>
                <textarea class="area-1"> {{ $cetak->pemeriksaan_fisik}}</textarea><br>
                <label>Diagnosis Pra Bedah:</label>
                <textarea class="area-1"> {{ $cetak->diagnosa}}</textarea>
            </td>
            <td>
                <strong>Verifikasi Pra Bedah</strong><br>
                <span>Berkas Rekam Medis Terkait :</span><br>
                <input type="checkbox" {{ $cetak->status_pasien == '1' ? 'checked' : '' }} class="checkbox"> Status Pasien<br>
                <input type="checkbox" {{ $cetak->assesmen_pra_bedah == '1' ? 'checked' : '' }} class="checkbox"> Assesmen Pra Bedah<br>
                <input type="checkbox" {{ $cetak->penandaan_lokasi == '1' ? 'checked' : '' }} class="checkbox"> Penandaan Lokasi<br>
                <input type="checkbox" {{ $cetak->informed_consent_bedah == '1' ? 'checked' : '' }} class="checkbox"> Informed Consent Bedah<br>
                <input type="checkbox" {{ $cetak->informed_consent_anastesi == '1' ? 'checked' : '' }} class="checkbox"> Assesmen Pra Anestesi/Sedasi<br>
                <input type="checkbox" {{ $cetak->assesmen_pra_anastesi_sedasi == '1' ? 'checked' : '' }} class="checkbox"> Edukasi Anestesi<br>
                <span>Hasil Pemeriksaan Penunjang:</span><br>
                <input type="checkbox" {{ $cetak->laboratorium == '1' ? 'checked' : '' }} class="checkbox"> Laboratorium:<br>
                <ul style="margin: 0; padding-left: 40px;">
                    <li>Hb : {{ $cetak->lab_hemoglobin}} Trombos : {{ $cetak->lab_hemoglobin}} BT : {{ $cetak->lab_bt}}</li>
                    <li>Leukosit : {{ $cetak->lab_hemoglobin}} Hematokrit : {{ $cetak->lab_hemoglobin}} CT : {{ $cetak->lab_ct}}</li>
                </ul>
                {{-- Rontgen --}}
                <input type="checkbox" {{ $cetak->rontgen == '1' ? 'checked' : '' }} class="checkbox">
                <span class="text-3">Rontgen: <b>{{ $cetak->deskripsi_rontgen }}</b></span><br>
                {{-- Ekg --}}
                <input type="checkbox" {{ $cetak->ekg == '1' ? 'checked' : '' }} class="checkbox">
                <span class="text-3">EKG: <b>{{ $cetak->deskripsi_ekg }}</b></span><br>
                {{-- Darah --}}
                <input type="checkbox" {{ $cetak->darah == '1' ? 'checked' : '' }} class="checkbox">
                <span class="text-3">Darah/Alat Khusus: <b>{{ $cetak->deskripsi_obat}}</b></span><br>
                <span style="padding-left: 25px;">Gol : {{ $cetak->gol}}</span> <span>Jumlah: {{ $cetak->jumlah }}</span> <br>
                {{-- Obat --}}
                <input type="checkbox" {{ $cetak->obat == '1' ? 'checked' : '' }} class="checkbox">
                <span class="text-3">Obat-Obatan yang Dibawa:</span>
                <textarea rows="2" style="width: 100%;">{{$cetak->deskripsi_obat}}</textarea><br>
                <span>Estimasi Waktu:<b>{{date('h:i', strtotime($cetak->estimasi_waktu))}}</b></span><br>
                <label>Rencana Tindakan:</label>
                <textarea rows="2" style="width: 100%;">{{ $cetak->rencana_tindakan}}</textarea>
            </td>
        </tr>
    </table>
    <table style="border: 1px solid black; border-top:none" width="100%">
        <tr>
            <td width="30%" class="text5"> Tanda Tangan Dokter Operator</td>
            <td width="40%" class="text5"> Tanda Tangan Pasien/Keluarga</td>
            <td width="30%" class="text5"> Tanda Tangan Perawat</td>
        </tr>
        <tr>
            <td width="30%" class="text5"><img src="storage/ttd/dokter/{{$cetak->ttd_dokter}}" width="80" height="80" /></td>
            <td width="40%" class="text5"><img src="storage/operasi/penandaan-pasien/ttd/{{$cetak->ttd_pasien}}" width="80" height="80" /></td>
            <td width="30%" class="text5"></td>
        </tr>
        <tr>
            <td width="30%" class="text5">({{ $cetak->nama_dokter}})</td>
            <td width="40%" class="text9">({{ $cetak->nama_pasien}})</td>
            <td width="30%" class="text5">({{ $cetak->nama_dokter}})</td>
        </tr>
    </table>
</body>
</html>
