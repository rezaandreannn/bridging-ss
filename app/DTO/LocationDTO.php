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
            'wi' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/location-physical-type',
                'coding_code' => 'wi',
                'coding_display' => 'Wing',
                'keterangan' => 'Sayap di dalam Gedung, sering berisi lantai, kamar, dan koridor'
            ],
            'wa' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/location-physical-type',
                'coding_code' => 'wa',
                'coding_display' => 'Ward',
                'keterangan' => 'Bangsal adalah bagian dari fasilitas medis yang mungkin berisi kamar dan jenis lokasi lainnya'
            ],
            'co' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/location-physical-type',
                'coding_code' => 'co',
                'coding_display' => 'Corridor',
                'keterangan' => 'Setiap koridor di dalam Gedung, yang dapat menghubungkan kamar-kamar'
            ],
            'bd' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/location-physical-type',
                'coding_code' => 'bd',
                'coding_display' => 'Bed',
                'keterangan' => 'Tempat tidur yang dapat ditempati'
            ],
            've' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/location-physical-type',
                'coding_code' => 've',
                'coding_display' => 'Vehicle',
                'keterangan' => 'Alat transportasi'
            ],
            'ho' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/location-physical-type',
                'coding_code' => 'ho',
                'coding_display' => 'House',
                'keterangan' => 'Rumah'
            ],
            'ca' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/location-physical-type',
                'coding_code' => 'ca',
                'coding_display' => 'Cabinet',
                'keterangan' => 'Wadah yang dapat menyimpan barang, peralatan, obat-obatan atau barang lainnya'
            ],
            'rd' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/location-physical-type',
                'coding_code' => 'rd',
                'coding_display' => 'Road',
                'keterangan' => 'Jalan'
            ],
            'area' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/location-physical-type',
                'coding_code' => 'area',
                'coding_display' => 'Cabinet',
                'keterangan' => 'Area (contoh : zona risiko banjir, wilayah, wilayah kodepos)'
            ],
            'jdn' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/location-physical-type',
                'coding_code' => 'jdn',
                'coding_display' => 'Jurisdiction',
                'keterangan' => 'Negara, Provinsi'
            ],
            'vir' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/location-physical-type',
                'coding_code' => 'vir',
                'coding_display' => 'Virtual',
                'keterangan' => 'Virtual'
            ]
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

    public static function getStatus()
    {
        return [
            'instance' => [
                'code_system' => 'http://hl7.org/fhir/location-status',
                'location_status' => 'active',
                'keterangan' => 'Lokasi sedang beroperasi'
            ],
            'suspended' => [
                'code_system' => 'http://hl7.org/fhir/location-status',
                'location_status' => 'suspended',
                'keterangan' => 'Lokasi ditutup sementara'
            ],
            'inactive' => [
                'code_system' => 'http://hl7.org/fhir/location-status',
                'location_status' => 'inactive',
                'keterangan' => 'Lokasi tidak lagi digunakan'
            ]
        ];
    }

    public static function getOperationalStatus()
    {
        return [
            'C' => [
                'code_system' => 'http://terminology.hl7.org/CodeSystem/v2-0116',
                'Status_code' => 'C',
                'Status_display' => 'Closed',
                'keterangan' => 'Tutup'
            ],
            'H' => [
                'code_system' => 'http://terminology.hl7.org/CodeSystem/v2-0116',
                'Status_code' => 'H',
                'Status_display' => 'Housekeeping',
                'keterangan' => 'Dalam pembersihan'
            ],
            'I' => [
                'code_system' => 'http://terminology.hl7.org/CodeSystem/v2-0116',
                'Status_code' => 'I',
                'Status_display' => 'Isolated',
                'keterangan' => 'Isolasi'
            ],
            'K' => [
                'code_system' => 'http://terminology.hl7.org/CodeSystem/v2-0116',
                'Status_code' => 'K',
                'Status_display' => 'Contaminated',
                'keterangan' => 'Terkontaminasi'
            ],
            'O' => [
                'code_system' => 'http://terminology.hl7.org/CodeSystem/v2-0116',
                'Status_code' => 'O',
                'Status_display' => 'Occupied',
                'keterangan' => 'Terisi'
            ],
            'U' => [
                'code_system' => 'http://terminology.hl7.org/CodeSystem/v2-0116',
                'Status_code' => 'U',
                'Status_display' => 'Unoccupied',
                'keterangan' => 'Tidak terisi'
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
                'telecom_use' => 'home',
                'keterangan' => 'Rumah'
            ],
            'work' => [
                'coding_system' => 'http://hl7.org/fhir/address-use',
                'telecom_use' => 'work',
                'keterangan' => 'Tempat kerja'
            ],
            'temp' => [
                'coding_system' => 'http://hl7.org/fhir/address-use',
                'telecom_use' => 'temp',
                'keterangan' => 'Sementara'
            ],
            'old' => [
                'coding_system' => 'http://hl7.org/fhir/address-use',
                'telecom_use' => 'old',
                'keterangan' => 'Tidak digunakan lagi'
            ],
            'biling' => [
                'coding_system' => 'http://hl7.org/fhir/address-use',
                'telecom_use' => 'biling',
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

    public static function getDaysOfWeek()
    {
        return [
            'mon' => [
                'coding_system' => 'http://hl7.org/fhir/days-of-week',
                'days_of_week' => 'mon',
                'keterangan' => 'Senin'
            ],
            'tue' => [
                'coding_system' => 'http://hl7.org/fhir/days-of-week',
                'days_of_week' => 'tue',
                'keterangan' => 'Selasa'
            ],
            'wed' => [
                'coding_system' => 'http://hl7.org/fhir/days-of-week',
                'days_of_week' => 'wed',
                'keterangan' => 'Rabu'
            ],
            'thu' => [
                'coding_system' => 'http://hl7.org/fhir/days-of-week',
                'days_of_week' => 'thu',
                'keterangan' => 'Kamis'
            ],
            'fri' => [
                'coding_system' => 'http://hl7.org/fhir/days-of-week',
                'days_of_week' => 'fri',
                'keterangan' => 'Jumat'
            ],
            'sat' => [
                'coding_system' => 'http://hl7.org/fhir/days-of-week',
                'days_of_week' => 'sat',
                'keterangan' => 'Sabtu'
            ],
            'sun' => [
                'coding_system' => 'http://hl7.org/fhir/days-of-week',
                'days_of_week' => 'sun',
                'keterangan' => 'Minggu'
            ]
        ];
    }

    public static function getServiceClass()
    {
        return [
            '1' => [
                'serviceClass_system' => 'http://terminology.kemkes.go.id/CodeSystem/locationServiceClass-Inpatient',
                'serviceClass_code' => '1',
                'serviceClass_display' => 'Kelas 1',
                'keterangan' => 'Perawatan Kelas 1'
            ],
            '2' => [
                'serviceClass_system' => 'http://terminology.kemkes.go.id/CodeSystem/locationServiceClass-Inpatient',
                'serviceClass_code' => '2',
                'serviceClass_display' => 'Kelas 2',
                'keterangan' => 'Perawatan Kelas 2'
            ],
            '3' => [
                'serviceClass_system' => 'http://terminology.kemkes.go.id/CodeSystem/locationServiceClass-Inpatient',
                'serviceClass_code' => '3',
                'serviceClass_display' => 'Kelas 3',
                'keterangan' => 'Perawatan Kelas 3'
            ],
            'vip' => [
                'serviceClass_system' => 'http://terminology.kemkes.go.id/CodeSystem/locationServiceClass-Inpatient',
                'serviceClass_code' => 'vip',
                'serviceClass_display' => 'Kelas VIP',
                'keterangan' => 'Perawatan Kelas VIP'
            ],
            'vvip' => [
                'serviceClass_system' => 'http://terminology.kemkes.go.id/CodeSystem/locationServiceClass-Inpatient',
                'serviceClass_code' => 'vvip',
                'serviceClass_display' => 'Kelas VVIP',
                'keterangan' => 'Perawatan Kelas VVIP'
            ],
            'reguler' => [
                'serviceClass_system' => 'http://terminology.kemkes.go.id/CodeSystem/locationServiceClass-Inpatient',
                'serviceClass_code' => 'reguler',
                'serviceClass_display' => 'Kelas Reguler',
                'keterangan' => 'Perawatan Kelas Reguler'
            ],
            'eksekutif' => [
                'serviceClass_system' => 'http://terminology.kemkes.go.id/CodeSystem/locationServiceClass-Inpatient',
                'serviceClass_code' => 'eksekutif',
                'serviceClass_display' => 'Kelas Eksekutif',
                'keterangan' => 'Perawatan Kelas Eksekutif'
            ]
        ];
    }

    public static function getType()
    {
        return [
            'RT0001' => [
                'type_system' => 'http://terminology.kemkes.go.id/CodeSystem/location-type',
                'type_code' => 'RT0001',
                'type_display' => 'Wahana PIDI',
                'keterangan' => 'Wahana PIDI'
            ],
            'RT0002' => [
                'type_system' => 'http://terminology.kemkes.go.id/CodeSystem/location-type',
                'type_code' => 'RT0002',
                'type_display' => 'Wahana PIDGI',
                'keterangan' => 'Wahana PIDGI'
            ],
            'RT0003' => [
                'type_system' => 'http://terminology.kemkes.go.id/CodeSystem/location-type',
                'type_code' => 'RT0003',
                'type_display' => 'RS Pendidikan',
                'keterangan' => 'RS Pendidikan'
            ],
            'RT0004' => [
                'type_system' => 'http://terminology.kemkes.go.id/CodeSystem/location-type',
                'type_code' => 'RT0004',
                'type_display' => 'Tempat Tidur',
                'keterangan' => 'Tempat Tidur'
            ],
            'RT0005' => [
                'type_system' => 'http://terminology.kemkes.go.id/CodeSystem/location-type',
                'type_code' => 'RT0005',
                'type_display' => 'Bank Darah',
                'keterangan' => 'Bank Darah'
            ],
            'RT0006' => [
                'type_system' => 'http://terminology.kemkes.go.id/CodeSystem/location-type',
                'type_code' => 'RT0006',
                'type_display' => 'Instalasi Gawat Darurat',
                'keterangan' => 'Instalasi Gawat Darurat'
            ],
            'RT0007' => [
                'type_system' => 'http://terminology.kemkes.go.id/CodeSystem/location-type',
                'type_code' => 'RT0007',
                'type_display' => 'Ruang Perawatan Intensif Umum (ICU)',
                'keterangan' => 'Ruang Perawatan Intensif Umum (ICU)'
            ],
            'RT0008' => [
                'type_system' => 'http://terminology.kemkes.go.id/CodeSystem/location-type',
                'type_code' => 'RT0008',
                'type_display' => 'Ruangan Persalinan',
                'keterangan' => 'Ruangan Persalinan'
            ],
            'RT0009' => [
                'type_system' => 'http://terminology.kemkes.go.id/CodeSystem/location-type',
                'type_code' => 'RT0009',
                'type_display' => 'Ruang Perawatan Intensif',
                'keterangan' => 'Ruang Perawatan Intensif'
            ],
            'RT0010' => [
                'type_system' => 'http://terminology.kemkes.go.id/CodeSystem/location-type',
                'type_code' => 'RT0010',
                'type_display' => 'Daerah Rawat Pasien ICU/ICCU/HCU/ PICU',
                'keterangan' => 'Daerah Rawat Pasien ICU/ICCU/HCU/ PICU'
            ],
            'RT0011' => [
                'type_system' => 'http://terminology.kemkes.go.id/CodeSystem/location-type',
                'type_code' => 'RT0011',
                'type_display' => 'Ruangan Perawatan Intensif Pediatrik (PICU)',
                'keterangan' => 'Ruangan Perawatan Intensif Pediatrik (PICU)'
            ],
            'RT0012' => [
                'type_system' => 'http://terminology.kemkes.go.id/CodeSystem/location-type',
                'type_code' => 'RT0012',
                'type_display' => 'Ruangan Perawatan Intensif Neonatus(NICU)',
                'keterangan' => 'Ruangan Perawatan Intensif Neonatus(NICU)'
            ],
            'RT0013' => [
                'type_system' => 'http://terminology.kemkes.go.id/CodeSystem/location-type',
                'type_code' => 'RT0013',
                'type_display' => 'High Care Unit (HCU)',
                'keterangan' => 'High Care Unit (HCU)'
            ],
            'RT0014' => [
                'type_system' => 'http://terminology.kemkes.go.id/CodeSystem/location-type',
                'type_code' => 'RT0014',
                'type_display' => 'Intensive Cardiology Care Unit (ICCU)',
                'keterangan' => 'Intensive Cardiology Care Unit (ICCU)'
            ],
            'RT0015' => [
                'type_system' => 'http://terminology.kemkes.go.id/CodeSystem/location-type',
                'type_code' => 'RT0015',
                'type_display' => 'Respiratory Intensive Care Unit (RICU)',
                'keterangan' => 'Respiratory Intensive Care Unit (RICU)'
            ],
            'RT0016' => [
                'type_system' => 'http://terminology.kemkes.go.id/CodeSystem/location-type',
                'type_code' => 'RT0016',
                'type_display' => 'Ruang Rawat Inap ',
                'keterangan' => 'Ruang Rawat Inap '
            ],
            'RT0017' => [
                'type_system' => 'http://terminology.kemkes.go.id/CodeSystem/location-type',
                'type_code' => 'RT0017',
                'type_display' => 'Ruangan Perawatan (Post Partum)',
                'keterangan' => 'Ruangan Perawatan (Post Partum)'
            ],
            'RT0018' => [
                'type_system' => 'http://terminology.kemkes.go.id/CodeSystem/location-type',
                'type_code' => 'RT0018',
                'type_display' => 'Ruangan Perawatan Isolasi',
                'keterangan' => 'Ruangan Perawatan Isolasif'
            ],
            'RT0019' => [
                'type_system' => 'http://terminology.kemkes.go.id/CodeSystem/location-type',
                'type_code' => 'RT0019',
                'type_display' => 'Ruangan Perawatan Neonatus Infeksius/Isolasi',
                'keterangan' => 'Ruangan Perawatan Neonatus Infeksius/Isolasi'
            ],
            'RT0020' => [
                'type_system' => 'http://terminology.kemkes.go.id/CodeSystem/location-type',
                'type_code' => 'RT0020',
                'type_display' => 'Ruangan Perawatan Neonatus Non Infeksius',
                'keterangan' => 'Ruangan Perawatan Neonatus Non Infeksius'
            ],
            'RT0021' => [
                'type_system' => 'http://terminology.kemkes.go.id/CodeSystem/location-type',
                'type_code' => 'RT0021',
                'type_display' => 'Ruangan Perawatan Pasien Paska Terapi',
                'keterangan' => 'Ruangan Perawatan Pasien Paska Terapi'
            ],
            'RT0022' => [
                'type_system' => 'http://terminology.kemkes.go.id/CodeSystem/location-type',
                'type_code' => 'RT0022',
                'type_display' => 'Ruangan Rawat Pasca Persalinan',
                'keterangan' => 'Ruangan Rawat Pasca Persalinan'
            ],
            'RT0023' => [
                'type_system' => 'http://terminology.kemkes.go.id/CodeSystem/location-type',
                'type_code' => 'RT0023',
                'type_display' => 'Ruangan / Daerah Rawat Pasien Isolasi',
                'keterangan' => 'Ruangan / Daerah Rawat Pasien Isolasi'
            ],
            'RT0024' => [
                'type_system' => 'http://terminology.kemkes.go.id/CodeSystem/location-type',
                'type_code' => 'RT0024',
                'type_display' => 'Ruangan / Daerah Rawat Pasien Non Isolasi',
                'keterangan' => 'Ruangan / Daerah Rawat Pasien Non Isolasi'
            ],
            'RT0025' => [
                'type_system' => 'http://terminology.kemkes.go.id/CodeSystem/location-type',
                'type_code' => 'RT0025',
                'type_display' => 'Ruang Operasi',
                'keterangan' => 'Ruang Operasi'
            ],
            'RT0026' => [
                'type_system' => 'http://terminology.kemkes.go.id/CodeSystem/location-type',
                'type_code' => 'RT0026',
                'type_display' => 'Ruangan Observasi',
                'keterangan' => 'Ruangan Observasi'
            ],
            'RT0027' => [
                'type_system' => 'http://terminology.kemkes.go.id/CodeSystem/location-type',
                'type_code' => 'RT0027',
                'type_display' => 'Ruangan Resusitasi',
                'keterangan' => 'Ruangan Resusitasi'
            ],
            'RT0028' => [
                'type_system' => 'http://terminology.kemkes.go.id/CodeSystem/location-type',
                'type_code' => 'RT0028',
                'type_display' => 'Ruangan Tindakan Anak',
                'keterangan' => 'Ruangan Tindakan Anak'
            ],
            'RT0029' => [
                'type_system' => 'http://terminology.kemkes.go.id/CodeSystem/location-type',
                'type_code' => 'RT0029',
                'type_display' => 'Ruangan Tindakan Bedah',
                'keterangan' => 'Ruangan Tindakan Bedah'
            ],
            'RT0030' => [
                'type_system' => 'http://terminology.kemkes.go.id/CodeSystem/location-type',
                'type_code' => 'RT0030',
                'type_display' => 'Ruangan Tindakan Kebidanan',
                'keterangan' => 'Ruangan Tindakan Kebidanan'
            ],
            'RT0031' => [
                'type_system' => 'http://terminology.kemkes.go.id/CodeSystem/location-type',
                'type_code' => 'RT0031',
                'type_display' => 'Ruangan Tindakan Non-Bedah',
                'keterangan' => 'Ruangan Tindakan Non-Bedah'
            ],
            'RT0032' => [
                'type_system' => 'http://terminology.kemkes.go.id/CodeSystem/location-type',
                'type_code' => 'RT0032',
                'type_display' => 'Ruangan Tindakan Triase',
                'keterangan' => 'Ruangan Tindakan Triase'
            ],
            'RT0033' => [
                'type_system' => 'http://terminology.kemkes.go.id/CodeSystem/location-type',
                'type_code' => 'RT0033',
                'type_display' => 'Ruangan Ultra Sonografi (USG)',
                'keterangan' => 'Ruangan Ultra Sonografi (USG)'
            ],
        ];
    }
}
