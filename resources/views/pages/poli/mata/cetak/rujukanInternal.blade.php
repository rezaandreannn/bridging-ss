<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rujukan Internal RS</title>
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

        table .ttd {
            padding-top: 50px;
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
                    <b>SURAT RUJUKAN</b>
                    <hr />
                </td>
            </tr>
        </table>
        <p style="font-size: 12px; text-align:left;"> <b>Yth,</b></p>
        <p style="font-size: 12px; text-align:left;"> <b>{{ $data->NAMA_DOKTER ?? ''}}</b></p>
        <p style="font-size: 12px; text-align:left;"> <b>{{ $data->FS_TUJUAN_RUJUKAN2 ?? ''}}</b></p>
        <p style="font-size: 12px; text-align:left;"> Assalamu'alaikum Wr Wb</p>
        <p style="font-size: 12px; text-align:left;"> Dengan hormat, bersama ini kami kirimkan pasien :</p>
        <table width="100%">
            <tr>
                <td width="80" style="font-size: 11px;">Nama</td>
                <td width="300" style="font-size: 11px;">: {{ $biodata->NAMA_PASIEN ?? ''}}</td>
            </tr>
            <tr>
                <td width="80" style="font-size: 11px;">No RM</td>
                <td width="300" style="font-size: 11px;">: {{ $biodata->NO_MR ?? ''}}</td>
            </tr>
            <tr>
                <td width="80" style="font-size: 11px;">Tanggal Lahir</td>
                <td width="300" style="font-size: 11px;">: {{ date('d-m-Y', strtotime($biodata->TGL_LAHIR)) }}</td>
            </tr>
            <tr>
                <td width="80" style="font-size: 11px;">Alamat</td>
                <td width="300" style="font-size: 11px;">: {{ $biodata->ALAMAT ?? ''}}</td>
            </tr>
            <tr>
                <td width="80" style="font-size: 11px;">Jenis Kelamin</td>
                <td width="300" style="font-size: 11px;">: @if ($biodata->JENIS_KELAMIN == 'L')
                    Laki-Laki
                    @else
                    Perempuan
                    @endif</td>
            </tr>
            <tr>
                <td width="80" style="font-size: 11px;">Diagnosa</td>
                <td width="300" style="font-size: 11px;">: {{ $data->diagnosa ?? ''}}</td>
            </tr>
            <tr>
                <td width="80" style="font-size: 11px;">Terapi</td>
                <td width="300" style="font-size: 11px;">: {{ $resep->FS_TERAPI ?? ''}}</td>
            </tr>
            <tr>
                <td width="80" style="font-size: 11px;">Alasan dirujuk</td>
                <td width="300" style="font-size: 11px;">: {{ $data->FS_ALASAN_RUJUK ?? ''}}</td>
            </tr>
        </table>
        <p style="font-size: 12px; text-align:left;"> Demikian harap menjadi maklum adanya dan terimakasih atas perhatian teman sejawat</p>
        <p style="font-size: 12px; text-align:left;"> Wassalamu'alaikum Wr Wb</p>

        <table width="100%">
            <tr>
                <td></td>
                <td class="ttd" style="text-align: left;">Metro, {{ date('d-m-Y', strtotime($resep->mdd)) }}</td>
            </tr>
            <tr>
                <td></td>
                <td style="float: left;">
                    <!-- Menampilkan barcode dengan lebar 200px dan tinggi 200px -->
                    {!! DNS1D::getBarcodeHTML($resep->mdb, 'C39') !!}
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: left;">{{ $biodata->NAMA_DOKTER ?? ''}}</td>
            </tr>
        </table>
    </center>
</body>

</html>