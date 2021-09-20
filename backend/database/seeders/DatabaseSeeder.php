<?php

namespace Database\Seeders;

use App\Models\Freight;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(FreightSeed::class);
    }
}
