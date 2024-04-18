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
                        Rekanan : {{ $biodata['NAMAREKANAN'] ?? ''}}
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
                    <td class="text5">{{ $data['NAMALENGKAP'] ?? ''}}</td>
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
                    <td width="10%">No RM</td>
                    <td width="25%">: {{ $biodata['NO_MR'] ?? ''}}</td>
                    <td width="15%">Tgl Lahir</td>
                    <td width="25%">: {{ date('d-m-Y', strtotime($biodata['TGL_LAHIR'])) }}</td>
                </tr>
                <tr>
                    <td width="10%">Nama</td>
                    <td width="30%">: {{ $biodata['NAMA_PASIEN'] ?? ''}}</td>
                </tr>
                <tr>
                    <td width="10%">Alamat</td>
                    <td width="40%">: {{ $biodata['ALAMAT'] ?? ''}}</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>: {{ $biodata['JENIS_KELAMIN'] ?? ''}}</td>
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
                    <td>: {{ $data['FS_ALERGI'] ?? ''}}</td>
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