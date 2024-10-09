<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Riwayat asesmen medis rawat jalan</title>
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
            padding: 2px;
            text-align: left;
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
            <td class="text3" colspan="2">: {{$perawat->FS_SUHU}}</td>
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
      
            <td class="text3"><b>Asesmen Nyeri</b></td>
            <td class="text3" colspan="2">: 
                @if ($perawat->FS_NYERI=='0')
                {{'Tidak Ada Nyeri'}}
                @elseif ($perawat->FS_NYERI=='1')
                {{'Ada Nyeri'}}
                @else
                {{'-'}}
                @endif
            </td>
        </tr>
        <tr>
            <td class="text3">Provoke</td>
            <td class="text3" colspan="2">:
                @if ($perawat->FS_NYERIP=='0')
                {{'Tidak Ada'}}
                @elseif ($perawat->FS_NYERIP=='1')
                {{'Biologik'}}
                @elseif ($perawat->FS_NYERIP=='2')
                {{'Kimiawi'}}
                @elseif ($perawat->FS_NYERIP=='3')
                {{'Mekanik / Rudapaksa'}}
                @else
                {{'-'}}
                @endif
            </td>
        </tr>
        <tr>
            <td class="text3">Quality</td>
            <td class="text3" colspan="2">: 
                @if ($perawat->FS_NYERIQ=='0')
                {{'Tidak Ada'}}
                @elseif ($perawat->FS_NYERIQ=='1')
                {{'Seperti Di Tusuk-Tusuk'}}
                @elseif ($perawat->FS_NYERIQ=='2')
                {{'Seperti Terbakar'}}
                @elseif ($perawat->FS_NYERIQ=='3')
                {{'Seperti Tertimpa Beban'}}
                @elseif ($perawat->FS_NYERIQ=='4')
                {{'Ngilu'}}
                @else
                {{'-'}}
                @endif
            </td>
        </tr>
        <tr>
            <td class="text3">Regio</td>
            <td class="text3" colspan="2">: {{$perawat->FS_NYERIR}} </td>
        </tr>
        <tr>
            <td class="text3">Severity</td>
            <td class="text3" colspan="2">:         
                @if ($perawat->FS_NYERIS!=null)
                {{$perawat->FS_NYERIS}}
                @else
                {{'-'}}
                @endif</td>
        </tr>
        <tr>
            <td class="text3">Time</td>
            <td class="text3" colspan="2">: 
                @if ($perawat->FS_NYERIT=='0')
                {{'Tidak Ada'}}
                @elseif ($perawat->FS_NYERIT=='1')
                {{'Kadang-kadang'}}
                @elseif ($perawat->FS_NYERIT=='2')
                {{'Sering'}}
                @elseif ($perawat->FS_NYERIT=='3')
                {{'Menetap'}}
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
            <td class="text3" colspan="2">: {{$biodata->FS_RIW_PENYAKIT_DAHULU}}</td>
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
            <td style="padding-top: 50px;" class="text5">Tanggal {{$perawat->TANGGAL_PERIKSA}} Jam {{$perawat->JAM_PERIKSA}}</td>
        </tr>
        <tr>
            <td width="70%" class="text5"></td>
            <td class="text5" style="padding-left: 30px;">{!! DNS2D::getBarcodeHTML($perawat->NAMALENGKAP, 'QRCODE', 3, 3) !!}</td>
        </tr>
        <tr>
            <td width="60%" class="text5"></td>
            <td class="text5" style="padding-right: 50px;">{{($perawat->NAMALENGKAP)}}</td>
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
        <p class="text7"><b>ASESMEN MEDIK</b></p>
        <table style="border: 1px solid black; border-bottom:none; " width="100%">
            <tr>
                <td class="text3"><b>Anamnesa</b></td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">: {{$asesmenDokterRj->FS_ANAMNESA}}</td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3"><b>Riwayat Penyakit</b></td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">: {{$biodata->FS_RIW_PENYAKIT_DAHULU}}</td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3"><b>Riwayat Penyakit Keluarga</b></td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">: {{$asesmenDokterRj->FS_RIW_PENYAKIT_DAHULU2}}</td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3"><b>Status Psikologi</b></td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">: 
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
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3"><b>Pemeriksaan Fisik</b></td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">: {{$asesmenDokterRj->FS_CATATAN_FISIK}}</td>
                <td class="text3" colspan="2"></td>
            </tr>
            @if ($asesmenDokterRj->MUKOSA !='')
            <tr>
                <td class="text3"><b>Kepala Leher</b></td>
                <td class="text3" colspan="2"></td>
            </tr>

                    <tr>
                        <td class="text3">Konjungtiva : {{$asesmenDokterRj->KONJUNGTIVA}}</td>
                        <td class="text3" colspan="2"></td>
                    </tr>
                        <tr>
                            <td class="text3">Sklera : {{$asesmenDokterRj->SKELERA}}  </td>
                            <td class="text3" colspan="2"></td>
                        </tr>
                        <tr>
                            <td class="text3">Bibir/Lidah : {{$asesmenDokterRj->BIBIR}} </td>
                            <td class="text3" colspan="2"></td>
                        </tr>
                        <tr>
                            <td class="text3"> Mukosa : {{$asesmenDokterRj->MUKOSA}}</td>
                            <td class="text3" colspan="2"></td>
                        </tr>
           
                        <tr>
                            <td class="text3">Deviasi Trakea : {{$asesmenDokterRj->DEVIASI}} </td>
                            <td class="text3" colspan="2"></td>
                        </tr>
                        <tr>
                            <td class="text3">JVP : {{$asesmenDokterRj->JVP}} </td>
                            <td class="text3" colspan="2"></td>
                        </tr>
             @endif
             @if ($asesmenDokterRj->THORAX !='')           
            <tr>
                <td class="text3"><b>Thorax</b></td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">{{$asesmenDokterRj->THORAX}}</td>
                <td class="text3" colspan="2"></td>
            </tr>
            @endif
            @if ($asesmenDokterRj->JANTUNG !='')
            <tr>
                <td class="text3"><b>Jantung</b></td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">{{$asesmenDokterRj->JANTUNG}}</td>
                <td class="text3" colspan="2"></td>
            </tr>
            @endif
            @if ($asesmenDokterRj->ABDOMEN !='')
            <tr>
                <td class="text3"><b>Abdomen</b></td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">{{$asesmenDokterRj->ABDOMEN}}</td>
                <td class="text3" colspan="2"></td>
            </tr>
            @endif
            @if ($asesmenDokterRj->PINGGANG !='')
            <tr>
                <td class="text3"><b>Pinggang</b></td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">{{$asesmenDokterRj->PINGGANG}}</td>
                <td class="text3" colspan="2"></td>
            </tr>
            @endif
            @if ($asesmenDokterRj->EKS_ATAS !='')
            <tr>
                <td class="text3"><b>Ekstremitas</b></td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">
                    {{$asesmenDokterRj->EKS_ATAS}}
                    {{$asesmenDokterRj->EKS_BAWAH}}
                </td>
                <td class="text3" colspan="2"></td>
            </tr>
            @endif
            <tr>
                <td class="text3"><b>Diagnosa (A)</b></td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">: {{$asesmenDokterRj->FS_DIAGNOSA}}</td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3"><b>Daftar Masalah</b></td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">: {{$asesmenDokterRj->FS_DAFTAR_MASALAH}}</td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3"><b>Tindakan (P)</b></td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">: 
                    {{$asesmenDokterRj->FS_TINDAKAN}}
                    @if ($asesmenDokterRj->FS_EKG !='')
                    <br>
                    EKG : {{$asesmenDokterRj->FS_EKG}}
                    @endif
                </td>
                <td class="text3" colspan="2"></td>
            </tr>
            @if ($asesmenDokterRj->FS_PLANNING !='')
            <tr>
                <td class="text3"><b>Planning</b></td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">: 
                    {{$asesmenDokterRj->FS_PLANNING}}
                </td>
                <td class="text3" colspan="2"></td>
            </tr>
            @endif
        </table>
        <table style="border: 1px solid black; border-top: none;" width="100%">
            <tr>
                <td style="padding-top: 50px;" class="text5"></td>
                <td style="padding-top: 50px;" class="text5">Tanggal {{$asesmenDokterRj->mdd}}, Jam {{$asesmenDokterRj->FS_JAM_TRS}}</td>
            </tr>
            <tr>
                <tr>
                    <td width="70%" class="text5"></td>
                    <td class="text5" style="padding-left: 30px;">{!! DNS2D::getBarcodeHTML($asesmenDokterRj->NamaLengkap, 'QRCODE', 3, 3) !!}</td>
                </tr>
            </tr>
            <tr>
                <td width="50%" class="text5"></td>
                <td class="text5">({{$asesmenDokterRj->NamaLengkap}})</td>
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
        <p class="text7"><b>HASIL USG</b></p>
        <table style="border: 1px solid black;" width="100%">
            <tr>
                <td class="text3"><b>Hasil USG</b></td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">: 
                    {{$asesmenDokterRj->FS_USG}}
                </td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text5"></td>
                <td class="text5" colspan="2">Tanggal {{$asesmenDokterRj->mdd}}, Jam {{$asesmenDokterRj->FS_JAM_TRS}}</td>
            </tr>
            <tr>
                <td width="70%" class="text5"></td>
                <td class="text5" colspan="2" style="padding-left: 30px;">{!! DNS2D::getBarcodeHTML($asesmenDokterRj->NamaLengkap, 'QRCODE', 3, 3) !!}</td>
            </tr>
            <tr>
                <td width="50%" class="text5"></td>
                <td class="text5" colspan="2">({{$asesmenDokterRj->NamaLengkap}})</td>
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