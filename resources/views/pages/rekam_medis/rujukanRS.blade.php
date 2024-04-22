<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rujukan RS</title>
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
                        <font size="2"><b>MAJELIS PEMBINA KESEHATAN UMUM</b></font><br />
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
        <table width="100%">
            <tr>
                <td><b>Yth,</b></td>
            </tr>
            <tr>
                <td><b>{{ $data['FS_TUJUAN_RUJUKAN'] ?? ''}}</b></td>
            </tr>
            <tr>
                <td><b>{{ $data['FS_TUJUAN_RUJUKAN2'] ?? ''}}</b></td>
            </tr>
            <tr>
                <td>
                    Assalamu'alaikum Wr Wb
                </td>
            </tr>
            <tr>
                <td>
                    Dengan hormat, bersama ini kami kirimkan pasien :
                </td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>: {{ $biodata['NAMA_PASIEN'] ?? ''}}</td>
            </tr>
            <tr>
                <td>No RM</td>
                <td>: {{ $biodata['NO_MR'] ?? ''}}</td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>: {{ date('d-m-Y', strtotime($biodata['TGL_LAHIR'])) }}</td>

            </tr>
            <tr>
                <td>Alamat</td>
                <td>: {{ $biodata['ALAMAT'] ?? ''}}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>: @if ($biodata['JENIS_KELAMIN'] == 'L')
                    Laki-Laki
                    @else
                    Perempuan
                    @endif</td>

            </tr>
            <tr>
                <td>Diagnosa</td>
                <td>: {{ $resep['FS_DIAGNOSA'] ?? ''}}</td>
            </tr>
            <tr>
                <td>Terapi</td>
                <td>: {{ $resep['FS_TERAPI'] ?? ''}}</td>
            </tr>
            <tr>
                <td>Alasan dirujuk</td>
                <td>: {{ $data['FS_ALASAN_RUJUK'] ?? ''}}</td>
            </tr>
            <tr>
                <td>
                    Demikian harap menjadi maklum adanya dan terimakasih atas perhatian teman sejawat
                </td>
            </tr>
            <tr>
                <td>
                    Wassalamu'alaikum Wr Wb
                </td>
            </tr>
        </table>
        <table width="100%">
            <tr>
                <td></td>
                <td class="ttd" style="text-align: left;">Metro, {{ $tanggal->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td></td>
                <td style="float: left;">
                    <!-- Menampilkan barcode dengan lebar 200px dan tinggi 200px -->
                    {!! DNS1D::getBarcodeHTML($biodata['FS_KD_TRS'], 'C39') !!}
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: left;">{{ $resep['NAMALENGKAP'] ?? ''}}</td>
            </tr>
        </table>
    </center>
</body>

</html>