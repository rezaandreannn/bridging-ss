<!DOCTYPE html>
<html>

<head>
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
                        <td>: 12345</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>: Dimas Budi Pratama</td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>: 10-02-2000</td>
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
        <tr>
            <td>17-04-2024 11.56</td>
            <td></td>
            <td></td>
            <td></td>
            <td>dr. Agung B Prasetiyono, Sp.PD</td>
        </tr>
    </table>
</body>

</html>