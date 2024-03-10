<?php

namespace App\DTO;

class OrganizationDTO
{
    public static function getTypes()
    {
        return [
            'dept' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/organization-type',
                'coding_code' => 'dept',
                'coding_display' => 'Hospital Departement',
                'keterangan' => 'Departemen Dalam Rumah sakit'
            ],
            'team' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/organization-type',
                'coding_code' => 'team',
                'coding_display' => 'Organizational team',
                'keterangan' => 'Kelompok praktisi/tenaga kesehatan yang menajalankan fungsi tertentu dalam suatu organisasi'
            ],
        ];
    }
}
