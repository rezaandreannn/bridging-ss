<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lab</title>
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
                    <b>PERMINTAAN PEMERIKSAAN PENUNJANGAN</b>
                    <hr />
                </td>
            </tr>
        </table>
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
                <td width="80" style="font-size: 11px;">Jenis Kelamin</td>
                <td width="300" style="font-size: 11px;">: @if ($biodata->JENIS_KELAMIN == 'L')
                    Laki-Laki
                    @else
                    Perempuan
                    @endif</td>
            </tr>
            <tr>
                <td width="80" style="font-size: 11px;">Alamat</td>
                <td width="300" style="font-size: 11px;">: {{ $biodata->ALAMAT ?? ''}}</td>
            </tr>

        </table>
        <table width="100%">
            <tr>
                <td colspan="3">
                    <hr />
                </td>
            </tr>
        </table>
        <table width="100%">
            <tr>
                <td>
                    <font size="2">Assalamu'alaikum Wr Wb</font>
                </td>
            </tr>
            <tr>
                <td>Pemeriksaan Penunjangan yang diminta</td>
                <td width="180">:
                    @foreach($data as $lab)
                    {{ $lab }},
                    @endforeach
                </td>
            </tr>
        </table>
        <table width="100%">
            <tr>
                <td width="250"><b>KETERANGAN KLIKIK PENDERITA</b></td>
            </tr>
        </table>
        <table width="100%">

            <tr>
                <td width="165">Diagnosa</td>
                <td>: {{ $resep->FS_DIAGNOSA ?? ''}}</td>
            </tr>
            <tr>
                <td width="165">Alergi</td>
                <td>: {{ $biodata->FS_ALERGI ?? ''}}</td>
            </tr>
            <tr>
                <td width="165">High Risk</td>
                <td>: {{ $biodata->FS_HIGH_RISK ?? ''}}</td>
            </tr>
            <tr>
                <td>
                    <font size="2">Wassalamu'alaikum Wr Wb</font>
                </td>
            </tr>
        </table>
        <table width="100%">
            <tr>
                <td></td>
                <td class="ttd" style="text-align: left;">Metro, {{ date('d-m-Y', strtotime($resep->mdd)) }}</td>
            </tr>
            <tr>
                <td></td>
                <td style="float: left;">
                    <!-- Menampilkan barcode dengan lebar 200px dan tinggi 200px -->
                    {!! DNS2D::getBarcodeHTML($resep->NAMALENGKAP, 'QRCODE', 2, 2) !!}
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: left;">{{ $resep->NAMALENGKAP ?? ''}}</td>
            </tr>
        </table>
    </center>
</body>

</html>