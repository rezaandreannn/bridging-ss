
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
        <table style="border: 1px solid black; border-bottom:none " width="100%">
            <tr>
                <td class="text2" colspan="4" style="text-align: center; border: 1px solid black"><b>Assesmen Awal Keperawatan</b></td>
            </tr>
            <tr>
                <td class="text3" width="180"><b>High Risk</b></td>
                <td class="text3" colspan="3">: {{$perawat->FS_HIGH_RISK}}</td>
            </tr>
            <tr>
                <td class="text3"><b>Alergi</b></td>
                <td class="text3" colspan="3">:</td>
            </tr>
            <tr>
                <td class="text3"><b>Anamnesa/Riwayat Masuk Rumah Sakit</b></td>
                <td class="text3" colspan="3">: {{$perawat->FS_ANAMNESA}}</td>
            </tr>
            <tr>
                <td class="text3"><b>Pemeriksaan Fisik</b></td>
                <td class="text3" colspan="3">: {{$perawat->FS_PEMERIKSAAN_FISIK}}</td>
            </tr>
            <tr>
                <td class="text3"><b>Vital Sign</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="180">Suhu</td>
                            <td class="text3">: </td>
                        </tr>
                        <tr>
                            <td class="text3">Respirasi</td>
                            <td class="text3">:  x/menit</td>
                        </tr>
                        <tr>
                            <td class="text3">Tinggi Badan</td>
                            <td class="text3">: cm</td>
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
                            <td class="text3">Berat Badan</td>
                            <td class="text3">: Kg</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="text3"><b>Breathing</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="180">Irama Nafas</td>
                            <td class="text3">: {{$perawat->IRAMA_NAFAS}}</td>
                        </tr>
                        <tr>
                            <td class="text3">Pola Pernafasan</td>
                            <td class="text3">: {{$perawat->POLA_NAFAS}}</td>
                        </tr>
                        <tr>
                            <td class="text3">Alat Bantu Nafas</td>
                            <td class="text3">: {{$perawat->BANTU_NAFAS}}</td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="100">Batuk</td>
                            <td class="text3">: {{$perawat->BATUK}}</td>
                        </tr>
                        <tr>
                            <td class="text3">Suara Nafas</td>
                            <td class="text3">: {{$perawat->SUARA_NAFAS}}</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="text3"><b>Blood</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="180">Nyeri Dada</td>
                            <td class="text3">: {{$perawat->NYERI_DADA}}</td>
                        </tr>
                        <tr>
                            <td class="text3">Pendarahan</td>
                            <td class="text3">: {{$perawat->PERDARAHAN}}</td>
                        </tr>
                        <tr>
                            <td class="text3">CRT</td>
                            <td class="text3">: {{$perawat->CRT}}</td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="100">Cyanosis</td>
                            <td class="text3">: {{$perawat->CYANOSIS}}</td>
                        </tr>
                        <tr>
                            <td class="text3">Turgor</td>
                            <td class="text3">: {{$perawat->TURGOR}}</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="text3"><b>Brain</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="180">Reflek Cahaya</td>
                            <td class="text3">: {{$perawat->REFLEK_CAHAYA}}</td>
                        </tr>
                        <tr>
                            <td class="text3">Kelumpuhan</td>
                            <td class="text3">: {{$perawat->LUMPUH}}</td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="100">Pupil</td>
                            <td class="text3">: {{$perawat->PUPIL}}</td>
                        </tr>
                        <tr>
                            <td class="text3">Pusing</td>
                            <td class="text3">: {{$perawat->PUSING}}</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="text3"><b>BAK</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="180">BAK</td>
                            <td class="text3">: {{$perawat->BAK}}</td>
                        </tr>
                        <tr>
                            <td class="text3">Produksi Urine</td>
                            <td class="text3">: {{$perawat->URINE}}</td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="100">Nyeri Tekan</td>
                            <td class="text3">: {{$perawat->BAK_TEKAN}}</td>
                        </tr>
                    </table>
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
                            <td class="text3" width="180">Ada Nyeri</td>
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
                <td class="text3"><b>Resiko Jatuh</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3"><b>Riwayat Kesehatan</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Riwayat Penyakit Dahulu</td>
                <td class="text3" colspan="3">:</td>
            </tr>
            <tr>
                <td class="text3">Riwayat Penyakit Keluarga</td>
                <td class="text3" colspan="3">:</td>
            </tr>
            <tr>
                <td class="text3"><b>Status Psikologis</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3"><b>Status Sosial</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Hubungan dengan anggota keluarga</td>
                <td class="text3" colspan="3">:</td>
            </tr>
            <tr>
                <td class="text3"><b>Kebutuhan Fungsional</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="180">Makan</td>
                            <td class="text3">: </td>
                        </tr>
                        <tr>
                            <td class="text3">Mandi</td>
                            <td class="text3">: </td>
                        </tr>
                        <tr>
                            <td class="text3">Perawatan Diri</td>
                            <td class="text3">: </td>
                        </tr>
                        <tr>
                            <td class="text3">Buang air kecil</td>
                            <td class="text3">: </td>
                        </tr>
                        <tr>
                            <td class="text3">Buang air besar</td>
                            <td class="text3">: </td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="100">Penggunaan toilet</td>
                            <td class="text3">: </td>
                        </tr>
                        <tr>
                            <td class="text3">Berpakaian</td>
                            <td class="text3">: </td>
                        </tr>
                        <tr>
                            <td class="text3">Transfer</td>
                            <td class="text3">: </td>
                        </tr>
                        <tr>
                            <td class="text3">Mobilitas</td>
                            <td class="text3">: </td>
                        </tr>
                        <tr>
                            <td class="text3">Naik turun tangga</td>
                            <td class="text3">: </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="text3"><b>Skrining Nutrisi</b></td>
                <td class="text3" colspan="3"> </td>
            </tr>
            <tr>
                <td class="text3">Penurunan berat badan yang tidak diinginkan selama 6 bulan terakhir</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Asupan makanan menurun dikarenakan adanya penurunan nafsu makan</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3"><b>Spiritual dan Kultural pasien</b></td>
                <td class="text3" colspan="3"> </td>
            </tr>
            <tr>
                <td class="text3">Agama</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Nilai/kepercayaan khusus</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Bantuan Pemenuhan Kebutuhan Spiritual</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3"><b>Kebutuhan Edukasi</b></td>
                <td class="text3" colspan="3"> </td>
            </tr>
            <tr>
                <td class="text3">Edukasi</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3"><b>Scrinning Discharge Planning</b></td>
                <td class="text3" colspan="3"> </td>
            </tr>
            <tr>
                <td class="text3">Discharge Planning</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3"><b>Keperawatan</b></td>
                <td class="text3" colspan="3"> </td>
            </tr>
            <tr>
                <td class="text3">Masalah Keperawatan</td>
                <td class="text3" colspan="3">: </td>
            </tr>
        </table>
        <table style="border: 1px solid black; border-top: none;" width="100%">
            <tr>
                <td style="padding-top: 50px;" width="60%" class="text5"></td>
                <td style="padding-top: 50px;" class="text5">Tanggal  Jam </td>
            </tr>
            <tr>
                <td width="70%" class="text5"></td>
                <td class="text5" style="padding-left: 50px;"></td>
            </tr>
            <tr>
                <td width="60%" class="text5"></td>
                <td class="text5" style="padding-right: 30px;">()</td>
            </tr>
        </table>
    </body>
</html>