<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Medicine;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class MedicineSeeder extends Seeder
{
    public function run(): void
    {
        $medicines = [
            [
                'category' => 'Analgesics',
                'name' => 'Paracetamol 500mg Tablets',
                'dosage_form' => 'Tablet',
                'strength' => '500mg',
                'unit' => 'Tablets',
                'quantity' => 620,
                'reorder_level' => 150,
                'batch_number' => 'PCM2401A',
                'expiry_date' => Carbon::now()->addMonths(10)->toDateString(),
                'supplier' => 'Medisel Kenya Ltd.',
                'description' => 'Common pain and fever reliever used in outpatient and inpatient care.',
            ],
            [
                'category' => 'Analgesics',
                'name' => 'Ibuprofen 400mg Tablets',
                'dosage_form' => 'Tablet',
                'strength' => '400mg',
                'unit' => 'Tablets',
                'quantity' => 340,
                'reorder_level' => 120,
                'batch_number' => 'IBU2402B',
                'expiry_date' => Carbon::now()->addMonths(12)->toDateString(),
                'supplier' => 'Lab and Allied Ltd.',
                'description' => 'Anti-inflammatory pain medicine for mild to moderate pain.',
            ],
            [
                'category' => 'Antibiotics',
                'name' => 'Amoxicillin 500mg Capsules',
                'dosage_form' => 'Capsule',
                'strength' => '500mg',
                'unit' => 'Capsules',
                'quantity' => 280,
                'reorder_level' => 100,
                'batch_number' => 'AMX2403C',
                'expiry_date' => Carbon::now()->addMonths(8)->toDateString(),
                'supplier' => 'Mission Pharma Supplies',
                'description' => 'Broad-spectrum antibiotic commonly prescribed for bacterial infections.',
            ],
            [
                'category' => 'Antibiotics',
                'name' => 'Ciprofloxacin 500mg Tablets',
                'dosage_form' => 'Tablet',
                'strength' => '500mg',
                'unit' => 'Tablets',
                'quantity' => 190,
                'reorder_level' => 80,
                'batch_number' => 'CIP2401D',
                'expiry_date' => Carbon::now()->addMonths(9)->toDateString(),
                'supplier' => 'Surgipharm Ltd.',
                'description' => 'Antibiotic used for urinary and gastrointestinal bacterial infections.',
            ],
            [
                'category' => 'Antimalarials',
                'name' => 'Artemether/Lumefantrine Tablets',
                'dosage_form' => 'Tablet',
                'strength' => '20/120mg',
                'unit' => 'Tablets',
                'quantity' => 430,
                'reorder_level' => 120,
                'batch_number' => 'AL2404E',
                'expiry_date' => Carbon::now()->addMonths(11)->toDateString(),
                'supplier' => 'Kemsa Regional Depot',
                'description' => 'First-line malaria treatment commonly issued in outpatient care.',
            ],
            [
                'category' => 'Antihypertensives',
                'name' => 'Amlodipine 5mg Tablets',
                'dosage_form' => 'Tablet',
                'strength' => '5mg',
                'unit' => 'Tablets',
                'quantity' => 210,
                'reorder_level' => 90,
                'batch_number' => 'AML2402F',
                'expiry_date' => Carbon::now()->addMonths(14)->toDateString(),
                'supplier' => 'PharmaNet Distributors',
                'description' => 'Used in chronic care clinic for hypertension management.',
            ],
            [
                'category' => 'Antidiabetics',
                'name' => 'Metformin 500mg Tablets',
                'dosage_form' => 'Tablet',
                'strength' => '500mg',
                'unit' => 'Tablets',
                'quantity' => 260,
                'reorder_level' => 100,
                'batch_number' => 'MTF2405G',
                'expiry_date' => Carbon::now()->addMonths(13)->toDateString(),
                'supplier' => 'Beta Healthcare',
                'description' => 'Routine oral medicine for type 2 diabetes patients.',
            ],
            [
                'category' => 'Gastrointestinal',
                'name' => 'Omeprazole 20mg Capsules',
                'dosage_form' => 'Capsule',
                'strength' => '20mg',
                'unit' => 'Capsules',
                'quantity' => 160,
                'reorder_level' => 70,
                'batch_number' => 'OMP2401H',
                'expiry_date' => Carbon::now()->addMonths(7)->toDateString(),
                'supplier' => 'Lab and Allied Ltd.',
                'description' => 'Used for acid reflux, gastritis, and ulcer management.',
            ],
            [
                'category' => 'Respiratory',
                'name' => 'Salbutamol Syrup',
                'dosage_form' => 'Syrup',
                'strength' => '2mg/5ml',
                'unit' => 'Bottles',
                'quantity' => 48,
                'reorder_level' => 30,
                'batch_number' => 'SAL2402J',
                'expiry_date' => Carbon::now()->addMonths(6)->toDateString(),
                'supplier' => 'Harleys Ltd.',
                'description' => 'Common pediatric respiratory medicine for wheezing and bronchospasm.',
            ],
            [
                'category' => 'Dermatological',
                'name' => 'Clotrimazole Cream',
                'dosage_form' => 'Cream',
                'strength' => '1%',
                'unit' => 'Tubes',
                'quantity' => 65,
                'reorder_level' => 40,
                'batch_number' => 'CLT2403K',
                'expiry_date' => Carbon::now()->addMonths(9)->toDateString(),
                'supplier' => 'Surgipharm Ltd.',
                'description' => 'Topical antifungal cream for common skin infections.',
            ],
            [
                'category' => 'Vitamins and Supplements',
                'name' => 'Ferrous Sulphate + Folic Acid Tablets',
                'dosage_form' => 'Tablet',
                'strength' => '200mg + 0.25mg',
                'unit' => 'Tablets',
                'quantity' => 300,
                'reorder_level' => 100,
                'batch_number' => 'FSF2404L',
                'expiry_date' => Carbon::now()->addMonths(15)->toDateString(),
                'supplier' => 'Kemsa Regional Depot',
                'description' => 'Supplement commonly issued in ANC and general nutrition support.',
            ],
            [
                'category' => 'Family Planning',
                'name' => 'Depo-Provera Injection',
                'dosage_form' => 'Injection',
                'strength' => '150mg/ml',
                'unit' => 'Vials',
                'quantity' => 42,
                'reorder_level' => 25,
                'batch_number' => 'DPO2402M',
                'expiry_date' => Carbon::now()->addMonths(10)->toDateString(),
                'supplier' => 'Kemsa Regional Depot',
                'description' => 'Long-acting contraceptive used in MCH and family planning clinics.',
            ],
            [
                'category' => 'Pediatrics',
                'name' => 'Zinc Sulphate Dispersible Tablets',
                'dosage_form' => 'Tablet',
                'strength' => '20mg',
                'unit' => 'Tablets',
                'quantity' => 145,
                'reorder_level' => 80,
                'batch_number' => 'ZNC2401N',
                'expiry_date' => Carbon::now()->addMonths(8)->toDateString(),
                'supplier' => 'Mission Pharma Supplies',
                'description' => 'Frequently issued alongside ORS in pediatric diarrhea management.',
            ],
            [
                'category' => 'Emergency Drugs',
                'name' => 'Adrenaline Injection',
                'dosage_form' => 'Injection',
                'strength' => '1mg/ml',
                'unit' => 'Ampoules',
                'quantity' => 28,
                'reorder_level' => 20,
                'batch_number' => 'ADR2403P',
                'expiry_date' => Carbon::now()->addMonths(5)->toDateString(),
                'supplier' => 'Harleys Ltd.',
                'description' => 'Critical emergency medicine kept for anaphylaxis and resuscitation use.',
            ],
        ];

        foreach ($medicines as $item) {
            $category = Category::where('name', $item['category'])->first();

            if (! $category) {
                continue;
            }

            Medicine::updateOrCreate(
                ['name' => $item['name']],
                [
                    'category_id' => $category->id,
                    'dosage_form' => $item['dosage_form'],
                    'strength' => $item['strength'],
                    'unit' => $item['unit'],
                    'quantity' => $item['quantity'],
                    'reorder_level' => $item['reorder_level'],
                    'batch_number' => $item['batch_number'],
                    'expiry_date' => $item['expiry_date'],
                    'supplier' => $item['supplier'],
                    'description' => $item['description'],
                ]
            );
        }
    }
}