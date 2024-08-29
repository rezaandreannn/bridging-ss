
{{-- TRIASE --}}
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
                <td class="text2" colspan="4" style="text-align: center; border: 1px solid black"><b>ASESMEN RAWAT JALAN IGD</b></td>
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
        <br>
        <table style="border: 1px solid black; border-bottom:none " width="100%">
            <tr>
                <td class="text2" colspan="4" style="text-align: center; border: 1px solid black"><b>TRIASE</b></td>
            </tr>
            <tr>
                <td class="text3"><b>Kontak Awal Pasien</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3" width="200">Tanggal</td>
                <td class="text3" colspan="3">: {{date('d-m-Y', strtotime($triase->TGL_DATANG))}}</td>
            </tr>
            <tr>
                <td class="text3">Jam Datang</td>
                <td class="text3" colspan="3">: {{date('H.i', strtotime($triase->JAM_DATANG))}} WIB</td>
            </tr>
            <tr>
                <td class="text3">Cara Masuk</td>
                <td class="text3" colspan="3">: {{$triase->CARA_MASUK}}</td>
            </tr>
            <tr>
                <td class="text3">Sudah Terpasang</td>
                <td class="text3" colspan="3">: {{$triase->SUDAH_TERPASANG}}</td>
            </tr>
            <tr>
                <td class="text3">Alasan Kedatangan</td>
                <td class="text3" colspan="3">:  {{$triase->ALASAN_DATANG}} </td>
            </tr>
            <tr>
                <td class="text3">Kendaraan</td>
                <td class="text3" colspan="3">: {{$triase->KENDARAAN}}</td>
            </tr>
            <tr>
                <td class="text3">Identitas Pengantar</td>
                <td class="text3" colspan="3">: {{$triase->NAMA_PENGANTAR}}</td>
            </tr>
            <tr>
                <td class="text3">No Pengantar</td>
                <td class="text3" colspan="3">: {{$triase->TELP_PENGANTAR}}</td>
            </tr>
            <tr>
                <td class="text3">Kasus Trauma</td>
                <td class="text3" colspan="3">: {{$triase->JENIS_KASUS}}</td>
            </tr>
            <tr>
                <td class="text3">Trauma</td>
                <td class="text3" colspan="3">: 
                    @if($triase->JENIS_TRAUMA == '1')
                        Kll Tunggal, di {{ $triase->TEMPAT_KEJADIAN }} Tgl {{ $triase->TGL_KEJADIAN }} jam {{ $triase->JAM_KEJADIAN }}
                    @elseif($triase->JENIS_TRAUMA == '2')
                        Kll Ganda, di {{ $triase->TEMPAT_KEJADIAN }} Tgl {{ $triase->TGL_KEJADIAN }} jam {{ $triase->JAM_KEJADIAN }}
                    @elseif($triase->JENIS_TRAUMA == '3')
                        Jatuh dari ketinggian, {{ $triase->URAIAN_TRAUMA }}
                    @elseif($triase->JENIS_TRAUMA == '4')
                        Trauma Listrik, {{ $triase->URAIAN_TRAUMA }}
                    @elseif($triase->JENIS_TRAUMA == '5')
                        Trauma Zat Kimia, {{ $triase->URAIAN_TRAUMA }}
                    @else
                        {{ $triase->URAIAN_TRAUMA }}
                    @endif
                </td>
            </tr>
            <tr>
                <td class="text3"><b>Kontak Awal pasien</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Keluhan Utama</td>
                <td class="text3" colspan="3">:  {{$triase->KELUHAN}}</td>
            </tr>
            <tr>
                <td class="text3"><b>Vital Sign</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="200">Kesadaran</td>
                            <td class="text3">: {{$triase->KESADARAN}}</td>
                        </tr>
                        <tr>
                            <td class="text3">Suhu</td>
                            <td class="text3">: {{$triase->SUHU}}</td>
                        </tr>
                        <tr>
                            <td class="text3">Respirasi</td>
                            <td class="text3">: {{$triase->R}} x/menit</td>
                        </tr>
                        <tr>
                            <td class="text3">Saturasi O2</td>
                            <td class="text3">: {{$triase->O2}}</td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="100">Nadi</td>
                            <td class="text3">: {{$triase->N}} x/menit</td>
                        </tr>
                        <tr>
                            <td class="text3">Tekanan Darah</td>
                            <td class="text3">:  {{$triase->TD}} mmHg</td>
                        </tr>
                        <tr>
                            <td class="text3">Berat Badan</td>
                            <td class="text3">: {{$triase->BB}} Kg</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="text3"><b>Kesimpulan</b></td>
                <td class="text3" colspan="3"> 
                    @if($triase->TOTAL_SKOR >= '5')
                        Prioritas I (>=5)
                    @elseif($triase->TOTAL_SKOR > '1' && $triase->TOTAL_SKOR < '5')
                        Prioritas II (2-4)
                    @elseif($triase->TOTAL_SKOR <= '1')
                        Prioritas III (0-1)
                    @else
                        Death on Arrived
                    @endif
                </td>
            </tr>
            <tr>
                <td class="text3"><b>Skor</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="200">Kesadaran</td>
                            <td class="text3">: {{$triase->SKOR_KESADARAN}}</td>
                        </tr>
                        <tr>
                            <td class="text3">Suhu</td>
                            <td class="text3">: {{$triase->SKOR_SUHU}}</td>
                        </tr>
                        <tr>
                            <td class="text3">Respirasi</td>
                            <td class="text3">: {{$triase->SKOR_R}}</td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="100">Nadi</td>
                            <td class="text3">: {{$triase->N_SKOR}}</td>
                        </tr>
                        <tr>
                            <td class="text3">Tekanan Darah</td>
                            <td class="text3">: {{$triase->SKOR_TD}}</td>
                        </tr>
                        <tr>
                            <td class="text3">Saturasi O2</td>
                            <td class="text3">: {{$triase->SKOR_O2}}</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="text3"><b>Total Skor</b></td>
                <td class="text3" colspan="3"> {{$triase->TOTAL_SKOR}}</td>
            </tr>
            <tr>
                <td class="text3">Catatan Khusus</td>
                <td class="text3" colspan="3">: {{$triase->CAT_KHUSUS}} </td>
            </tr>
            <tr>
                <td class="text3">Keputusan</td>
                <td class="text3" colspan="3">: {{date('H:i:s', strtotime($triase->JAM_KEP))}}
                </td>
            </tr>
        </table>
        <table style="border: 1px solid black; border-top: none;" width="100%">
            <tr>
                <td style="padding-top: 50px;" width="60%" class="text5"></td>
                <td style="padding-top: 50px;" class="text5">Tanggal {{date('d-m-Y', strtotime($triase->mdd))}} Jam {{date('H:i:s', strtotime($triase->mdd))}}</td>
            </tr>
            <tr>
                <td width="70%" class="text5"></td>
                <td class="text5" style="padding-left: 50px;">{!! DNS2D::getBarcodeHTML($triase->NAMALENGKAP, 'QRCODE', 2, 2) !!}</td>
            </tr>
            <tr>
                <td width="60%" class="text5"></td>
                <td class="text5" style="padding-right: 30px;">({{$triase->NAMALENGKAP}})</td>
            </tr>
        </table>
    </body>
</html>


{{-- Assesmen Keperawatan IGD --}}
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
                <td class="text2" colspan="4" style="text-align: center; border: 1px solid black"><b>ASESMEN RAWAT JALAN IGD</b></td>
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
        <br>
        <table style="border: 1px solid black; border-bottom:none " width="100%">
            <tr>
                <td class="text2" colspan="4" style="text-align: center; border: 1px solid black"><b>ASESMEN KEPERAWATAN IGD</b></td>
            </tr>
            <tr>
                <td class="text3" width="150">Keluhan Utama</td>
                <td class="text3" colspan="3">: {{$perawatIGD->KEL_UTAMA}}</td>
            </tr>
            <tr>
                <td class="text3">Keluhan Penyakit Sekarang</td>
                <td class="text3" colspan="3">: {{$perawatIGD->KEL_SEKARANG}}</td>
            </tr>
            <tr>
                <td class="text3">Status Kehamilan</td>
                <td class="text3" colspan="3">: {{$perawatIGD->HAMIL}}</td>
            </tr>
            <tr>
                <td class="text3"><b>BIO SOSIO</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Status Pernikahan</td>
                <td class="text3" colspan="3">: {{$perawatIGD->MENIKAH}}</td>
            </tr>
            <tr>
                <td class="text3">Pekerjaan</td>
                <td class="text3" colspan="3">: {{$perawatIGD->JOB}}</td>
            </tr>
            <tr>
                <td class="text3">Suku</td>
                <td class="text3" colspan="3">: {{$perawatIGD->SUKU}}</td>
            </tr>
            <tr>
                <td class="text3">Agama</td>
                <td class="text3" colspan="3">: 
                    @if($perawatIGD->AGAMA == '1')
                       Islam
                    @elseif($perawatIGD->AGAMA == '2')
                        Kristen
                    @elseif($perawatIGD->AGAMA == '3')
                        Katholik
                    @elseif($perawatIGD->AGAMA == '4')
                        Hindu
                    @elseif($perawatIGD->AGAMA == '5')
                        Buddha
                    @elseif($perawatIGD->AGAMA == '6')
                        Konghucu
                    @else
                        -
                    @endif
                </td>
            </tr>
            <tr>
                <td class="text3"><b>OBJEKTIF</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Psikologis</td>
                <td class="text3" colspan="3">: {{$perawatIGD->PSIKOLOGIS}}</td>
            </tr>
            <tr>
                <td class="text3">Mental</td>
                <td class="text3" colspan="3">: {{$perawatIGD->MENTAL}}</td>
            </tr>
            <tr>
                <td class="text3">Kesadaran</td>
                <td class="text3" colspan="3">: {{$perawatIGD->KESADARAN}}</td>
            </tr>
            <tr>
                <td class="text3">GCS</td>
                <td class="text3" colspan="3">: {{$perawatIGD->GCS}}</td>
            </tr>
            <tr>
                <td class="text3">Keadaan Umum</td>
                <td class="text3" colspan="3">: {{$perawatIGD->KEADAAN_UMUM}}</td>
            </tr>
            <tr>
                <td class="text3"><b>Vital Sign</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="150">Suhu</td>
                            <td class="text3">: {{$assesmenPerawat->FS_SUHU}}</td>
                        </tr>
                        <tr>
                            <td class="text3">Respirasi</td>
                            <td class="text3">: {{$assesmenPerawat->FS_R}} x/menit</td>
                        </tr>
                        <tr>
                            <td class="text3">Tinggi Badan</td>
                            <td class="text3">: {{$assesmenPerawat->FS_TB}} cm</td>
                        </tr>
                        <tr>
                            <td class="text3">Lingkar Kepala</td>
                            <td class="text3">: {{$perawatIGD->LINGKAR_KEPALA}} cm</td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="100">Nadi</td>
                            <td class="text3">: {{$assesmenPerawat->FS_NADI}} x/menit</td>
                        </tr>
                        <tr>
                            <td class="text3">Tekanan Darah</td>
                            <td class="text3">: {{$assesmenPerawat->FS_TD}} mmHg</td>
                        </tr>
                        <tr>
                            <td class="text3">Berat Badan</td>
                            <td class="text3">: {{$assesmenPerawat->FS_BB}} Kg</td>
                        </tr>
                        <tr>
                            <td class="text3">Status Gizi</td>
                            <td class="text3">: {{$perawatIGD->STATUS_GIZI}}</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="text3"><b>KEBUTUHAN FUNGSIONAL</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Alat Bantu</td>
                <td class="text3" colspan="3">: {{$perawatIGD->ALAT_BANTU}}</td>
            </tr>
            <tr>
                <td class="text3">Cacat</td>
                <td class="text3" colspan="3">: {{$perawatIGD->CACAT}}</td>
            </tr>
            <tr>
                <td class="text3">ADL</td>
                <td class="text3" colspan="3">: 
                    @if($perawatIGD->ADL == '1')
                       Mandiri
                    @elseif($perawatIGD->ADL == '2')
                        Dibantu
                    @endif
                </td>
            </tr>
            <tr>
                <td class="text3"><b>ASESMEN NYERI</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="150">Ada Nyeri</td>
                            <td class="text3">:  
                            @if($assesmenPerawat->FS_NYERI == '0')
                                Tidak Ada Nyeri
                            @elseif($assesmenPerawat->FS_NYERI == '1')
                                Ada Nyeri
                            @else
                                -
                            @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="text3">Provoke</td>
                            <td class="text3">: 
                            @if($assesmenPerawat->FS_NYERIP == '0')
                                Tidak Ada
                            @elseif($assesmenPerawat->FS_NYERIP == '1')
                                Aktivitas
                            @elseif($assesmenPerawat->FS_NYERIP == '2')
                                Spontan
                            @elseif($assesmenPerawat->FS_NYERIP == '3')
                                Stres
                            @else
                                -
                            @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="text3">Quality</td>
                            <td class="text3">: 
                            @if($assesmenPerawat->FS_NYERIQ == '0')
                                Tidak Ada
                            @elseif($assesmenPerawat->FS_NYERIQ == '1')
                                Seperti Di Tusuk-Tusuk
                            @elseif($assesmenPerawat->FS_NYERIQ == '2')
                                Seperti Terbakar
                            @elseif($assesmenPerawat->FS_NYERIQ == '3')
                                Seperti Tertimpa Beb
                            @elseif($assesmenPerawat->FS_NYERIQ == '4')
                                Ngilu
                            @else
                                -
                            @endif
                            </td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="100">Regio</td>
                            <td class="text3">: {{$assesmenPerawat->FS_NYERIR}}</td>
                        </tr>
                        <tr>
                            <td class="text3">Severity</td>
                            <td class="text3">: 
                            @if($assesmenPerawat->FS_NYERIS == '0')
                                0
                            @elseif($assesmenPerawat->FS_NYERIS == '1')
                                1
                            @elseif($assesmenPerawat->FS_NYERIS == '2')
                                2
                            @elseif($assesmenPerawat->FS_NYERIS == '3')
                                3
                            @elseif($assesmenPerawat->FS_NYERIS == '4')
                                4
                            @elseif($assesmenPerawat->FS_NYERIS == '5')
                                5
                            @elseif($assesmenPerawat->FS_NYERIS == '6')
                                6
                            @elseif($assesmenPerawat->FS_NYERIS == '7')
                                7
                            @elseif($assesmenPerawat->FS_NYERIS == '8')
                                8
                            @elseif($assesmenPerawat->FS_NYERIS == '9')
                                9
                            @elseif($assesmenPerawat->FS_NYERIS == '10')
                                10
                            @else
                                -
                            @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="text3">Time</td>
                            <td class="text3">: 
                            @if($assesmenPerawat->FS_NYERIT == '0')
                                Tidak Ada
                            @elseif($assesmenPerawat->FS_NYERIT == '1')
                                Kadang-kadang
                            @elseif($assesmenPerawat->FS_NYERIT == '2')
                                Sering
                            @elseif($assesmenPerawat->FS_NYERIT == '3')
                                Menetap
                            @else
                                -
                            @endif
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="text3"><b>B1 (Breathing)</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="150">Irama Nafas</td>
                            <td class="text3">: {{$perawatIGD->IRAMA_NAFAS}}</td>
                        </tr>
                        <tr>
                            <td class="text3">Pola Pernafasan</td>
                            <td class="text3">: {{$perawatIGD->POLA_NAFAS}}</td>
                        </tr>
                        <tr>
                            <td class="text3">Alat Bantu Nafas</td>
                            <td class="text3">: {{$perawatIGD->BANTU_NAFAS}}</td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="100">Batuk</td>
                            <td class="text3">: {{$perawatIGD->BATUK}}</td>
                        </tr>
                        <tr>
                            <td class="text3">Suara Nafas</td>
                            <td class="text3">: {{$perawatIGD->SUARA_NAFAS}}</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="text3"><b>B2 (Blood)</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="150">Nyeri Dada</td>
                            <td class="text3">: {{$perawatIGD->NYERI_DADA}}</td>
                        </tr>
                        <tr>
                            <td class="text3">Pendarahan</td>
                            <td class="text3">: {{$perawatIGD->PERDARAHAN}}</td>
                        </tr>
                        <tr>
                            <td class="text3">CRT</td>
                            <td class="text3">: {{$perawatIGD->CRT}}</td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="100">Akral</td>
                            <td class="text3">: {{$perawatIGD->AKRAL}}</td>
                        </tr>
                        <tr>
                            <td class="text3">Cyanosis</td>
                            <td class="text3">: {{$perawatIGD->CYANOSIS}}</td>
                        </tr>
                        <tr>
                            <td class="text3">Turgor</td>
                            <td class="text3">: {{$perawatIGD->TURGOR}}</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="text3"><b>B3 (Brain)</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="150">Reflek Cahaya</td>
                            <td class="text3">: {{$perawatIGD->REFLEK_CAHAYA}}</td>
                        </tr>
                        <tr>
                            <td class="text3">Kelumpuhan</td>
                            <td class="text3">: {{$perawatIGD->LUMPUH}}</td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="100">Pupil</td>
                            <td class="text3">: {{$perawatIGD->PUPIL}}</td>
                        </tr>
                        <tr>
                            <td class="text3">Pusing</td>
                            <td class="text3">: {{$perawatIGD->PUSING}}</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="text3"><b>B4 (BAK)</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="150">BAK</td>
                            <td class="text3">: {{$perawatIGD->BAK}}</td>
                        </tr>
                        <tr>
                            <td class="text3">Urine</td>
                            <td class="text3">: {{$perawatIGD->URINE}}</td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="100">Nyeri Tekan</td>
                            <td class="text3">: {{$perawatIGD->BAK_TEKAN}}</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="text3"><b>B5 (BOWEL)</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="150">BAB</td>
                            <td class="text3">: {{$perawatIGD->BAB}}</td>
                        </tr>
                        <tr>
                            <td class="text3">Nyeri Tekan</td>
                            <td class="text3">: {{$perawatIGD->BAB_TEKAN}}</td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="100">Abdomen</td>
                            <td class="text3">: {{$perawatIGD->ABDOMEN}}</td>
                        </tr>
                        <tr>
                            <td class="text3">Jejas Abdomen</td>
                            <td class="text3">: {{$perawatIGD->JEJAS_ABDOMEN}}</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="text3"><b>B6 (BONE)</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="150">Pergerakan Sendi</td>
                            <td class="text3">: {{$perawatIGD->SENDI}}</td>
                        </tr>
                        <tr>
                            <td class="text3">Fraktur</td>
                            <td class="text3">: {{$perawatIGD->FRAKTUR}}</td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="100">Dislokasi</td>
                            <td class="text3">: {{$perawatIGD->DISLOK}}</td>
                        </tr>
                        <tr>
                            <td class="text3">Luka</td>
                            <td class="text3">: {{$perawatIGD->LUKA}}</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="text3"><b>Resiko Dekubitus</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Pasien menggunakan kursi roda/membutuhkan bantuan</td>
                <td class="text3" colspan="3">: {{$perawatIGD->KURSI_RODA}}</td>
            </tr>
            <tr>
                <td class="text3">Pasien inkontinensiauri / alvi</td>
                <td class="text3" colspan="3">: {{$perawatIGD->ALVI}}</td>
            </tr>
            <tr>
                <td class="text3">Riwayat dekubitus atau luka dekubitus</td>
                <td class="text3" colspan="3">: {{$perawatIGD->RIWAYAT_DEKUBITUS}}</td>
            </tr>
            <tr>
                <td class="text3">Usia diatas 65 tahun</td>
                <td class="text3" colspan="3">: {{$perawatIGD->USIA65}}</td>
            </tr>
            <tr>
                <td class="text3">Ekstremitas dan badan tidak sesuai dengan usia perkembangan</td>
                <td class="text3" colspan="3">: {{$perawatIGD->ANAK_SESUAI_UMUR}}</td>
            </tr>
            <tr>
                <td class="text3"><b>Status Fungsional</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Penglihatan</td>
                <td class="text3" colspan="3">: 
                @if($assesmenPerawat->FS_PENGELIHATAN == '1')
                    Normal
                @elseif($assesmenPerawat->FS_PENGELIHATAN == '2')
                    Kabur
                @elseif($assesmenPerawat->FS_PENGELIHATAN == '3')
                    Kaca Mata
                @elseif($assesmenPerawat->FS_PENGELIHATAN == '4')
                    Lensa Kontak
                @else
                    -
                @endif
                </td>
            </tr>
            <tr>
                <td class="text3">Pendengaran</td>
                <td class="text3" colspan="3">:  
                @if($assesmenPerawat->FS_PENDENGARAN == '1')
                    Normal
                @elseif($assesmenPerawat->FS_PENDENGARAN == '2')
                    Tidak Normal (Kanan)
                @elseif($assesmenPerawat->FS_PENDENGARAN == '3')
                    Tidak Normal (Kiri)
                @elseif($assesmenPerawat->FS_PENDENGARAN == '4')
                    Tidak Normal (Kanan & Kiri)
                @elseif($assesmenPerawat->FS_PENDENGARAN == '5')
                    Alat Bantu Dengar (Kanan)
                @elseif($assesmenPerawat->FS_PENDENGARAN == '6')
                    Alat Bantu Dengar (Kiri)
                @elseif($assesmenPerawat->FS_PENDENGARAN == '7')
                    Alat Bantu Dengar (Kanan & Kiri)
                @else
                    -
                @endif
                </td>
            </tr>
            <tr>
                <td class="text3">Penciuman</td>
                <td class="text3" colspan="3">:  
                @if($assesmenPerawat->FS_PENCIUMAN == '1')
                    Normal
                @elseif($assesmenPerawat->FS_PENCIUMAN == '2')
                    Tidak Normal
                @else
                    -
                @endif
                </td>
            </tr>
            <tr>
                <td class="text3"><b>Keperawatan</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Masalah Keperawatan</td>
                <td class="text3" colspan="3">:
                    @foreach ($masalahKeperawatan as $masalah)
                        {{ $masalah->FS_NM_DIAGNOSA }},
                    @endforeach
                </td>
            </tr>
            <tr>
                <td class="text3">Rencana Keperawatan</td>
                <td class="text3" colspan="3">: 
                    @foreach ($rencanaKeperawatan as $rencana)
                        {{ $rencana->FS_NM_REN_KEP }},
                    @endforeach
                </td>
            </tr>
            <tr>
                <td class="text3">Jam selesai periksa</td>
                <td class="text3" colspan="3">: {{date('H:i:s', strtotime($perawatIGD->JAM_SELESAI))}}</td>
            </tr>
        </table>
        <table style="border: 1px solid black; border-top: none;" width="100%">
            <tr>
                <td style="padding-top: 50px;" width="60%" class="text5"></td>
                <td style="padding-top: 50px;" class="text5">Tanggal {{date('d-m-Y', strtotime($perawatIGD->MDD))}} Jam {{date('H:i:s', strtotime($perawatIGD->MDD))}}</td>
            </tr>
            <tr>
                <td width="70%" class="text5"></td>
                <td class="text5" style="padding-left: 50px;">{!! DNS2D::getBarcodeHTML($perawatIGD->NAMALENGKAP, 'QRCODE', 2, 2) !!}</td>
            </tr>
            <tr>
                <td width="60%" class="text5"></td>
                <td class="text5" style="padding-right: 30px;">({{$perawatIGD->NAMALENGKAP}})</td>
            </tr>
        </table>
    </body>
</html>

{{-- Assesmen Kebidanan IGD --}}
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
                <td class="text2" colspan="4" style="text-align: center; border: 1px solid black"><b>ASESMEN RAWAT JALAN IGD</b></td>
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
        <br>
        <table style="border: 1px solid black; border-bottom:none " width="100%">
            <tr>
                <td class="text2" colspan="4" style="text-align: center; border: 1px solid black"><b>ASESMEN KEBIDANAN IGD</b></td>
            </tr>
            <tr>
                <td class="text3" width="150">Cara masuk</td>
                <td class="text3" colspan="3">:  Kursi Roda</td>
            </tr>
            <tr>
                <td class="text3">Rujukan dari</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Membawa obat sendiri</td>
                <td class="text3" colspan="3">: Tidak</td>
            </tr>
            <tr>
                <td class="text3"><b>Data Suami</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Nama</td>
                <td class="text3" colspan="3">: gilang jayanto</td>
            </tr>
            <tr>
                <td class="text3">Tanggal Lahir</td>
                <td class="text3" colspan="3">:  1991-08-11</td>
            </tr>
            <tr>
                <td class="text3">Pekerjaan</td>
                <td class="text3" colspan="3">:  karyawan swasta</td>
            </tr>
            <tr>
                <td class="text3">Agama</td>
                <td class="text3" colspan="3">: Islam</td>
            </tr>
            <tr>
                <td class="text3"><b>Data Pasien</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Pekerjaan Pasien</td>
                <td class="text3" colspan="3">: IRT</td>
            </tr>
            <tr>
                <td class="text3">Pendidikan Pasien</td>
                <td class="text3" colspan="3">: S1</td>
            </tr>
            <tr>
                <td class="text3">Agama</td>
                <td class="text3" colspan="3">: Islam</td>
            </tr>
            <tr>
                <td class="text3"><b>Riwayat Haid</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="150">Menarche</td>
                            <td class="text3">: 12 tahun</td>
                        </tr>
                        <tr>
                            <td class="text3">Lama haid</td>
                            <td class="text3">: 7</td>
                        </tr>
                        <tr>
                            <td class="text3">HPL</td>
                            <td class="text3">: 19/09/2024</td>
                        </tr>
                        <tr>
                            <td class="text3">Keluhan Utama</td>
                            <td class="text3">: hamil anak ke 2 UK 30 minggu, mengeluh keluar darah segar pukul 00.00 wib, mules (-), riwayat PP </td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="100">Siklus haid</td>
                            <td class="text3">: 7 tahun</td>
                        </tr>
                        <tr>
                            <td class="text3">Hpht</td>
                            <td class="text3">: 19/09/2024 </td>
                        </tr>
                        <tr>
                            <td class="text3">Keluhan</td>
                            <td class="text3">: Sakit</td>
                        </tr>
                        <tr>
                            <td class="text3">Riwayat Penyakit Dahulu</td>
                            <td class="text3">: hamil anak ke 2 UK 30 minggu</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="text3"><b>Riwayat Penyakit pada kehamilan sekarang</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Asma</td>
                <td class="text3" colspan="3">: - , Dalam Terapi -</td>
            </tr>
            <tr>
                <td class="text3">Jantung</td>
                <td class="text3" colspan="3">:  , Dalam Terapi</td>
            </tr>
            <tr>
                <td class="text3">Diabetes</td>
                <td class="text3" colspan="3">:  , Dalam Terapi</td>
            </tr>
            <tr>
                <td class="text3">Hipertensi</td>
                <td class="text3" colspan="3">:  , Dalam Terapi</td>
            </tr>
            <tr>
                <td class="text3">Sakit lainnya</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Riwayat Gynekologi</td>
                <td class="text3" colspan="3">:  </td>
            </tr>
            <tr>
                <td class="text3">Riwayat KB</td>
                <td class="text3" colspan="3">:  </td>
            </tr>
            <tr>
                <td class="text3">Riwayat komplikasi KB</td>
                <td class="text3" colspan="3">:  </td>
            </tr>
            <tr>
                <td class="text3"><b>Riwayat Penyakit pada kehamilan sekarang</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Pola Makan</td>
                <td class="text3" colspan="3">:  3 kali/hari, Terakhir Jam 19.00 Wib</td>
            </tr>
            <tr>
                <td class="text3">Pola Minum</td>
                <td class="text3" colspan="3">:  3 cc/hari, Terakhir Jam 19.00 Wib</td>
            </tr>
            <tr>
                <td class="text3">Pola BAK</td>
                <td class="text3" colspan="3">:  3 kali/hari, Terakhir Jam 19.00 Wib</td>
            </tr>
            <tr>
                <td class="text3">Pola BAB</td>
                <td class="text3" colspan="3">:  3 kali/hari, Terakhir Jam 19.00 Wib</td>
            </tr>
            <tr>
                <td class="text3">Pola Istirahat</td>
                <td class="text3" colspan="3">:  Terakhir Jam</td>
            </tr>
            <tr>
                <td class="text3"><b>Data Psikologi & Sosial</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Rumah Tinggal</td>
                <td class="text3" colspan="3">:  </td>
            </tr>
            <tr>
                <td class="text3">Tinggal bersama</td>
                <td class="text3" colspan="3">:  </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="150">PJ Darurat</td>
                            <td class="text3">:  gilang jayanto</td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="100">Hubungan</td>
                            <td class="text3">: Suami </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="text3">Aktivitas</td>
                <td class="text3" colspan="3">:  </td>
            </tr>
            <tr>
                <td class="text3">Sosial Support</td>
                <td class="text3" colspan="3">:  </td>
            </tr>
            <tr>
                <td class="text3">Penerima Persalinan</td>
                <td class="text3" colspan="3">:  </td>
            </tr>
            <tr>
                <td class="text3"><b>Vital Sign</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="150">Suhu</td>
                            <td class="text3">:</td>
                        </tr>
                        <tr>
                            <td class="text3">Respirasi</td>
                            <td class="text3">: x/menit</td>
                        </tr>
                        <tr>
                            <td class="text3">Tinggi Badan</td>
                            <td class="text3">: cm</td>
                        </tr>
                        <tr>
                            <td class="text3">Berat Badan</td>
                            <td class="text3">: kg</td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="100">Nadi</td>
                            <td class="text3">: x/menit</td>
                        </tr>
                        <tr>
                            <td class="text3">Tekanan Darah</td>
                            <td class="text3">: mmHg</td>
                        </tr>
                        <tr>
                            <td class="text3">Berat Badan Sebelum Hamil</td>
                            <td class="text3">: Kg</td>
                        </tr>
                        <tr>
                            <td class="text3">Alat Bantu</td>
                            <td class="text3">:</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="text3"><b>Pemeriksaan Umum</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Keadaan Umum</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Kesadaran</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3"><b>Pemeriksaan Fisik</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="150">Mata</td>
                            <td class="text3">:</td>
                        </tr>
                        <tr>
                            <td class="text3">Konjungtiva</td>
                            <td class="text3">:</td>
                        </tr>
                        <tr>
                            <td class="text3">Telinga</td>
                            <td class="text3">:   </td>
                        </tr>
                        <tr>
                            <td class="text3">Tenggorokan</td>
                            <td class="text3">:   </td>
                        </tr>
                        <tr>
                            <td class="text3">Dada</td>
                            <td class="text3">:   </td>
                        </tr>
                        <tr>
                            <td class="text3">Paru Paru</td>
                            <td class="text3">:   </td>
                        </tr>
                        <tr>
                            <td class="text3">Anggota Gerak Atas</td>
                            <td class="text3">:   </td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="100">Sklera</td>
                            <td class="text3">:  </td>
                        </tr>
                        <tr>
                            <td class="text3">Kepala</td>
                            <td class="text3">:     </td>
                        </tr>
                        <tr>
                            <td class="text3">Hidung</td>
                            <td class="text3">:     </td>
                        </tr>
                        <tr>
                            <td class="text3">Leher</td>
                            <td class="text3">:     </td>
                        </tr>
                        <tr>
                            <td class="text3">Jantung</td>
                            <td class="text3">:     </td>
                        </tr>
                        <tr>
                            <td class="text3">Abdomen</td>
                            <td class="text3">:     </td>
                        </tr>
                        <tr>
                            <td class="text3">Anggota Gerak Bawah</td>
                            <td class="text3">:     </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="text3"><b>Pemeriksaan Khusus</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="150">Dada</td>
                            <td class="text3">:</td>
                        </tr>
                        <tr>
                            <td class="text3">Leopod I</td>
                            <td class="text3">:</td>
                        </tr>
                        <tr>
                            <td class="text3">Leopod II</td>
                            <td class="text3">:</td>
                        </tr>
                        <tr>
                            <td class="text3">Leopod III</td>
                            <td class="text3">:</td>
                        </tr>
                        <tr>
                            <td class="text3">Leopod IV</td>
                            <td class="text3">:</td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="100">Auskultasi</td>
                            <td class="text3">:  </td>
                        </tr>
                        <tr>
                            <td class="text3">Inspeksi Ano Genital</td>
                            <td class="text3">:     </td>
                        </tr>
                        <tr>
                            <td class="text3">Inspeksi Abdomen</td>
                            <td class="text3">:     </td>
                        </tr>
                        <tr>
                            <td class="text3">Kontraksi</td>
                            <td class="text3">:     </td>
                        </tr>
                        <tr>
                            <td class="text3">Vagina Toucher</td>
                            <td class="text3">:     </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="text3"><b>Assesmen Nyeri</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Ada Nyeri</td>
                <td class="text3" colspan="3">: -</td>
            </tr>
            <tr>
                <td class="text3">Provokatif</td>
                <td class="text3" colspan="3">: -</td>
            </tr>
            <tr>
                <td class="text3">Quality</td>
                <td class="text3" colspan="3">: -</td>
            </tr>
            <tr>
                <td class="text3">Regio</td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Severity</td>
                <td class="text3" colspan="3">: -</td>
            </tr>
            <tr>
                <td class="text3">Time</td>
                <td class="text3" colspan="3">: -</td>
            </tr>
            <tr>
                <td class="text3"><b>Skrining Nutrisi</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Penurunan berat badan yang tidak diinginkan selama 6 bulan terakhir</td>
                <td class="text3" colspan="3"> : -</td>
            </tr>
            <tr>
                <td class="text3">Asupan makanan menurun dikarenakan adanya penurunan nafsu makan</td>
                <td class="text3" colspan="3">: -</td>
            </tr>
            <tr>
                <td class="text3"><b>Status Fungsional</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Penglihatan</td>
                <td class="text3" colspan="3">: -</td>
            </tr>
            <tr>
                <td class="text3">Penciuman</td>
                <td class="text3" colspan="3">: -</td>
            </tr>
            <tr>
                <td class="text3">Pendengaran</td>
                <td class="text3" colspan="3">: -</td>
            </tr>
            <tr>
                <td class="text3">Butuh Penerjemah</td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3"><b>Kebidanan</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Masalah kebidanan</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Diagnosa kebidanan</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Rencana tindakan</td>
                <td class="text3" colspan="3">: </td>
            </tr>
        </table>
        <table style="border: 1px solid black; border-top: none;" width="100%">
            <tr>
                <td style="padding-top: 50px;" width="60%" class="text5"></td>
                <td style="padding-top: 50px;" class="text5">Tanggal 27-07-2024 Jam 11.00</td>
            </tr>
            <tr>
                <td width="70%" class="text5"></td>
                <td class="text5" style="padding-left: 30px;"><img src="img/barcode.jpeg" width="50" height="50" /></td>
            </tr>
            <tr>
                <td width="60%" class="text5"></td>
                <td class="text5" style="padding-right: 50px;">(Perawat)</td>
            </tr>
        </table>
    </body>
</html>

{{-- Assesmen Neonatus IGD --}}
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
                <td class="text2" colspan="4" style="text-align: center; border: 1px solid black"><b>ASESMEN RAWAT JALAN IGD</b></td>
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
        <br>
        <table style="border: 1px solid black; border-bottom:none " width="100%">
            <tr>
                <td class="text2" colspan="4" style="text-align: center; border: 1px solid black"><b>ASESMEN NEONATUS IGD</b></td>
            </tr>
            <tr>
                <td class="text3" width="150">Tanggal dan Jam Masuk ruangan</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Kriteria saat masuk</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Diagnosa medis</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">DPJP</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="150">Jenis Kelamin</td>
                            <td class="text3">:</td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="100">Tanggal Lahir</td>
                            <td class="text3">: </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="text3">Diagnosa Masuk</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Nama Ayah</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Nama Ibu</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Pekerjaan Orang Tua</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Jaminan</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3"><b>Status Bio-Sosio-Kultur</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="150">Agama</td>
                            <td class="text3">:</td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="100">Suku</td>
                            <td class="text3">: </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="text3"><b>Riwayat Kesehatan</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Riwayat Penyakit Dahulu</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Riwayat Imunisasi</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3"><b>Riwayat Kehamilan</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Usia Kehamilan</td>
                <td class="text3" colspan="3">:  bulan</td>
            </tr>
            <tr>
                <td class="text3">Anak ke</td>
                <td class="text3" colspan="3">:  </td>
            </tr>
            <tr>
                <td class="text3">Jumlah anak</td>
                <td class="text3" colspan="3">:  </td>
            </tr>
            <tr>
                <td class="text3"><b>Riwayat Persalinan</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="150">Prenatal</td>
                            <td class="text3">:</td>
                        </tr>
                        <tr>
                            <td class="text3">Intrantal</td>
                            <td class="text3">: </td>
                        </tr>
                        <tr>
                            <td class="text3">Warna Ketuban</td>
                            <td class="text3">: </td>
                        </tr>
                        <tr>
                            <td class="text3">Tindakan yang dilakukan sebelum dirawat inap</td>
                            <td class="text3">: </td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="100">Natal</td>
                            <td class="text3">: </td>
                        </tr>
                        <tr>
                            <td class="text3">Posnatal</td>
                            <td class="text3">: </td>
                        </tr>
                        <tr>
                            <td class="text3">Pasien ditangani oleh</td>
                            <td class="text3">: </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="150">Suhu</td>
                            <td class="text3">:</td>
                        </tr>
                        <tr>
                            <td class="text3">Respirasi</td>
                            <td class="text3">: x/menit</td>
                        </tr>
                        <tr>
                            <td class="text3">Tinggi Badan</td>
                            <td class="text3">: cm</td>
                        </tr>
                        <tr>
                            <td class="text3">Berat Badan Masuk</td>
                            <td class="text3">: kg</td>
                        </tr>
                        <tr>
                            <td class="text3">Berat Badan Lahir</td>
                            <td class="text3">: kg</td>
                        </tr>
                        <tr>
                            <td class="text3">A / S</td>
                            <td class="text3">: </td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="100">Nadi</td>
                            <td class="text3">: x/menit</td>
                        </tr>
                        <tr>
                            <td class="text3">Satunasi Oksigen</td>
                            <td class="text3">: </td>
                        </tr>
                        <tr>
                            <td class="text3">Lingkar Kepala</td>
                            <td class="text3">: </td>
                        </tr>
                        <tr>
                            <td class="text3">Lingkar Dada</td>
                            <td class="text3">:</td>
                        </tr>
                        <tr>
                            <td class="text3">Lingkar Lengan</td>
                            <td class="text3">:</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="text3"><b>Riwayat Alergi</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Riwayat Alergi</td>
                <td class="text3" colspan="3">:  </td>
            </tr>
            <tr>
                <td class="text3">Kesadaran</td>
                <td class="text3" colspan="3">:  </td>
            </tr>
            <tr>
                <td class="text3"><b>Vital Sign</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="150">Suhu</td>
                            <td class="text3">:</td>
                        </tr>
                        <tr>
                            <td class="text3">Respirasi</td>
                            <td class="text3">: x/menit</td>
                        </tr>
                        <tr>
                            <td class="text3">Tinggi Badan</td>
                            <td class="text3">: cm</td>
                        </tr>
                        <tr>
                            <td class="text3">Berat Badan Masuk</td>
                            <td class="text3">: kg</td>
                        </tr>
                        <tr>
                            <td class="text3">Berat Badan Lahir</td>
                            <td class="text3">: kg</td>
                        </tr>
                        <tr>
                            <td class="text3">A / S</td>
                            <td class="text3">: </td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="100">Nadi</td>
                            <td class="text3">: x/menit</td>
                        </tr>
                        <tr>
                            <td class="text3">Satunasi Oksigen</td>
                            <td class="text3">: </td>
                        </tr>
                        <tr>
                            <td class="text3">Lingkar Kepala</td>
                            <td class="text3">: </td>
                        </tr>
                        <tr>
                            <td class="text3">Lingkar Dada</td>
                            <td class="text3">:</td>
                        </tr>
                        <tr>
                            <td class="text3">Lingkar Lengan</td>
                            <td class="text3">:</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="text3"><b>Pemeriksaan Kepala dan Leher</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="150">Kepala</td>
                            <td class="text3">:</td>
                        </tr>
                        <tr>
                            <td class="text3">Mata</td>
                            <td class="text3">:</td>
                        </tr>
                        <tr>
                            <td class="text3">Palpebra</td>
                            <td class="text3">:</td>
                        </tr>
                        <tr>
                            <td class="text3">Telinga</td>
                            <td class="text3">:   </td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="100">Mulut</td>
                            <td class="text3">:  </td>
                        </tr>
                        <tr>
                            <td class="text3">Leher</td>
                            <td class="text3">:     </td>
                        </tr>
                        <tr>
                            <td class="text3">Hidung</td>
                            <td class="text3">:     </td>
                        </tr>
                        <tr>
                            <td class="text3">Pupil</td>
                            <td class="text3">:     </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="text3"><b>Pemeriksaan Jantung dan Paru</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3" width="150">Dada</td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Irama Nafas</td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Bunyi Nafas</td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3"><b>Pemeriksaan Gastroinestinal</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="150">Abdomen</td>
                            <td class="text3">:</td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="100">Tali Pusat</td>
                            <td class="text3">:  </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="text3"><b>Pemeriksaan Status Nutrisi</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Regurgitasi</td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Refleks Menghisap</td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Refleks Menelan</td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3"><b>Pemeriksaan Genitourinaria</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="150">Genitalia</td>
                            <td class="text3">:</td>
                        </tr>
                        <tr>
                            <td class="text3" width="150">Mekonium</td>
                            <td class="text3">:</td>
                        </tr>
                        <tr>
                            <td class="text3" width="150">Bab</td>
                            <td class="text3">:</td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="100">Anus</td>
                            <td class="text3">:  </td>
                        </tr>
                        <tr>
                            <td class="text3" width="100">Bak</td>
                            <td class="text3">:  </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="text3"><b>Pemeriksaan Muskuloskeletal dan Integumentum</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="150">Ekstremitas atas / bawah</td>
                            <td class="text3">:</td>
                        </tr>
                        <tr>
                            <td class="text3" width="150">Turgor</td>
                            <td class="text3">:</td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="100">Kelainan Fisik</td>
                            <td class="text3">:  </td>
                        </tr>
                        <tr>
                            <td class="text3" width="100">Warna Kulit</td>
                            <td class="text3">:  </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="text3"><b>SKALA NYERI - NIPS
                    (NEONATAL INFANT PAINT SCORE)</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Ekspresi Wajah</td>
                <td class="text3" colspan="3">: -</td>
            </tr>
            <tr>
                <td class="text3">Tangisan</td>
                <td class="text3" colspan="3">: -</td>
            </tr>
            <tr>
                <td class="text3">Pola Nafas</td>
                <td class="text3" colspan="3">: -</td>
            </tr>
            <tr>
                <td class="text3">Tangan</td>
                <td class="text3" colspan="3">: -</td>
            </tr>
            <tr>
                <td class="text3">Kaki</td>
                <td class="text3" colspan="3">: -</td>
            </tr>
            <tr>
                <td class="text3">Kesadaran</td>
                <td class="text3" colspan="3">: -</td>
            </tr>
            <tr>
                <td class="text3"><b>Analisis dan Rencana keperawatan</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Masalah Keperawatan</td>
                <td class="text3" colspan="3">: -</td>
            </tr>
            <tr>
                <td class="text3">Rencana Keperawatan</td>
                <td class="text3" colspan="3">: -</td>
            </tr>
            <tr>
                <td class="text3"><b>Kebutuhan Edukasi</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Terdapat Hambatan dalam Pembelajaran ?</td>
                <td class="text3" colspan="3">: -</td>
            </tr>
            <tr>
                <td class="text3">Butuh Penerjemah ?</td>
                <td class="text3" colspan="3">: -</td>
            </tr>
            <tr>
                <td class="text3">Kebutuhan Edukasi ?</td>
                <td class="text3" colspan="3">: -</td>
            </tr>
            <tr>
                <td class="text3"><b>Rencana Pulang / Discharge Planning Awal</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Perawatan Bayi Baru Lahir ?</td>
                <td class="text3" colspan="3">: -</td>
            </tr>
            <tr>
                <td class="text3">Lainnya</td>
                <td class="text3" colspan="3">: -</td>
            </tr>
        </table>
        <table style="border: 1px solid black; border-top: none;" width="100%">
            <tr>
                <td style="padding-top: 50px;" width="60%" class="text5"></td>
                <td style="padding-top: 50px;" class="text5">Tanggal 27-07-2024 Jam 11.00</td>
            </tr>
            <tr>
                <td width="70%" class="text5"></td>
                <td class="text5" style="padding-left: 30px;"><img src="img/barcode.jpeg" width="50" height="50" /></td>
            </tr>
            <tr>
                <td width="60%" class="text5"></td>
                <td class="text5" style="padding-right: 50px;">(Perawat)</td>
            </tr>
        </table>
    </body>
</html>

{{-- Assesmen Medis IGD --}}
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
                <td class="text2" colspan="4" style="text-align: center; border: 1px solid black"><b>ASESMEN RAWAT JALAN IGD</b></td>
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
        <br>
        <table style="border: 1px solid black; border-bottom:none " width="100%">
            <tr>
                <td class="text2" colspan="4" style="text-align: center; border: 1px solid black"><b>ASESMEN MEDIS IGD</b></td>
            </tr>
            <tr>
                <td class="text3" width="200"><b>Anamnesa (S)</b></td>
                <td class="text3" colspan="3">: {{$medis->FS_ANAMNESA}}</td>
            </tr>
            <tr>
                <td class="text3">Riwayat Penyakit Dahulu</td>
                <td class="text3" colspan="3">: {{$medis->RIW_PENYAKIT_DAHULU}}</td>
            </tr>
            <tr>
                <td class="text3">Riwayat Penyakit Sekarang</td>
                <td class="text3" colspan="3">: {{$medis->RIW_PENYAKIT_NOW ?? ''}}</td>
            </tr>
            <tr>
                <td class="text3">Riwayat Perawatan Sebelumnya</td>
                <td class="text3" colspan="3">: {{$medis->RIW_PERAWATAN}}</td>
            </tr>
            <tr>
                <td class="text3">Terapi & Tindakan yang pernah dilakukan</td>
                <td class="text3" colspan="3">: {{$medis->RIW_TINDAKAN}}</td>
            </tr>
            <tr>
                <td class="text3">Riwayat Alergi</td>
                <td class="text3" colspan="3">: {{$assesmenPerawat->FS_ALERGI}}</td>
            </tr>
            <tr>
                <td class="text3">Reaksi Alergi</td>
                <td class="text3" colspan="3">: {{$assesmenPerawat->FS_REAK_ALERGI}}</td>
            </tr>
            <tr>
                <td class="text3">Status Psikologi</td>
                <td class="text3" colspan="3">: 
                    @if($medis->FS_STATUS_PSIK == '1')
                        Tenang
                    @elseif($medis->FS_STATUS_PSIK == '2')
                        Cemas
                    @elseif($medis->FS_STATUS_PSIK == '3')
                        Takut
                    @elseif($medis->FS_STATUS_PSIK == '4')
                        Marah
                    @elseif($medis->FS_STATUS_PSIK == '5')
                        Sedih
                    @elseif($medis->FS_STATUS_PSIK == '6')
                        {{$medis->FS_STATUS_PSIK2}}
                    @else
                        -
                    @endif
                </td>
            </tr>
            <tr>
                <td class="text3">Status Mental</td>
                <td class="text3" colspan="3">: {{$medis->MENTAL}}</td>
            </tr>
            <tr>
                <td class="text3">Pemeriksaan Fisik</td>
                <td class="text3" colspan="3">: {{$medis->PEMERIKSAAN_FISIK}}</td>
            </tr>
            <tr>
                <td class="text3"><b>Kepala Leher</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Konjungtiva</td>
                <td class="text3" colspan="3">: {{$medis->KONJUNGTIVA}}</td>
            </tr>
            <tr>
                <td class="text3">Sklera</td>
                <td class="text3" colspan="3">: {{$medis->SKELERA}}</td>
            </tr>
            <tr>
                <td class="text3">Bibir/Lidah</td>
                <td class="text3" colspan="3">: {{$medis->BIBIR}}</td>
            </tr>
            <tr>
                <td class="text3">Mukos</td>
                <td class="text3" colspan="3">: {{$medis->MUKOSA}}</td>
            </tr>
            <tr>
                <td class="text3">Deviasi Trakea</td>
                <td class="text3" colspan="3">: {{$medis->DEVIASI}}</td>
            </tr>
            <tr>
                <td class="text3">JVP</td>
                <td class="text3" colspan="3">: {{$medis->JVP}}</td>
            </tr>
            <tr>
                <td class="text3">Thorax</td>
                <td class="text3" colspan="3">: {{$medis->THORAX}}</td>
            </tr>
            <tr>
                <td class="text3">Jantung</td>
                <td class="text3" colspan="3">: {{$medis->JANTUNG}}</td>
            </tr>
            <tr>
                <td class="text3">Abdomen</td>
                <td class="text3" colspan="3">: {{$medis->ABDOMEN}}</td>
            </tr>
            <tr>
                <td class="text3">Pinggang</td>
                <td class="text3" colspan="3">: {{$medis->PINGGANG}}</td>
            </tr>
            <tr>
                <td class="text3">Ekstremitas</td>
                <td class="text3" colspan="3">: - Atas {{$medis->EKS_ATAS}},- Bawah {{$medis->EKS_BAWAH}}</td>
            </tr>
            <tr>
                <td class="text3">Diagnosa (A)</td>
                <td class="text3" colspan="3">: {{$medis->FS_DIAGNOSA}}</td>
            </tr>
            <tr>
                <td class="text3">Tindakan (P)</td>
                <td class="text3" colspan="3">: {{$medis->RENCANA}}</td>
            </tr>
            <tr>
                <td class="text3">Diet</td>
                <td class="text3" colspan="3">: {{$medis->DIET}}</td>
            </tr>
            <tr>
                <td class="text3">Konsul DPJP 1</td>
                <td class="text3" colspan="3">: 
                    @php
                        $rjk = $medis->KD_DOKTER_KONSUL;
                        $dpjp = '';

                        if (is_numeric($rjk)) {
                            $data = DB::connection('db_rsmm')
                                ->table('DOKTER')
                                ->select('Nama_Dokter')
                                ->where('Kode_Dokter', $rjk)
                                ->first();

                            if ($data) {
                                $dpjp = $data->Nama_Dokter;
                            }
                        }
                    @endphp
                    {{ $dpjp }}
                </td>
            </tr>
            <tr>
                <td class="text3">Isi Konsul</td>
                <td class="text3" colspan="3">: {{$medis->KONSUL}}</td>
            </tr>
            @if ($medis->KD_DOKTER_KONSUL2 != '')
                <tr>
                    <td class="text3">Konsul DPJP 2</td>
                    <td class="text3" colspan="3">:
                        @php
                            $rjk = $medis->KD_DOKTER_KONSUL2;
                            $dpjp2 = '';

                            if (is_numeric($rjk)) {
                                $data = DB::connection('db_rsmm')
                                    ->table('DOKTER')
                                    ->select('Nama_Dokter')
                                    ->where('Kode_Dokter', $rjk)
                                    ->first();

                                if ($data) {
                                    $dpjp2 = $data->Nama_Dokter;
                                }
                            }
                        @endphp
                        {{ $dpjp2 }}
                    </td>
                </tr>
                <tr>
                    <td class="text3">Isi Konsul 2</td>
                    <td class="text3" colspan="3">: {{$medis->KONSUL2}}</td>
                </tr>
            @endif
            @if ($medis->KD_DOKTER_KONSUL3 != '')
                <tr>
                    <td class="text3">Konsul DPJP 3</td>
                    <td class="text3" colspan="3">:
                        @php
                            $rjk = $medis->KD_DOKTER_KONSUL3;
                            $dpjp3 = '';

                            if (is_numeric($rjk)) {
                                $data = DB::connection('db_rsmm')
                                    ->table('DOKTER')
                                    ->select('Nama_Dokter')
                                    ->where('Kode_Dokter', $rjk)
                                    ->first();

                                if ($data) {
                                    $dpjp3 = $data->Nama_Dokter;
                                }
                            }
                        @endphp
                        {{ $dpjp3 }}
                    </td>
                </tr>
                <tr>
                    <td class="text3">Isi Konsul 3</td>
                    <td class="text3" colspan="3">: {{$medis->KONSUL3}}</td>
                </tr>
            @endif
            <tr>
                <td class="text3">Kondisi Akhir</td>
                <td class="text3" colspan="3">: {{$medis->KONDISI_AKHIR}}</td>
            </tr>
            <tr>
                <td class="text3">Jam Selesai periksa</td>
                <td class="text3" colspan="3">: {{date('H:i:s', strtotime($medis->JAM_SELESAI))}}</td>
            </tr>
        </table>
        <table style="border: 1px solid black; border-top: none;" width="100%">
            <tr>
                <td style="padding-top: 50px;" width="60%" class="text5"></td>
                <td style="padding-top: 50px;" class="text5">Tanggal {{date('d-m-Y', strtotime($medis->MDD))}}</td>
            </tr>
            <tr>
                <td width="70%" class="text5"></td>
                <td class="text5" style="padding-left: 50px;">{!! DNS2D::getBarcodeHTML($medis->NAMALENGKAP, 'QRCODE', 2, 2) !!}</td>
            </tr>
            <tr>
                <td width="60%" class="text5"></td>
                <td class="text5" style="padding-right: 30px;">({{$medis->NAMALENGKAP}})</td>
            </tr>
        </table>
    </body>
</html>


{{-- Hasil USG, RAD, LAB, RESEP --}}
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
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">: 
                    
                </td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text5"></td>
                <td class="text5" colspan="3">Tanggal 27-07-2024, Jam 11.00</td>
            </tr>
            <tr>
                <td width="70%" class="text5"></td>
                <td class="text5" colspan="3" style="padding-left: 30px;"><img src="img/barcode.jpeg" width="50" height="50" /></td>
            </tr>
            <tr>
                <td width="50%" class="text5"></td>
                <td class="text5" colspan="3">(Perawat)</td>
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