<?php

namespace Database\Seeders;

use App\Models\Freight;
use Illuminate\Database\Seeder;

class FreightSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    //TODO aqui minha função run
    //TODO onde vai criar os dados de inicio que serão
    //TODO executados pelo --seed
    public function run()
    {
      Freight::create([
         'board'=>'JSY4172',
            'vehicle_owner'=> 'Soubu',
            'price_freight'=>800,
            'date_start'=>'2021-09-19',
            'date_end'=>'2021-10-20',
            'status'=>'Iniciado',
      ]);
        Freight::create(['board' => 'MVD0900',
            'vehicle_owner' => 'Soubu',
            'price_freight' => 15000,
            'date_start' => '2021-09-19',
            'date_end' => '2021-10-20',
            'status' => 'em trânsito',
        ]);
        Freight::create(['board' => 'JPR6413',
            'vehicle_owner' => 'Feol',
            'price_freight' => 20000,
            'date_start' => '2021-09-19',
            'date_end' => '2021-10-20',
            'status' => 'concluido',
        ]);
        Freight::create(['board' => 'JAW5042',
            'vehicle_owner' => 'Invoi',
            'price_freight' => 30000,
            'date_start' => '2021-09-19',
            'date_end' => '2021-10-20',
            'status' => 'concluido',
        ]);
        Freight::create(['board' => 'LXG2162',
            'vehicle_owner' => 'Fuyen',
            'price_freight' => 40000,
            'date_start' => '2021-09-19',
            'date_end' => '2021-10-20',
            'status' => 'em trânsito',
        ]);
        Freight::create(['board' => 'KIE2499',
            'vehicle_owner' => 'Xiekutus',
            'price_freight' => 50000,
            'date_start' => '2021-09-19',
            'date_end' => '2021-10-20',
            'status' => 'Iniciado',
        ]);
    }
}
