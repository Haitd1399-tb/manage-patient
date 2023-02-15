<?php

namespace Database\Seeders;

use App\Models\storeOriental;
use Illuminate\Database\Seeder;

class StoreOrientalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        storeOriental::factory()->count(20)->create();
    }
}
