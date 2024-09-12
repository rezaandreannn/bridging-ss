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