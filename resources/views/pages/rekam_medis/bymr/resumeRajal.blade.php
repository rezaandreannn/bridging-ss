
{{-- TRIASE --}}
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Surat</title>
        <style>
            .isi td {
                border: 1px solid black;
                border-collapse: collapse;
            }
            .text2 {
                font-size: 18px;
                padding-left: 5px;
            }

            .text3 {
                font-size: 15px;
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
        <table style="border: 1px solid black;" class="isi" width="100%">
            <tr>
                <td class="text2" colspan="6" style="text-align: center; border: 1px solid black;"><b>RINGKASAN RAWAT JALAN</b></td>
            </tr>
            <tr>
                <td class="text3" width="100"><b>Tanggal Pelayanan</b></td>
                <td class="text3" colspan="5"> {{date('d M Y', strtotime($asesmenDokterRj->mdd))}}</td>
            </tr>
            <tr>
                <td class="text3" colspan="3">Indikasi rawat :</td>
                <td class="text3" colspan="3">Diagnosa saat masuk : {{ $asesmenDokterRj->FS_ANAMNESA}}</td>
            </tr>
            <tr>
                <td class="text3">Ringkasan Riwayat Pasien</td>
                <td class="text3" colspan="5"> {{ $asesmenDokterRj->FS_RIW_PENYAKIT_DAHULU}}</td>
            </tr>
            <tr>
                <td class="text3">Pemeriksaan Fisik</td>
                <td class="text3" colspan="5"> , {{ $asesmenDokterRj->FS_CATATAN_FISIK}}</td>
            </tr>
            <tr>
                <td class="text3">Pemeriksaan Penunjang</td>
                <td class="text3" colspan="5"> </td>
            </tr>
            <tr>
                <td class="text3">Terapi / Pengobatan </td>
                <td class="text3" colspan="5"> {{ $asesmenDokterRj->FS_TERAPI}}</td>
            </tr>
            <tr>
                <td class="text3">Hasil Laboratorium</td>
                <td class="text3" colspan="5"> </td>
            </tr>
            <tr>
                <td class="text3">Alergi</td>
                <td class="text3" colspan="5"> {{ $asesmenDokterRj->FS_ALERGI}}</td>
            </tr>
            <tr>
                <td class="text3">Tanggal Kontrol</td>
                <td class="text3" colspan="5"> {{date('d M Y', strtotime($asesmenDokterRj->mdd))}}</td>
            </tr>
            <tr>
                <td class="text3">Diagnosa Utama</td>
                <td class="text3" colspan="3"> {{ $asesmenDokterRj->FS_DIAGNOSA}}</td>
                <td class="text3" colspan="2">ICD 10:</td>
            </tr>
            {{-- <tr>
                <td class="text3">Diagnosa Utama</td>
                <td class="text3" colspan="5"> {{ $asesmenDokterRj->FS_DIAGNOSA}}</td>
            </tr> --}}
            <tr>
                <td class="text3">Diagnosa Sekunder</td>
                <td class="text3" colspan="5"> {{ $biodata->FS_DIAGNOSA_SEKUNDER}}</td>
            </tr>
            <tr>
                <td class="text3">Tindakan / Prosedur</td>
                <td class="text3" colspan="3"> {{ $asesmenDokterRj->FS_TINDAKAN}}</td>
                <td class="text3" colspan="2">ICD 9 : </td>
            </tr>
            <tr>
                <td class="text3" colspan="6"><b>Terapi yang diberikan dokter</b></td>
            </tr>
        </table>
        <table width="100%" style="border-top:none;">
            <thead>
                <tr>
                    <th class="tabel1">Nama Obat</th>
                    <th class="tabel1">Cara Pemakaian</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($resep as $reseps)
                <tr>
                    <td class="text8">{{$reseps->Nama_Obat}}</td>
                    <td class="text8">{{$reseps->Dosis}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <table  width="100%">
            <tr>
                <td style="padding-top: 100px;" class="text5"></td>
                <td style="padding-top: 100px;" class="text5">Tanggal 27-07-2024, Jam 11.00</td>
            </tr>
            <tr>
                <td class="text5">Tanda Tangan Pasien / Keluarga</td>
                <td class="text5">Tanda Tangan dan Nama DPJP</td>
            </tr>
            <tr>
                <tr>
                    <td class="text5" style="padding-left: 30px;"><img src="img/barcode.jpeg" width="50" height="50" /></td>
                    <td class="text5" style="padding-left: 30px;"><img src="img/barcode.jpeg" width="50" height="50" /></td>
                </tr>
            </tr>
            <tr>
                <td class="text5" style="padding-left: 30px;">(Perawat)</td>
                <td class="text5" style="padding-left: 30px;">(Perawat)</td>
            </tr>
        </table>
    </body>
</html>

<!DOCTYPE html>
<?php
date_default_timezone_set('Asia/Jakarta');
    $dayList = array(
        'Sun' => 'Minggu',
        'Mon' => 'Senin',
        'Tue' => 'Selasa',
        'Wed' => 'Rabu',
        'Thu' => 'Kamis',
        'Fri' => 'Jumat',
        'Sat' => 'Sabtu'
);
?>
<html lang="en">

<head>
 
</head>

<body>
    <center>
        <table width="100%">
            <tr>
                <td><img src="img/logo.png" width="50" height="50" /></td>
                <td>
                    <center>
                        <font size="2"><b>MAJELIS PEMBINAAN KESEHATAN UMUM</b></font><br />
                        <font size="2"><b>RSU MUHAMMADIYAH METRO </b></font><br />
                        <font style="font-size: 8px;">JL Soekarno Hatta No. 42 Mulyojati 16B, Fax: (0725) 47760 Metro Barat - Kota Metro 34125</font><br />
                        <font style="font-size: 8px;">Email : info.rsumm@gmail.com , Telp: (0721) 49490-7850378 , Website : www.rsumm.co.id</font>
                    </center>
                </td>
                <td><img src="img/larsibaru.png" width="50" height="50" /></td>
            </tr>
            <tr>
                <td colspan="3">
                    <hr />
                </td>
            </tr>
        </table>
        <table width="100%">
            <tr>
                <td style="text-align: center">
                    <u><b>SURAT KETERANGAN KONTROL KEMBALI KE RSUMM</b></u>
                </td>
            </tr>
        </table>
        <table width="100%">
            <tr>
                <td>No MR </td>
                <td>: {{ $biodata->NO_MR}}</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>: {{ $biodata->NAMA_PASIEN}}</td>
            </tr>
            <tr>
                <td width="100">Diagnosa </td>
                <td width="200">: {{ $asesmenDokterRj->FS_ANAMNESA}}</td>
            </tr>
            <tr>
                <td width="100">Terapi</td>
                <td width="200">:</td>
            </tr>
            <tr>
                <td colspan="4"></td>
            </tr>
        </table>
        <table width="100%" style="border-top:none;">
            <thead>
                <tr>
                    <th class="tabel1">Nama Obat</th>
                    <th class="tabel1">Cara Pemakaian</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($resep as $reseps)
                <tr>
                    <td class="text8">{{$reseps->Nama_Obat}}</td>
                    <td class="text8">{{$reseps->Dosis}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <table width="100%">
                <tr>
                    <td>
                        Pasien dapat kontrol kembali ke Rumah Sakit pada hari Kamis,01 Jan 1970 , di
                        Demikian hal ini kami sampaikan untuk dapat dipergunakan sebagaimana perlu, Terimakasih
                    </td>
                </tr>
                <table  width="100%">
                    <tr>
                        <td style="padding-top: 100px;" class="text5"></td>
                        <td style="padding-top: 100px;" class="text5">Tanggal 27-07-2024, Jam 11.00</td>
                    </tr>
                    <tr>
                        <td class="text5"></td>
                        <td class="text5">Tanda Tangan dan Nama DPJP</td>
                    </tr>
                    <tr>
                        <tr>
                            <td class="text5" style="padding-left: 30px;"></td>
                            <td class="text5" style="padding-left: 30px;"><img src="img/barcode.jpeg" width="50" height="50" /></td>
                        </tr>
                    </tr>
                    <tr>
                        <td class="text5" style="padding-left: 30px;"></td>
                        <td class="text5" style="padding-left: 30px;">(Perawat)</td>
                    </tr>
                </table>
    </center>
</body>

</html>
