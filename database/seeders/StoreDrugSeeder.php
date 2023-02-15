<?php

namespace Database\Seeders;

use App\Models\StoreDrug;
use Illuminate\Database\Seeder;

class StoreDrugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StoreDrug::factory()->count(20)->create();
    }
}
