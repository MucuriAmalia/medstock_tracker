<?php

namespace Database\Seeders;

use App\Models\Medicine;
use App\Models\StockMovement;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class StockMovementSeeder extends Seeder
{
    public function run(): void
    {
        $aron = User::where('email', 'aron@medstock.com')->first();
        $grace = User::where('email', 'grace.pharmacy@medstock.com')->first();
        $james = User::where('email', 'james.store@medstock.com')->first();

        $movements = [
            [
                'medicine' => 'Paracetamol 500mg Tablets',
                'user_id' => $james?->id,
                'type' => 'in',
                'quantity' => 400,
                'reference' => 'GRN-1001',
                'notes' => 'Routine monthly restock from Medisel Kenya Ltd.',
                'movement_date' => Carbon::now()->subDays(18),
            ],
            [
                'medicine' => 'Paracetamol 500mg Tablets',
                'user_id' => $grace?->id,
                'type' => 'out',
                'quantity' => 120,
                'reference' => 'ISS-2001',
                'notes' => 'Issued to outpatient pharmacy for daily dispensing.',
                'movement_date' => Carbon::now()->subDays(15),
            ],
            [
                'medicine' => 'Amoxicillin 500mg Capsules',
                'user_id' => $james?->id,
                'type' => 'in',
                'quantity' => 250,
                'reference' => 'GRN-1002',
                'notes' => 'Restocked from Mission Pharma Supplies.',
                'movement_date' => Carbon::now()->subDays(16),
            ],
            [
                'medicine' => 'Amoxicillin 500mg Capsules',
                'user_id' => $grace?->id,
                'type' => 'out',
                'quantity' => 70,
                'reference' => 'ISS-2002',
                'notes' => 'Issued for pediatric and general outpatient prescriptions.',
                'movement_date' => Carbon::now()->subDays(12),
            ],
            [
                'medicine' => 'Artemether/Lumefantrine Tablets',
                'user_id' => $james?->id,
                'type' => 'in',
                'quantity' => 300,
                'reference' => 'GRN-1003',
                'notes' => 'Emergency malaria season replenishment.',
                'movement_date' => Carbon::now()->subDays(20),
            ],
            [
                'medicine' => 'Artemether/Lumefantrine Tablets',
                'user_id' => $grace?->id,
                'type' => 'out',
                'quantity' => 96,
                'reference' => 'ISS-2003',
                'notes' => 'Issued to outpatient and maternity wing.',
                'movement_date' => Carbon::now()->subDays(10),
            ],
            [
                'medicine' => 'Metformin 500mg Tablets',
                'user_id' => $james?->id,
                'type' => 'in',
                'quantity' => 180,
                'reference' => 'GRN-1004',
                'notes' => 'Received chronic care clinic restock.',
                'movement_date' => Carbon::now()->subDays(14),
            ],
            [
                'medicine' => 'Metformin 500mg Tablets',
                'user_id' => $grace?->id,
                'type' => 'out',
                'quantity' => 60,
                'reference' => 'ISS-2004',
                'notes' => 'Issued for diabetic clinic patients.',
                'movement_date' => Carbon::now()->subDays(7),
            ],
            [
                'medicine' => 'Salbutamol Syrup',
                'user_id' => $james?->id,
                'type' => 'in',
                'quantity' => 30,
                'reference' => 'GRN-1005',
                'notes' => 'Received pediatric respiratory stock.',
                'movement_date' => Carbon::now()->subDays(11),
            ],
            [
                'medicine' => 'Salbutamol Syrup',
                'user_id' => $grace?->id,
                'type' => 'out',
                'quantity' => 8,
                'reference' => 'ISS-2005',
                'notes' => 'Issued for pediatric clinic use.',
                'movement_date' => Carbon::now()->subDays(5),
            ],
            [
                'medicine' => 'Depo-Provera Injection',
                'user_id' => $aron?->id,
                'type' => 'in',
                'quantity' => 20,
                'reference' => 'GRN-1006',
                'notes' => 'Family planning unit replenishment.',
                'movement_date' => Carbon::now()->subDays(13),
            ],
            [
                'medicine' => 'Depo-Provera Injection',
                'user_id' => $grace?->id,
                'type' => 'out',
                'quantity' => 6,
                'reference' => 'ISS-2006',
                'notes' => 'Issued to MCH and family planning clinic.',
                'movement_date' => Carbon::now()->subDays(4),
            ],
        ];

        foreach ($movements as $movement) {
            $medicine = Medicine::where('name', $movement['medicine'])->first();

            if (! $medicine || ! $movement['user_id']) {
                continue;
            }

            StockMovement::create([
                'medicine_id' => $medicine->id,
                'user_id' => $movement['user_id'],
                'type' => $movement['type'],
                'quantity' => $movement['quantity'],
                'reference' => $movement['reference'],
                'notes' => $movement['notes'],
                'movement_date' => $movement['movement_date'],
            ]);
        }
    }
}