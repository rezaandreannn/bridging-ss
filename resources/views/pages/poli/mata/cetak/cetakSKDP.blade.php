<!DOCTYPE html>
<?php
date_default_timezone_set('Asia/Jakarta');
$dayList = array(
    'Sun' => 'Minggu',
    'Mon' => 'Senin',
    'Tue' => 'Selasa',
    'Wed' => 'Rabu',
    'Thu' => 'Kamis',
    'Fri' => 'Jumat',
    'Sat' => 'Sabtu'
);
?>
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
            text-align: center;
            font-size: 15px;
            text-decoration: underline;
        }

        table tr .text2 {
            text-align: center;
        }

        table tr .text3 {
            font-size: 15px;
        }

        table .ttd {
            padding-top: 50px;
        }

        table .barcode {
            float: right;
        }
    </style>
</head>

<body>
    <center>
        <table width="100%">
            <tr>
                <td><img src="img/logo.png" width="50" height="50" /></td>
                <td>
                    <center>
                        <font size="2"><b>MAJELIS PEMBINAAN KESEHATAN UMUM</b></font><br />
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
                <td class="text" style="font-size: 12px;">
                    @php
                    $kers = new DateTime($data->FS_SKDP_KONTROL);
                    $rujukannya = new DateTime($data->FS_SKDP_FASKES);
                    @endphp

                    @if ($data->FS_SKDP_FASKES == '')
                    <u><b>SURAT KETERANGAN KONTROL KEMBALI KE RSUMM</b></u>
                    @elseif ($kers < $rujukannya) <u><b>SURAT KETERANGAN KONTROL KEMBALI KE RSUMM</b></u>
                        @else
                        <u><b>SURAT KETERANGAN KONTROL KEMBALI KE RSUMM SETELAH DARI FASKES PRIMER</b></u>
                        @endif
                        <hr />
                </td>
            </tr>
        </table>
        <table width="100%">
            <tr>
                <td width="100" style="font-size: 10px;">Nama</td>
                <td width="175" style="font-size: 10px;">: {{ $biodata->NAMA_PASIEN ?? ''}}</td>
            </tr>
            <tr>
                <td width="100" style="font-size: 10px;">No MR</td>
                <td width="175" style="font-size: 10px;">: {{ $biodata->NO_MR ?? ''}}</td>
            </tr>
            <tr>
                <td width="100" style="font-size: 10px;">Diagnosa</td>
                <td width="175" style="font-size: 10px;">: {{ $data->DIAGNOSA ?? ''}}</td>
            </tr>
            <tr>
                <td width="100" style="font-size: 10px;">Terapi</td>
                <td width="175" style="font-size: 10px;">:</td>
            </tr>
            <tr>
                <td colspan="4"></td>
            </tr>
        </table>
        <p style="font-size: 12px; text-align:left; border: 1px solid">{!! str_replace("\n", "<br>", $resep->FS_TERAPI) !!}</p>
        <table width="100%">
            @if ($data->FS_SKDP_FASKES == '')
            <tr>
                <td class="text3" style="font-size: 12px;"><br>
                    @if ($data->FS_SKDP_KONTROL == '')
                <td class="text3" style="font-size: 12px;">Pasien dapat kontrol ke Rumah Sakit dengan catatan : <b> {{ $resep->FS_PESAN ?? ''}}</b></td>
                @else
                <td class="text3" style="font-size: 12px;"> <br>
                    Pasien dapat kontrol kembali ke Rumah Sakit pada hari <b>
                        {{ $dayList[date('D', strtotime($data->FS_SKDP_KONTROL))] . ',' . date('d M Y', strtotime($data->FS_SKDP_KONTROL)) }}
                    </b>
                </td>
                <br>
                @if ($data->FS_PESAN != null || $data->FS_PESAN != '')
                <p>catatan : {{ $data->FS_PESAN ?? ''}}</p>
                @endif
                @endif
            </tr>
            <tr>
                <td class="text3" style="font-size: 12px;">Demikian hal ini kami sampaikan untuk dapat dipergunakan sebagaimana perlu, Terimakasih.</td>
            </tr>
            @elseif ($kers < $rujukannya) <tr>
                <td class="text3" style="font-size: 12px;"><br>Belum dapat dikembalikan ke Fasilitas Perujuk dengan alasan:</td>
                </tr>
                <tr>
                    <td class="text3" style="font-size: 12px;"><b>{{ $data->FS_NM_SKDP_ALASAN ?? ''}}</b></td>
                </tr>
                <tr>
                    <td class="text3" style="font-size: 12px;">Rencana tindak lanjut yang akan dilakukan pada kunjungan selanjutnya :</td>
                </tr>
                <tr>
                    <td class="text3" style="font-size: 12px;"><b>{{ $data->FS_NM_SKDP_RENCANA ?? ''}} {{ $data->FS_SKDP_KET ?? ''}}</b></td>
                </tr>
                <tr>
                    <td class="text3" style="font-size: 12px;">Pasien dapat kontrol kembali pada <b> hari {{ $dayList[date('D', strtotime($data->FS_SKDP_KONTROL))] . ', Tanggal ' . date('d M Y', strtotime($data->FS_SKDP_KONTROL)) }}</b>
                        @if ($data->FS_PESAN != null || $data->FS_PESAN != '')
                        <p>catatan : {{ $data->FS_PESAN ?? ''}}</p>
                        @endif
                </tr>
                @if ($data->FS_SKDP_FASKES != '')
                <tr>
                    <td class="text3" style="font-size: 12px;">Adapun tanggal expired/batas masa surat rujuk faskes sampai <b> hari {{ $dayList[date('D', strtotime($data->FS_SKDP_FASKES))] . ', Tanggal ' . date('d M Y', strtotime($data->FS_SKDP_FASKES)) }}</b></td>
                </tr>
                @endif
                @else
                <tr>
                    <td>
                        Pasien dapat kontrol kembali ke Rumah Sakit setelah dari Faskes Primer pada hari <b> {{ $dayList[date('D', strtotime($data->FS_SKDP_KONTROL))] . ', Tanggal ' . date('d M Y', strtotime($data->FS_SKDP_KONTROL)) }}. </b>
                        <br>
                        @if ($data->FS_PESAN != null || $data->FS_PESAN != '')
                        <p>catatan : {{ $data->FS_PESAN ?? ''}}</p>
                        @endif
                        Demikian hal ini kami sampaikan untuk dapat dipergunakan sebagaimana perlu, Terimakasih.
                    </td>
                </tr>
                @endif
        </table>
        <table width="100%">
            <tr>
                <td></td>
                <td class="ttd" style="text-align: left;">Metro, {{ date('d-m-Y', strtotime($resep->created_at)) }}</td>
            </tr>
            <tr>
                <td></td>
                <td style="float: left;">
                    <!-- Menampilkan barcode dengan lebar 200px dan tinggi 200px -->
                    {!! DNS2D::getBarcodeHTML($resep->NAMA_DOKTER, 'QRCODE', 2, 2) !!}
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: left;">{{ $resep->NAMA_DOKTER ?? ''}}</td>
            </tr>
        </table>
    </center>
</body>

</html>