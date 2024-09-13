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