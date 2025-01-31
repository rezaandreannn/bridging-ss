{{----------------- Assement Awal Kedokteran -----------------}}
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Asesmen SPKFR</title>
        <style>
            table {
                border-collapse: collapse;
            }

            .text2 {
                font-size: 14px;
                padding-left: 10px;
                padding-top: 5px;
            }

            .text3 {
                font-size: 15px;
                padding-left: 10px;
                padding-top: 10px;
            }
            
            .text4 {
                font-size: 13px;
                padding-left: 10px;
            }

            .text5 {
                font-size: 15px;
                text-align: center;
            }

            .text6 {
                font-size: 15px;
                padding-left: 10px;
                padding-top: 30px;
            }

            .logo-cell {
                border: 1px solid black;
                border-right: none;
                width: 10%;
                padding-left: 20px;
            }

            .logo-cell-2 {
                border: 1px solid black;
                border-left: none;
                width: 10%;
                padding-right: 20px;
            }
            .info-cell {
                text-align: center;
                border: 1px solid black;
                border-left: none;
                border-right: none;
                width: 40%;
                padding-top: 10px;
            }
            .tindakan1 {
                border: 1px solid black;
                border-right: none;
                border-bottom: none;
            }
            .tindakan2 {
                border: 1px solid black;
                border-right: none;
                border-left: none;
                border-bottom: none;
            }
            .tindakan3 {
                border: 1px solid black;
                border-left: none;
                border-bottom: none;
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
                border: 1px solid black;
                margin: auto;
                width: 60%;
            }

            .patient-info td {
                font-size: 12px;
                padding-top: 8px;
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
        </table>
        <table style="border: 1px solid black;" width="100%">
            <tr>
                <td class="text2" colspan="3" style="text-align: center;"><b>ASSESMENT AWAL KEDOKTERAN FISIK DAN REHABILITASI</b></td>
            </tr>
            <tr>
                <td class="text2" colspan="3" style="border: 1px solid black">Tanggal : {{ date('d-m-Y', strtotime($asesmenDokter->tanggal))}} | Jam : {{ date('H:i:s', strtotime($asesmenDokter->jam))}}</td>
            </tr>
            </tr>
        </table>
        <table style="border: 1px solid black; border-top: none;border-bottom: none;" width="100%">
            <tr>
                <td class="text3"><b>1. Subjektif</b></td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text4">Anamnesa</td>
                <td class="text4" colspan="2">: {{ $asesmenDokter->anamnesa}}</td>
            </tr>
            <tr>
                <td class="text3"><b>2. Pemeriksaan Fisik</b></td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text4">Tekanan Darah</td>
                <td class="text4" colspan="2">: {{ $asesmenDokter->tekanan_darah}} mmHg</td>
            </tr>
            <tr>
                <td class="text4">Nadi</td>
                <td class="text4" colspan="2">: {{ $asesmenDokter->nadi}}x/menit</td>
            </tr>
            <tr>
                <td class="text4">Respirasi</td>
                <td class="text4" colspan="2">: {{ $asesmenDokter->respirasi}}K/menit</td>
            </tr>
            <tr>
                <td class="text4">Suhu</td>
                <td class="text4" colspan="2">: {{ $asesmenDokter->suhu}}C</td>
            </tr> 
            <tr>
                <td class="text4">Berat Badan</td>
                <td class="text4" colspan="2">: {{ $asesmenDokter->berat_badan}}kg</td>
            </tr>
            <tr>
                <td class="text4">Prothesa</td>
                <td class="text4" colspan="2">: {{ $asesmenDokter->prothesa}}</td>
            </tr>
            <tr>
                <td class="text4">Ortosis</td>
                <td class="text4" colspan="2">: {{ $asesmenDokter->orthosis}}</td>
            </tr>
            <tr>
                <td class="text3"><b>3. Analisa</b></td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text4">Diagnosa Klinis</td>
                <td class="text4" colspan="2">: {{ $asesmenDokter->diagnosa_klinis}}</td>
            </tr>
            <tr>
                <td class="text3"><b>5. Perencanaan</b></td>
                <td class="text3" colspan="2"></td>
            </tr>
            <tr>
                <td class="text4">Terapi</td>
                <td class="text4" colspan="2">: 
                    {{ $asesmenDokter->terapi}}
                </td>
            </tr>
            {{-- <tr>
                <td class="text4">Rencana Tindakan</td>
                <td class="text4" colspan="2">: {{ $asesmenDokter->rencana_tindakan}}
                    @if($asesmenDokter->rencana_tindakan == 'Ya'),{{ $asesmenDokter->deskripsi_tindakan ?? ''}} @endif
                </td>
            </tr> --}}
            <tr>
                <td class="text4">Rujuk</td>
                <td class="text4" colspan="2">: {{ $asesmenDokter->rencana_rujukan}}
                    @if($asesmenDokter->rencana_rujukan == 'Ya'),{{ $asesmenDokter->deskripsi_rujukan ?? ''}} @endif
                </td>
            </tr>
            <tr>
                <td class="text4">Konsul</td>
                <td class="text4" colspan="2">: {{ $asesmenDokter->rencana_konsul}}
                    @if($asesmenDokter->rencana_konsul == 'Ya'),{{ $asesmenDokter->deskripsi_konsul ?? ''}} @endif
                </td>
            </tr>
            <tr>
                <td class="text4">Anjuran</td>
                <td class="text4" colspan="2">: {{ $asesmenDokter->anjuran_terapi}}x Seminggu</td>
            </tr>
            <tr>
                <td class="text4">Evaluasi</td>
                <td class="text4" colspan="2">: {{ $asesmenDokter->evaluasi_terapi}}x Terapi</td>
            </tr>
        </table>
        <table style="border: 1px solid black; border-top: none;" width="100%">
            <tr>
                <td style="padding-top: 100px;" class="text5"></td>
                <td style="padding-top: 100px;" class="text5">Dokter, Metro {{$asesmenDokter->created_at}}</td>
            </tr>
            <tr>
                <td class="text5"></td>
                <!-- <td class="text5" style="padding-left: 135px">{!! DNS2D::getBarcodeHTML($namaDokter->Nama_Dokter, 'QRCODE', 3, 3) !!}</td> -->
                <td class="text5" style="padding-left: 135px"><br><br><br></td>
            </tr>
            <tr>
                <td width="50%" class="text5"></td>Nama_Dokter
                <td class="text5">({{ $namaDokter->Nama_Dokter}})</td>
            </tr>
        </table>
    </body>
</html>

{{----------------- Tindakan -----------------}}
<!DOCTYPE html>
<html lang="en">
    <head></head>
    <body>
        <table class="header-row" width="100%">
            <tr>
                <td class="tindakan1"><img src="img/logo.png" width="50" height="50" /></td>
                <td class="tindakan2">
                    <center>
                        <font size="2"><b>MAJELIS PEMBINAAN KESEHATAN UMUM</b></font><br />
                        <font size="2"><b>RSU MUHAMMADIYAH METRO </b></font><br />
                        <font style="font-size: 8px;">JL Soekarno Hatta No. 42 Mulyojati 16B, Fax: (0725) 47760 Metro Barat - Kota Metro 34125</font><br />
                        <font style="font-size: 8px;">Email : info.rsumm@gmail.com , Telp: (0721) 49490-7850378 , Website : www.rsumm.co.id</font>
                    </center>
                </td>
                <td class="tindakan3"><img src="img/larsibaru.png" width="50" height="50" /></td>
            </tr>
        </table>
        <table style="border: 1px solid black;" width="100%">
            <tr>
                <td class="text5" colspan="3" style="text-align: center;"><b>Lembar Hasil Tindakan Uji Fungsi / Prosedur Kfr {{ $lembarUjiFungsi->prosedur_kfr}} (Koding: ......)</b></td>
            </tr>
            <tr>
                <td class="text2">No MR</td>
                <td class="text2" colspan="2">: {{ $biodata->NO_MR}}</td>
            </tr>
            <tr>
                <td class="text2">Nama</td>
                <td class="text2" colspan="2">: {{ $biodata->NAMA_PASIEN}}</td>
            </tr>
            <tr>
                <td class="text2">Tanggal Lahir / Usia</td>
                <td class="text2" colspan="2">: {{ date('d-m-Y', strtotime($biodata->TGL_LAHIR))}} / {{ $usia }}</td>
            </tr>
            <tr>
                <td class="text2">Alamat</td>
                <td class="text2" colspan="2">: {{ $biodata->ALAMAT}}</td>
            </tr>
            <tr>
                <td class="text2">Telepon</td>
                <td class="text2" colspan="2">: {{ $biodata->HP1}}</td>
            </tr>
            <tr>
                <td class="text2">Jenis Kelamin</td>
                <td class="text2" colspan="2">: {{ $biodata->JENIS_KELAMIN}}</td>
            </tr>
            <tr>
                <td class="text2">Tanggal</td>
                <td class="text2" colspan="2">: {{ date('d-m-Y', strtotime($lembarUjiFungsi->created_at))}}</td>
            </tr>
            <tr>
                <td class="text2">Diagnosis Fungsional / Diagnosis Medis</td>
                <td class="text2" colspan="2">: {{ $lembarUjiFungsi->diagnosis_fungsional}}</td>
            </tr>
        </table>
        <table style="border: 1px solid black; border-top: none;border-bottom: none;" width="100%">
            <tr>
                <td class="text6">Instrumen Uji Fungsi / Prosedur KFR : {{ $lembarUjiFungsi->prosedur_kfr}}</td>
            </tr>
            <tr>
                <td class="text6">Kesimpulan : {{ $lembarUjiFungsi->kesimpulan}}</td>
            
            </tr>
            <tr>
                <td class="text6">Rekomendasi : {{ $lembarUjiFungsi->rekomendasi}}</td>
            </tr>
            <tr>
                <td class="text6">Edukasi : {{ $lembarUjiFungsi->edukasi}}</td>
            </tr>
        </table>
        <table style="border: 1px solid black; border-top: none;" width="100%">
            <tr>
                <td style="padding-top: 100px;" class="text5"></td>
                <td style="padding-top: 100px;" class="text5">Tanda Tangan</td>
            </tr>
            <tr>
                <td class="text5"></td>
                <!-- <td class="text5" style="padding-left: 135px">{!! DNS2D::getBarcodeHTML($namaDokter->Nama_Dokter, 'QRCODE', 3, 3) !!}</td> -->
                <td class="text5" style="padding-left: 135px"><br><br><br></td>
            </tr>
            <tr>
                <td width="50%" class="text5"></td>
                <td class="text5">({{ $namaDokter->Nama_Dokter}})</td>
            </tr>
        </table>
    </body>
</html>

{{----------------- SpKFR -----------------}}
<!DOCTYPE html>
<html lang="en">
    <head></head>
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
        </table>
        <table style="border: 1px solid black;" width="100%">
            <tr>
                <td class="text2" colspan="3" style="text-align: center; border: 1px solid black"><b>LEMBAR FORMULIR RAWAT JALAN LAYANAN KEDOKTERAN FISIK DAN REHABILITASI</b></td>
            </tr>
            <tr>
                <td class="text2" colspan="3" style="border: 1px solid black">Alamat : {{ $biodata->ALAMAT}}</td>
            </tr>
            <tr>
                <td class="text2" colspan="3" style="border: 1px solid black">No. Telp / HP : {{ $biodata->HP1}}</td>
            </tr>
        </table>
        <table style="border: 1px solid black; border-top: none; border-bottom:none " width="100%">
            <tr>
                <td class="text3">Tanggal Pelayanan</td>
                <td class="text3" colspan="2">: Tanggal : {{ date('d-m-Y', strtotime($lembarSpkfr->created_at))}} | Jam : {{ date('H:i:s', strtotime($lembarSpkfr->created_at))}} WIB</td>
            </tr>
            <tr>
                <td class="text3">Anamesa</td>
                <td class="text3" colspan="2">: {{ $asesmenDokter->anamnesa}}</td>
            </tr>
            <tr>
                <td class="text3">Pemeriksaan Fisik dan Uji Fungsi</td>
                <td class="text3" colspan="2">: {{ $lembarSpkfr->pemeriksaan_fisik}}</td>
            </tr>
            <tr>
                <td class="text3">Diagnosis Medis (ICD-10)</td>
                <td class="text3" colspan="2">: {{ $lembarSpkfr->diagnosis_medis}}</td>
            </tr>
            <tr>
                <td class="text3">Diagnosis Fungsi (ICD-10)</td>
                <td class="text3" colspan="2">: {{ $lembarSpkfr->diagnosis_fungsi}}</td>
            </tr>
            <tr>
                <td class="text3">Tata Laksana KFR (ICD 9 CM)</td>
                <td class="text3" colspan="2">: {{ $lembarSpkfr->tata_laksana_kfr}}</td>
            </tr>
            <tr>
                <td class="text3">Ajuran</td>
                <td class="text3" colspan="2">: {{ $asesmenDokter->anjuran_terapi}}x Seminggu</td>
            </tr>
            <tr>
                <td class="text3">Evalusi</td>
                <td class="text3" colspan="2">: {{ $asesmenDokter->evaluasi_terapi}}x Terapi</td>
            </tr>
        </table>
        <table style="border: 1px solid black; border-top: none;" width="100%">
            <tr>
                <td style="padding-top: 100px;" class="text5">Pasien</td>
                <td style="padding-top: 100px;" class="text5">Dokter Pemeriksa</td>
            </tr>
            <tr>
                <td class="text5">
                    @if (isset($ttdPasien->IMAGE))
                    <img src="storage/ttd/{{$ttdPasien->IMAGE}}" width="80" height="100" />
                    @else 
                    <img src="" width="80" height="100" />
                    @endif
                    {{-- <img src="img/logo.png" width="50" height="50" /> --}}
                    {{-- {!! DNS2D::getBarcodeHTML($biodata->NAMA_PASIEN, 'QRCODE', 3, 3) !!} --}}
                </td>
                <!-- <td class="text5" style="padding-left: 130px">{!! DNS2D::getBarcodeHTML($namaDokter->Nama_Dokter, 'QRCODE', 3, 3) !!}</td> -->
                <td class="text5" style="padding-left: 135px"><br><br><br></td>
            </tr>
            <tr>
                <td width="50%" class="text5">({{ $biodata->NAMA_PASIEN}})</td>
                <td class="text5">({{ $namaDokter->Nama_Dokter}})</td>
            </tr>
        </table>
    </body>
</html>