<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Surat</title>
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
        .tabel1{
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
                        <td>: {{ $biodata->NO_MR}}</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>: {{ $biodata->NAMA_PASIEN}}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>: {{ date('d-m-Y', strtotime($biodata->TGL_LAHIR))}}</td>
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
            <td class="text2" colspan="4" style="text-align: center; border: 1px solid black"><b>ASESMEN ULANG RAWAT JALAN</b></td>
        </tr>
        <tr>
            <td colspan="2" style="vertical-align: top;">
                <table width="100%">
                    <tr>
                        <td class="text3"><b>Tanggal Kunjungan</b></td>
                        <td class="text3">: {{date('d-m-Y', strtotime($biodata->tanggal_kunjungan))}}</td>
                    </tr>
                    <tr>
                        <td class="text3"><b>High Risk </b></td>
                        <td class="text3">: {{$biodata->FS_HIGH_RISK}}</td>
                    </tr>
                </table>
            </td>
            <td colspan="2" style="vertical-align: top;">
                <table width="100%">
                    <tr>
                        <td class="text3"><b>Klinik Tujuan</b></td>
                        <td class="text3">: {{$biodata->SPESIALIS}}</td>
                    </tr>
                    <tr>
                        <td class="text3"><b>Alergi</b></td>
                        <td class="text3">: {{$biodata->FS_ALERGI}}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <p class="text7"><b>ASESMEN KEPERAWATAN</b></p>
    <table style="border: 1px solid black; border-bottom:none " width="100%">
        <tr>
            <td class="text3"><b>Vital Sign</b></td>
            <td class="text3" colspan="2"></td>
        </tr>
        <tr>
            <td class="text3">Suhu</td>
            <td class="text3" colspan="2">: {{$perawat->FS_SUHU}} C</td>
        </tr>
        <tr>
            <td class="text3">Nadi</td>
            <td class="text3" colspan="2">: {{$perawat->FS_NADI}} x/menit</td>
        </tr>
        <tr>
            <td class="text3">R</td>
            <td class="text3" colspan="2">: {{$perawat->FS_R}} x/menit</td>
        </tr>
        <tr>
            <td class="text3">TD</td>
            <td class="text3" colspan="2">: {{$perawat->FS_TD}} mmHg</td>
        </tr>
        <tr>
            <td class="text3">Tinggi Badan</td>
            <td class="text3" colspan="2">:  {{$perawat->FS_TB}} cm</td>
        </tr>
        <tr>
            <td class="text3">Berat Badan</td>
            <td class="text3" colspan="2">: {{$perawat->FS_BB}} Kg</td>
        </tr>
        <tr>
      
            <td class="text3"><b>Keadaan Umum</b></td>
            <td class="text3" colspan="2">: 
                @if ($perawat->KEADAAN_UMUM=='1')
                {{'Baik'}}
                @elseif ($perawat->KEADAAN_UMUM=='2')
                {{'Sedang'}}
                @elseif ($perawat->KEADAAN_UMUM=='3')
                {{'Buruk'}}
                @else
                {{'-'}}
                @endif
            </td>
        </tr>
        <tr>
            <td class="text3">Kesadaran</td>
            <td class="text3" colspan="2">:
                @if ($perawat->KESADARAN=='1')
                {{'Baik'}}
                @elseif ($perawat->KESADARAN=='2')
                {{'Sedang'}}
                @elseif ($perawat->KESADARAN=='3')
                {{'Buruk'}}
                @else
                {{'-'}}
                @endif
            </td>
        </tr>
        <tr>
            <td class="text3">Status Mental</td>
            <td class="text3" colspan="2">: 
                @if ($perawat->STATUS_MENTAL=='1')
                {{'Kooperatif'}}
                @elseif ($perawat->STATUS_MENTAL=='2')
                {{'Tidak Kooperatif'}}
                @elseif ($perawat->STATUS_MENTAL=='3')
                {{'Gelisah/Delirium/Berontak'}}
                @elseif ($perawat->STATUS_MENTAL=='4')
                {{'Ketidak Mampuan Dalam Mengikuti Perintah'}}
                @else
                {{'-'}}
                @endif
            </td>
        </tr>
        <tr>
            <td class="text3">Lingkar Kepala</td>
            <td class="text3" colspan="2">: {{$perawat->LINGKAR_KEPALA}} </td>
        </tr>
        <tr>
            <td class="text3">Cacat</td>
            <td class="text3" colspan="2">: {{$perawat->CACAT}} </td>
        </tr>
        <tr>
            <td class="text3">Status Gizi</td>
            <td class="text3" colspan="2">: 
                @if ($perawat->STATUS_GIZI=='1')
                {{'Baik'}}
                @elseif ($perawat->STATUS_GIZI=='2')
                {{'Cukup'}}
                @elseif ($perawat->STATUS_GIZI=='3')
                {{'Kurang'}}
                @else
                {{'-'}}
                @endif
            </td>
        </tr>
        <tr>
            <td class="text3">ADL</td>
            <td class="text3" colspan="2">: 
                @if ($perawat->ADL=='1')
                {{'Mandiri'}}
                @elseif ($perawat->ADL=='2')
                {{'Dibantu'}}
                @else
                {{'-'}}
                @endif
            </td>
        </tr>
        <tr>
            <td class="text3"><b>Asesmen Jatuh</b></td>
            <td class="text3" colspan="2">
            </td>
        </tr>
        <tr>
            <td class="text3">Cara berjalan pasien Tidak seimbang/sempoyongan/limbung</td>
            <td class="text3" colspan="2">:               
                @if ($perawat->FS_CARA_BERJALAN1=='1')
                {{'Ya'}}
                @elseif ($perawat->FS_CARA_BERJALAN1=='0')
                {{'Tidak'}}
                @else
                {{'-'}}
                @endif
            </td>
        </tr>
        <tr>
            <td class="text3">Cara berjalan pasien dengan mengunakan alat bantu</td>
            <td class="text3" colspan="2">: 
                @if ($perawat->FS_CARA_BERJALAN2=='1')
                {{'Ya'}}
                @elseif ($perawat->FS_CARA_BERJALAN2=='0')
                {{'Tidak'}}
                @else
                {{'-'}}
                @endif
            </td>
        </tr>
        <tr>
            <td class="text3">Menopang saat akan duduk: tampak memegang pinggiran kursi atau meja / <br>benda lain sebagai penopang saat akan duduk</td>
            <td class="text3" colspan="2">: 
                @if ($perawat->FS_CARA_DUDUK=='1')
                {{'Ya'}}
                @elseif ($perawat->FS_CARA_DUDUK=='0')
                {{'Tidak'}}
                @else
                {{'-'}}
                @endif
            </td>
        </tr>
        <tr>
            <td class="text3">Kesimpulan</td>
            <td class="text3" colspan="2">: 
                @php
                    $kesimpulan = $perawat->FS_CARA_BERJALAN1 + $perawat->FS_CARA_BERJALAN2 + $perawat->FS_CARA_DUDUK
                @endphp
                <b>
                    @if($kesimpulan <= '1')
                    {{'RESIKO RENDAH'}}
                    @elseif ($kesimpulan == '2')
                    {{'RESIKO SEDANG'}}
                    @elseif ($kesimpulan >= '3')
                    {{'RESIKO TINGGI'}}
                    @else 
                    {{'-'}}
                    @endif
                </b>
            </td>
        </tr>
        <tr>
            <td class="text3"><b>Riwayat Kesehatan</b></td>
            <td class="text3" colspan="2"></td>
        </tr>
        <tr>
            <td class="text3">Riwayat Penyakit Dahulu</td>
            <td class="text3" colspan="2">: {{$perawat->FS_RIW_PENYAKIT_DAHULU}}</td>
        </tr>
        <tr>
            <td class="text3">Riwayat Penyakit Keluarga</td>
            <td class="text3" colspan="2">: 
                @if($perawat->FS_RIW_PENYAKIT_KEL == '1')
                {{'Hipertensi'}}
                @elseif ($perawat->FS_RIW_PENYAKIT_KEL == '2')
                {{'TB Paru'}}
                @elseif ($perawat->FS_RIW_PENYAKIT_KEL == '3')
                {{$perawat->FS_RIW_PENYAKIT_KEL2}}
                @else 
                {{'-'}}
                @endif
            </td>
        </tr>
        <tr>
            <td class="text3"><b>Status Psikologi</b></td>
            <td class="text3" colspan="2">: 
                @if($perawat->FS_STATUS_PSIK == '1')
                {{'Tenang'}}
                @elseif ($perawat->FS_STATUS_PSIK == '2')
                {{'Cemas'}}
                @elseif ($perawat->FS_STATUS_PSIK == '3')
                {{'Takut'}}
                @elseif ($perawat->FS_STATUS_PSIK == '4')
                {{'Marah'}}
                @elseif ($perawat->FS_STATUS_PSIK == '5')
                {{'Sedih'}}
                @elseif ($perawat->FS_STATUS_PSIK == '6')
                {{$perawat->FS_STATUS_PSIK2}}
                @else 
                {{'-'}}
                @endif
            </td>
        </tr>
        <tr>
            <td class="text3"><b>Status Sosial</b></td>
            <td class="text3" colspan="2"></td>
        </tr>
        <tr>
            <td class="text3">Hubungan dengan anggota keluarga</td>
            <td class="text3" colspan="2">: 
                @if($perawat->FS_HUB_KELUARGA == '1')
                {{'Baik'}}
                @elseif ($perawat->FS_HUB_KELUARGA == '2')
                {{'Tidak Baik'}}
                @else 
                {{'-'}}
                @endif
            </td>
        </tr>
        <tr>
            <td class="text3"><b>Status Fungsional</b></td>
            <td class="text3" colspan="2">: 

                @if($perawat->FS_ST_FUNGSIONAL == '1')
                {{'Mandiri'}}
                @elseif ($perawat->FS_ST_FUNGSIONAL == '2')
                {{'Perlu Bantuan'}}
                @else 
                {{'-'}}
                @endif
            </td>
        </tr>
        <tr>
            <td class="text3">Penglihatan</td>
            <td class="text3" colspan="2">: 
                @if($perawat->FS_PENGELIHATAN == '1')
                {{'Normal'}}
                @elseif ($perawat->FS_PENGELIHATAN == '2')
                {{'Kabur'}}
                @elseif ($perawat->FS_PENGELIHATAN == '3')
                {{'Kacamata'}}
                @elseif ($perawat->FS_PENGELIHATAN == '4')
                {{'Lensa kontak'}}
                @else 
                {{'-'}}
                @endif
            </td>
        </tr>
        <tr>
            <td class="text3">Penciuman</td>
            <td class="text3" colspan="2">: 
                @if($perawat->FS_PENCIUMAN == '1')
                {{'Normal'}}
                @elseif ($perawat->FS_PENCIUMAN == '2')
                {{'Tidak Normal'}}
                @else 
                {{'-'}}
                @endif
            </td>
        </tr>
        <tr>
            <td class="text3">Pendengaran</td>
            <td class="text3" colspan="2">: 
                @if($perawat->FS_PENDENGARAN == '1')
                {{'Normal'}}
                @elseif ($perawat->FS_PENDENGARAN == '2')
                {{'Tidak Normal (Kanan)'}}
                @elseif ($perawat->FS_PENDENGARAN == '3')
                {{'Tidak Normal (Kiri)'}}
                @elseif ($perawat->FS_PENDENGARAN == '4')
                {{'Tidak Normal (Kanan & Kiri)'}}
                @elseif ($perawat->FS_PENDENGARAN == '5')
                {{'Alat Bantu Dengar (Kanan)'}}
                @elseif ($perawat->FS_PENDENGARAN == '6')
                {{'Alat Bantu Dengar (Kiri)'}}
                @elseif ($perawat->FS_PENDENGARAN == '7')
                {{'Alat Bantu Dengar (Kanan & Kiri)'}}
                @else 
                {{'-'}}
                @endif
            </td>
        </tr>
        <tr>
            <td class="text3"><b>Spritual dan kultural pasien</b></td>
            <td class="text3" colspan="2"></td>
        </tr>
        <tr>
            <td class="text3">Agama</td>
            <td class="text3" colspan="2">: 
                @if($perawat->FS_AGAMA == '1')
                {{'Islam'}}
                @elseif ($perawat->FS_AGAMA == '2')
                {{'Kristen'}}
                @elseif ($perawat->FS_AGAMA == '3')
                {{'Katholik'}}
                @elseif ($perawat->FS_AGAMA == '4')
                {{'Hindu'}}
                @elseif ($perawat->FS_AGAMA == '5')
                {{'Budha'}}
                @elseif ($perawat->FS_AGAMA == '6')
                {{'Konghucu'}}
    
                @else 
                {{'-'}}
                @endif
            </td>
        </tr>
        <tr>
            <td class="text3">Nilai/Kepercayaan khusus</td>
            <td class="text3" colspan="2">: 
                @if($perawat->FS_NILAI_KHUSUS == '1')
                {{'Tidak Ada'}}
                @elseif ($perawat->FS_NILAI_KHUSUS == '2')
                {{$perawat->FS_NILAI_KHUSUS2}}
                @else 
                {{'-'}}
                @endif
            </td>
            </td>
        </tr>
        <tr>
            <td class="text3"><b>Keperawatan</b></td>
            <td class="text3" colspan="2"></td>
        </tr>
        <tr>
            <td class="text3">Masalah Keperawatan</td>
            <td class="text3" colspan="2">: 
                @forelse ($masalahKeperawatan as $masalahkep)
                    {{$masalahkep->FS_NM_DIAGNOSA}}
                @empty
                    
                @endforelse
            </td>
        </tr>
        <tr>
            <td class="text3">Rencana Keperawatan</td>
            <td class="text3" colspan="2">: 
                @forelse ($rencanaKeperawatan as $rencanakep)
                {{$rencanakep->FS_NM_REN_KEP}}
                 @empty
                
                @endforelse
            </td>
        </tr>
    </table>
    <table style="border: 1px solid black; border-top: none;" width="100%">
        <tr>
            <td style="padding-top: 50px;" width="60%" class="text5"></td>
            <td style="padding-top: 50px;" class="text5">Tanggal {{date('d-m-Y', strtotime($perawat->mdb))}}</td>
        </tr>
        <tr>
            <td width="70%" class="text5"></td>
            <td class="text5" style="padding-left: 30px;">{!! DNS2D::getBarcodeHTML($perawat->NamaLengkap, 'QRCODE', 3, 3) !!}</td>
        </tr>
        <tr>
            <td width="60%" class="text5"></td>
            <td class="text5" style="padding-right: 50px;">{{($perawat->NamaLengkap)}}</td>
        </tr>
    </table>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
    <head>        
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
                            <td>: {{ $biodata->NO_MR}}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>: {{ $biodata->NAMA_PASIEN}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td>: {{ date('d-m-Y', strtotime($biodata->TGL_LAHIR))}}</td>
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
                <td class="text2" colspan="4" style="text-align: center; border: 1px solid black"><b>ASESMEN ULANG RAWAT JALAN</b></td>
            </tr>
            <tr>
                <td colspan="2" style="vertical-align: top;">
                    <table width="100%">
                        <tr>
                            <td class="text3"><b>Tanggal Kunjungan</b></td>
                            <td class="text3">: {{date('d-m-Y', strtotime($biodata->tanggal_kunjungan))}}</td>
                        </tr>
                        <tr>
                            <td class="text3"><b>High Risk </b></td>
                            <td class="text3">: {{$biodata->FS_HIGH_RISK}}</td>
                        </tr>
                    </table>
                </td>
                <td colspan="2" style="vertical-align: top;">
                    <table width="100%">
                        <tr>
                            <td class="text3"><b>Klinik Tujuan</b></td>
                            <td class="text3">: {{$biodata->SPESIALIS}}</td>
                        </tr>
                        <tr>
                            <td class="text3"><b>Alergi</b></td>
                            <td class="text3">: {{$biodata->FS_ALERGI}}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <p class="text7"><b>Assesmen Dokter</b></p>
        <table style="border: 1px solid black; border-bottom:none; " width="100%">
            <tr>
                <td class="text3"><b>Anamnesa</b></td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">: {{$dokter->anamnesa}}</td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3"><b>Riwayat Penyakit Sekarang</b></td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">: {{$dokter->RIWAYAT_SEKARANG}}</td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3"><b>Status Psikologi</b></td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">: 
                    @if($dokter->status_psikologi == '1')
                    {{'Tenang'}}
                    @elseif ($dokter->status_psikologi == '2')
                    {{'Cemas'}}
                    @elseif ($dokter->status_psikologi == '3')
                    {{'Takut'}}
                    @elseif ($dokter->status_psikologi == '4')
                    {{'Marah'}}
                    @elseif ($dokter->status_psikologi == '5')
                    {{'Sedih'}}
                    @elseif ($dokter->status_psikologi == '6')
                    {{'Lainnya'}}
                    @else 
                    {{'-'}}
                    @endif
                </td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3"><b>Pemeriksaan Fisik</b></td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">: Suhu : {{$dokter->suhu}} C, Tekanan Darah : {{$dokter->tekanan_darah}} mmHg, Respirasi : {{$dokter->respirasi}} x/menit, Nadi : {{$dokter->nadi}} x/menit, Berat Badan : {{$dokter->berat_badan}} Kg, Tinggi Badan : {{$dokter->tinggi_badan}} CM</td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3"><b>Diagnosa (A)</b></td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">: {{$dokter->DIAGNOSA}}</td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3"><b>Edukasi</b></td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">: {{$dokter->edukasi}}</td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3"><b>Visus</b></td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">OD : {{$dokter->VISUS_OD}}</td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">OS : {{$dokter->VISUS_OS}}</td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3"><b>Add</b></td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">OD : {{$dokter->ADD_OD}}</td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">OS : {{$dokter->ADD_OS}}</td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3"><b>Tonometri</b></td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">TOD : {{$dokter->NCT_TOD}}</td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">TOS :  {{$dokter->NCT_TOS}}</td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3"><b>Deskripsi Mata Kiri</b></td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">: {{$mataKiri->DESKRIPSI}}</td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3"><b>Deskripsi Mata Kanan</b></td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">: {{$mataKanan->DESKRIPSI}}</td>
                <td class="text3" colspan="2"></td>
            </tr>
        </table>
        <table style="border: 1px solid black; border-top: none;" width="100%">
            <tr>
                <td style="padding-top: 50px;" class="text5"></td>
                <td style="padding-top: 50px;" class="text5">Tanggal {{date('d-m-Y', strtotime($dokter->created_at))}} Jam {{date('H:i:s', strtotime($dokter->created_at))}}</td>
            </tr>
            <tr>
                <tr>
                    <td width="70%" class="text5"></td>
                    <td class="text5" style="padding-left: 30px;">{!! DNS2D::getBarcodeHTML($dokter->NAMA_DOKTER, 'QRCODE', 3, 3) !!}</td>
                </tr>
            </tr>
            <tr>
                <td width="50%" class="text5"></td>
                <td class="text5">({{$dokter->NAMA_DOKTER}})</td>
            </tr>
        </table>
        @if(($mataKiri->GAMBAR != null) || ($mataKanan->GAMBAR != null))
        <p class="text7"><b>HASIL GAMBAR</b></p>
        <table width="100%">
            <thead>
                <tr>
                    <th class="tabel1" colspan="2">Mata Kiri</th>
                    <th class="tabel1" colspan="2">Mata Kanan</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        @if($mataKiri->GAMBAR != null)
                            <td class="gambar-mata"> <img src="storage/gambar_mata/{{$mataKiri->GAMBAR}}" width="60" height="80" /></td>
                            <td class="text-mata" width="150px"> {{$mataKiri->DESKRIPSI}}</td>
                        @else
                            <td class="gambar-mata"></td>
                            <td class="text-mata" width="150px">{{$mataKiri->DESKRIPSI}}</td>
                        @endif

                        @if($mataKanan->GAMBAR != null)
                        <td class="gambar-mata"> <img src="storage/gambar_mata/{{$mataKanan->GAMBAR}}" width="60" height="80" /></td>
                        <td class="text-mata" width="150px">{{$mataKanan->DESKRIPSI}}</td>
                        @else
                            <td class="gambar-mata"></td>
                            <td class="text-mata" width="150px">{{$mataKanan->DESKRIPSI}}</td>
                        @endif
                    </tr>
            </tbody>
        </table>
        @endif
    </body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>

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
                            <td>: {{ $biodata->NO_MR}}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>: {{ $biodata->NAMA_PASIEN}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td>: {{ date('d-m-Y', strtotime($biodata->TGL_LAHIR))}}</td>
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
        <p class="text7"><b>HASIL RADIOLOGI</b></p>
        <table width="100%">
            <thead>
                <tr>
                    <th class="tabel1">Jenis Pemeriksaan</th>
                    <th class="tabel1">Hasil</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rads as $rad)
                <tr>
                    <td class="text8">{{$rad->KET_TINDAKAN}}</td>
                    <td class="text8">{{$rad->Ket}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <p class="text7"><b>HASIL LABORATORIUM</b></p>
        <table width="100%">
            <thead>
                <tr>
                    <th class="tabel1">Pemeriksaan</th>
                    <th class="tabel1">Hasil</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($labs as $lab)
                <tr>
                    <td class="text8">{{$lab->Pemeriksaan}}</td>
                    <td class="text8">{{$lab->Hasil}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <p class="text7"><b>RESEP</b></p>
        <table width="100%">
            <thead>
                <tr>
                    <th class="tabel1">Nama Obat</th>
                    <th class="tabel1">Jumlah</th>
                    <th class="tabel1">Cara Pemakaian</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($resep as $reseps)
                <tr>
                    <td class="text8">{{$reseps->Nama_Obat}}</td>
                    <td class="text8">{{ number_format($reseps->Jumlah, 2, ',', '.') }} {{$reseps->Satuan}}</td>
                    <td class="text8">{{$reseps->Dosis}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>