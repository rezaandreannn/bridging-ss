<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cetak Pre Post Operasi</title>
    <style>
        table {
            border-collapse: collapse;
        }

        .text9 {
            font-size: 10px;
            text-align: center;
        }

        .text5 {
            font-size: 15px;
            padding: 0;
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
            font-size: 12px;
            text-align: center;
            font-weight: bold;
        }
        .tindakan {
            padding: 0;
            font-size: 14px;
            padding-left:10px;
        }
        .text-1{
            font-size: 14px;
        }

        .checkbox {
            font-size: 15px;
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
            <td colspan="2" style="padding-top:0;">
                <label class="text-1">Diagnosa : {{ $cetak->diagnosa ?? ''}}</label> <label style="float:right;" class="text-1">TB : {{ $cetak->tinggi_badan ?? ''}}</label><br>
                <label class="text-1">Jenis Operasi : {{ $cetak->jenis_operasi ?? ''}}</label> <label style="float:right;" class="text-1">BB : {{ $cetak->berat_badan ?? ''}}</label><br>
                <label class="text-1">Dokter Operator :</label> <label style="float:right;">TD : {{ $cetak->tekanan_darah ?? ''}}</label><br>
                <label class="text-1">Puasa Jam : {{ $cetak->puasa_jam ?? ''}}</label> <label style="float:right;" class="text-1">ND : {{ $cetak->nadi ?? ''}}</label><br>
                <label class="text-1">Riwayat Asma : Ada <input type="checkbox" {{ optional($cetak)->riwayat_asma == '0' ? 'checked' : '' }}> Tidak <input type="checkbox" {{ optional($cetak)->riwayat_asma == '1' ? 'checked' : '' }}></label> <label style="float:right;" class="text-1">P : {{ $cetak->pernafasan ?? ''}}</label><br>
                <label class="text-1">Alergi : {{ $cetak->alergi ?? ''}}</label> <label style="float:right;" class="text-1">SH : {{ $cetak->suhu ?? ''}}</label><br>
                <label class="text-1">Antibiotik Profilaksis : {{ $cetak->antibiotik_profilaksis ?? ''}}</label><label style="float:right;" class="text-1">Jam : {{ $cetak->antibiotik_profilaksis_jam ?? ''}}</label>      
            </td>
            <td style="padding-top:0;">
                <label class="text-1">Diagnosa Pra Bedah : {{ $cetak->diagnosa_prabedah ?? ''}}</label><br>
                <label class="text-1">Diagnosa Pasca Bedah : {{ $cetak->diagnosa_pascabedah ?? ''}}</label><br>
                <label class="text-1">Jenis Operasi : {{ $cetak->jenis_operasi_post ?? ''}}</label>  <label class="text-1" style="padding-left: 15px;">Jam Operasi :</label><br>
                <label class="text-1">Dokter Operator :  
                    @foreach ($operators as $operator)
                    {{ $operator }}
                    @endforeach</label><br>
                <label class="text-1">Asisten Bedah :  
                    @foreach ($assistens as $asisten)
                    {{ ucwords(strtolower(trim($asisten))) }}
                    @endforeach
                </label><br>
                <label class="text-1">Jenis Anestesi :</label><br>
                <label class="text-1">Dokter Anestesi :  
                    @foreach ($dokters as $dokter)
                    {{ $dokter }}
                    @endforeach</label><br>
                <label class="text-1">Asisten Anestesi :
                    @foreach ($anastesis as $anastesi)
                    {{ ucwords(strtolower(trim($anastesi))) }}
                    @endforeach
                </label>
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
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->lapor_dokter == '1' ? 'checked' : '' }} class="checkbox"></td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->lapor_dokter == '0' ? 'checked' : '' }} class="checkbox"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">2</td>
                            <td class="tindakan">Melapor ke kamar bedah</td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->lapor_kamar == '1' ? 'checked' : '' }} class="checkbox"></td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->lapor_kamar == '0' ? 'checked' : '' }} class="checkbox"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">3</td>
                            <td class="tindakan">Mengisi surat izin pembedahan dan anestesi</td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->surat_izin_pembedahan == '1' ? 'checked' : '' }} class="checkbox"></td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->surat_izin_pembedahan == '0' ? 'checked' : '' }} class="checkbox"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">4</td>
                            <td class="tindakan">Menandai daerah operasi</td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->tandai_daerah_operasi == '1' ? 'checked' : '' }} class="checkbox"></td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->tandai_daerah_operasi == '0' ? 'checked' : '' }} class="checkbox"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">5</td>
                            <td class="tindakan">Memakai gelang identitas</td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->memakai_gelang_identitas == '1' ? 'checked' : '' }} class="checkbox"></td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->memakai_gelang_identitas == '0' ? 'checked' : '' }} class="checkbox"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">6</td>
                            <td class="tindakan">Melepas Aksesoris</td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->melepas_aksesoris == '1' ? 'checked' : '' }} class="checkbox"></td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->melepas_aksesoris == '0' ? 'checked' : '' }} class="checkbox"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">7</td>
                            <td class="tindakan">Menghapus lipstick,cat kuku</td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->menghapus_aksesoris == '1' ? 'checked' : '' }} class="checkbox"></td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->menghapus_aksesoris == '0' ? 'checked' : '' }} class="checkbox"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">8</td>
                            <td class="tindakan">Melakukan oral hygiene</td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->melakukan_oral_hygiene == '1' ? 'checked' : '' }} class="checkbox"></td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->melakukan_oral_hygiene == '0' ? 'checked' : '' }} class="checkbox"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">9</td>
                            <td class="tindakan">Memasang bidai, fiksasi leher</td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->memasang_bidai == '1' ? 'checked' : '' }} class="checkbox"></td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->memasang_bidai == '0' ? 'checked' : '' }} class="checkbox"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">10</td>
                            <td class="tindakan">Memasang infuse</td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->memasang_infuse == '1' ? 'checked' : '' }} class="checkbox"></td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->memasang_infuse == '0' ? 'checked' : '' }} class="checkbox"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">11</td>
                            <td class="tindakan">Memasang DC</td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->memasang_dc == '1' ? 'checked' : '' }} class="checkbox"></td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->memasang_dc == '0' ? 'checked' : '' }} class="checkbox"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">12</td>
                            <td class="tindakan">Memasang NGT</td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->memasang_ngt == '1' ? 'checked' : '' }} class="checkbox"></td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->memasang_ngt == '0' ? 'checked' : '' }} class="checkbox"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">13</td>
                            <td class="tindakan">Memasang drainage</td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->memasang_drainage == '1' ? 'checked' : '' }} class="checkbox"></td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->memasang_drainage == '0' ? 'checked' : '' }} class="checkbox"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">14</td>
                            <td class="tindakan">Memasang WSD</td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->memasang_wsd == '1' ? 'checked' : '' }} class="checkbox"></td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->memasang_wsd == '0' ? 'checked' : '' }} class="checkbox"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">15</td>
                            <td class="tindakan">Mencukur daerah operasi</td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->mencukur_daerah_operasi == '1' ? 'checked' : '' }} class="checkbox"></td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->mencukur_daerah_operasi == '0' ? 'checked' : '' }} class="checkbox"></td>
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
                            <td class="tindakan"> <input type="checkbox" {{ optional($cetak)->penyakit_dm == '1' ? 'checked' : '' }} class="checkbox"></td>
                            <td class="tindakan"> <input type="checkbox" {{ optional($cetak)->penyakit_dm == '0' ? 'checked' : '' }} class="checkbox"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">2</td>
                            <td class="tindakan">Hipertensi</td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->penyakit_hipertensi == '1' ? 'checked' : '' }} class="checkbox"></td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->penyakit_hipertensi == '0' ? 'checked' : '' }} class="checkbox"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">3</td>
                            <td class="tindakan">TB Paru</td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->penyakit_tb_paru == '1' ? 'checked' : '' }} class="checkbox"></td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->penyakit_tb_paru == '0' ? 'checked' : '' }} class="checkbox"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">4</td>
                            <td class="tindakan">HIV / AIDS</td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->penyakit_hiv == '1' ? 'checked' : '' }} class="checkbox"></td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->penyakit_hiv == '0' ? 'checked' : '' }} class="checkbox"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">5</td>
                            <td class="tindakan">Hepatitis B-C-A</td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->penyakit_hepatitis == '1' ? 'checked' : '' }} class="checkbox"></td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->penyakit_hepatitis == '0' ? 'checked' : '' }} class="checkbox"></td>
                        </tr>
                    </tbody>
                </table>
                <label>Premedikasi : {{ $cetak->premedikasi ?? ''}} </label> <label style="padding-left:20px;">Jam : {{ $cetak->premedikasi_jam ?? ''}}</label><br>
                <label>IVFD : {{ $cetak->ivfd ?? ''}} tts/menis</label>
                <label style="padding-left:20px;">DC No : {{ $cetak->dc ?? ''}}</label><br>
                <label>Catatan Medis :</label><br>
                    <input type="checkbox" {{ optional($cetak)->assesmen_pra_bedah == '1' ? 'checked' : '' }} class="checkbox"> Asesmen Pra Bedah
                    <input type="checkbox" {{ optional($cetak)->edukasi_anastesi == '1' ? 'checked' : '' }} class="checkbox"> Edukasi Anestesi <br>
                    <input type="checkbox" {{ optional($cetak)->informed_consent_bedah == '1' ? 'checked' : '' }} class="checkbox"> Informed Consent Bedah
                    <input type="checkbox" {{ optional($cetak)->informed_consent_anestesi == '1' ? 'checked' : '' }} class="checkbox"> Informed Consent Anestesi
                </label><br>
                <label>Darah : {{ $cetak->darah ?? ''}} cc</label>
                <label style="padding-left: 20px;">Gol : {{ $cetak->gol ?? ''}}</label><br>
                <label>Obat : {{ $cetak->obat ?? ''}}</label>
                <label style="padding-left: 30px;">Foto Rontgen : {{ $cetak->rontgen ?? ''}}</label>
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
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->status_pasien == '1' ? 'checked' : '' }} class="checkbox"></td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->status_pasien == '0' ? 'checked' : '' }} class="checkbox"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">2</td>
                            <td class="tindakan">Catatan anestesi</td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->catatan_anestesi == '1' ? 'checked' : '' }} class="checkbox"></td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->catatan_anestesi == '0' ? 'checked' : '' }} class="checkbox"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">3</td>
                            <td class="tindakan">Laporan pembedahan</td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->laporan_pembedahan == '1' ? 'checked' : '' }} class="checkbox"></td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->laporan_pembedahan == '0' ? 'checked' : '' }} class="checkbox"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">4</td>
                            <td class="tindakan">Perencanaa medis pasca bedah</td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->perencanaan_pasca_medis == '1' ? 'checked' : '' }} class="checkbox"></td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->perencanaan_pasca_medis == '0' ? 'checked' : '' }} class="checkbox"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">5</td>
                            <td class="tindakan">Cheklist keselamatan pasien</td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->checklist_keselamatan_pasien == '1' ? 'checked' : '' }} class="checkbox"></td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->checklist_keselamatan_pasien == '0' ? 'checked' : '' }} class="checkbox"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">6</td>
                            <td class="tindakan">Cheklist monitoring alat</td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->checklist_monitoring == '1' ? 'checked' : '' }} class="checkbox"></td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->checklist_monitoring == '0' ? 'checked' : '' }} class="checkbox"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">7</td>
                            <td class="tindakan">Askep perioperatif</td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->askep_perioperatif == '1' ? 'checked' : '' }} class="checkbox"></td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->askep_perioperatif == '0' ? 'checked' : '' }} class="checkbox"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">8</td>
                            <td class="tindakan">Lembar pemantauan pembedahan</td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->lembar_pemantauan == '1' ? 'checked' : '' }} class="checkbox"></td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->lembar_pemantauan == '0' ? 'checked' : '' }} class="checkbox"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">9</td>
                            <td class="tindakan">Formulir pemeriksaan</td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->formulir_pemeriksaan == '1' ? 'checked' : '' }} class="checkbox"></td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->formulir_pemeriksaan == '0' ? 'checked' : '' }} class="checkbox"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">10</td>
                            <td class="tindakan">Bahan/sampel pemeriksaan</td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->sampel_pemeriksaan == '1' ? 'checked' : '' }} class="checkbox"></td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->sampel_pemeriksaan == '0' ? 'checked' : '' }} class="checkbox"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">11</td>
                            <td class="tindakan">Foto rontgen</td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->foto_rontgen_post == '1' ? 'checked' : '' }} class="checkbox"></td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->foto_rontgen_post == '0' ? 'checked' : '' }} class="checkbox"></td>
                        </tr>
                        <tr>
                            <td class="tindakan">12</td>
                            <td class="tindakan">Resep</td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->resep == '1' ? 'checked' : '' }} class="checkbox"></td>
                            <td class="tindakan"><input type="checkbox" {{ optional($cetak)->resep == '0' ? 'checked' : '' }} class="checkbox"></td>
                        </tr>
                    </tbody>
                </table>
                <span>Terpasang :</span><br>
                <input type="checkbox" {{ optional($cetak)->ngt == '1' ? 'checked' : '' }} class="checkbox"> NGT
                <input type="checkbox" {{ optional($cetak)->tampon_vagina == '1' ? 'checked' : '' }} class="checkbox"> Tampon Vagina<br>
                <input type="checkbox" {{ optional($cetak)->drain == '1' ? 'checked' : '' }} class="checkbox"> Drain
                <input type="checkbox" {{ optional($cetak)->tranfusi == '1' ? 'checked' : '' }} class="checkbox"> Tranfusi<br>
                <input type="checkbox" {{ optional($cetak)->tampon_hidung == '1' ? 'checked' : '' }} class="checkbox"> Tampon Hidung
                <input type="checkbox" {{ optional($cetak)->ivfd == '1' ? 'checked' : '' }} class="checkbox"> IVFD<br>
                <input type="checkbox" {{ optional($cetak)->tampon_gigi == '1' ? 'checked' : '' }} class="checkbox"> Tampon Gigi
                <input type="checkbox" {{ optional($cetak)->kompres_luka == '1' ? 'checked' : '' }} class="checkbox"> Kompres Luka<br>
                <input type="checkbox" {{ optional($cetak)->tampon_abdomen == '1' ? 'checked' : '' }} class="checkbox"> Tampon Abdomen
                <input type="checkbox" {{ optional($cetak)->dc == '1' ? 'checked' : '' }} class="checkbox"> DC<br><br>
                <label>Keadaan Umum : {{ $cetak->keadaan_umum_post ?? ''}}</label><br>
                <label>Kesadaran : {{ $cetak->kesadaran_post ?? ''}}</label><br>
                <label>TD : {{ $cetak->tekanan_darah_post ?? ''}} mmHg,</label> <label style="padding-left: 20px;">ND : {{ $cetak->nadi_post ?? ''}} x/mnt</label><br>
                <label>SH : {{ $cetak->suhu_post ?? ''}} mmHg,</label> <label style="padding-left: 20px;">P : {{ $cetak->pernafasan_post ?? ''}} x/mnt</label><br>
                <label>Intruksi Dokter bedah via lisan : {{ $cetak->instruksi_dokter ?? ''}}</label><br>
            </td>
    </table>
    <table style="border: 1px solid black; border-top:none" width="100%">
        <tr>
            <td width="25%" class="text5"> Yang menerima Petugas Anestesi</td>
            <td width="25%" class="text5"> Yang menyerahkan Petugas Ruangan</td>
            <td width="25%" class="text5"> Yang menerima Petugas Ruangan</td>
            <td width="25%" class="text5"> Yang menyerahkan Petugas Anestesi</td>
        </tr>
        <tr>
            <td width="25%" class="text5" style="padding-left: 60px;">{!! DNS2D::getBarcodeHTML($cetak->created_by_post, 'QRCODE', 2, 2) !!}</td>
            <td width="25%" class="text5" style="padding-left: 80px;"> {!! DNS2D::getBarcodeHTML($cetak->created_by_pre, 'QRCODE', 2, 2) !!}</td>
            <td width="25%" class="text5" style="padding-left: 70px;">{!! DNS2D::getBarcodeHTML($cetak->created_by_pre, 'QRCODE', 2, 2) !!}</td>
            <td width="25%" class="text5" style="padding-left: 70px;">{!! DNS2D::getBarcodeHTML($cetak->created_by_post, 'QRCODE', 2, 2) !!}</td>
        </tr>
        <tr>
            <td width="25%" class="text5">({{ $cetak->created_by_post}})</td>
            <td width="25%" class="text5">({{ $cetak->created_by_pre}})</td>
            <td width="25%" class="text5">({{ optional($cetak)->created_by_pre ?? ''}})</td>
            <td width="25%" class="text5">({{ optional($cetak)->created_by_post ?? ''}})</td>
        </tr>
    </table>
</body>
</html>
