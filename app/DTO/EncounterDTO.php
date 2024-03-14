<?php

namespace App\DTO;

class EncounterDTO
{
    // 3.1
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
    // 3.2
    public static function getStatusEncounter()
    {
        return [
            'planned' => [
                'code_system' => 'http://terminology.hl7.org/CodeSystem-v2-0203',
                'encounter_status' => 'planned',
                'keterangan' => 'Sudah direncanakan'
            ],
            'arrived' => [
                'code_system' => 'http://terminology.hl7.org/CodeSystem-v2-0203',
                'encounter_status' => 'arrived',
                'keterangan' => 'Sudah datang'
            ],
            'triaged' => [
                'code_system' => 'http://terminology.hl7.org/CodeSystem-v2-0203',
                'encounter_status' => 'triaged',
                'keterangan' => 'Sudah direncanakan'
            ],
            'in-progress' => [
                'code_system' => 'http://terminology.hl7.org/CodeSystem-v2-0203',
                'encounter_status' => 'in-progress',
                'keterangan' => 'Sedang berlangsung'
            ],
            'onleave' => [
                'code_system' => 'http://terminology.hl7.org/CodeSystem-v2-0203',
                'encounter_status' => 'onleave',
                'keterangan' => 'Sedang pergi'
            ],
            'finished' => [
                'code_system' => 'http://terminology.hl7.org/CodeSystem-v2-0203',
                'encounter_status' => 'finished',
                'keterangan' => 'Sudah selesai'
            ],
            'cancelled' => [
                'code_system' => 'http://terminology.hl7.org/CodeSystem-v2-0203',
                'encounter_status' => 'cancelled ',
                'keterangan' => 'Dibatalkan'
            ],
        ];
    }
    // 3.3
    public static function getStatusHistory()
    {
        return [
            'planned' => [
                'code_system' => 'http://terminology.hl7.org/CodeSystem-v2-0203',
                'encounter_status' => 'planned',
                'keterangan' => 'Sudah direncanakan'
            ],
            'arrived' => [
                'code_system' => 'http://terminology.hl7.org/CodeSystem-v2-0203',
                'encounter_status' => 'arrived',
                'keterangan' => 'Sudah datang'
            ],
            'triaged' => [
                'code_system' => 'http://terminology.hl7.org/CodeSystem-v2-0203',
                'encounter_status' => 'triaged',
                'keterangan' => 'Sudah direncanakan'
            ],
            'in-progress' => [
                'code_system' => 'http://terminology.hl7.org/CodeSystem-v2-0203',
                'encounter_status' => 'in-progress',
                'keterangan' => 'Sedang berlangsung'
            ],
            'onleave' => [
                'code_system' => 'http://terminology.hl7.org/CodeSystem-v2-0203',
                'encounter_status' => 'onleave',
                'keterangan' => 'Sedang pergi'
            ],
            'finished' => [
                'code_system' => 'http://terminology.hl7.org/CodeSystem-v2-0203',
                'encounter_status' => 'finished',
                'keterangan' => 'Sudah selesai'
            ],
            'cancelled' => [
                'code_system' => 'http://terminology.hl7.org/CodeSystem-v2-0203',
                'encounter_status' => 'cancelled ',
                'keterangan' => 'Dibatalkan'
            ],
        ];
    }
    // 3.4
    public static function getClass()
    {
        return [
            'AMB' => [
                'class_system' => 'http://terminology.hl7.org/CodeSystem/v3-ActCode',
                'class_code' => 'AMB',
                'class_display' => 'ambulatory',
                'keterangan' => 'Digunakan untuk kunjungan Rawat Jalan'
            ],
            'EMER' => [
                'class_system' => 'http://terminology.hl7.org/CodeSystem/v3-ActCode',
                'class_code' => 'EMER',
                'class_display' => 'emergency',
                'keterangan' => 'Digunakan untuk kunjungan instalasi gawat darurat'
            ],
            'FLD' => [
                'class_system' => 'http://terminology.hl7.org/CodeSystem/v3-ActCode',
                'class_code' => 'FLD',
                'class_display' => 'field',
                'keterangan' => 'Digunakan untuk kunjungan lapangan'
            ],
            'HH' => [
                'class_system' => 'http://terminology.hl7.org/CodeSystem/v3-ActCode',
                'class_code' => 'HH',
                'class_display' => 'home health',
                'keterangan' => 'Digunakan untuk kunjungan ke rumah'
            ],
            'IMP' => [
                'class_system' => 'http://terminology.hl7.org/CodeSystem/v3-ActCode',
                'class_code' => 'IMP',
                'class_display' => 'inpatient encounter',
                'keterangan' => 'Digunakan untuk kunjungan rawat inap'
            ],
            'ACUTE' => [
                'class_system' => 'http://terminology.hl7.org/CodeSystem/v3-ActCode',
                'class_code' => 'AMB',
                'class_display' => 'inpatient acute',
                'keterangan' => 'Digunakan untuk kunjungan rawat inap akut'
            ],
            'NONAC' => [
                'class_system' => 'http://terminology.hl7.org/CodeSystem/v3-ActCode',
                'class_code' => 'NONAC',
                'class_display' => 'inpatient non-acute',
                'keterangan' => 'Digunakan untuk kunjungan rawat inap non-akut'
            ],
            'OBSENC' => [
                'class_system' => 'http://terminology.hl7.org/CodeSystem/v3-ActCode',
                'class_code' => 'OBSENC',
                'class_display' => 'observation encounter',
                'keterangan' => 'Digunakan untuk kunjungan observasi'
            ],
            'PRENC' => [
                'class_system' => 'http://terminology.hl7.org/CodeSystem/v3-ActCode',
                'class_code' => 'PRENC',
                'class_display' => 'pre-admission',
                'keterangan' => 'Digunakan untuk kunjungan preadmisi'
            ],
            'SS' => [
                'class_system' => 'http://terminology.hl7.org/CodeSystem/v3-ActCode',
                'class_code' => 'SS',
                'class_display' => 'short stay',
                'keterangan' => 'Digunakan untuk kunjungan pendek'
            ],
            'VR' => [
                'class_system' => 'http://terminology.hl7.org/CodeSystem/v3-ActCode',
                'class_code' => 'VR',
                'class_display' => 'virtual',
                'keterangan' => 'Digunakan untuk kunjungan dimana pasien dan tenaga kesehatan tidak berada dalam satu tempat, seperti telefon, email, chat, televideo konferensi'
            ]
        ];
    }
    // 3.5
    public static function getClassHistory()
    {
        return [
            'AMB' => [
                'class_system' => 'http://terminology.hl7.org/CodeSystem/v3-ActCode',
                'class_code' => 'AMB',
                'class_display' => 'ambulatory',
                'keterangan' => 'Digunakan untuk kunjungan Rawat Jalan'
            ],
            'EMER' => [
                'class_system' => 'http://terminology.hl7.org/CodeSystem/v3-ActCode',
                'class_code' => 'EMER',
                'class_display' => 'emergency',
                'keterangan' => 'Digunakan untuk kunjungan instalasi gawat darurat'
            ],
            'FLD' => [
                'class_system' => 'http://terminology.hl7.org/CodeSystem/v3-ActCode',
                'class_code' => 'FLD',
                'class_display' => 'field',
                'keterangan' => 'Digunakan untuk kunjungan lapangan'
            ],
            'HH' => [
                'class_system' => 'http://terminology.hl7.org/CodeSystem/v3-ActCode',
                'class_code' => 'HH',
                'class_display' => 'home health',
                'keterangan' => 'Digunakan untuk kunjungan ke rumah'
            ],
            'IMP' => [
                'class_system' => 'http://terminology.hl7.org/CodeSystem/v3-ActCode',
                'class_code' => 'IMP',
                'class_display' => 'inpatient encounter',
                'keterangan' => 'Digunakan untuk kunjungan rawat inap'
            ],
            'ACUTE' => [
                'class_system' => 'http://terminology.hl7.org/CodeSystem/v3-ActCode',
                'class_code' => 'AMB',
                'class_display' => 'inpatient acute',
                'keterangan' => 'Digunakan untuk kunjungan rawat inap akut'
            ],
            'NONAC' => [
                'class_system' => 'http://terminology.hl7.org/CodeSystem/v3-ActCode',
                'class_code' => 'NONAC',
                'class_display' => 'inpatient non-acute',
                'keterangan' => 'Digunakan untuk kunjungan rawat inap non-akut'
            ],
            'OBSENC' => [
                'class_system' => 'http://terminology.hl7.org/CodeSystem/v3-ActCode',
                'class_code' => 'OBSENC',
                'class_display' => 'observation encounter',
                'keterangan' => 'Digunakan untuk kunjungan observasi'
            ],
            'PRENC' => [
                'class_system' => 'http://terminology.hl7.org/CodeSystem/v3-ActCode',
                'class_code' => 'PRENC',
                'class_display' => 'pre-admission',
                'keterangan' => 'Digunakan untuk kunjungan preadmisi'
            ],
            'SS' => [
                'class_system' => 'http://terminology.hl7.org/CodeSystem/v3-ActCode',
                'class_code' => 'SS',
                'class_display' => 'short stay',
                'keterangan' => 'Digunakan untuk kunjungan pendek'
            ],
            'VR' => [
                'class_system' => 'http://terminology.hl7.org/CodeSystem/v3-ActCode',
                'class_code' => 'VR',
                'class_display' => 'virtual',
                'keterangan' => 'Digunakan untuk kunjungan dimana pasien dan tenaga kesehatan tidak berada dalam satu tempat, seperti telefon, email, chat, televideo konferensi'
            ]
        ];
    }
    // 3.6
    public static function getPriority()
    {
        return [
            'A' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/v3-ActPriority',
                'coding_code' => 'A',
                'coding_display' => 'ASAP',
            ],
            'CR' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/v3-ActPriority',
                'coding_code' => 'CR',
                'coding_display' => 'callback results',
            ],
            'CS' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/v3-ActPriority',
                'coding_code' => 'CS',
                'coding_display' => 'callback for scheduling',
            ],
            'CSP' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/v3-ActPriority',
                'coding_code' => 'CSP',
                'coding_display' => 'callback placer for scheduling',
            ],
            'CSR' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/v3-ActPriority',
                'coding_code' => 'CSR',
                'coding_display' => 'contact recipient for scheduling',
            ],
            'EL' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/v3-ActPriority',
                'coding_code' => 'EL',
                'coding_display' => 'elective',
            ],
            'EM' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/v3-ActPriority',
                'coding_code' => 'EM',
                'coding_display' => 'emergency',
            ],
            'P' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/v3-ActPriority',
                'coding_code' => 'P',
                'coding_display' => 'preop',
            ],
            'PRN' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/v3-ActPriority',
                'coding_code' => 'PRN',
                'coding_display' => 'as needed',
            ],
            'R' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/v3-ActPriority',
                'coding_code' => 'R',
                'coding_display' => 'routine',
            ],
            'RR' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/v3-ActPriority',
                'coding_code' => 'RR',
                'coding_display' => 'rush reporting',
            ],
            'S' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/v3-ActPriority',
                'coding_code' => 'S',
                'coding_display' => 'stat',
            ],
            'T' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/v3-ActPriority',
                'coding_code' => 'T',
                'coding_display' => 'timing critical',
            ],
            'UD' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/v3-ActPriority',
                'coding_code' => 'UD',
                'coding_display' => 'use as directed',
            ],
            'UR' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/v3-ActPriority',
                'coding_code' => 'UR',
                'coding_display' => 'urgent',
            ],
        ];
    }
    // 3.7
    public static function getParticipant()
    {
        return [
            'ADM' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/v3-ParticipationType',
                'coding_code' => 'ADM',
                'coding_display' => 'admitter',
                'keterangan'    => 'Tenaga kesehatan yang berperan memasukkan pasien ke dalam suatu kunjungan',
            ],
            'ATND' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/v3-ParticipationType',
                'coding_code' => 'ATND',
                'coding_display' => 'attender',
                'keterangan'    => 'Tenaga kesehatan yang bertanggung jawab untuk mengawasi perawatan pasien selama kunjungan',
            ],
            'CALLBCK' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/v3-ParticipationType',
                'coding_code' => 'CALLBCK',
                'coding_display' => 'callback contact',
                'keterangan'    => 'Seseorang atau organisasi yang dapat dikontak untuk pertanyaan tidak lanjut',
            ],
            'CON' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/v3-ParticipationType',
                'coding_code' => 'CON',
                'coding_display' => 'consultant',
                'keterangan'    => 'Penasihat berpartisipasi dalam layanan dengan melakukan evaluasi dan membuat rekomendasi.',
            ],
            'DIS' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/v3-ParticipationType',
                'coding_code' => 'DIS',
                'coding_display' => 'discharger',
                'keterangan'    => 'Tenaga kesehatan yang berperan dalam discharge atau memulangkan seorang pasien.',
            ],
            'ESC' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/v3-ParticipationType',
                'coding_code' => 'ESC',
                'coding_display' => 'escort',
                'keterangan'    => 'Hanya dengan jasa Transportasi. Orang yang mengantar pasien',
            ],
            'REF' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/v3-ParticipationType',
                'coding_code' => 'REF',
                'coding_display' => 'referrer',
                'keterangan'    => 'Seseorang yang merujuk subjek layanan kepada pelaku (dokter perujuk). Biasanya, dokter yang merujuk akan menerima laporan.',
            ],
            'SPRF' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/v3-ParticipationType',
                'coding_code' => 'SPRF',
                'coding_display' => 'secondary performer',
                'keterangan'    => 'Seseorang yang membantu dalam suatu tindakan melalui kehadiran dan keterlibatannya yang substansial Ini termasuk: asisten, teknisi, rekanan, atau apa pun jabatannya.',
            ],
            'PPRF' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/v3-ParticipationType',
                'coding_code' => 'PPRF',
                'coding_display' => 'primary performer',
                'keterangan'    => 'Pelaku utama dari tindakan tersebut.',
            ],
            'PART' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/v3-ParticipationType',
                'coding_code' => 'PART',
                'coding_display' => 'Participation',
                'keterangan'    => 'Menunjukkan bahwa seorang individu terlibat dalam suatu perbuatan, tetapi tidak memenuhi syarat yang jelas.',
            ],
            'translator' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/v3-ParticipationType',
                'coding_code' => 'translator',
                'coding_display' => 'Translator',
                'keterangan'    => 'Seorang penerjemah yang memfasilitasi komunikasi dengan pasien selama pertemuan',
            ],
            'emergency' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/v3-ParticipationType',
                'coding_code' => 'emergency',
                'coding_display' => 'Emergency',
                'keterangan'    => 'Seseorang yang dapat dihubungi dalam keadaan darurat selama kunjungan terjadi',
            ],
        ];
    }
    // 3.8
    public static function getadmitSource()
    {
        return [
            'hops-trans' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/admit-source',
                'coding_code' => 'hops-trans',
                'coding_display' => 'Transferred from other hospital',
                'keterangan'    => 'Pasien dirujuk ke rumah sakit lain',
            ],
            'emd' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/admit-source',
                'coding_code' => 'emd',
                'coding_display' => 'From accident/emergency department',
                'keterangan'    => 'Pasien dipindahkan dari departemen gawat darurat dalam rumah sakit tersebut. Biasanya terjadi ketika transisi ke kunjungan rawat inap.',
            ],
            'outp' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/admit-source',
                'coding_code' => 'outp',
                'coding_display' => 'From outpatient department',
                'keterangan'    => 'Pasien dipindahkan dari departemen rawat jalan dalam rumah sakit tersebut',
            ],
            'born' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/admit-source',
                'coding_code' => 'born',
                'coding_display' => 'Born in hospital',
                'keterangan'    => 'Pasien adalah bayi baru lahir dan kunjungan ini digunakan untuk melacak kondisi bayi',
            ],
            'gp' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/admit-source',
                'coding_code' => 'gp',
                'coding_display' => 'General Practitioner referral',
                'keterangan'    => 'Pasien masuk/admisi akibat rujukan dari fasyankes tingkat satu',
            ],
            'mp' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/admit-source',
                'coding_code' => 'mp',
                'coding_display' => 'Medical Practitioner/physician referral',
                'keterangan'    => 'Pasien diadmisi karena rujukan dari spesialis',
            ],
            'nursing' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/admit-source',
                'coding_code' => 'nursing',
                'coding_display' => 'From nursing home',
                'keterangan'    => 'Pasien dipindahkan dari panti jompo',
            ],
            'psych' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/admit-source',
                'coding_code' => 'psych',
                'coding_display' => 'From psychiatric hospital',
                'keterangan'    => 'Pasien dipindahkan dari fasilitas psikiatri',
            ],
            'rehab' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/admit-source',
                'coding_code' => 'rehab',
                'coding_display' => 'From rehabilitation facility',
                'keterangan'    => 'Pasien dipindahkan dari fasilitas atau klinik rehabilitasi',
            ],
            'other' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/admit-source',
                'coding_code' => 'other',
                'coding_display' => 'Other',
                'keterangan'    => 'Pasien masuk dari sumber yang tidak diketahui',
            ],
        ];
    }
    // 3.9
    public static function getreAdmission()
    {
        return [
            'R' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/v2-0092',
                'coding_code' => 'R',
                'coding_display' => 'Re-admission',
            ],
        ];
    }
    // 3.10
    public static function getdietPreference()
    {
        return [
            'vegetarian' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/diet',
                'coding_code' => 'vegetarian',
                'coding_display' => 'Vegetarian',
                'keterangan'    => 'Makanan tanpa daging, unggas, makanan laut',
            ],
            'dairy-free' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/diet',
                'coding_code' => 'dairy Free',
                'coding_display' => 'Dairy Free',
                'keterangan'    => 'Makanan tanpa susu atau olahan susu',
            ],
            'nut-free' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/diet',
                'coding_code' => 'nut-free',
                'coding_display' => 'Nut Free',
                'keterangan'    => 'Makanan tanpa kandungan kacang',
            ],
            'gluten-free' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/diet',
                'coding_code' => 'gluten-free',
                'coding_display' => 'Gluten Free',
                'keterangan'    => 'Makanan tanpa kandungan kacang',
            ],
            'vegan' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/diet',
                'coding_code' => 'vegan',
                'coding_display' => 'Vegan',
                'keterangan'    => 'Makanan tanpa daging, unggas, makanan laut, telur, produk susu, dan bahan turunan hewan lainnya',
            ],
            'halal' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/diet',
                'coding_code' => 'halal',
                'coding_display' => 'Halal',
                'keterangan'    => 'Makanan yang sesuai dengan peraturan Islam',
            ],
            'kosher' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/diet',
                'coding_code' => 'kosher',
                'coding_display' => 'Kosher',
                'keterangan'    => 'Makanan yang sesuai dengan peraturan diet Yahudi',
            ],
        ];
    }
    // 3.11
    public static function getspecialArrangement()
    {
        return [
            'wheel' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/encounter-special-arrangements',
                'coding_code' => 'wheel',
                'coding_display' => 'Wheelchair',
                'keterangan'    => 'Kursi roda',
            ],
            'add-bed' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/encounter-special-arrangements',
                'coding_code' => 'add-bed',
                'coding_display' => 'Additional bedding',
                'keterangan'    => 'Tambahan kasur',
            ],
            'int' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/encounter-special-arrangements',
                'coding_code' => 'int',
                'coding_display' => 'Interpreter',
                'keterangan'    => 'Penerjemah',
            ],
            'att' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/encounter-special-arrangements',
                'coding_code' => 'att',
                'coding_display' => 'Attendant',
                'keterangan'    => 'Asisten yang membantu pasien melakukan kegiatan',
            ],
            'dog' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/encounter-special-arrangements',
                'coding_code' => 'dog',
                'coding_display' => 'Guide dog',
                'keterangan'    => 'Anjing Pemandu',
            ],
        ];
    }
    // 3.12
    public static function getdischargeDisposition()
    {
        return [
            'home' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/discharge-disposition',
                'coding_code' => 'home',
                'coding_display' => 'Home',
                'keterangan'    => 'Pasien dipulangkan dan terindikasi akan pulang ke rumah sendiri setelahnya',
            ],
            'alt-home' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/discharge-disposition',
                'coding_code' => 'alt-home',
                'coding_display' => 'Alternative home',
                'keterangan'    => 'Pasien dipulangkan dan terindikasi ke rumah tetapi bukan rumahnya sendiri',
            ],
            'other-hcf' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/discharge-disposition',
                'coding_code' => 'other-hcf',
                'coding_display' => 'Other healthcare facility',
                'keterangan'    => 'Pasien dirujuk ke fasilitas pelayanan kesehatan lainnya',
            ],
            'hosp' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/discharge-disposition',
                'coding_code' => 'hosp',
                'coding_display' => 'Hospice',
                'keterangan'    => 'Pasien dipulangkan ke layanan paliatif',
            ],
            'long' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/discharge-disposition',
                'coding_code' => 'long',
                'coding_display' => 'Long-term care',
                'keterangan'    => 'Pasien dipulangkan ke long-term care dimana akan di monitor secara terus menerus dalam suatu episode perawatan',
            ],
            'advice' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/discharge-disposition',
                'coding_code' => 'advice',
                'coding_display' => 'Left against advice',
                'keterangan'    => 'Pasien pulang atas permintaan sendiri atau tidak sesuai dengan saran medis',
            ],
            'exp' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/discharge-disposition',
                'coding_code' => 'exp',
                'coding_display' => 'Expired',
                'keterangan'    => 'Pasien meninggal saat kunjungan terjadi',
            ],
            'psy' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/discharge-disposition',
                'coding_code' => 'psy',
                'coding_display' => 'Psychiatric hospital',
                'keterangan'    => 'Pasien dipindahkan ke fasilitas psikiatri',
            ],
            'rehab' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/discharge-disposition',
                'coding_code' => 'rehab',
                'coding_display' => 'Rehabilitation',
                'keterangan'    => 'Pasien dipulangkan dan mendapatkan layanan rehabilitasi',
            ],
            'snf' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/discharge-disposition',
                'coding_code' => 'snf',
                'coding_display' => 'Skilled nursing facility',
                'keterangan'    => 'Pasien dipulangkan ke fasilitas keperawatan untuk mendapatkan layanan tambahan',
            ],
            'oth' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/discharge-disposition',
                'coding_code' => 'oth',
                'coding_display' => 'Other',
                'keterangan'    => 'Kepulangan belum terdefinisi di tempat lain',
            ],
            'exp-lt48h' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/discharge-disposition',
                'coding_code' => 'exp-lt48h',
                'coding_display' => 'Meninggal < 48 jam',
                'keterangan'    => '',
            ],
            'exp-gt48h' => [
                'coding_system' => 'http://terminology.hl7.org/CodeSystem/discharge-disposition',
                'coding_code' => 'exp-gt48h',
                'coding_display' => 'Meninggal > 48 jam',
                'keterangan'    => '',
            ],
        ];
    }
    // 3.13
    public static function getserviceClass()
    {
        return [
            '1' => [
                'coding_system' => 'http://terminology.kemkes.go.id/CodeSystem/locationServiceClass-Inpatient',
                'coding_code' => '1',
                'coding_display' => 'Kelas 1',
                'keterangan'    => 'Perawatan Kelas 1',
            ],
            '2' => [
                'coding_system' => 'http://terminology.kemkes.go.id/CodeSystem/locationServiceClass-Inpatient',
                'coding_code' => '2',
                'coding_display' => 'Kelas 2',
                'keterangan'    => 'Perawatan Kelas 2',
            ],
            '3' => [
                'coding_system' => 'http://terminology.kemkes.go.id/CodeSystem/locationServiceClass-Inpatient',
                'coding_code' => '3',
                'coding_display' => 'Kelas 3',
                'keterangan'    => 'Perawatan Kelas 3',
            ],
            'vip' => [
                'coding_system' => 'http://terminology.kemkes.go.id/CodeSystem/locationServiceClass-Inpatient',
                'coding_code' => 'vip',
                'coding_display' => 'Kelas VIP',
                'keterangan'    => 'Perawatan Kelas VIP',
            ],
            'VVIP' => [
                'coding_system' => 'http://terminology.kemkes.go.id/CodeSystem/locationServiceClass-Inpatient',
                'coding_code' => 'VVIP',
                'coding_display' => 'Kelas VVIP',
                'keterangan'    => 'Perawatan Kelas VVIP',
            ],
            'reguler' => [
                'coding_system' => 'http://terminology.kemkes.go.id/CodeSystem/locationServiceClass-Inpatient',
                'coding_code' => 'reguler',
                'coding_display' => 'Kelas Reguler',
                'keterangan'    => 'Perawatan Kelas Reguler',
            ],
            'eksekutif' => [
                'coding_system' => 'http://terminology.kemkes.go.id/CodeSystem/locationServiceClass-Inpatient',
                'coding_code' => 'eksekutif',
                'coding_display' => 'Kelas Eksekutif',
                'keterangan'    => 'Perawatan Kelas Eksekutif',
            ],
        ];
    }
    // 3.14
    public static function getupgradeClassIndicator()
    {
        return [
            'kelas-tetap' => [
                'coding_system' => 'http://terminology.kemkes.go.id/CodeSystem/locationUpgradeClass',
                'coding_code' => 'kelas-tetap',
                'coding_display' => 'Kelas Tetap Perawatan',
                'keterangan'    => 'Pasien memiliki Kelas Perawatan yang sama dengan Hak Kelas Perawatan yang dimiliki',
            ],
            'naik-kelas' => [
                'coding_system' => 'http://terminology.kemkes.go.id/CodeSystem/locationUpgradeClass',
                'coding_code' => 'naik-kelas',
                'coding_display' => 'Kenaikan Kelas Perawatan',
                'keterangan'    => 'Pasien memiliki Kelas Perawatan yang lebih Tinggi dari Hak Kelas Perawatan yang dimiliki berdasarkan pengajuan dari pasien',
            ],
            'turun-kelas' => [
                'coding_system' => 'http://terminology.kemkes.go.id/CodeSystem/locationUpgradeClass',
                'coding_code' => 'turun-kelas',
                'coding_display' => 'Penurunan Kelas Perawatan',
                'keterangan'    => 'Pasien memiliki Kelas Perawatan yang lebih Rendah dari Hak Kelas Perawatan yang dimiliki berdasarkan pengajuan dari pasien',
            ],
            'titip-rawat' => [
                'coding_system' => 'http://terminology.kemkes.go.id/CodeSystem/locationUpgradeClass',
                'coding_code' => 'titip-rawat',
                'coding_display' => 'Titip Kelas Perawatan',
                'keterangan'    => 'Pasien memiliki Kelas Perawatan yang berbeda dengan Hak Kelas Perawatan yang dimiliki karena ketidaktersediaan ruangan yang sesuai dengan Hak Kelasnya',
            ],
        ];
    }
}
