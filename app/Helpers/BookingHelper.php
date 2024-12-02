<?php

namespace App\Helpers;

use App\Models\Operasi\PenandaanOperasi;
use App\Models\Operasi\PraBedah\AssesmenPraBedah;
use App\Models\Operasi\PraBedah\VerifikasiPraBedahBerkas;
use App\Models\Operasi\PraBedah\VerifikasiPraBedahDarah;
use App\Models\Operasi\PraBedah\VerifikasiPraBedahEkg;
use App\Models\Operasi\PraBedah\VerifikasiPraBedahLab;
use App\Models\Operasi\PraBedah\VerifikasiPraBedahObat;
use App\Models\Operasi\PraBedah\VerifikasiPraBedahRontgen;
use App\Models\Operasi\TtdTandaOperasi;

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

    public static function getStatusVerifikasi($verifikasis)
    {
        $statusVerifikasi = [];

        foreach ($verifikasis as $verifikasi) {
            $kodeRegister = $verifikasi->kode_register;

            $status = [
                'berkas'  => VerifikasiPraBedahBerkas::where('kode_register', $kodeRegister)->exists(),
                'darah'   => VerifikasiPraBedahDarah::where('kode_register', $kodeRegister)->exists(),
                'ekg'     => VerifikasiPraBedahEkg::where('kode_register', $kodeRegister)->exists(),
                'lab'     => VerifikasiPraBedahLab::where('kode_register', $kodeRegister)->exists(),
                'obat'    => VerifikasiPraBedahObat::where('kode_register', $kodeRegister)->exists(),
                'rontgen' => VerifikasiPraBedahRontgen::where('kode_register', $kodeRegister)->exists(),
            ];

            $statusVerifikasi[$kodeRegister] = $status;
        }

        return $statusVerifikasi;
    }
}
