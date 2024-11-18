<?php

namespace App\Helpers;

use App\Models\Operasi\PenandaanOperasi;

class BookingHelper
{
    public static function getStatusPenandaan($bookings)
    {
        $statusPenandaan = [];

        foreach ($bookings as $booking) {
            $exists = PenandaanOperasi::where('kode_register', $booking->kode_register)->exists();
            $statusPenandaan[$booking->id] = $exists ? 'create' : $exists->id;
        }

        return $statusPenandaan;
    }
}
