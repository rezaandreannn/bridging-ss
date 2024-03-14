<?php

namespace App\DTO;

class OrganizationDTO
{
    public static function getIdentifierUse()
    {
        return [
            'usual' => [
                'code_system' => 'http://hl7.org/fhir/identifier_use',
                'identifier_use' => 'usual',
                'keterangan' => 'Identifier yang direkomendasikan digunakan untuk interaksi dunia nyata'
            ],
            'official' => [
                'code_system' => 'http://hl7.org/fhir/identifier_use',
                'identifier_use' => 'official',
                'keterangan' => 'Identifier yang dianggap paling terpercaya. Terkadang juga dikenal sebagai "primer" dan "utama". Penentuan "resmi" bersifat subyektif dan panduan implementasi seringkali memberikan panduan tambahan untuk digunakan.'
            ],
            'temp' => [
                'code_system' => 'http://hl7.org/fhir/identifier_use',
                'identifier_use' => 'temp',
                'keterangan' => 'Identifier sementara'
            ],
            'secondary' => [
                'code_system' => 'http://hl7.org/fhir/identifier_use',
                'identifier_use' => 'secondary',
                'keterangan' => 'Identifier yang ditugaskan dalam penggunaan sekunder - ini berfungsi untuk mengidentifikasi objek dalam konteks relatif, tetapi tidak dapat secara konsisten ditugaskan ke objek yang sama lagi dalam konteks yang berbeda'
            ],
            'old' => [
                'code_system' => 'http://hl7.org/fhir/identifier_use',
                'identifier_use' => 'old',
                'keterangan' => 'Id identifier sudah dianggap tidak valid, tetapi masih memungkinkan relevan untuk kebutuhan pencarian'
            ]
        ];
    }

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
            'prov'  => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/organization-type',
                'coding_code' => 'prov',
                'coding_display' => 'Healthcare Provider',
                'keterangan' => 'Fasilitas Pelayanan Kesehatan'
            ],
            'govt'  => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/organization-type',
                'coding_code' => 'govt',
                'coding_display' => 'Government',
                'keterangan' => 'Organisasi Pemerintah'
            ],
            'ins'   => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/organization-type',
                'coding_code' => 'ins',
                'coding_display' => 'Insurance Company',
                'keterangan' => 'Perusahaan Asuransi'
            ],
            'pay'   => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/organization-type',
                'coding_code' => 'pay',
                'coding_display' => 'Payer',
                'keterangan' => 'Badan Penjamin'
            ],
            'edu'   => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/organization-type',
                'coding_code' => 'edu',
                'coding_display' => 'Educational Institute',
                'keterangan' => 'Institusi Pendidikan/Penelitian'
            ],
            'reli'  => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/organization-type',
                'coding_code' => 'edu',
                'coding_display' => 'Religious Institution',
                'keterangan' => 'Organisasi Keagamaan'
            ],
            'crs'   => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/organization-type',
                'coding_code' => 'crs',
                'coding_display' => 'Clinical Research Sponsor',
                'keterangan' => 'Sponsor penelitian klinis'
            ],
            'cg'    => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/organization-type',
                'coding_code' => 'cg',
                'coding_display' => 'Community Group',
                'keterangan' => 'Kelompok Masyarakat'
            ],
            'bus'   => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/organization-type',
                'coding_code' => 'bus',
                'coding_display' => 'Non-Healthcare Business or Corporation',
                'keterangan' => 'Perusahaan diluar bidang kesehatan'
            ],
            'other' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/organization-type',
                'coding_code' => 'other',
                'coding_display' => 'Other',
                'keterangan' => 'Lain-lain'
            ]
        ];
    }

    public static function getTelecomSystem()
    {
        return [
            'phone' => [
                'coding_system' => 'http://hl7.org/fhir/contact-point-system',
                'telecom_system' => 'phone',
                'keterangan' => 'Nomor Telepon Kantor'
            ],
            'fax' => [
                'coding_system' => 'http://hl7.org/fhir/contact-point-system',
                'telecom_system' => 'fax',
                'keterangan' => 'Nomor Fax'
            ],
            'email' => [
                'coding_system' => 'http://hl7.org/fhir/contact-point-system',
                'telecom_system' => 'email',
                'keterangan' => 'Email Kantor'
            ],
            'pager' => [
                'coding_system' => 'http://hl7.org/fhir/contact-point-system',
                'telecom_system' => 'pager',
                'keterangan' => 'Pager'
            ],
            'url' => [
                'coding_system' => 'http://hl7.org/fhir/contact-point-system',
                'telecom_system' => 'url',
                'keterangan' => 'URL website kantor'
            ],
            'sms' => [
                'coding_system' => 'http://hl7.org/fhir/contact-point-system',
                'telecom_system' => 'sms',
                'keterangan' => 'Nomor SMS kantor'
            ],
            'other' => [
                'coding_system' => 'http://hl7.org/fhir/contact-point-system',
                'telecom_system' => 'other',
                'keterangan' => 'Lain-lain'
            ],
        ];
    }

    public static function getTelecomUse()
    {
        return [
            'home' => [
                'coding_system' => 'http://hl7.org/fhir/contact-point-use',
                'telecom_use' => 'home',
                'keterangan' => 'Rumah'
            ],
            'work' => [
                'coding_system' => 'http://hl7.org/fhir/R4/contact-point-use',
                'telecom_use' => 'work',
                'keterangan' => 'Tempat kerja'
            ],
            'temp' => [
                'coding_system' => 'http://hl7.org/fhir/R4/contact-point-use',
                'telecom_use' => 'temp',
                'keterangan' => 'Sementara'
            ],
            'old' => [
                'coding_system' => 'http://hl7.org/fhir/R4/contact-point-use',
                'telecom_use' => 'old',
                'keterangan' => 'Tidak digunakan lagi'
            ],
            'mobile' => [
                'coding_system' => 'http://hl7.org/fhir/R4/contact-point-use',
                'telecom_use' => 'mobile',
                'keterangan' => 'Telepon seluler'
            ],
        ];
    }

    public static function getAddressUse()
    {
        return [
            'home' => [
                'coding_system' => 'http://hl7.org/fhir/address-use',
                'address_use' => 'home',
                'keterangan' => 'Rumah'
            ],
            'work' => [
                'coding_system' => 'http://hl7.org/fhir/address-use',
                'address_use' => 'work',
                'keterangan' => 'Tempat kerja'
            ],
            'temp' => [
                'coding_system' => 'http://hl7.org/fhir/address-use',
                'address_use' => 'temp',
                'keterangan' => 'Sementara'
            ],
            'old' => [
                'coding_system' => 'http://hl7.org/fhir/address-use',
                'address_use' => 'old',
                'keterangan' => 'Tidak digunakan lagi'
            ],
            'biling' => [
                'coding_system' => 'http://hl7.org/fhir/address-use',
                'address_use' => 'biling',
                'keterangan' => 'Penagihan'
            ],
        ];
    }

    public static function getAddressType()
    {
        return [
            'postal' => [
                'coding_system' => 'http://hl7.org/fhir/address-type',
                'address_type' => 'postal',
                'keterangan' => 'Alamat surat'
            ],
            'physical' => [
                'coding_system' => 'http://hl7.org/fhir/address-type',
                'address_type' => 'physical',
                'keterangan' => 'Alamat fisik yang dapat dikunjungi.'
            ],
            'both' => [
                'coding_system' => 'http://hl7.org/fhir/address-type',
                'address_type' => 'both',
                'keterangan' => 'Alamat yang bersifat fisik dan surat.'
            ],
        ];
    }

    public static function getContactPurpose()
    {
        return [
            'BILL' => [
                'purpose_coding_system' => 'http://terminology.hl7.org/CodeSystem/contactentity-type',
                'purpose_coding_code' => 'BILL',
                'purpose_coding_display' => 'Billing',
                'keterangan' => 'Billing'
            ],
            'ADMIN' => [
                'purpose_coding_system' => 'http://terminology.hl7.org/CodeSystem/contactentity-type',
                'purpose_coding_code' => 'ADMIN',
                'purpose_coding_display' => 'Administrative',
                'keterangan' => 'Administratif'
            ],
            'HR' => [
                'purpose_coding_system' => 'http://terminology.hl7.org/CodeSystem/contactentity-type',
                'purpose_coding_code' => 'HR',
                'purpose_coding_display' => 'Human Resource',
                'keterangan' => 'SDM seperti informasi staf/tenaga kesehatan'
            ],
            'PAYOR' => [
                'purpose_coding_system' => 'http://terminology.hl7.org/CodeSystem/contactentity-type',
                'purpose_coding_code' => 'PAYOR',
                'purpose_coding_display' => 'Payor',
                'keterangan' => 'Klaim asuransi, pembayaran'
            ],
            'PATINF' => [
                'purpose_coding_system' => 'http://terminology.hl7.org/CodeSystem/contactentity-type',
                'purpose_coding_code' => 'PATINF',
                'purpose_coding_display' => 'Patient',
                'keterangan' => 'Informasi umum untuk pasien'
            ],
            'PRESS' => [
                'purpose_coding_system' => 'http://terminology.hl7.org/CodeSystem/contactentity-type',
                'purpose_coding_code' => 'PRESS',
                'purpose_coding_display' => 'Press',
                'keterangan' => 'Pertanyaan terkait press'
            ],
        ];
    }
}
