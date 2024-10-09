<!DOCTYPE html>
<html>

<head>
    <title>CPPT</title>
    <style>
        table {
            font-family: 'Times New Roman', Times, serif;

            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #dddddd;
            text-align: center;
        }

        .patient-info td {
            font-size: 12px;
            padding-top: 8px;
        }

        .patient-info {
            border: 1px solid black;
            margin: auto;
            width: 60%;
        }

        .data-cppt {
            font-size: 12px;

        }
    </style>
</head>

<body>
    <table class="header-row" width="100%">
        <tr>
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
    <table width="100%">
        <tr>
            <td class="text3" colspan="3" style="text-align: center; border: 1px solid black"><b> LEMBAR CPPT</b></td>
        </tr>
    </table>
    <table style="border: 1px solid black" class="data-cppt" width="100%">
        <tr>
            <th width="15%">Tanggal & Jam</th>
            <th width="20%">Anamnese & Pemeriksaan</th>
            <th width="20%">Diagnosa</th>
            <th width="20%">Terapi</th>
            <th width="20%">Dokter</th>
        </tr>
        @foreach ($data as $item)
        @php         
        $nama_dokter = DB::connection('db_rsmm')
        ->table('DOKTER')->select('Nama_Dokter')
        ->where('Kode_Dokter',$item->KODE_DOKTER)
        ->get();
         @endphp
        <tr>
            <td>{{ $item->TANGGAL_FISIO }} & {{ date('G:i', strtotime($item->JAM_FISIO)) }}</td>
            <td>S = {{ $item->ANAMNESA }} <br>O = TD = {{ $item->TEKANAN_DARAH }}, N = {{ $item->NADI }}, T = {{ $item->SUHU }}, <br> Lainnya = {{$item->LAINNYA}}
            </td>
            <td>{{ $item->DIAGNOSA }}</td>
            <td>{{ $item->JENIS_FISIO }}</td>
            <td>
                @foreach ($nama_dokter as $dokter)
                {{$dokter->Nama_Dokter}}
                @endforeach
            </td>
        </tr>
        @endforeach
    </table>
</body>

</html>