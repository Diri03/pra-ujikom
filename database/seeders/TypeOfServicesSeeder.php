<?php

namespace Database\Seeders;

use App\Models\TypeOfServices;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeOfServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeOfServices::insert([
            [
                'service_name' => 'Hanya Gosok',
                'price' => 4000,
                'description' => 'Paket hanya gosok Rp 4.000 per kg'
            ],
            [
                'service_name' => 'Hanya Cuci',
                'price' => 5000,
                'description' => 'Paket hanya Cuci Rp 5.000 per kg'
            ],
            [
                'service_name' => 'Cuci dan Gosok',
                'price' => 7000,
                'description' => 'Paket cuci dan gosok Rp 7.000 per kg'
            ]
        ]);
    }
}
