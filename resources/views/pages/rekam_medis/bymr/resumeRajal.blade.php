
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
                <td class="text2" colspan="6" style="color:white;background-color:black;  text-align: center; border: 1px solid black;"><b>RESUME MEDIS RAWAT JALAN</b></td>
            </tr>
            <tr>
                <td class="text3">Keluhan utama saat masuk rumah sakit</td>
                <td class="text3" colspan="5"> {{ $asesmenDokterRj->FS_ANAMNESA}} </td>
            </tr>
            <tr>
                <td class="text3">Diagnosa Utama</td>
                <td class="text3" colspan="3"> {{ $asesmenDokterRj->FS_DIAGNOSA}}</td>
                <td class="text3" colspan="2">ICD 10:</td>
            </tr>
            <tr>
                <td class="text3">Diagnosa Sekunder</td>
                <td class="text3" colspan="3"> {{ $asesmenDokterRj->FS_DIAGNOSA_SEKUNDER}}</td>
                <td class="text3" colspan="2">ICD 10:</td>
            </tr>
            <tr>
                <td class="text3">Prosedur Tindakan</td>
                <td class="text3" colspan="5" height="30px"> 
                    @if ($asesmenDokterRj->FS_TINDAKAN == '')
                    {{$asesmenDokterRj->FS_TINDAKAN}}
                    @else
                        {{'tidak ada'}}
                    @endif
                </td>
            </tr>
            <tr>
                <td class="text3">Riwayat Penyakit</td>
                <td class="text3" colspan="5">{{ $asesmenDokterRj->FS_RIW_PENYAKIT_DAHULU}}</td>
            </tr>
            <tr>
                <td class="text3">Alergi</td>
                <td class="text3" colspan="5">{{ $asesmenDokterRj->FS_ALERGI}}</td>
            </tr>
            <tr>
                <td class="text3">Pemeriksaan Fisik</td>
                <td class="text3" colspan="5"> Tanda-tanda vital {{ $asesmenDokterRj->FS_CATATAN_FISIK}}</td>
            </tr>
            <tr>
                <td class="text3">Kondisi Keluar</td>
                <td class="text3" colspan="5">
                    @if ($asesmenDokterRj->FS_CARA_PULANG == '2')
                    {{'Kontrol'}}
                    @elseif ($asesmenDokterRj->FS_CARA_PULANG == '0')
                    {{'Kontrol'}}
                    @elseif ($asesmenDokterRj->FS_CARA_PULANG == '3')
                    {{'Lain lain : Rawat Inap'}}
                    @elseif ($asesmenDokterRj->FS_CARA_PULANG == '4')
                    {{'Lain lain : Rujuk Luar RS'}}
                    @elseif ($asesmenDokterRj->FS_CARA_PULANG == '6')
                    {{'Lain lain : Rujuk Internal'}}
                    @elseif ($asesmenDokterRj->FS_CARA_PULANG == '7')
                    {{'Lain lain : Kembali Ke Faskes Primer'}}
                    @endif
                </td>
            </tr>
            <tr>
                <td class="text3">Instruksi dan edukasi lanjutan</td>
                <td class="text3" colspan="3">Tanggal Kontrol: {{date('d M Y', strtotime($asesmenDokterRj->FS_SKDP_KONTROL))}}</td>
                <td class="text3" colspan="2">Di: </td>
            </tr>
            <tr>
                <td class="text3" colspan="6" height="50px"><b>Terapi yang diberikan dokter</b></td>
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
        {{-- <table width="100%" style="border-top:none;">
            <thead>
                <tr>
                    <th class="tabel1">Pemeriksaan Lab</th>
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
        </table> --}}
        <table  width="100%">
            <tr>
                <td style="padding-top: 100px;" class="text5"></td>
                <td style="padding-top: 100px;" class="text5">Tanggal {{date('d M Y', strtotime($asesmenDokterRj->mdd))}}, Jam {{$asesmenDokterRj->FS_JAM_TRS}}</td>
            </tr>
            <tr>
                <td class="text5">Tanda Tangan Pasien / Keluarga</td>
                <td class="text5">Tanda Tangan dan Nama DPJP</td>
            </tr>
            <tr>
                <tr>
                    <td class="text5" style="padding-left: 150px;">
                        {!! DNS2D::getBarcodeHTML($biodata->NAMA_PASIEN, 'QRCODE', 2, 2) !!}
                    </td>
                    <td class="text5" style="padding-left: 150px;">
                        {!! DNS2D::getBarcodeHTML($asesmenDokterRj->Nama_Dokter, 'QRCODE', 2, 2) !!}
                        {{-- <img src="img/barcode.jpeg" width="50" height="50" /> --}}
                    </td>
                </tr>
            </tr>
            <tr>
                <td class="text5" style="padding-left: 30px;">({{$biodata->NAMA_PASIEN}})</td>
                <td class="text5" style="padding-left: 30px;">({{$asesmenDokterRj->Nama_Dokter}})</td>
            </tr>
        </table>
    </body>
</html>
