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

        .text2 {
            font-size: 15px;
        }

        .text3 {
            font-size: 15px;
            padding-bottom: 10px;
        }

        .text5 {
            font-size: 15px;
            text-align: center;
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
                        <td>: {{ $biodatas->NO_MR}}</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>: {{ $biodatas->NAMA_PASIEN}}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>: {{ date('d-m-Y', strtotime($biodatas->TGL_LAHIR))}}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table style="border: 1px solid black;" width="100%">
        <tr>
            <td class="text2" colspan="3" style="text-align: center; border: 1px solid black"><b>LEMBAR FORMULIR RAWAT JALAN LAYANAN KEDOKTERAN FISIK DAN REHABILITASI</b></td>
        </tr>
        <tr>
            <td class="text2" colspan="3" style="border: 1px solid black">No. Telp / HP : {{ $biodatas->HP1}}</td>
        </tr>
        <tr>
            <td class="text2" colspan="3" style="border: 1px solid black">Diagnosa : </td>
        </tr>
        <tr>
            <td class="text2" colspan="3" style="border: 1px solid black">Permintaan Terapi : </td>
        </tr>
    </table>
    <table style="border: 1px solid black; border-top: none; border-bottom:none " width="100%">
        <tr>
            <td class="text3">Tanggal Pelayanan</td>
            <td class="text3" colspan="2">: 10-02-2024 Jam : 20.00 WIB</td>
        </tr>
        <tr>
            <td class="text3">Anamesa</td>
            <td class="text3" colspan="2">: Sakit</td>
        </tr>
        <tr>
            <td class="text3">Pemeriksaan Fisik dan Uji Fungsi</td>
            <td class="text3" colspan="2">: Testing</td>
        </tr>
        <tr>
            <td class="text3">Diagnosis Medis (ICD-10)</td>
            <td class="text3" colspan="2">: Testing</td>
        </tr>
        <tr>
            <td class="text3">Diagnosis Fungsi (ICD-10)</td>
            <td class="text3" colspan="2">: Testing</td>
        </tr>
        <tr>
            <td class="text3">Pemeriksaan Penunjang</td>
            <td class="text3" colspan="2">: Testing</td>
        </tr>
        <tr>
            <td class="text3">Tata Laksana KFR (ICD 9 CM)</td>
            <td class="text3" colspan="2">: Testing</td>
        </tr>
        <tr>
            <td class="text3">Ajuran</td>
            <td class="text3" colspan="2">: 8 x Seminggu</td>
        </tr>
        <tr>
            <td class="text3">Evalusi</td>
            <td class="text3" colspan="2">: 8 x Terapi</td>
        </tr>
    </table>
    <table style="border: 1px solid black; border-top: none;" width="100%">
        <tr>
            <td style="padding-top: 100px;" class="text5">Pasien</td>
            <td style="padding-top: 100px;" class="text5">Dokter Pemeriksa</td>
        </tr>
        <tr>
            <td class="text5"><img src="img/code.png" width="65" height="65" /></td>
            <td class="text5"><img src="img/code.png" width="65" height="65" /></td>
        </tr>
        <tr>
            <td width="50%" class="text5">(Dimas Budi Pratama)</td>
            <td class="text5">(dr. Agung B Prasetiyono,Sp.PD)</td>
        </tr>
    </table>
    </table>
</body>

</html>