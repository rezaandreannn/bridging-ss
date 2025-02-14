<?php

namespace App\Helpers;

use App\Models\Simrs\Pendaftaran;
use App\Models\MasterData\TtdPerawat;
use App\Models\Operasi\LaporanOperasi;
use App\Models\Operasi\TtdTandaOperasi;
use App\Models\Operasi\PenandaanOperasi;
use App\Models\Operasi\PraBedah\AssesmenPraBedah;
use App\Models\Operasi\ChecklistPembedahan\SignIn;
use App\Models\Operasi\ChecklistPembedahan\SignOut;
use App\Models\Operasi\PostOperasi\AlatPostOperasi;
use App\Models\Operasi\PreOperasi\DataUmumPreOperasi;
use App\Models\Operasi\PreOperasi\TindakanPreOperasi;
use App\Models\Operasi\PraBedah\VerifikasiPraBedahEkg;
use App\Models\Operasi\PraBedah\VerifikasiPraBedahLab;
use App\Models\Operasi\PostOperasi\TindakanPostOperasi;
use App\Models\Operasi\PraBedah\VerifikasiPraBedahObat;
use App\Models\Operasi\PreOperasi\VerifikasiPreOperasi;
use App\Models\Operasi\PraBedah\VerifikasiPraBedahDarah;
use App\Models\Operasi\PostOperasi\VerifikasiPostOperasi;
use App\Models\Operasi\PraBedah\VerifikasiPraBedahBerkas;
use App\Models\Operasi\PraBedah\VerifikasiPraBedahRontgen;
use App\Models\Operasi\PraBedah\VerifikasiPraBedahRadiologi;
use App\Models\Operasi\PreOperasi\PemeriksaanFisikPreOperasi;
use App\Models\Operasi\PostOperasi\PemeriksaanFisikPostOperasi;

class BookingHelper
{
    public static function getStatusPenandaan($bookings)
    {
        $statusPenandaan = [];

        foreach ($bookings as $booking) {
            $exists = PenandaanOperasi::where('kode_register', $booking->kode_register)->first();
            $statusPenandaan[$booking->id] = $exists ? $exists->id : 'create';
        }

        return $statusPenandaan;
    }

    public static function getStatusLaporan($bookings)
    {
        $statusLaporan = [];

        foreach ($bookings as $booking) {
            $exists = LaporanOperasi::where('kode_register', $booking->kode_register)->first();
            $statusLaporan[$booking->id] = $exists ? $exists->id : 'Downlaod';
        }

        return $statusLaporan;
    }

    public static function getStatusPendaftaran($bookings)
    {
        $statusPendaftaran = [];

        foreach ($bookings as $booking) {
            $pendaftaran = Pendaftaran::where('No_Reg', $booking->kode_register)->first();

            if ($pendaftaran) {
                $statusPendaftaran[$booking->kode_register] = $pendaftaran->Status == 1 ? 1 : 0;  // Menggunakan angka 1 atau 0
            } else {
                $statusPendaftaran[$booking->kode_register] = 0;  // Jika tidak ditemukan, anggap nonaktif
            }
        }

        return $statusPendaftaran;
    }

    public static function getStatusGambar($bookings)
    {
        $statusGambar = [];

        foreach ($bookings as $booking) {
            $exists = PenandaanOperasi::where('kode_register', $booking->kode_register)->first();
            $statusGambar[$booking->id] = $exists ? $exists->id : null; // Gunakan null jika tidak ada gambar
        }

        return $statusGambar;
    }

    public static function getStatusPembedahanSignIn($signin)
    {
        $statusSignIn = [];

        foreach ($signin as $sign) {
            $exists = SignIn::where('kode_register', $sign->kode_register)->first();
            $statusSignIn[$sign->id] = $exists ? $exists->id : 'create';
        }

        return $statusSignIn;
    }

    public static function getStatusPembedahanSignOut($signout)
    {
        $statusSignOut = [];

        foreach ($signout as $sign) {
            $exists = SignOut::where('kode_register', $sign->kode_register)->first();
            $statusSignOut[$sign->id] = $exists ? $exists->id : 'create';
        }

        return $statusSignOut;
    }

    public static function getStatusTandaTangan($ttds)
    {
        $statusTandaTangan = [];

        foreach ($ttds as $ttd) {
            $exists = TtdTandaOperasi::where('kode_register', $ttd->kode_register)->first();
            $statusTandaTangan[$ttd->id] = $exists ? $exists->id : 'create';
        }

        return $statusTandaTangan;
    }

    public static function getStatusAssesmen($assesmens)
    {
        $statusAssesmen = [];

        foreach ($assesmens as $assesmen) {
            $exists = AssesmenPraBedah::where('kode_register', $assesmen->kode_register)->first();
            $statusAssesmen[$assesmen->id] = $exists ? $exists->id : 'create';
        }

        return $statusAssesmen;
    }

    public static function getStatusBerkasVerifikasi($verifikasis)
    {
        $statusVerifikasi = [];

        foreach ($verifikasis as $verifikasi) {
            $record = VerifikasiPraBedahBerkas::where('kode_register', $verifikasi->kode_register)->first();

            if ($record) {
                $statusVerifikasi[$verifikasi->id] = [
                    'status_pasien' => $record->status_pasien,
                    'assesmen_pra_bedah' => $record->assesmen_pra_bedah,
                    'penandaan_lokasi' => $record->penandaan_lokasi,
                    'informed_consent_bedah' => $record->informed_consent_bedah,
                    'informed_consent_anastesi' => $record->informed_consent_anastesi,
                    'assesmen_pra_anastesi_sedasi' => $record->assesmen_pra_anastesi_sedasi,
                    'edukasi_anastesi' => $record->edukasi_anastesi,
                ];
            }
        }

        return $statusVerifikasi;
    }

    // Status Verifikasi Pra Bedah
    public static function getStatusVerifikasi($verifikasis)
    {
        $statusVerifikasi = [];

        foreach ($verifikasis as $verifikasi) {
            $kodeRegister = $verifikasi->kode_register;

            $status = [
                'berkas'  => VerifikasiPraBedahBerkas::where('kode_register', $kodeRegister)->first(),
                'darah'   => VerifikasiPraBedahDarah::where('kode_register', $kodeRegister)->first(),
                'ekg'     => VerifikasiPraBedahEkg::where('kode_register', $kodeRegister)->first(),
                'lab'     => VerifikasiPraBedahLab::where('kode_register', $kodeRegister)->first(),
                'obat'    => VerifikasiPraBedahObat::where('kode_register', $kodeRegister)->first(),
                'radiologi' => VerifikasiPraBedahRadiologi::where('kode_register', $kodeRegister)->first(),
            ];

            $statusVerifikasi[$kodeRegister] = $status;
        }

        return $statusVerifikasi;
    }


    // Status Post Operasi
    public static function getStatusPostOperasi($postOperasi)
    {
        $statusPostOperasi = [];

        foreach ($postOperasi as $post) {
            $kodeRegister = $post->kode_register;

            $status = [
                'tindakan' => TindakanPostOperasi::where('kode_register', $kodeRegister)->first(),
                'alat' => AlatPostOperasi::where('kode_register', $kodeRegister)->first(),
                'ttv' => PemeriksaanFisikPostOperasi::where('kode_register', $kodeRegister)->first()
            ];

            $statusPostOperasi[$kodeRegister] = $status;
        }

        return $statusPostOperasi;
    }

    // Status Pre Operasi
    public static function getStatusPreOperasi($postOperasi)
    {
        $statusPreOperasi = [];

        foreach ($postOperasi as $post) {
            $kodeRegister = $post->kode_register;

            $status = [
                'tindakan' => TindakanPreOperasi::where('kode_register', $kodeRegister)->first(),
                'dataUmum' => DataUmumPreOperasi::where('kode_register', $kodeRegister)->first(),
                'ttv' => PemeriksaanFisikPreOperasi::where('kode_register', $kodeRegister)->first()
            ];

            $statusPreOperasi[$kodeRegister] = $status;
        }

        return $statusPreOperasi;
    }

    // Verifikasi Pre Operasi
    public static function getVerifikasiPreOperasi($verifikasiPre)
    {
        $verifikasiPreOperasi = [];

        foreach ($verifikasiPre as $pre) {
            $kodeRegister = $pre->kode_register;

            $status = [
                'verifikasi' => VerifikasiPreOperasi::where('kode_register', $kodeRegister)->first(),
            ];

            $verifikasiPreOperasi[$kodeRegister] = $status;
        }

        return $verifikasiPreOperasi;
    }

    // Verifikasi Post Operasi
    public static function getVerifikasiPostOperasi($verifikasiPost)
    {
        $verifikasiPostOperasi = [];

        foreach ($verifikasiPost as $post) {
            $kodeRegister = $post->kode_register;

            $status = [
                'verifikasi' => VerifikasiPostOperasi::where('kode_register', $kodeRegister)->first(),
            ];

            $verifikasiPostOperasi[$kodeRegister] = $status;
        }

        return $verifikasiPostOperasi;
    }


    // Status Berkas Pre Post
    public static function getStatusPrePostOperasi($prePost)
    {
        $statusPrePostOperasi = [];

        foreach ($prePost as $operasi) {
            $kodeRegister = $operasi->kode_register;

            $status = [
                'pre-operasi' => [
                    'tindakan' => TindakanPreOperasi::where('kode_register', $kodeRegister)->first(),
                    'dataUmum' => DataUmumPreOperasi::where('kode_register', $kodeRegister)->first(),
                    'ttv' => PemeriksaanFisikPreOperasi::where('kode_register', $kodeRegister)->first()
                ],
                'post-operasi' => [
                    'tindakan' => TindakanPostOperasi::where('kode_register', $kodeRegister)->first(),
                    'alat' => AlatPostOperasi::where('kode_register', $kodeRegister)->first(),
                    'ttv' => PemeriksaanFisikPostOperasi::where('kode_register', $kodeRegister)->first()
                ]
            ];

            $statusPrePostOperasi[$kodeRegister] = $status;
        }

        return $statusPrePostOperasi;
    }
}
