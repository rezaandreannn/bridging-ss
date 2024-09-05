<?php

namespace App\Helpers;

class NumberToWords
{
    public static function terbilang($angka)
    {
        $baca = [
            0 => 'Nol',
            1 => 'Satu',
            2 => 'Dua',
            3 => 'Tiga',
            4 => 'Empat',
            5 => 'Lima',
            6 => 'Enam',
            7 => 'Tujuh',
            8 => 'Delapan',
            9 => 'Sembilan',
            10 => 'Sepuluh',
            11 => 'Sebelas',
            12 => 'Dua Belas',
            13 => 'Tiga Belas',
            14 => 'Empat Belas',
            15 => 'Lima Belas',
            16 => 'Enam Belas',
            17 => 'Tujuh Belas',
            18 => 'Delapan Belas',
            19 => 'Sembilan Belas',
            20 => 'Dua Puluh',
            30 => 'Tiga Puluh',
            40 => 'Empat Puluh',
            50 => 'Lima Puluh',
            60 => 'Enam Puluh',
            70 => 'Tujuh Puluh',
            80 => 'Delapan Puluh',
            90 => 'Sembilan Puluh',
            100 => 'Seratus',
            1000 => 'Seribu',
            1000000 => 'Satu Juta'
        ];

        if ($angka < 20) {
            return $baca[$angka];
        }

        if ($angka < 100) {
            $unit = floor($angka / 10) * 10;
            $remainder = $angka % 10;
            return $baca[$unit] . ($remainder ? ' ' . self::terbilang($remainder) : '');
        }

        if ($angka < 1000) {
            $unit = floor($angka / 100);
            $remainder = $angka % 100;
            return ($unit > 1 ? self::terbilang($unit) . ' ' : '') . 'Ratus' . ($remainder ? ' ' . self::terbilang($remainder) : '');
        }
 
        $unitIndex = 0;
        $units = ['', 'Ribu', 'Juta', 'Miliar', 'Triliun'];

        while ($angka >= 1000) {
            $angka /= 1000;
            $unitIndex++;
        }

        $unit = floor($angka);
        $remainder = $angka - $unit;

        return self::terbilang($unit) . ' ' . $units[$unitIndex] . ($remainder ? ' ' . self::terbilang($remainder * 1000) : '');
    }
}
?>