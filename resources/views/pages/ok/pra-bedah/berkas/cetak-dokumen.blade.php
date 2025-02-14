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
            font-family: Arial, Helvetica, sans-serif;
            border:none;
            font-size: 12px;
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
            <td colspan="3" class="section-title">Assesmen Pra Bedah</td>
        </tr>
        <tr>
            <td colspan="2">
                <label>Dokter Operator: {{ $booking->nama_dokter ?? ''}}</label>
            </td>
            <td>
                <label>Perawat: {{ optional($cetak)->created_by ?? ''}} |</label>
                <label>Tgl: {{ optional($cetak)->tanggal ? date('d-m-Y', strtotime($cetak->tanggal)) : '' }}</label>
                <label>Jam: {{ optional($cetak)->jam_mulai ? date('h:i', strtotime($cetak->jam_mulai)) : '' }}
                    -
                    {{ optional($cetak)->jam_selesai ? date('h:i', strtotime($cetak->jam_selesai)) : '' }} WIB</label>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>Asesmen Pra Bedah</strong><br>
                <label>Data Subjektif (Anamnesis):</label>
                <textarea class="area-1"> {{ $cetak->anamnesa ?? ''}}</textarea>
                <label>Data Objektif (Pemeriksaan Fisik):</label>
                <textarea class="area-1"> {{ $cetak->pemeriksaan_fisik ?? ''}}</textarea>
                <label>Diagnosis Pra Bedah:</label>
                <textarea class="area-1"> {{ $cetak->diagnosa ?? ''}}</textarea>
                <label>Planning:</label>
                <textarea class="area-1"> {{ $cetak->planning ?? ''}}</textarea>
                 {{-- Estimasi Waktu --}}
                 <span>Estimasi Waktu: {{ $cetak->estimasi_waktu ?? ''}}</span><br>

                 {{-- Rencana Tindakan --}}
                 <label>Rencana Tindakan:</label>
                 <textarea rows="2" class="area-1" style="width: 100%;">{{ optional($cetak)->rencana_tindakan ?? '' }}</textarea>
            </td>
            <td>
                <strong>Verifikasi Pra Bedah</strong><br>
                <span>Berkas Rekam Medis Terkait :</span><br>
                <input type="checkbox" {{ optional($cetak)->status_pasien == '1' ? 'checked' : '' }} class="checkbox"> Status Pasien<br>
                <input type="checkbox" {{ optional($cetak)->assesmen_pra_bedah == '1' ? 'checked' : '' }} class="checkbox"> Assesmen Pra Bedah<br>
                <input type="checkbox" {{ optional($cetak)->penandaan_lokasi == '1' ? 'checked' : '' }} class="checkbox"> Penandaan Lokasi<br>
                <input type="checkbox" {{ optional($cetak)->informed_consent_bedah == '1' ? 'checked' : '' }} class="checkbox"> Informed Consent Bedah<br>
                <input type="checkbox" {{ optional($cetak)->informed_consent_anastesi == '1' ? 'checked' : '' }} class="checkbox"> Assesmen Pra Anestesi/Sedasi<br>
                <input type="checkbox" {{ optional($cetak)->assesmen_pra_anastesi_sedasi == '1' ? 'checked' : '' }} class="checkbox"> Edukasi Anestesi<br>

                <span>Hasil Pemeriksaan Penunjang:</span><br>
                {{-- Rontgen --}}
                <input type="checkbox" {{ optional($cetak)->radiologi == '1' ? 'checked' : '' }} class="checkbox">
                <span class="text-3">Radiologi: <b>{{ optional($cetak)->deskripsi_radiologi ?? '' }}</b></span><br>

                {{-- EKG --}}
                <input type="checkbox" {{ optional($cetak)->ekg == '1' ? 'checked' : '' }} class="checkbox">
                <span class="text-3">EKG: <b>{{ optional($cetak)->deskripsi_ekg ?? '' }}</b></span><br>

                {{-- Darah --}}
                <input type="checkbox" {{ optional($cetak)->darah == '1' ? 'checked' : '' }} class="checkbox">
                <span class="text-3">Darah/Alat Khusus: <b>{{ optional($cetak)->deskripsi_obat ?? '' }}</b></span><br>
                <span style="padding-left: 25px;">Gol : {{ optional($cetak)->gol ?? '' }}</span>
                <span>Jumlah: {{ optional($cetak)->jumlah ?? '' }}</span><br>

                {{-- Obat --}}
                <input type="checkbox" {{ optional($cetak)->obat == '1' ? 'checked' : '' }} class="checkbox">
                <span class="text-3">Obat-Obatan yang Dibawa:</span>
                <textarea rows="2" style="width: 100%;" class="area-1">{{ optional($cetak)->deskripsi_obat ?? '' }}</textarea><br>

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
            <td width="30%" class="text5" style="padding-left: 60px;">{!! DNS2D::getBarcodeHTML($booking->nama_dokter, 'QRCODE', 3, 3) !!}</td>
            <td width="40%" class="text5" style="padding-left: 100px;"> {!! DNS2D::getBarcodeHTML($booking->nama_pasien, 'QRCODE', 3, 3) !!}</td>
            <td width="30%" class="text5" style="padding-left: 70px;">{!! DNS2D::getBarcodeHTML($booking->created_by, 'QRCODE', 3, 3) !!}</td>
        </tr>
        <tr>
            <td width="30%" class="text5">({{ $booking->nama_dokter}})</td>
            <td width="40%" class="text5">({{ $booking->nama_pasien}})</td>
            <td width="30%" class="text5">({{ optional($cetak)->created_by ?? ''}})</td>
        </tr>
    </table>
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
    <table width="100%">
        <tr>
            <td colspan="3" class="section-title-lab">Hasil Lab</td>
        </tr>
        <thead>
            <tr>
                <th>No</th>
                <th>Pemeriksaan</th>
                <th>Hasil</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($labs as $data)
            <tr>
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->PEMERIKSAAN ?? '' }}</td>
                    <td>{{ $data->Hasil ?? '' }}</td>
                </tr>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
