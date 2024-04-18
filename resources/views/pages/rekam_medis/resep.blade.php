<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Surat</title>
    <style>
        table tr td {
            font-size: 13px;
        }

        table tr .text {
            text-align: right;
            font-size: 15px;
        }

        table tr .text5 {
            text-align: center;
            font-size: 15px;
        }

        table tr .text2 {
            text-align: center;
        }

        table tr .text10 {
            text-align: right;
        }

        table tr .img {
            padding-bottom: 100px;
        }


        .page {
            width: 100mm;
            min-height: 210mm;

        }
    </style>
</head>

<body>
    <div class="page">
        <center>
            <table width="100%">
                <tr>
                    <td class="text">
                        Rekanan : 231
                    </td>
                </tr>
            </table>
            <table width="100%">
                <tr>
                    <td class="text">
                        <b>No Antrian Obat : 1</b>

                    </td>
                </tr>
            </table>
            <table width="100%">
                <tr>
                    <td class="text5">{{ $data['NAMA_DOKTER'] ?? ''}}</td>
                </tr>
                <tr>
                    <td class="text5">SIP : </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <hr />
                    </td>
                </tr>
            </table>
            <table width="100%">
                <tr>
                    <td class="text">
                        <b></b>
                    </td>
                </tr>
            </table>
            <table width="100%">
                <tr>
                    <td> {!! str_replace("\n", "<br>", $data['FS_TERAPI']) !!}</td>

                </tr>
            </table>
            <table width="100%">
                <tr>
                    <td colspan="4">
                        <hr />
                    </td>
                </tr>
                <tr>
                    <td>No RM</td>
                    <td>: 123456</td>
                    <td>Tgl Lahir</td>
                    <td>: 10-02-2000</td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>: Dimas Budi Pratama</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>: LK TOTOKATON RT 0</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>: l</td>
                </tr>
                <tr>
                    <td>TB</td>
                    <td>: </td>
                    <td>BB</td>
                    <td>: </td>
                </tr>

                <tr>
                    <td>Diagnosa</td>
                    <td>: {{ $data['FS_DIAGNOSA'] ?? ''}}</td>
                    <td>Alergi</td>
                    <td>: Kosong</td>
                </tr>
                <tr>
                    <td>Diagnosa Sekunder</td>
                    <td>: {{ $data['FS_DIAGNOSA_SEKUNDER'] ?? ''}}</td>
                </tr>
            </table>
            <table width="100%">
                <tr>
                    barcode</td>
                </tr>
            </table>
        </center>
    </div>

</body>

</html>