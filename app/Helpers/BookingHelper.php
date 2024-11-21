<?php

namespace App\Helpers;

use App\Models\Operasi\PenandaanOperasi;
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
}
