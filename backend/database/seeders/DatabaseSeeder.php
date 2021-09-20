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
        //TODO aqui onde chamo a minha class FreightSeed
        //TODO para ser executada.
        $this->call(FreightSeed::class);
    }
}
