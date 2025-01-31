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

        .text3,
        .text5 {
            font-size: 15px;
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
        .gambar{
            padding: 10px;
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
                        <td>: {{ $biodatas->NO_MR ?? ''}}</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>: {{ $biodatas->NAMA_PASIEN ?? ''}}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>: {{ date('d-m-Y', strtotime($biodatas->TGL_LAHIR))}}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table style="border: 1px solid black" width="100%">
        <tr>
            <td class="text3" colspan="3" style="text-align: center; border: 1px solid black"><b>BUKTI PELAYANAN KEDOKTERAN FISIK DAN REHABILITASI</b></td>
        </tr>
        <tr>
            <td class="text3" colspan="3" style="border: 1px solid black">No. Telp / HP : {{ $biodatas->HP1 ?? ''}}</td>
        </tr>
        <tr>
            <td class="text3" colspan="3" style="border: 1px solid black">Diagnosa : {{$firstCppt->DIAGNOSA?? ''}} </td>
        </tr>
        <tr>
            <td class="text3" colspan="3" style="border: 1px solid black">Permintaan Terapi : {{$firstCppt->JENIS_FISIO ?? ''}} </td>
        </tr>
    </table>
    <table border="1" width="100%">
        <tr>
            <th rowspan="2" style="text-align: center;">No</th>
            <th rowspan="2" style="text-align: center;">Program</th>
            <th rowspan="2" style="text-align: center;">Tanggal</th>
            <th colspan="3" style="text-align: center;">TTD</th>
        </tr>
        <tr>
            <td style="text-align: center;">Pasien</td>
            <td style="text-align: center;">Dokter</td>
            <td style="text-align: center;">Terapis</td>
        </tr>
        @foreach ($data as $item)
   
        <tr>
            <td style="text-align: center">{{ $loop->iteration }}</td>
            <td style="text-align: center">{{ $item->JENIS_FISIO }}</td>
            <td style="text-align: center">{{ $item->TANGGAL_FISIO }}</td>
            <td style="text-align: center ">
                <div class="gambar">
                    {{-- {!! DNS2D::getBarcodeHTML($item->PASIEN_USERNAME, 'QRCODE', 2, 2) !!} --}}
                    @if($item->ttd_pasien == null)
                    @if(isset($ttdPasien->IMAGE))
                    <img src="storage/ttd/{{$ttdPasien->IMAGE}}" width="60" height="80" />
                    @endif
                    @else
                    @if(isset($item->ttd_pasien))
                    <img src="storage/ttd/{{$item->ttd_pasien}}" width="60" height="80" />
                    @endif
                    @endif
                </div>
            </td>
            <td style="text-align: center">
                <!-- @if($item->KODE_DOKTER == '151')
                    <div class="gambar">
                        {!! DNS2D::getBarcodeHTML($item->name, 'QRCODE', 2, 2) !!}
                    </div>
                @endif -->
            </td>
            <td style="text-align: center">
                <!-- @if($item->KODE_DOKTER != '151')
                    <div class="gambar">
                        {!! DNS2D::getBarcodeHTML($item->name, 'QRCODE', 2, 2) !!}
                    </div>
                @endif -->
            </td>
        </tr>
        @endforeach
        @for ($x = 0; $x <= $row; $x++)
        @if ($x == $row)
            @break
        @endif
        <tr>
            <td style="text-align: center; padding-top: 55px"></td>
            <td style="text-align: center; padding-top: 55px"></td>
            <td style="text-align: center; padding-top: 55px"></td>
            <td style="text-align: center; padding-top: 55px"></td>
            <td style="text-align: center; padding-top: 55px"></td>
            <td style="text-align: center; padding-top: 55px"></td>
        </tr>
        @endfor
    </table>
    <br />
    <table width="100%">
        <tr>
            <td class="text5" width="60%"></td>
            <!-- <td class="text5">Metro, {{$lastCppt->TANGGAL_FISIO}}, Jam : {{date("H:i", strtotime($lastCppt->JAM_FISIO))}} WIB</td> -->
            <td class="text5">Metro, </td>
        </tr>
        <tr>
            <td class="text5" width="60%"></td>
            <td class="text5">Dokter Sp. KFR</td>
        </tr>
        <tr>
            <td width="60%" class="text5"></td>
            <td class="text5"><img src="" width="65" height="65" /></td>
        </tr>
        <tr>
            <td width="60%" class="text5"></td>
          
            <td class="text5" style="padding-top: 60px"> 
            </td>
        </tr>
        <tr>
            <td width="60%" class="text5"></td>
          
            <td class="text5">({{$firstCppt->Nama_Dokter ?? ''}})</td>
        </tr>
    </table>
</body>

</html>