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
        .text1 {
            padding-left: 15px;
            font-size: 13px;
        }
        .text2 {
            font-size: 12px; 
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
        /* Tanda Ceklis */
        ul {
            list-style: none;
            padding-left: 0;
            margin: 0;
        }
        li {
            position: relative;
            padding-left: 25px; /* Ruang untuk gambar ceklis */
            margin-bottom: 5px;
        }
        li::before {
            content: '';
            position: absolute;
            margin: 0;
            left: 0;
            top: 0;
            width: 20px;
            height: 20px;
            background-image: url('img/ceklis.png'); /* URL gambar ceklis */
            background-size: contain;
            background-repeat: no-repeat;
        }
        /* Penutup Tanda Ceklis */
        /* Tanda Tangan */
        .tanda {
            font-size: 12px;
            border: 1px solid black;
            border-top: none;
            margin: 0;
            
        }
        .tandatangan {
            font-size: 12px;
            border: 1px solid black;
            border-top: none;
            border-left: none;
            padding: 0 30px;
            margin: 0; /* Menghapus margin untuk menghindari spasi atas */
            text-align: center; /* Menyelaraskan teks di tengah */
        }
        /* Penutup Tanda Tangan */
        /* Barcode */
        .barcode {
            padding-left: 30px;
        }
        /* Penutup Barcode */
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
                        <td>: {{ $biodata->NO_MR ?? ''}}</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>: {{ $biodata->NAMA_PASIEN ?? ''}}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>: {{ date('d-m-Y', strtotime($biodata->TGL_LAHIR))}}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table style="border: 1px solid black" width="100%">
        <tr>
            <td class="text3" colspan="3" style="text-align: center; border: 1px solid black"><b>PEMEBERIAN INFORMASI DAN PERSETUJUAN/PENOLAKAN TINDAKAN TERAPI MODALITAS REHABILITASI MEDIK</b></td>
        </tr>
        <tr>
            <td class="text3" colspan="3" style="border: 1px solid black">Dokter Pelaksana Tindakan : {{ $biodata->HP1 ?? ''}}</td>
        </tr>
        <tr>
            <td class="text3" colspan="3" style="border: 1px solid black">Pemberi Informasi :  </td>
        </tr>
        <tr>
            <td class="text3" colspan="3" style="border: 1px solid black">Penerima Informasi / Pemberi Persetujuan : </td>
        </tr>
    </table>
    <table border="1" width="100%">
        <tr>
            <th style="text-align: center;">No</th>
            <th style="text-align: center;">JENIS INFORMASI</th>
            <th style="text-align: center;">ISI INFORMASI</th>
        </tr>
        <tr>
            <td class="text1">1</td>
            <td class="text1">Diagnosa(WD dan DD)</td>
            <td></td>
        </tr>
        <tr>
            <td class="text1">2</td>
            <td class="text1">Dasar Diagnosa</td>
            <td>
                <ul style="list-style: none; padding-left: 0;">
                    <li class="text2">Anamnesa</li>
                    <li class="text2">Pemeriksaan Fisik</li>
                    <li class="text2">Pemeriksaan Penunjang</li>
                </ul>
            </td>
        </tr>
        <tr>
            <td class="text1">3</td>
            <td class="text1">Tindakan Kedokteran</td>
            <td class="text1">Terapi Modalitas</td>
        </tr>
        <tr>
            <td class="text1">4</td>
            <td class="text1">Indikasi Tindakan</td>
            <td>
                <ul style="list-style: none; padding-left: 0;">
                    <li class="text2">Nyeri</li>
                    <li class="text2">Proses Peradangan</li>
                    <li class="text2">Stifness (Adanya Kekakuan)</li>
                    <li class="text2">Kelemahan Otot</li>
                </ul>
            </td>
        </tr>
        <tr>
            <td class="text1">5</td>
            <td class="text1">Tata Cara</td>
            <td>
                <ul style="list-style: none; padding-left: 0;">
                    <li class="text2">Pemberian Diatermi</li>
                    <li class="text2">Pemberian Electrical Stimulation</li>
                    <li class="text2">Pemberian TMS</li>
                </ul>
            </td>
        </tr>
        <tr>
            <td class="text1">6</td>
            <td class="text1">Tujuan</td>
            <td>
                <ul style="list-style: none; padding-left: 0;">
                    <li class="text2">Mengurangi Nyeri</li>
                    <li class="text2">Mengurangi Proses Peradangan</li>
                    <li class="text2">Meningkatkan Ekstensibilitas Jaringan</li>
                    <li class="text2">Stimulasi Saraf</li>
                </ul>
            </td>
        </tr>
        <tr>
            <td class="text1">7</td>
            <td class="text1">Resiko</td>
            <td class="text1">Iritasi kulit, rasa tidak nyaman</td>
        </tr>
        <tr>
            <td class="text1">8</td>
            <td class="text1">Komplikasi</td>
            <td class="text1">Luka bakar, kerusakan jaringan</td>
        </tr>
        <tr>
            <td class="text1">9</td>
            <td class="text1">Prognosis</td>
            <td class="text1">Dubin ad bonam - Dubis ad malam</td>
        </tr>
        <tr>
            <td class="text1">10</td>
            <td class="text1">Alternatif</td>
            <td class="text1"> - </td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td rowspan="2" colspan="2" class="tanda">Dengan ini menyatakan bahwa saya telah menerangkan hal-hal di atas secara benar dan jelas dan memberikan kesempatan untuk bertanya dan atau berdiskusi.</td>
            <td class="tandatangan" colspan="2" style="border-left:none; border-top:none;border-bottom:none;">Pemberi Informasi</td>
          </tr>
        <tr>
            <td class="tandatangan" colspan="2" style="border-left:none; border-top:none;">
                <img src="img/barcode.jpeg" width="50" height="50" />
                <div>(dr. Bastian)</div>
            </td>
        </tr>
        <tr>
            <td rowspan="2" colspan="2" class="tanda">Dengan ini menyatakan bahwa saya telah menerima informasi sebagaimana di atas yang beri tanda/paraf di kolom kanannya telah memahaminya</td>
            <td class="tandatangan" colspan="2" style="border-left:none; border-top:none;border-bottom:none;">Penerima Informasi</td>
          </tr>
        <tr>
            <td class="tandatangan" colspan="2" style="border-left:none; border-top:none;">
                <img src="img/barcode.jpeg" width="50" height="50" />
                <div>(Pasien)</div>
            </td>
        </tr>
    </table>
</body>

</html>

<!DOCTYPE html>
<html lang="en">
    <head>
    
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
                            <td>: {{ $biodata->NO_MR ?? ''}}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>: {{ $biodata->NAMA_PASIEN ?? ''}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td>: {{ date('d-m-Y', strtotime($biodata->TGL_LAHIR))}}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table width="100%" style="border:solid 1px black;border-bottom:none;">
            <tr>
                <td colspan="4" class="text1">Saya yang bertanda tangan dibawah ini :</td>
                <td></td>
            </tr>
            <tr>
                <td width="20%" class="text1">NIK</td>
                <td colspan="4" class="text1">: 23131313213142</td>
            <tr>
            <tr>
                <td width="20%" class="text1">Nama</td>
                <td colspan="4" class="text1">: Dimas Budi Pratama</td>
            <tr>
            <tr>
                <td width="20%" class="text1">Tgl Lahir</td>
                <td colspan="4" class="text1">: 10 Febuari 2000</td>
            <tr>
            <tr>
                <td width="20%"  class="text1">No Telp</td>
                <td colspan="4" class="text1">: 082279137077</td>
            <tr>
            <tr>
                <td width="20%"  class="text1">Jenis Kelamin</td>
                <td colspan="4" class="text1">: Laki-Laki</td>
            <tr>
            <tr>
                <td width="20%"  class="text1">Penanggung Jawab</td>
                <td colspan="4" class="text1">: Diri Sendiri</td>
            </tr>
            <tr>
                <td colspan="4" width="100%" class="text1">Persetujuan/Penolakan untuk dilakukan tindakan <b>TERAPI MODALITAS REHABITLITAS MEDIK</b> terhadap pasien RSU MUHAMMADIYAH METRO :</td>
                <td></td>
            </tr>
            <tr>
                <td width="20%" class="text1">No.RM</td>
                <td colspan="4" class="text1">: 231313</td>
            </tr>
            <tr>
                <td width="20%" class="text1">Nama</td>
                <td colspan="4" class="text1">: Dimas Budi Pratama</td>
            </tr>
            <tr>
                <td width="20%" class="text1">Tanggal Lahir</td>
                <td colspan="4" class="text1">: 10 Febuari 2000</td>
            </tr>
            <tr>
                <td colspan="4" width="100%" class="text1">Saya Telah dijelaskan memahami tentang jenis tindakan beserta manfaat, resiko, komplikasi yang mungkin belum diprediksi. Saya menyadari bahwa ilmu kedokteran bukanlah ilmu pasti maka keberhasilan tindakan kedokteran sangat bertanggung kepada izin Tuhan yang maha esa</td>
                <td></td>
            </tr>
            <tr>
                <td width="60%"></td>
                <td colspan="4" class="text1">Metro,26-05-2024 , Jam : 09.50  WIB</td>
            </tr>
        </table>
        <table width="100%" style="border:solid 1px black; border-top:none;">
            <tr>
                <td class="barcode" width="40%">Dokter</td>
                <td>Yang menyatakan</td>
                <td>Saksi Pihak Rumah Sakit</td>
            </tr>
            <tr>
                <td class="barcode"><img src="img/barcode.jpeg" width="50" height="50" /></td>
                <td class="barcode"><img src="img/barcode.jpeg" width="50" height="50" /></td>
                <td class="barcode"><img src="img/barcode.jpeg" width="50" height="50" /></td>
            </tr>
            <tr>
                <td class="barcode">(dr. Bastian)</td>
                <td class="barcode">(Pasien)</td>
                <td class="barcode">(Saksi)</td>
            </tr>
        </table>
    </body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
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
                        <td>: {{ $biodata->NO_MR ?? ''}}</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>: {{ $biodata->NAMA_PASIEN ?? ''}}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>: {{ date('d-m-Y', strtotime($biodata->TGL_LAHIR))}}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td class="text3" colspan="4" style="text-align: center; border: 1px solid black"><b>PERSETUJUAN TINDAKAN KEDOKTERAN</b></td>
        </tr>
    </table>
    <table width="100%" style="border:solid 1px black;border-bottom:none;">
        <tr>
            <td colspan="4" class="text1">Saya yang bertanda tangan dibawah ini saya:</td>
            <td></td>
        </tr>
        <tr>
            <td width="20%" class="text1">Nama</td>
            <td colspan="4" class="text1">: Dimas Budi Pratama</td>
        <tr>
        <tr>
            <td width="20%" class="text1">Umur</td>
            <td colspan="4" class="text1">: 18</td>
        <tr>
        <tr>
            <td width="20%" class="text1">Jenis Kelamin</td>
            <td colspan="4" class="text1">: Laki-Laki</td>
        <tr>
        <tr>
            <td width="20%" class="text1">Alamat</td>
            <td colspan="4" class="text1">: Jl Nusa Indah 1</td>
        <tr>
        <tr>
            <td width="20%"  class="text1">Dengan ini menyatakan <b>SETUJU</b> untuk dilakukan tindakan</td>
            <td colspan="4" class="text1">: Fisioterapi</td>
        <tr>
        <tr>
            <td width="20%" class="text1">Nama</td>
            <td colspan="4" class="text1">: Dimas Budi Pratama</td>
        <tr>
        <tr>
            <td width="20%" class="text1">Umur</td>
            <td colspan="4" class="text1">: 18</td>
        <tr>
        <tr>
            <td width="20%" class="text1">Jenis Kelamin</td>
            <td colspan="4" class="text1">: Laki-Laki</td>
        <tr>
        <tr>
            <td width="20%" class="text1">Alamat</td>
            <td colspan="4" class="text1">: Jl Nusa Indah 1</td>
        <tr>
        <tr>
            <td colspan="4" width="100%" class="text1">Saya memahami perlunya dan manfaat tindakan tersebut sebagaimana telah dijelaskan dalam tabel pemberian informasi pada halaman sebelumnya, termasuk resiko dan komplikasi yang mungkin timbul. Saya juga menyadari bahwa oleh karena ilmu kedokteran bukan ilmu pasti, maka keberhasilan tindakan kedokteran bukanlah keniscayaan, melainkan sangat bergantung kepada Tuhan Yang Maha Esa.</td>
            <td></td>
        </tr>
        <tr>
            <td width="60%"></td>
            <td colspan="4" class="text1">Metro,26-05-2024 , Jam : 09.50  WIB</td>
        </tr>
    </table>
    <table width="100%" style="border:solid 1px black; border-top:none;">
        <tr>
            <td class="barcode" width="60%">Yang menyatakan</td>
            <td>Saksi Pihak Rumah Sakit</td>
        </tr>
        <tr>
            <td class="barcode"><img src="img/barcode.jpeg" width="50" height="50" /></td>
            <td class="barcode"><img src="img/barcode.jpeg" width="50" height="50" /></td>
        </tr>
        <tr>
            <td class="barcode">(Pasien)</td>
            <td class="barcode">(Saksi)</td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td class="text3" colspan="4" style="text-align: center; border: 1px solid black"><b>PENOLAKAN TINDAKAN KEDOKTERAN</b></td>
        </tr>
    </table>
    <table width="100%" style="border:solid 1px black;border-bottom:none;">
        <tr>
            <td colspan="4" class="text1">Saya yang bertanda tangan dibawah ini saya:</td>
            <td></td>
        </tr>
        <tr>
            <td width="20%" class="text1">Nama</td>
            <td colspan="4" class="text1">: Dimas Budi Pratama</td>
        <tr>
        <tr>
            <td width="20%" class="text1">Umur</td>
            <td colspan="4" class="text1">: 18</td>
        <tr>
        <tr>
            <td width="20%" class="text1">Jenis Kelamin</td>
            <td colspan="4" class="text1">: Laki-Laki</td>
        <tr>
        <tr>
            <td width="20%" class="text1">Alamat</td>
            <td colspan="4" class="text1">: Jl Nusa Indah 1</td>
        <tr>
        <tr>
            <td width="20%"  class="text1">Dengan ini menyatakan <b>MENOLAK</b> untuk dilakukan tindakan</td>
            <td colspan="4" class="text1">: Fisioterapi</td>
        <tr>
        <tr>
            <td width="20%" class="text1">Nama</td>
            <td colspan="4" class="text1">: Dimas Budi Pratama</td>
        <tr>
        <tr>
            <td width="20%" class="text1">Umur</td>
            <td colspan="4" class="text1">: 18</td>
        <tr>
        <tr>
            <td width="20%" class="text1">Jenis Kelamin</td>
            <td colspan="4" class="text1">: Laki-Laki</td>
        <tr>
        <tr>
            <td width="20%" class="text1">Alamat</td>
            <td colspan="4" class="text1">: Jl Nusa Indah 1</td>
        <tr>
        <tr>
            <td colspan="4" width="100%" class="text1">Saya memahami perlunya dan manfaat tindakan tersebut sebagaimana telah dijelaskan dalam tabel pemberian informasi pada halaman sebelumnya, termasuk resiko dan komplikasi yang mungkin timbul. Saya juga menyadari bahwa oleh karena ilmu kedokteran bukan ilmu pasti, maka keberhasilan tindakan kedokteran bukanlah keniscayaan, melainkan sangat bergantung kepada Tuhan Yang Maha Esa.</td>
            <td></td>
        </tr>
        <tr>
            <td width="60%"></td>
            <td colspan="4" class="text1">Metro,26-05-2024 , Jam : 09.50  WIB</td>
        </tr>
    </table>
    <table width="100%" style="border:solid 1px black; border-top:none;">
        <tr>
            <td class="barcode" width="60%">Yang menyatakan</td>
            <td>Saksi Pihak Rumah Sakit</td>
        </tr>
        <tr>
            <td class="barcode"><img src="img/barcode.jpeg" width="50" height="50" /></td>
            <td class="barcode"><img src="img/barcode.jpeg" width="50" height="50" /></td>
        </tr>
        <tr>
            <td class="barcode">(Pasien)</td>
            <td class="barcode">(Saksi)</td>
        </tr>
    </table>
</body>
</html>