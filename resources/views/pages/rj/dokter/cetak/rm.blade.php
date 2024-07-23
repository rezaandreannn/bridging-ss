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
            <td class="text2" colspan="4" style="text-align: center; border: 1px solid black"><b>ASESMEN ULANG RAWAT JALAN</b></td>
        </tr>
        <tr>
            <td colspan="2" style="vertical-align: top;">
                <table width="100%">
                    <tr>
                        <td class="text3"><b>Tanggal Kunjungan</b></td>
                        <td class="text3">: 13-Jan-2024</td>
                    </tr>
                    <tr>
                        <td class="text3"><b>High Risk </b></td>
                        <td class="text3">:</td>
                    </tr>
                </table>
            </td>
            <td colspan="2" style="vertical-align: top;">
                <table width="100%">
                    <tr>
                        <td class="text3"><b>Klinik Tujuan</b></td>
                        <td class="text3">: SPESIALIS PENYAKIT DALAM</td>
                    </tr>
                    <tr>
                        <td class="text3"><b>Alergi</b></td>
                        <td class="text3">: </td>
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
            <td class="text3" colspan="2">: 36.0</td>
        </tr>
        <tr>
            <td class="text3">Nadi</td>
            <td class="text3" colspan="2">: 68 x/menit</td>
        </tr>
        <tr>
            <td class="text3">R</td>
            <td class="text3" colspan="2">: 68 x/menit</td>
        </tr>
        <tr>
            <td class="text3">TD</td>
            <td class="text3" colspan="2">: 140/70 mmHg</td>
        </tr>
        <tr>
            <td class="text3">Tinggi Badan</td>
            <td class="text3" colspan="2">:  - cm</td>
        </tr>
        <tr>
            <td class="text3">Berat Badan</td>
            <td class="text3" colspan="2">: - Kg</td>
        </tr>
        <tr>
            <td class="text3"><b>Asesmen Nyeri</b></td>
            <td class="text3" colspan="2">: Tidak Ada Nyeri</td>
        </tr>
        <tr>
            <td class="text3">Provoke</td>
            <td class="text3" colspan="2">: Tidak Ada</td>
        </tr>
        <tr>
            <td class="text3">Quality</td>
            <td class="text3" colspan="2">: Tidak Ada</td>
        </tr>
        <tr>
            <td class="text3">Regio</td>
            <td class="text3" colspan="2">: - </td>
        </tr>
        <tr>
            <td class="text3">Severity</td>
            <td class="text3" colspan="2">: 0</td>
        </tr>
        <tr>
            <td class="text3">Time</td>
            <td class="text3" colspan="2">: Tidak Ada</td>
        </tr>
        <tr>
            <td class="text3"><b>Asesmen Jatuh</b></td>
            <td class="text3" colspan="2"></td>
        </tr>
        <tr>
            <td class="text3">Cara berjalan pasien Tidak seimbang/sempoyongan/limbung</td>
            <td class="text3" colspan="2">: Tidak</td>
        </tr>
        <tr>
            <td class="text3">Cara berjalan pasien dengan mengunakan alat bantu</td>
            <td class="text3" colspan="2">: Tidak</td>
        </tr>
        <tr>
            <td class="text3">Menopang saat akan duduk: </td>
            <td class="text3" colspan="2">: Tidak</td>
        </tr>
        <tr>
            <td class="text3">Kesimpulan</td>
            <td class="text3" colspan="2">: <b>Resiko Rendah</b></td>
        </tr>
        <tr>
            <td class="text3"><b>Riwayat Kesehatan</b></td>
            <td class="text3" colspan="2"></td>
        </tr>
        <tr>
            <td class="text3">Riwayat Penyakit Dahulu</td>
            <td class="text3" colspan="2">: </td>
        </tr>
        <tr>
            <td class="text3">Riwayat Penyakit Keluarga</td>
            <td class="text3" colspan="2">: -</td>
        </tr>
        <tr>
            <td class="text3"><b>Status Psikologi</b></td>
            <td class="text3" colspan="2">: Tenang</td>
        </tr>
        <tr>
            <td class="text3"><b>Status Sosial</b></td>
            <td class="text3" colspan="2"></td>
        </tr>
        <tr>
            <td class="text3">Hubungan dengan anggota keluarga</td>
            <td class="text3" colspan="2">: Baik</td>
        </tr>
        <tr>
            <td class="text3"><b>Status Fungsional</b></td>
            <td class="text3" colspan="2">: Mandiri</td>
        </tr>
        <tr>
            <td class="text3">Penglihatan</td>
            <td class="text3" colspan="2">: Normal</td>
        </tr>
        <tr>
            <td class="text3">Penciuman</td>
            <td class="text3" colspan="2">: Normal</td>
        </tr>
        <tr>
            <td class="text3">Pendengaran</td>
            <td class="text3" colspan="2">: Normal</td>
        </tr>
        <tr>
            <td class="text3"><b>Spritual dan kultural pasien</b></td>
            <td class="text3" colspan="2"></td>
        </tr>
        <tr>
            <td class="text3">Agama</td>
            <td class="text3" colspan="2">: Islam</td>
        </tr>
        <tr>
            <td class="text3">Nilai/Kepercayaan khusus</td>
            <td class="text3" colspan="2">: Tidak Ada</td>
        </tr>
        <tr>
            <td class="text3"><b>Keperawatan</b></td>
            <td class="text3" colspan="2"></td>
        </tr>
        <tr>
            <td class="text3">Masalah Keperawatan</td>
            <td class="text3" colspan="2">: Kurang pengetahuan proses penyakit</td>
        </tr>
        <tr>
            <td class="text3">Rencana Keperawatan</td>
            <td class="text3" colspan="2">: Edukasi Proses Penyakit</td>
        </tr>
    </table>
    <table style="border: 1px solid black; border-top: none;" width="100%">
        <tr>
            <td style="padding-top: 50px;" class="text5"></td>
            <td style="padding-top: 50px;" class="text5">Tanggal 2024-07-10 Jam 08:35:22</td>
        </tr>
        <tr>
            <td class="text5"></td>
            <td class="text5"><img src="img/code.png" width="65" height="65" /></td>
        </tr>
        <tr>
            <td width="50%" class="text5"></td>
            <td class="text5">(VITA VIA RANTI)</td>
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
                <td class="text3">: -kontrol hipotiroid. kel; TAK</td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3"><b>Riwayat Penyakit</b></td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">: </td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3"><b>Riwayat Penyakit Keluarga</b></td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">:</td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3"><b>Status Psikologi</b></td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">: Tenang</td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3"><b>Pemeriksaan Fisik</b></td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">: Suhu : -36 C, Nadi : -83 x/menit, Respirasi : -20 x/menit, TD : -134/82 mmHg, BB : -, TB : -, Alergi : Skala Nyeri :0, Skrining Nutrisi : Normal</td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3"><b>Diagnosa</b></td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">: Hipotiroid</td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3"><b>Daftar Masalah</b></td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">: </td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3"><b>Tindakan (P)</b></td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text3">: </td>
                <td class="text3" colspan="2"></td>
            </tr>
        </table>
        <table style="border: 1px solid black; border-top: none;" width="100%">
            <tr>
                <td style="padding-top: 50px;" class="text5"></td>
                <td style="padding-top: 50px;" class="text5">Tanggal 2024-07-10 Jam 08:35:22</td>
            </tr>
            <tr>
                <td class="text5"></td>
                <td class="text5"><img src="img/code.png" width="65" height="65" /></td>
            </tr>
            <tr>
                <td width="50%" class="text5"></td>
                <td class="text5">(VITA VIA RANTI)</td>
            </tr>
        </table>
        <p class="text7"><b>HASIL USG</b></p>
        <table style="border: 1px solid black;" width="100%">
            <tr>
                <td class="text5"></td>
                <td class="text5">Tanggal 2024-07-10 Jam 08:35:22</td>
            </tr>
            <tr>
                <td class="text5"></td>
                <td class="text5"><img src="img/code.png" width="65" height="65" /></td>
            </tr>
            <tr>
                <td width="50%" class="text5"></td>
                <td class="text5">(VITA VIA RANTI)</td>
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
        <p class="text7"><b>HASIL RADIOLOGI</b></p>
        <table width="100%">
            <thead>
                <tr>
                    <th class="tabel1">Jenis Pemeriksaan</th>
                    <th class="tabel1">Hasil</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text8">Testing</td>
                    <td class="text8">2</td>
                </tr>
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
                @foreach ($lab as $labs)
                <tr>
                    <td class="text8">{{$labs->Pemeriksaan}}</td>
                    <td class="text8">{{$labs->Hasil}}</td>
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