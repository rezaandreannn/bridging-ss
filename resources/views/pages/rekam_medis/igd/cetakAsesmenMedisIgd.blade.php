{{-- Assesmen Medis IGD --}}
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
                <td class="text3" colspan="3">: {{$assesmenPerawat->FS_ALERGI ?? ''}}</td>
            </tr>
            <tr>
                <td class="text3">Reaksi Alergi</td>
                <td class="text3" colspan="3">: {{$assesmenPerawat->FS_REAK_ALERGI ?? ''}}</td>
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