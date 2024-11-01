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

        .text1{
            font-size: 10px
        }
    </style>
</head>

<body>
    <div class="page">
        <center>
            <table width="100%">
                <tr>
                    <td class="text">
                        Rekanan : {{ $biodata->NAMAREKANAN ?? ''}}
                    </td>
                </tr>
            </table>
            <table width="100%">
                <tr>
                    <td class="text5">{{ $data->NAMALENGKAP}}</td>
                </tr>
                <tr>
                    <td class="text5" style="text-align: right;">{{ date('d-m-Y', strtotime($data->mdd)) }}</td>
                </tr>
                <tr>
                    <td colspan="4" style="padding: 0;">
                        <hr style="margin: 0;" />
                    </td>
                </tr>
            </table>
            <p style="font-size: 12px; text-align:left;">{!! nl2br(trim($data->FS_TERAPI)) !!}</p>
            <table width="100%">
                <tr>
                    <td colspan="4">
                        <hr />
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="text1">No RM</td>
                    <td width="25%" class="text1">: {{ $biodata->NO_MR ?? ''}}</td>
                    <td width="15%" class="text1">Tgl Lahir</td>
                    <td width="25%" class="text1">: {{ date('d-m-Y', strtotime($biodata->TGL_LAHIR)) }}</td>
                </tr>
                <tr>
                    <td width="10%" class="text1">Nama</td>
                    <td width="30%" class="text1">: {{ $biodata->NAMA_PASIEN ?? ''}}</td>
                </tr>
                <tr>
                    <td width="10%" class="text1">Alamat</td>
                    <td width="40%" class="text1">: {{ $biodata->ALAMAT ?? ''}}</td>
                </tr>
                <tr>
                    <td class="text1">Jenis Kelamin</td>
                    <td class="text1">: @if ($biodata->JENIS_KELAMIN == 'L')
                        Laki-Laki
                        @else
                        Perempuan
                        @endif</td>
                </tr>
   

                <tr>
                    <td class="text1">Diagnosa</td>
                    <td class="text1">: {{ $biodata->FS_DIAGNOSA}}</td>
                    <td class="text1">Alergi</td>
                    <td class="text1">: {{ $biodata->FS_ALERGI}}</td>
                </tr>
                <tr>
                    <td class="text1">Diagnosa Sekunder</td>
                    <td class="text1">: {{ $biodata->FS_DIAGNOSA_SEKUNDER}}</td>
                </tr>
            </table>
            <table width="100%">
                <tr>
                    {!! DNS1D::getBarcodeHTML($data->KODE_DOKTER, 'C39',2,40) !!}
                </tr>
            </table>
        </center>
    </div>

</body>

</html>