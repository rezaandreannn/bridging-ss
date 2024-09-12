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
