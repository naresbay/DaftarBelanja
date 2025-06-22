<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    public function run()
    {
        DB::table('items')->insert([
            ['name' => 'Beras', 'quantity' => 2, 'notes' => 'Beras merah'],
            ['name' => 'Telur', 'quantity' => 12, 'notes' => 'Telur ayam kampung'],
            ['name' => 'Minyak Goreng', 'quantity' => 1, 'notes' => null]
        ]);
    }
}
