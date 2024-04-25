<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Resep Obat</title>
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
                    <td colspan="4" style="padding: 0;">
                        <hr style="margin: 0;" />
                    </td>
                </tr>
            </table>
            <p style="font-size: 12px; text-align:left;">{!! nl2br(trim($data['FS_TERAPI'] ?? '')) !!}</p>
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
                    {!! DNS1D::getBarcodeHTML($data['KODE_DOKTER'], 'C39',2,40) !!}
                </tr>
            </table>
        </center>
    </div>

</body>

</html>