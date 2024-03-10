<?php

namespace App\DTO;

class LocationDTO
{
    public static function getPhysicalTypes()
    {
        return [
            'si' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/location-physical-type',
                'coding_code' => 'si',
                'coding_display' => 'Site',
                'keterangan' => 'Kumpulan banguanan atau lokasi lain seperti kompleks atau kampus'
            ],
            'bu' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/location-physical-type',
                'coding_code' => 'bu',
                'coding_display' => 'Building',
                'keterangan' => 'Setiap bangunana atau struktur'
            ],
            'lvl' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/location-physical-type',
                'coding_code' => 'lvl',
                'coding_display' => 'Level',
                'keterangan' => 'Lantai di Gedung/Struktur'
            ],
            'ro' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/location-physical-type',
                'coding_code' => 'ro',
                'coding_display' => 'Room',
                'keterangan' => 'Sebuah ruangan yang dialokasikan sebagai ruangan'
            ],
        ];
    }

    public static function getModes()
    {
        return [
            'instance' => [
                'code_system' => 'http://hl7.org/fhir/location-mode',
                'mode' => 'instance',
                'keterangan' => 'Merepresentasikan lokasi spesifik'
            ],
            'kind' => [
                'code_system' => 'http://hl7.org/fhir/location-mode',
                'mode' => 'kind',
                'keterangan' => 'Merepresentasikan kelompok/kelas lokasi'
            ]
        ];
    }
}
