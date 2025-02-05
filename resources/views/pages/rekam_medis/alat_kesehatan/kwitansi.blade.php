<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            width: 100%;
            max-width: 800px;
            margin: auto;
        }
    
        .kwitansi {
            padding: 20px;
            position: relative;
        }
        .kwitansi h2 {
            text-align: left;
            margin-bottom: 20px;
        }
        .kwitansi table {
            width: 100%;
            border-collapse: collapse;
        }
        .kwitansi th, .kwitansi td {
            padding: 8px;
            text-align: left;
        }
        .kwitansi .field {
            margin-bottom: 10px;
            font-size: 12px;
        }
        .field2 {
            margin-bottom: 10px;
            margin-left: 10px;
            font-size: 12px;
        }
        .kwitansi .field label {
            display: inline-block;
            width: 150px;
            font-weight: bold;
        }
        .kwitansi .field p {
            display: inline;
        }
        /* .tanda-tangan {
            position: absolute;
            bottom: 20px;
            right: 20px;
            text-align: center;
            width: 200px;
        } */
        .footer {
            margin-top: 13px;
            text-align: right;
            font-size: 12px;
        }
        .barcode {
            display: inline-block;
            vertical-align: middle;
            margin-left: 10px;
        }
        .margin-dokter {
         
            margin-top: 35px;
        }

    </style>
</head>
<body>
    <table width="100%">
        <tr>
            <td><img src="img/logo.png" width="50" height="50" /></td>
            <td>
                <center>
                    <font size="3"><b>MAJELIS PEMBINAAN KESEHATAN UMUM</b></font><br />
                    <font size="3"><b>RSU MUHAMMADIYAH METRO </b></font><br />
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

    <div class="kwitansi">
        <h2>Kwitansi</h2>
        <div class="field">
            <label for="penerima">Sudah Terima Dari</label>
            <p id="penerima">: {{$data->Nama_Pasien}}</p>
        </div>
        <div class="field">
            <label for="jumlah">Sejumlah</label>
            {{-- <p id="jumlah">: Rp {{number_format($data->biaya, 0, ",", ".")}} ({{ $biaya }})</p> --}}
            <p id="jumlah">: {{ $biaya }}</p>
        </div>
        <div class="field">
            <label for="pembayaran">Untuk Pembayaran</label>
            <p id="pembayaran">: {{$data->jenis_alat}}</p>
        </div>

        <div class="field2">
           
            <p id="jumlah">Rp {{number_format($data->biaya, 0, ",", ".")}}</p>
            {{-- <p id="jumlah">: {{ $biaya }}</p> --}}
        </div>

        {{-- <div class="tanda-tangan">
            <p>Tanda Tangan</p>
            <hr style="width: 100%; border-top: 1px solid #000;">
        </div> --}}
    </div>

    <div class="footer">
        <p>Metro, {{ \Carbon\Carbon::parse($data->updated_at)->format('d F Y') }}.</p>
        {{-- <p>Hormat kami,</p> --}}
        <div class="barcode">
            {{-- {!! DNS2D::getBarcodeHTML($data->NAMA_DOKTER, 'QRCODE', 2, 2) !!} --}}
        </div>
        <p class="margin-dokter">{{$data->NAMA_DOKTER}}</p>
    </div>
</body>
</html>