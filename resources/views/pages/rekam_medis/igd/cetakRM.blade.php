
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
                <td class="text3" colspan="3">: 29-07-2024</td>
            </tr>
            <tr>
                <td class="text3">Jam Datang</td>
                <td class="text3" colspan="3">: 14.00</td>
            </tr>
            <tr>
                <td class="text3">Cara Masuk</td>
                <td class="text3" colspan="3">: Kursi Roda</td>
            </tr>
            <tr>
                <td class="text3">Sudah Terpasang</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Alasan Kedatangan</td>
                <td class="text3" colspan="3">:  Datang Sendiri </td>
            </tr>
            <tr>
                <td class="text3">Kendaraan</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Identitas Pengantar</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">No Pengantar</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Kasus Trauma</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Trauma</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3"><b>Kontak Awal pasien</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Keluhan Utama</td>
                <td class="text3" colspan="3">:  hamil anak ke 2 UK 30 minggu, mengeluh keluar darah segar pukul 00.00 wib, mules (-), riwayat PP</td>
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
                            <td class="text3">: Sadar</td>
                        </tr>
                        <tr>
                            <td class="text3">Suhu</td>
                            <td class="text3">: 36.4</td>
                        </tr>
                        <tr>
                            <td class="text3">Respirasi</td>
                            <td class="text3">: 20x/menit</td>
                        </tr>
                        <tr>
                            <td class="text3">Saturasi O2</td>
                            <td class="text3">: 99</td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="100">Nadi</td>
                            <td class="text3">: 77x/menit</td>
                        </tr>
                        <tr>
                            <td class="text3">Tekanan Darah</td>
                            <td class="text3">:  125/92mmHg</td>
                        </tr>
                        <tr>
                            <td class="text3">Berat Badan</td>
                            <td class="text3">: 60Kg</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="text3"><b>Kesimpulan</b></td>
                <td class="text3" colspan="3"> Prioritas III (0-1)</td>
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
                            <td class="text3">: 0</td>
                        </tr>
                        <tr>
                            <td class="text3">Suhu</td>
                            <td class="text3">: 0</td>
                        </tr>
                        <tr>
                            <td class="text3">Respirasi</td>
                            <td class="text3">: 1</td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="100">Nadi</td>
                            <td class="text3">: 0</td>
                        </tr>
                        <tr>
                            <td class="text3">Tekanan Darah</td>
                            <td class="text3">: 1</td>
                        </tr>
                        <tr>
                            <td class="text3">Saturasi O2</td>
                            <td class="text3">: 0</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="text3"><b>Total Skor</b></td>
                <td class="text3" colspan="3"> 1</td>
            </tr>
            <tr>
                <td class="text3">Catatan Khusus</td>
                <td class="text3" colspan="3">: anak ke 1 SC tahun 20199 di RSPH, vaksin covid boster </td>
            </tr>
            <tr>
                <td class="text3">Keputusan</td>
                <td class="text3" colspan="3">: 01:03:00.0000000 </td>
            </tr>
        </table>
        <table style="border: 1px solid black; border-top: none;" width="100%">
            <tr>
                <td style="padding-top: 50px;" class="text5"></td>
                <td style="padding-top: 50px;" class="text5">Tanggal 27-07-2024, Jam 11.00</td>
            </tr>
            <tr>
                <tr>
                    <td width="70%" class="text5"></td>
                    <td class="text5" style="padding-left: 30px;"><img src="img/barcode.jpeg" width="50" height="50" /></td>
                </tr>
            </tr>
            <tr>
                <td width="50%" class="text5"></td>
                <td class="text5">(Perawat)</td>
            </tr>
        </table>
    </body>
</html>


{{-- Assesmen Keperawatn IGD --}}
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
                <td class="text3" width="200">Keluhan Utama</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Keluhan Penyakit Sekarang</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Status Kehamilan</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3"><b>BIO SOSIO</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Status Pernikahan</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Pekerjaan</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Suku</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Agama</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3"><b>OBJEKTIF</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Psikologis</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Mental</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Kesadaran</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">GCS</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Keadaan Umum</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3"><b>Vital Sign</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="200">Suhu</td>
                            <td class="text3">: 36.4</td>
                        </tr>
                        <tr>
                            <td class="text3">Respirasi</td>
                            <td class="text3">: 20x/menit</td>
                        </tr>
                        <tr>
                            <td class="text3">Tinggi Badan</td>
                            <td class="text3">: 152cm</td>
                        </tr>
                        <tr>
                            <td class="text3">Lingkar Kepala</td>
                            <td class="text3">: cm</td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3" width="150">Nadi</td>
                            <td class="text3">: 36.4x/menit</td>
                        </tr>
                        <tr>
                            <td class="text3">Tekanan Darah</td>
                            <td class="text3">: 125/92mmHg</td>
                        </tr>
                        <tr>
                            <td class="text3">Berat Badan</td>
                            <td class="text3">: 60Kg</td>
                        </tr>
                        <tr>
                            <td class="text3">Status Gizi</td>
                            <td class="text3">:</td>
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
                <td class="text3" colspan="3">:  </td>
            </tr>
            <tr>
                <td class="text3">Cacat</td>
                <td class="text3" colspan="3">:  </td>
            </tr>
            <tr>
                <td class="text3">ADL</td>
                <td class="text3" colspan="3">:  </td>
            </tr>
            <tr>
                <td class="text3"><b>ASESMEN NYERI</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3">Ada Nyeri</td>
                            <td class="text3">:</td>
                        </tr>
                        <tr>
                            <td class="text3">Provoke</td>
                            <td class="text3">:</td>
                        </tr>
                        <tr>
                            <td class="text3">Quality</td>
                            <td class="text3">:   </td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3">Regio</td>
                            <td class="text3">:  </td>
                        </tr>
                        <tr>
                            <td class="text3">Severity</td>
                            <td class="text3">:     </td>
                        </tr>
                        <tr>
                            <td class="text3">Time</td>
                            <td class="text3">: </td>
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
                            <td class="text3">Irama Nafas</td>
                            <td class="text3">:</td>
                        </tr>
                        <tr>
                            <td class="text3">Pola Pernafasan</td>
                            <td class="text3">:</td>
                        </tr>
                        <tr>
                            <td class="text3">Alat Bantu Nafas</td>
                            <td class="text3">:   </td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3">Batuk</td>
                            <td class="text3">:  </td>
                        </tr>
                        <tr>
                            <td class="text3">Suara Nafas</td>
                            <td class="text3">:     </td>
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
                            <td class="text3">Nyeri Dada</td>
                            <td class="text3">:</td>
                        </tr>
                        <tr>
                            <td class="text3">Pendarahan</td>
                            <td class="text3">:</td>
                        </tr>
                        <tr>
                            <td class="text3">CRT</td>
                            <td class="text3">:   </td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3">Akral</td>
                            <td class="text3">:  </td>
                        </tr>
                        <tr>
                            <td class="text3">Cyanosis</td>
                            <td class="text3">:     </td>
                        </tr>
                        <tr>
                            <td class="text3">Turgor</td>
                            <td class="text3">:     </td>
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
                            <td class="text3">Reflek Cahaya</td>
                            <td class="text3">:</td>
                        </tr>
                        <tr>
                            <td class="text3">Kelumpuhan</td>
                            <td class="text3">:</td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3">Pupil</td>
                            <td class="text3">:  </td>
                        </tr>
                        <tr>
                            <td class="text3">Pusing</td>
                            <td class="text3">:     </td>
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
                            <td class="text3">BAK</td>
                            <td class="text3">:</td>
                        </tr>
                        <tr>
                            <td class="text3">Urine</td>
                            <td class="text3">:</td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3">Nyeri Tekan</td>
                            <td class="text3">:  </td>
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
                            <td class="text3">BAB</td>
                            <td class="text3">:</td>
                        </tr>
                        <tr>
                            <td class="text3">Nyeri Tekan</td>
                            <td class="text3">:</td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3">Abdomen</td>
                            <td class="text3">:  </td>
                        </tr>
                        <tr>
                            <td class="text3">Jejas Abdomen</td>
                            <td class="text3">:  </td>
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
                            <td class="text3">Pergerakan Sendi</td>
                            <td class="text3">:</td>
                        </tr>
                        <tr>
                            <td class="text3">Fraktur</td>
                            <td class="text3">:</td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3">Dislokasi</td>
                            <td class="text3">:  </td>
                        </tr>
                        <tr>
                            <td class="text3">Luka</td>
                            <td class="text3">:  </td>
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
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Pasien inkontinensiauri / alvi</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Riwayat dekubitus atau luka dekubitus</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Usia diatas 65 tahun</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Ekstremitas dan badan tidak sesuai dengan usia perkembangan</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3"><b>Status Fungsional</b></td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Penglihatan</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Pendengaran</td>
                <td class="text3" colspan="3">:  </td>
            </tr>
            <tr>
                <td class="text3">Penciuman</td>
                <td class="text3" colspan="3">:  </td>
            </tr>
            <tr>
                <td class="text3"><b>Keperawatan</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Masalah Keperawatan</td>
                <td class="text3" colspan="3">:  </td>
            </tr>
            <tr>
                <td class="text3">Rencana Keperawatan</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Jam selesai periksa</td>
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
                <td class="text3">Cara masuk</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Rujukan dari</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Membawa obat sendiri</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3"><b>Data Suami</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Nama</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Tanggal Lahir</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Pekerjaan</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Agama</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3"><b>Data Pasien</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Pekerjaan Pasien</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Pendidikan Pasien</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3">Agama</td>
                <td class="text3" colspan="3">: </td>
            </tr>
            <tr>
                <td class="text3"><b>Riwayat Haid</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3">Menarche</td>
                            <td class="text3">:</td>
                        </tr>
                        <tr>
                            <td class="text3">Lama haid</td>
                            <td class="text3">:</td>
                        </tr>
                        <tr>
                            <td class="text3">HPL</td>
                            <td class="text3">: </td>
                        </tr>
                        <tr>
                            <td class="text3">Keluhan Utama</td>
                            <td class="text3">: </td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3">Riwayat Penyakit Dahulu</td>
                            <td class="text3">: </td>
                        </tr>
                        <tr>
                            <td class="text3">Siklus haid</td>
                            <td class="text3">: </td>
                        </tr>
                        <tr>
                            <td class="text3">Hpht</td>
                            <td class="text3">: </td>
                        </tr>
                        <tr>
                            <td class="text3">Keluhan</td>
                            <td class="text3">:</td>
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
                <td class="text3" colspan="3">:  , Dalam Terapi</td>
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
                <td class="text3" colspan="3">:  kali/hari, Terakhir Jam</td>
            </tr>
            <tr>
                <td class="text3">Pola Minum</td>
                <td class="text3" colspan="3">:  cc/hari, Terakhir Jam</td>
            </tr>
            <tr>
                <td class="text3">Pola BAK</td>
                <td class="text3" colspan="3">:  kali/hari, Terakhir Jam</td>
            </tr>
            <tr>
                <td class="text3">Pola BAB</td>
                <td class="text3" colspan="3">:  kali/hari, Terakhir Jam</td>
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
                            <td class="text3">PJ Darurat</td>
                            <td class="text3">:</td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3">Hubungan</td>
                            <td class="text3">:  </td>
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
                            <td class="text3">Suhu</td>
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
                            <td class="text3">Nadi</td>
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
                            <td class="text3">Mata</td>
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
                            <td class="text3">Sklera</td>
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
                            <td class="text3">Dada</td>
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
                            <td class="text3">Auskultasi</td>
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
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Provokatif</td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Quality</td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Regio</td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Severity</td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Time</td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3"><b>Skrining Nutrisi</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Penurunan berat badan yang tidak diinginkan selama 6 bulan terakhir</td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Asupan makanan menurun dikarenakan adanya penurunan nafsu makan</td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3"><b>Status Fungsional</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Penglihatan</td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Penciuman</td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Pendengaran</td>
                <td class="text3" colspan="3"></td>
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
                <td class="text3">Tanggal dan Jam Masuk ruangan</td>
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
                            <td class="text3">Jenis Kelamin</td>
                            <td class="text3">:</td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3">Tanggal Lahir</td>
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
                            <td class="text3">Agama</td>
                            <td class="text3">:</td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3">Suku</td>
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
                            <td class="text3">Prenatal</td>
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
                            <td class="text3">Natal</td>
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
                            <td class="text3">Suhu</td>
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
                            <td class="text3">Nadi</td>
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
                            <td class="text3">Suhu</td>
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
                            <td class="text3">Nadi</td>
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
                            <td class="text3">Kepala</td>
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
                            <td class="text3">Mulut</td>
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
                <td class="text3">Dada</td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Irama Nafas</td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td class="text3">Dada</td>
                            <td class="text3">:</td>
                        </tr>
                        <tr>
                            <td class="text3">Irama Nafas</td>
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
                            <td class="text3">Auskultasi</td>
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
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Provokatif</td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Quality</td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Regio</td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Severity</td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Time</td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3"><b>Skrining Nutrisi</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Penurunan berat badan yang tidak diinginkan selama 6 bulan terakhir</td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Asupan makanan menurun dikarenakan adanya penurunan nafsu makan</td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3"><b>Status Fungsional</b></td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Penglihatan</td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Penciuman</td>
                <td class="text3" colspan="3"></td>
            </tr>
            <tr>
                <td class="text3">Pendengaran</td>
                <td class="text3" colspan="3"></td>
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