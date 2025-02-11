<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cetak Assesmen Pra Bedah</title>
    <style>
        table {
            border-collapse: collapse;
        }

        .text9 {
            font-size: 10px;
            text-align: center;
        }

        .text-3 {
            margin-bottom: 10px;
        }

        .text5 {
            font-size: 15px;
            text-align: center;
        }

        .logo-cell {
            border-right: none;
            width: 10%;
            padding-left: 20px;
        }

        .logo-cell-2 {
            border-left: none;
            width: 10%;
            padding-right: 20px;
        }

        .info-cell {
            text-align: center;
            border-left: none;
            border-right: none;
            width: 40%;
            padding-top: 5px;
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
            font-size: 12px;
            padding-right: 10px;
            margin: auto;
        }

        .table-kop,
        .table-kop td,
        .table-nama,
        .table-nama td {
            border: none;
        }

        .table-nama {
            border-collapse: collapse;
            width: 100%;
        }

        .table-nama td {
            padding: 4px;
        }

        .table-kop td {
            font-size: 6px;
            padding: 4px;
        }

        .patient-info {
            margin: auto;
            width: 60%;
        }

        .patient-info td {
            font-size: 10px;
            padding-top: 2px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .tabel1 {
            border: 1px solid black;
            padding: 2px;
            text-align: center;
        }

        .section-title {
            font-weight: bold;
            text-align: center;
            padding: 0;
        }
        .judul-tindakan {
            padding: 0;
            font-size: 14px;
            text-align: center;
            font-weight: bold;
        }
        .tindakan {
            padding: 0;
            font-size: 18px;
            padding-left:10px;
        }

        .checkbox {
            margin-right: 3px;
        }

        .area-1 {
            height: 80px;
            width: 300px;
            font-family: Arial, Helvetica, sans-serif;
            border:none;
            font-size: 12px;
        }

        td,
        th {
            border: 1px solid black;
            padding: 10px;
            vertical-align: top;
        }

        th {
            background-color: #f2f2f2;
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
                <table class="table-kop">
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
                <table class="table-nama">
                    <tr>
                        <td>No. RM </td>
                        <td>: {{ $pasien->No_MR ?? '' }} </td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>: {{ $pasien->Nama_Pasien ?? ''}}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>: {{ date('d-m-Y', strtotime($pasien->TGL_LAHIR))}}</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>: {{ $pasien->JENIS_KELAMIN ?? '' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td colspan="3" class="section-title">DATA UMUM PASIEN PRE DAN POST OPERASI</td>
        </tr>
        <tr>
            <td colspan="2">
                <label>Diagnosa :</label><br>
                <label>Jenis Operasi :</label><br>
                <label>Dokter Operator :</label><br>
                <label>Puasa Jam :</label><br>
                <label>Riwayat Asma : Ada <input type="checkbox"> Tidak <input type="checkbox"></label><br>
                <label>Alergi :</label><br>
                <label>Antibiotik Profilaksis :</label>
            </td>
            <td>
                <label>Diagnosa Pra Bedah :</label><br>
                <label>Diagnosa Pasca Bedah :</label><br>
                <label>Jenis Operasi :</label><br>
                <label>Dokter Operator :</label><br>
                <label>Asisten Bedah :</label><br>
                <label>Jam Operasi :</label><br>
                <label>Jenis Anestesi :</label><br>
                <label>Asisten Anestesi :</label>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="section-title">
                <label>PERSIAPAN PRE OPERASI</label>
            </td>
            <td class="section-title">
                <label>SERAH TERIMA POST OPERASI</label>
            </td>
        </tr>
        <tr>
            <td colspan="2" width="50%">
                <table>
                    <thead>
                        <tr>
                            <th class="judul-tindakan">NO</th>
                            <th class="judul-tindakan">TINDAKAN</th>
                            <th class="judul-tindakan">YA</th>
                            <th class="judul-tindakan">TIDAK</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="tindakan">1</td>
                            <td class="tindakan">Melapor ke dokter bedah</td>
                            <td class="tindakan"></td>
                            <td class="tindakan"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">2</td>
                            <td class="tindakan">Melapor ke kamar bedah</td>
                            <td class="tindakan"></td>
                            <td class="tindakan"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">3</td>
                            <td class="tindakan">Mengisi surat izin pembedahan dan anestesi</td>
                            <td class="tindakan"></td>
                            <td class="tindakan"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">4</td>
                            <td class="tindakan">Menandai daerah operasi</td>
                            <td class="tindakan"></td>
                            <td class="tindakan"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">5</td>
                            <td class="tindakan">Memakai gelang identitas</td>
                            <td class="tindakan"></td>
                            <td class="tindakan"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">6</td>
                            <td class="tindakan">Melepas Aksesoris</td>
                            <td class="tindakan"></td>
                            <td class="tindakan"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">7</td>
                            <td class="tindakan">Menghapus lipstick,cat kuku</td>
                            <td class="tindakan"></td>
                            <td class="tindakan"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">8</td>
                            <td class="tindakan">Melakukan oral hygiene</td>
                            <td class="tindakan"></td>
                            <td class="tindakan"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">9</td>
                            <td class="tindakan">Memasang bidai, fiksasi leher</td>
                            <td class="tindakan"></td>
                            <td class="tindakan"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">10</td>
                            <td class="tindakan">Memasang infuse</td>
                            <td class="tindakan"></td>
                            <td class="tindakan"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">11</td>
                            <td class="tindakan">Memasang DC</td>
                            <td class="tindakan"></td>
                            <td class="tindakan"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">12</td>
                            <td class="tindakan">Memasang NGT</td>
                            <td class="tindakan"></td>
                            <td class="tindakan"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">13</td>
                            <td class="tindakan">Memasang drainage</td>
                            <td class="tindakan"></td>
                            <td class="tindakan"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">14</td>
                            <td class="tindakan">Memasang WSD</td>
                            <td class="tindakan"></td>
                            <td class="tindakan"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">15</td>
                            <td class="tindakan">Mencukur daerah operasi</td>
                            <td class="tindakan"></td>
                            <td class="tindakan"></td>
                        </tr>
                    </tbody>
                </table>
                <table>
                    <thead>
                        <tr>
                            <th class="judul-tindakan"></th>
                            <th class="judul-tindakan">PENYAKIT KRONIS</th>
                            <th class="judul-tindakan">YA</th>
                            <th class="judul-tindakan">TIDAK</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="tindakan">1</td>
                            <td class="tindakan">DM</td>
                            <td class="tindakan"></td>
                            <td class="tindakan"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">2</td>
                            <td class="tindakan">Hipertensi</td>
                            <td class="tindakan"></td>
                            <td class="tindakan"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">3</td>
                            <td class="tindakan">TB Paru</td>
                            <td class="tindakan"></td>
                            <td class="tindakan"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">4</td>
                            <td class="tindakan">HIV / AIDS</td>
                            <td class="tindakan"></td>
                            <td class="tindakan"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">5</td>
                            <td class="tindakan">Hepatitis B-C-A</td>
                            <td class="tindakan"></td>
                            <td class="tindakan"></td>
                        </tr>
                    </tbody>
                </table>
                <span>Premedikasi :</span><br>
                <label>IVFD : tts/menis</label><br>
                <label>DC No :</label><br>
                <label>Darah : cc</label>
                <label>Gol : </label><br>
                <label>Obat : </label>
                <label>Foto Rontgen : </label>
            </td> 
            <td width="50%">
                <table class="tindakan">
                    <thead>
                        <tr>
                            <th class="judul-tindakan">NO</th>
                            <th class="judul-tindakan">TINDAKAN</th>
                            <th class="judul-tindakan">YA</th>
                            <th class="judul-tindakan">TIDAK</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="tindakan">1</td>
                            <td class="tindakan">Status Pasien</td>
                            <td class="tindakan"></td>
                            <td class="tindakan"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">2</td>
                            <td class="tindakan">Catatan anestesi</td>
                            <td class="tindakan"></td>
                            <td class="tindakan"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">3</td>
                            <td class="tindakan">Laporan pembedahan</td>
                            <td class="tindakan"></td>
                            <td class="tindakan"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">4</td>
                            <td class="tindakan">Perencanaa medis pasca bedah</td>
                            <td class="tindakan"></td>
                            <td class="tindakan"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">5</td>
                            <td class="tindakan">Cheklist keselamatan pasien</td>
                            <td class="tindakan"></td>
                            <td class="tindakan"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">6</td>
                            <td class="tindakan">Cheklist monitoring alat</td>
                            <td class="tindakan"></td>
                            <td class="tindakan"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">7</td>
                            <td class="tindakan">Askep perioperatif</td>
                            <td class="tindakan"></td>
                            <td class="tindakan"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">8</td>
                            <td class="tindakan">Lembar pemantauan pembedahan</td>
                            <td class="tindakan"></td>
                            <td class="tindakan"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">9</td>
                            <td class="tindakan">Formulir pemeriksaan</td>
                            <td class="tindakan"></td>
                            <td class="tindakan"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">10</td>
                            <td class="tindakan">Bahan/sampel pemeriksaan</td>
                            <td class="tindakan"></td>
                            <td class="tindakan"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">11</td>
                            <td class="tindakan">Foto rontgen</td>
                            <td class="tindakan"></td>
                            <td class="tindakan"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">12</td>
                            <td class="tindakan">Resep</td>
                            <td class="tindakan"></td>
                            <td class="tindakan"></td>
                        </tr>
                    </tbody>
                </table>
                <span>Terpasang :</span><br>
                <div style="display: flex; gap: 20px;">
                    <!-- Bagian 1 -->
                    <div>
                        <input type="checkbox" {{ optional($cetak)->ngt == '1' ? 'checked' : '' }} class="checkbox"> NGT<br>
                        <input type="checkbox" {{ optional($cetak)->drain == '1' ? 'checked' : '' }} class="checkbox"> Drain<br>
                        <input type="checkbox" {{ optional($cetak)->tampon_hidung == '1' ? 'checked' : '' }} class="checkbox"> Tampon Hidung<br>
                        <input type="checkbox" {{ optional($cetak)->tampon_gigi == '1' ? 'checked' : '' }} class="checkbox"> Tampon Gigi<br>
                        <input type="checkbox" {{ optional($cetak)->tampon_abdomen == '1' ? 'checked' : '' }} class="checkbox"> Tampon Abdomen<br>
                    </div>
                
                    <!-- Bagian 2 -->
                    <div>
                        <input type="checkbox" {{ optional($cetak)->tampon_vagina == '1' ? 'checked' : '' }} class="checkbox"> Tampon Vagina<br>
                        <input type="checkbox" {{ optional($cetak)->tranfusi == '1' ? 'checked' : '' }} class="checkbox"> Tranfusi<br>
                        <input type="checkbox" {{ optional($cetak)->ivfd == '1' ? 'checked' : '' }} class="checkbox"> IVFD<br>
                        <input type="checkbox" {{ optional($cetak)->kompres_luka == '1' ? 'checked' : '' }} class="checkbox"> Kompres Luka<br>
                        <input type="checkbox" {{ optional($cetak)->dc == '1' ? 'checked' : '' }} class="checkbox"> DC<br>
                    </div>
                </div>
            </td>
    </table>
    <table style="border: 1px solid black; border-top:none" width="100%">
        <tr>
            <td width="30%" class="text5"> Tanda Tangan Dokter Operator</td>
            <td width="40%" class="text5"> Tanda Tangan Pasien/Keluarga</td>
            <td width="30%" class="text5"> Tanda Tangan Perawat</td>
        </tr>
        <tr>
            <td width="30%" class="text5" style="padding-left: 60px;">{!! DNS2D::getBarcodeHTML($booking->nama_dokter, 'QRCODE', 3, 3) !!}</td>
            <td width="40%" class="text5" style="padding-left: 80px;"> {!! DNS2D::getBarcodeHTML($booking->nama_pasien, 'QRCODE', 3, 3) !!}</td>
            <td width="30%" class="text5" style="padding-left: 70px;">{!! DNS2D::getBarcodeHTML($booking->created_by, 'QRCODE', 3, 3) !!}</td>
        </tr>
        <tr>
            <td width="30%" class="text5">({{ $booking->nama_dokter}})</td>
            <td width="40%" class="text9">({{ $booking->nama_pasien}})</td>
            <td width="30%" class="text5">({{ optional($cetak)->created_by ?? ''}})</td>
        </tr>
    </table>
</body>
</html>
