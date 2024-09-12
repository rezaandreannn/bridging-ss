{{-- Assesmen Keperawatan IGD --}}
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