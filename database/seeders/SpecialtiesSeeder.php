<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialtiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialties = [
            ['name' => 'Acupuncture'],
            ['name' => 'Aerospace Medicine'],
            ['name' => 'Allergy and Immunology'],
            ['name' => 'Anesthesiology'],
            ['name' => 'Chiropractic'],
            ['name' => 'Clinical Biochemical Genetics'],
            ['name' => 'Clinical Cytogenics'],
            ['name' => 'Clinical Genetics MD'],
            ['name' => 'Clinical Molecular Genetics'],
            ['name' => 'Clinical Psychologist'],
            ['name' => 'Colon and Rectal Surgery'],
            ['name' => 'Dentistry'],
            ['name' => 'Dermatology'],
            ['name' => 'Diagnostic Radiology'],
            ['name' => 'Emergency Medicine'],
            ['name' => 'Family Medicine'],
            ['name' => 'Industrial Hygienist'],
            ['name' => 'Internal Medicine'],
            ['name' => 'Legal'],
            ['name' => 'Neurological Surgery'],
            ['name' => 'Neurology'],
            ['name' => 'Neurology w Special Qual in Child Neuro'],
            ['name' => 'Neuropsychology'],
            ['name' => 'None indicated'],
            ['name' => 'Nuclear Medicine'],
            ['name' => 'Nurse Practitioner'],
            ['name' => 'Obstetrics and Gynecology'],
            ['name' => 'Occupational Medicine'],
            ['name' => 'Occupational Therapy'],
            ['name' => 'Ophthalmology'],
            ['name' => 'Optometrist'],
            ['name' => 'Oral and Maxillofacial Surgery'],
            ['name' => 'Orthodontist'],
            ['name' => 'Orthopaedic Surgery'],
            ['name' => 'Otolaryngology ENT'],
            ['name' => 'Pain Medicine'],
            ['name' => 'Pathology Anatomic'],
            ['name' => 'Pathology Clinical'],
            ['name' => 'Pathology-Anatomic/Pathology-Clinical'],
            ['name' => 'Pediatrics'],
            ['name' => 'Periodontics'],
            ['name' => 'Pharmacology'],
            ['name' => 'Physical Medicine and Rehabilitation'],
            ['name' => 'Physical Therapy'],
            ['name' => 'Physical Therapy Assistant'],
            ['name' => 'Plastic Surgery'],
            ['name' => 'Podiatry'],
            ['name' => 'Preventative Medicine'],
            ['name' => 'Prosthetist'],
            ['name' => 'Psychiatry'],
            ['name' => 'Psychology'],
            ['name' => 'Public Health & General Preventative Med'],
            ['name' => 'Pulmonology'],
            ['name' => 'Radiation Oncology'],
            ['name' => 'Radiological Physics'],
            ['name' => 'Registered Nurse'],
            ['name' => 'Social Worker'],
            ['name' => 'Speech Language Pathologist'],
            ['name' => 'Surgery'],
            ['name' => 'Thoracic Surgery'],
            ['name' => 'Translation'],
            ['name' => 'Transportation'],
            ['name' => 'Urogynecology'],
            ['name' => 'Urology'],
            ['name' => 'Vascular Surgery'],
            ['name' => 'Vocational Counselor'],
        ];

        // Insert the data into the database
        Specialty::truncate();
        Specialty::insert($specialties);
    }
}
