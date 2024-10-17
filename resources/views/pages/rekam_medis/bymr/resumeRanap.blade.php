
{{-- TRIASE --}}
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Surat</title>
        <style>
            .isi td {
                border: 1px solid black;
                border-collapse: collapse;
            }
            .text2 {
                font-size: 18px;
                padding-left: 5px;
            }

            .text3 {
                font-size: 15px;
                padding-left: 5px;
            }

            .text5 {
                font-size: 15px;
                text-align: center;
            }
            
            .text7 {
                font-size: 14px;
                margin: 5px; 
                padding: 0;
            }
            .text8 {
                font-size: 12px;
                border: 1px solid black;
                padding: 2px;
                text-align: left;
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
                margin: auto;
                width: 60%;
            }

            .patient-info td {
                font-size: 12px;
                padding-top: 8px;
            }

            table {
                    width: 100%;
                    border-collapse: collapse;
                }
            .tabel1{
                    border: 1px solid black;
                    padding: 2px;
                    text-align: center;
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
                            <td>: {{ $biodata->no_mr}}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>: {{ $biodata->nama_pasien}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td>: {{ date('d-m-Y', strtotime($biodata->tgl_lahir))}}</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <hr />
                </td>
            </tr>
        </table>
        <table style="border: 1px solid black;" class="isi" width="100%">
            <tr>
                <td class="text2" colspan="6" style="text-align: center; border: 1px solid black;"><b>RINGKASAN PASIEN PULANG</b></td>
            </tr>
            <tr>
                <td class="text3" colspan="2">Tanggal Masuk : {{date('d M Y', strtotime($resumePasienRanap->tanggal))}}</td>
                <td class="text3" colspan="2" width="300">Tanggal keluar :  {{date('d M Y', strtotime($resumePasienRanap->tgl_keluar ?? ""))}}</td>
                <td class="text3" colspan="2" width="300">Ruang perawatan : {{ $resumePasienRanap->nama_ruang}}</td>
            </tr>
       
            {{-- {{date('d-m-Y', strtotime($biodata->tanggal_kunjungan))}}
            {{$biodata->SPESIALIS}}
            {{$biodata->SPESIALIS}} --}}
            <tr>
                <td class="text3">Ringkasan Riwayat Pasien</td>
                <td class="text3" colspan="5"> {{ $resumePasienRanap->FS_RIWAYAT_PENYAKIT}}</td>
            </tr>
            <tr>
                <td class="text3">Pemeriksaan Fisik</td>
                <td class="text3" colspan="5"> {{ $resumePasienRanap->FS_PEMERIKSAAN_FISIK}}, S: {{ $resumePasienRanap->FS_SUHU1}} C, N: {{ $resumePasienRanap->FS_NADI1}} x/Menit, R: {{ $resumePasienRanap->FS_R1}} x/Menit, TD: {{ $resumePasienRanap->FS_TD1}} mmHg</td>
            </tr>
            <tr>
                <td class="text3">Pemeriksaan penunjang terpenting </td>
                <td class="text3" colspan="5"> {{ $resumePasienRanap->FS_PEMERIKSAAN_PENUNJANG}}</td>
            </tr>
            {{-- <tr>
                <td class="text3">Terapi / Pengobatan selama di rumah sakit</td>
                <td class="text3" colspan="5"> {{ $resumePasienRanap->FS_TERAPI}}</td>
            </tr>
            <tr>
                <td class="text3">Hasil laboratorium belum selesai</td>
                <td class="text3" colspan="5"> 
                    @if($resumePasienRanap->FS_HASIL_LAB != 'NULL')
                        {{ $resumePasienRanap->FS_HASIL_LAB }}
                    @else
                        {{ '' }}
                    @endif
                </td>
            </tr> --}}
            <tr>
                <td class="text3">Alergi (reaksi obat)</td>
                <td class="text3" colspan="5">
                    @if($resumePasienRanap->FS_ALERGI != 'NULL')
                        {{ $resumePasienRanap->FS_ALERGI }}
                    @else
                        {{ '' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td class="text3">Diet</td>
                <td class="text3" colspan="5"> 
                    @foreach ($resumeDiet as $diet)
                    {{ $diet->FS_NM_DIET}},
                    @endforeach
                </td>
            </tr>
            <tr>
                <td class="text3">Pengobatan dilanjutkan</td>
                <td class="text3" colspan="5"> 
                @if (empty($resumePasienRanap->FS_KET_KONTROL))
                    {{-- No output if FD_TGL_KONTROL is empty --}}
                @else
                    {{ $resumePasienRanap->ket_masuk }} {{ $resumePasienRanap->FS_KET_KONTROL }}, Tanggal Kontrol: {{ date('d-M-Y', strtotime($resumePasienRanap->FD_TGL_KONTROL)) }}, Jam: {{ $resumePasienRanap->FS_JAM_KONTROL }}
                    <br>
                    @if (empty($resumePasienRanap->FS_KD_LAYANAN2) || $resumePasienRanap->FS_KD_LAYANAN2 == ' ' || $resumePasienRanap->FS_KD_LAYANAN2 == 'NULL')
                        {{-- No output if FS_KD_LAYANAN2 is empty, a space, or 'NULL' --}}
                    @else
                        POLIKLINIK 2 {{ $resumePasienRanap->FS_NM_LAYANAN2 }} {{ $resumePasienRanap->FS_KET_KONTROL }}, Tanggal Kontrol: {{ date('d-M-Y', strtotime($resumePasienRanap->FD_TGL_KONTROL2)) }}, Jam: {{ $resumePasienRanap->FS_JAM_KONTROL2 }}
                    @endif
                @endif
                    
                    {{-- {{ $resumePasienRanap->ket_masuk}} {{ $resumePasienRanap->FS_KET_KONTROL}}, Tanggal Kontrol :{{date('d M Y', strtotime($resumePasienRanap->FD_TGL_KONTROL))}}, Jam :{{ $resumePasienRanap->FS_JAM_KONTROL}}  </td> --}}
            </tr>
            <tr>
                <td class="text3">Diagnosa Utama</td>
                <td class="text3" colspan="3">{{ $resumePasienRanap->FS_DIAG_UTAMA}}</td>
                <td class="text3" colspan="2">ICD 10 : {{ $resumePasienRanap->FS_ICD_DIAG_UTAMA}}</td>
            </tr>
            <tr>
                <td class="text3">Diagnosa Sekunder</td>
                <td class="text3" colspan="3">{{ $resumeDiagnosa->FS_NM_DIAG_SEK ?? ''}}</td>
                <td class="text3" colspan="2">ICD 10 : {{ $resumeDiagnosa->ICD10 ?? ''}}</td>
            </tr>
            <tr>
                <td class="text3">Tindakan / Prosedur</td>
                <td class="text3" colspan="3">{{ $resumeTindakan->FS_NM_TIND ?? ""}} </td>
                <td class="text3" colspan="2">ICD 9 : {{ $resumeTindakan->ICD9CM ?? ""}}</td>
            </tr>
            <tr>
                <td class="text3" colspan="6"><b>Keadaan Pasien Saat Pulang</b></td>
            </tr>
            <tr>
                <td class="text3">Keadaan Umum</td>
                <td class="text3" colspan="5">
                    {{ $resumePasienRanap->FS_KEADAAN_UMUM_BAIK == "YA" ? "Baik," : "" }}
                    {{ $resumePasienRanap->FS_KEADAAN_UMUM_MASIH_SAKIT == "YA" ? "Masih Sakit," : "" }}
                    {{ $resumePasienRanap->FS_KEADAAN_UMUM_SESAK == "YA" ? "Sesak," : "" }}
                    {{ $resumePasienRanap->FS_KEADAAN_UMUM_PUCAT == "YA" ? "Pucat," : "" }}
                    {{ $resumePasienRanap->FS_KEADAAN_UMUM_LEMAH == "YA" ? "Lemah," : "" }}
                    {{ $resumePasienRanap->FS_KEADAAN_UMUM_LAIN != "0" ? 'Lainnya: ' . $resumePasienRanap->FS_KEADAAN_UMUM_LAIN : '' }}
                </td>
            </tr>
            <tr>
                <td class="text3">Vital Sign</td>
                <td class="text3" colspan="5">S: {{ $resumePasienRanap->FS_SUHU}}C, N: {{ $resumePasienRanap->FS_NADI}} x/Menit, R: {{ $resumePasienRanap->FS_R}} x/Menit, TD: {{ $resumePasienRanap->FS_TD}} mmHg </td>
            </tr>
            <tr>
                <td class="text3">Pemeriksaan Fisik</td>
                <td class="text3" colspan="5"> 
                    {{ $resumePasienRanap->FS_PEM_FISIK1 == "YA" ? "Tak Anemis," : "" }}
                    {{ $resumePasienRanap->FS_PEM_FISIK2 == "YA" ? "Anemis," : "" }}
                    {{ $resumePasienRanap->FS_PEM_FISIK3 == "YA" ? "COR Dalam Batas Normal," : "" }}
                    {{ $resumePasienRanap->FS_PEM_FISIK4 == "YA" ? "Kardiomegali," : "" }}
                    {{ $resumePasienRanap->FS_PEM_FISIK5 == "YA" ? "Paru Dalam Batas Normal," : "" }}
                    {{ $resumePasienRanap->FS_PEM_FISIK6 == "YA" ? "Ekstremitas Dalam Batas Normal," : "" }}
                    {{ $resumePasienRanap->FS_PEM_FISIK7 != "YA" && $resumePasienRanap->FS_PEM_FISIK7 != "0" && $resumePasienRanap->FS_PEM_FISIK7 != "1" ? $resumePasienRanap->FS_PEM_FISIK7 : "" }}
                    {{ $resumePasienRanap->FS_PEM_FISIK8 != "YA" && $resumePasienRanap->FS_PEM_FISIK8 != "0" && $resumePasienRanap->FS_PEM_FISIK8 != "1" ? $resumePasienRanap->FS_PEM_FISIK8 : "" }}
                </td>
            </tr>
            <tr>
                <td class="text3">Cara Pulang</td>
                <td class="text3" colspan="5">
                    {{ $resumePasienRanap->FS_CARA_PULANG == "1" ? "Sembuh," : "" }}
                    {{ $resumePasienRanap->FS_CARA_PULANG == "2" ? "Tampak Masih Sakit," : "" }}
                    {{ $resumePasienRanap->FS_CARA_PULANG == "3" ? "Pulang Atas Peremintaan Sendiri," : "" }}
                    {{ $resumePasienRanap->FS_CARA_PULANG == "4" ? "Meninggal," : "" }}
                    {{ $resumePasienRanap->FS_CARA_PULANG == "5" ? "Pindah Rumah Sakit," : "" }}
                    {{ $resumePasienRanap->FS_CARA_PULANG != "1" && 
                    $resumePasienRanap->FS_CARA_PULANG != "2" && 
                    $resumePasienRanap->FS_CARA_PULANG != "3" && 
                    $resumePasienRanap->FS_CARA_PULANG != "4" && 
                    $resumePasienRanap->FS_CARA_PULANG != "5" &&
                    $resumePasienRanap->FS_CARA_PULANG != null &&
                    $resumePasienRanap->FS_CARA_PULANG != "" 
                    ? "Lainnya," . $resumePasienRanap->FS_CARA_PULANG : "" 
                    }}
                </td>
            </tr>
            <tr>
                <td class="text3">Instruksi/Anjuran edukasi</td>
                <td class="text3" colspan="5"> 
                    {!! $resumePasienRanap->FS_INSTRUKSI1 == "YA" ? "Istirahat Cukup,<br>" : "" !!}
                    {!! $resumePasienRanap->FS_INSTRUKSI2 == "YA" ? "Kontrol Sesuai Waktu Yang Di Anjurkan,<br>" : "" !!}
                    {!! $resumePasienRanap->FS_INSTRUKSI3 == "YA" ? "Minum Obat Sesuai Anjuran,<br>" : "" !!}
                    {!! $resumePasienRanap->FS_INSTRUKSI4 == "YA" ? "Tingkatkan Latihan,<br>" : "" !!}
                    {!! $resumePasienRanap->FS_INSTRUKSI5 == "YA" ? "Hubungi RSU Muhammadiyah Metro bila dalam keadaan gawat darurat," : "" !!}
                </td>
            </tr>
            <tr>
                <td class="text3" colspan="6"><b>Terapi saat pulang</b></td>
            </tr>
        </table>
        <table width="100%">
            <thead>
                <tr>
                    <th class="tabel1">Nama Obat</th>
                    <th class="tabel1">Jumlah</th>
                    <th class="tabel1">Dosis</th>
                    <th class="tabel1">Cara Pemberian</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($resumeTerapiPulang as $resep)
                <tr>
                    <td class="text8">{{$resep->FS_NM_OBAT}}</td>
                    <td class="text8">{{$resep->FS_JML_OBAT}}</td>
                    <td class="text8">{{$resep->FS_DOSIS_OBAT}}</td>
                    <td class="text8">{{$resep->FS_CARA_PEM_OBAT}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <table width="100%">
            <tr>
                <td style="padding-top: 50px;" class="text5"></td>
                <td style="padding-top: 50px;" class="text5">Tanggal {{date('d-m-Y', strtotime($resumePasienRanap->FD_TGL_PULANG))}}</td>
            </tr>
            <tr>
                <td class="text5">Tanda Tangan Pasien / Keluarga</td>
                <td class="text5">Tanda Tangan dan Nama DPJP</td>
            </tr>
            <tr>
                <tr>
                    <td class="text5" style="padding-left: 180px;">{!! DNS2D::getBarcodeHTML($biodata->nama_pasien, 'QRCODE', 2, 2) !!}</td>
                    <td class="text5" style="padding-left: 30px;"><img src="img/barcode.jpeg" width="50" height="50" /></td>
                </tr>
            </tr>
            <tr>
                <td class="text5" style="padding-left: 30px;">({{$biodata->nama_pasien}})</td>
                <td class="text5" style="padding-left: 30px;">(Dokter)</td>
            </tr>
        </table>
    </body>
</html>

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
                <td style="text-align: center">
                    <u><b>SURAT KETERANGAN KONTROL KEMBALI KE RSUMM</b></u>
                </td>
            </tr>
        </table>
        <table width="100%">
            <tr>
                <td width="100">Nama</td>
                <td width="175">: {{ $biodata->nama_pasien}}</td>
            </tr>
            <tr>
                <td width="100">No MR</td>
                <td width="175">: {{ $biodata->no_mr}}</td>
            </tr>
            <tr>
                <td width="100">Diagnosa </td>
                <td width="175">: {{ $resumePasienRanap->FS_DIAG_UTAMA}}</td>
            </tr>
            <tr>
                <td width="100">Terapi</td>
                <td width="175">:</td>
            </tr>
            <tr>
                <td colspan="4"></td>
            </tr>
        </table>
        <table width="100%">
            <thead>
                <tr>
                    <th class="tabel1">Nama Obat</th>
                    <th class="tabel1">Cara Pemakaian</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($resumeTerapiPulang as $resep)
                <tr>
                    <td class="text8">{{$resep->FS_NM_OBAT}}</td>
                    <td class="text8">{{$resep->FS_DOSIS_OBAT}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <table width="100%">
                <tr>
                    <td>
                        Pasien dapat kontrol kembali ke Rumah Sakit pada hari <b> {{ $dayList[date('D', strtotime($resumePasienRanap->FD_TGL_KONTROL))] . ', ' . date('d M Y', strtotime($resumePasienRanap->FD_TGL_KONTROL)) }}</b> , di <b>{{ $resumePasienRanap->ket_masuk}}</b>
                        adapun tanggal expired rujukan adalah : <b>{{date('d M Y', strtotime($resumePasienRanap->FS_KET_KONTROL))}}</b>
                        <br>
                        catatan : <b>{{ $resumePasienRanap->FS_KET_KONTROL}}</b>
                        <br>
                        Demikian hal ini kami sampaikan untuk dapat dipergunakan sebagaimana perlu, Terimakasih
                    </td>
                </tr>
                <table  width="100%">
                    <tr>
                        <td style="padding-top: 100px;" class="text5"></td>
                        <td style="padding-top: 100px;" class="text5">Tanda Tangan dan Nama DPJP</td>
                    </tr>
                    <tr>
                        <tr>
                            <td class="text5" style="padding-left: 30px;"></td>
                            <td class="text5" style="padding-left: 30px;"><img src="img/barcode.jpeg" width="50" height="50" /></td>
                        </tr>
                    </tr>
                    <tr>
                        <td class="text5" style="padding-left: 30px;"></td>
                        <td class="text5" style="padding-left: 30px;">(Dokter)</td>
                    </tr>
                </table>
    </center>
</body>

</html>
