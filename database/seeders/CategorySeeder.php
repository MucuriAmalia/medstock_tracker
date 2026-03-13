<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Analgesics',
                'description' => 'Medicines used to relieve pain and reduce fever.',
            ],
            [
                'name' => 'Antibiotics',
                'description' => 'Medicines used to treat bacterial infections.',
            ],
            [
                'name' => 'Antimalarials',
                'description' => 'Medicines used for malaria treatment and prevention.',
            ],
            [
                'name' => 'Antihypertensives',
                'description' => 'Medicines used to manage high blood pressure.',
            ],
            [
                'name' => 'Antidiabetics',
                'description' => 'Medicines used in diabetes management.',
            ],
            [
                'name' => 'Gastrointestinal',
                'description' => 'Medicines used for ulcers, reflux, nausea, and stomach conditions.',
            ],
            [
                'name' => 'Respiratory',
                'description' => 'Medicines used for asthma, cough, and other breathing conditions.',
            ],
            [
                'name' => 'Dermatological',
                'description' => 'Medicines used for skin infections and skin care treatment.',
            ],
            [
                'name' => 'Vitamins and Supplements',
                'description' => 'Nutritional supplements and supportive therapy medicines.',
            ],
            [
                'name' => 'Family Planning',
                'description' => 'Medicines and products used in reproductive health and contraception.',
            ],
            [
                'name' => 'Pediatrics',
                'description' => 'Medicines commonly used in child healthcare.',
            ],
            [
                'name' => 'Emergency Drugs',
                'description' => 'Critical medicines used in urgent and emergency care.',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category['name']],
                $category
            );
        }
    }
}