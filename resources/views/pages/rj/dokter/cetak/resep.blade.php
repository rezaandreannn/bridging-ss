<html lang="en">
    <head>
        <style>
            .text5 {
                font-size: 15px;
                text-align: center;
            }
            .text1 {
                font-size: 12px;
                border: 1px solid black;
                padding: 8px;
                text-align: left;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            .tabel1{
                border: 1px solid black;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
            }
        </style>
    </head>
    <body>
        <table class="header-row" width="100%">
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
                <td>Nama</td>
                <td >: {{ $biodata->NAMA_PASIEN}}</td>
            </tr>
            <tr>
                <td>No RM</td>
                <td >: {{ $biodata->NO_MR}}</td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td >: {{ date('d-m-Y', strtotime($biodata->TGL_LAHIR)) }}</td>

            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td >: @if ($biodata->JENIS_KELAMIN == 'L')
                    Laki-Laki
                    @else
                    Perempuan
                    @endif</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td >: {{ $biodata->ALAMAT}}</td>
            </tr>
        </table>
        <table width="100%">
            <thead>
                <tr>
                    <th class="tabel1">Nama Obat</th>
                    <th class="tabel1">Jumlah</th>
                    <th class="tabel1">Cara Pemakaian</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $resep)
                <tr>
                    <td class="text1">{{$resep->Nama_Obat}}</td>
                    <td class="text1">{{ number_format($resep->Jumlah, 2, ',', '.') }} {{$resep->Satuan}}</td>
                    <td class="text1">{{$resep->Dosis}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>