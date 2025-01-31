<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pelayanan Alat</title>
    <style>
        table tr td {
            font-size: 13px;
        }

        table tr .text {
            text-align: center;
            font-size: 15px;
        }

        table tr .text2 {
            text-align: center;
        }

        .text3 {
            font-size: 14px;
            padding-left: 18px;
            padding-bottom: 10px; 
        }
        .text4 {
            font-size: 14px;
        }

        table .ttd {
            padding-top: 100px;
        }
    </style>
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
                <td class="text">
                    <b>BUKTI PELAYANAN ALAT KESEHATAN</b>
                    <hr />
                </td>
            </tr>
        </table>
        <table width="100%">
            <tr>
                <td class="text4">A. Pemberi alat kesehatan</td>
            </tr>
            <tr>
                <td width="80" class="text3">1. Dokter</td>
                <td width="300" class="text3">: {{ $biodata->NAMA_DOKTER ?? ''}}</td>
            </tr>
            <tr>
                <td width="80" class="text3">2. Jenis alat kesehatan</td>
                <td width="300" class="text3">: {{ $alkes->jenis_alat ?? ''}}</td>
            </tr>
            <tr>
                <td width="80" class="text3">3. Biaya</td>
                <td width="300" class="text3">: Rp. {{ number_format($alkes->biaya ?? '', 2, ",", "."); }}</td>
            </tr>
            <tr>
                <td width="80" class="text3">4. Lingkar Pinggang</td>
                <td width="300" class="text3">: {{ $alkes->lingkar_pinggang ?? ''}} cm</td>
            </tr>
            <tr>
                <td class="text4">
                    B. Penerima Alat Kesehatan
                </td>
            </tr>
            <tr>
                <td width="80" class="text3">1. Nama</td>
                <td width="300" class="text3">: {{ $biodata->NAMA_PASIEN ?? ''}}</td>
            </tr>
            <tr>
                <td width="80" class="text3">2. Umur</td>
                <td width="300" class="text3">: {{ $usia ?? ''}} Tahun</td>
            </tr>
            <tr>
                <td width="80" class="text3">3. Alamat</td>
                <td width="300" class="text3">: {{ $biodata->ALAMAT ?? ''}}</td>
            </tr>
            <tr>
                <td width="80" class="text3">4. Diagnosa</td>
                <td width="300" class="text3">: {{ $alkes->diagnosa_klinis ?? ''}}</td>
            </tr>
            <tr>
                <td width="80" class="text3">5. No Rekam Medis</td>
                <td width="300" class="text3">: {{ $biodata->NO_MR ?? ''}}</td>
            </tr>
            <tr>
                <td width="80" class="text3">6. No Kartu</td>
                <td width="300" class="text3">: </td>
            </tr>
            <tr>
                <td width="80" class="text3">7. No SEP</td>
                <td width="300" class="text3">: {{ $alkes->no_sep ?? ''}}</td>
            </tr>
            <tr>
                <td width="80" class="text3">8. Jenis Rawat</td>
                <td width="300" class="text3">: {{ $alkes->jenis_rawat ?? ''}}, Poli : {{ $alkes->ruangan_rawat ?? ''}}</td>
            </tr>
            <tr>
                <td width="80" class="text3">9. Tanggal Masuk</td>
                <td width="300" class="text3">: {{ $alkes->tanggal_masuk ?? ''}}</td>
            </tr>
            <tr>
                <td width="80" class="text3">10. Tanggal Pulang</td>
                <td width="300" class="text3">: {{ $alkes->tanggal_pulang ?? ''}}</td>
            </tr>

        </table>
        <table width="100%">
            <tr>
                <td style="padding-top: 50px;" width="60%" class="text5"></td>
                <td style="padding-top: 50px; padding-left: 30px;" class="text5">Metro, {{ date('d-m-Y', strtotime($alkes->verif_at))}}</td>
            </tr>
            <tr>
                <td class="text5" style="padding-left: 20px;">Dokter Penanggung Jawab</td>
                <td class="text5" style="padding-left: 30px;">Tim BPJS Kesehatan</td>
            </tr>
            <tr>
                <td class="text5" style="padding-left: 20px;"></td>
                <td class="text5" style="padding-left: 30px;">RSU Muhammadiyah Metro</td>
            </tr>
            <tr>
                <!-- <td class="text5" style="padding-left: 50px;">{!! DNS2D::getBarcodeHTML($biodata->NAMA_DOKTER, 'QRCODE', 2, 2) !!}</td>
                <td class="text5" style="padding-left: 50px;">{!! DNS2D::getBarcodeHTML($alkes->nama_verifikator, 'QRCODE', 2, 2) !!}</td> -->
                <td class="text5" style="padding-left: 50px;"></td>
                <td class="text5" style="padding-left: 50px;"></td>
            </tr>
            <tr>
                <td class="text5" style="padding-right: 30px;">({{$biodata->NAMA_DOKTER}})</td>
                <td class="text5" style="padding-left: 30px;">({{$alkes->nama_verifikator}})</td>
            </tr>
        </table>
        <table width="100%">
            <tr>
                <td style="padding-top: 30px;" class="text5"></td>
                <td style="padding-top: 30px;" class="text5"> </td>
            </tr>
            <tr>
                <td class="text5" style="padding-left: 70px;"></td>
                <td class="text5" style="padding-left: 70px;">Pasien / Keluarga Pasien</td>
            </tr>
            <tr>
                <td class="text5" style="padding-left: 100px;"></td>
                <td class="text5" style="padding-left: 100px;">
                    @if($ttdPasienByNoreg->IMAGE == null)
                    <img src="storage/ttd/{{$ttdPasien->IMAGE}}" width="60" height="80" />
                    @else
                    <img src="storage/ttd/{{$ttdPasienByNoreg->IMAGE}}" width="60" height="80" />
                    @endif
                </td>
            </tr>
            <tr>
                <td class="text5" style="padding-right: 10px; "></td>
                <td class="text5" style="padding-right: 10px; padding-left: 50px;">({{$biodata->NAMA_PASIEN}})</td>
            </tr>
        </table>
    </center>
</body>

</html>