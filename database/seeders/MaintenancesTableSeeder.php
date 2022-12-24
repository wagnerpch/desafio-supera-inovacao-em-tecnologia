<?php

namespace Database\Seeders;
use App\Models\Maintenance;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaintenancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 0; $i < 100; $i++){
            $maintenances = array("Troca de óleo", "Revisão dos Freios", "Troca de escapamento", "Troca dos filtros");
            $progresses = array("pendente", "em andamento", "realizada");
            $date_start = strtotime(date('Y-m-d H:i:s', strtotime(today()."+1 days")));
            $date_end = strtotime(date('Y-m-d H:i:s', strtotime(today()."+14 days")));
            $value = rand($date_start, $date_end);
            $date = date('Y-m-d H:i:s', $value);

            Maintenance::create([
                'maintenance' => $maintenances[array_rand($maintenances, 1)],
                'progress' => $progresses[array_rand($progresses, 1)],
                'date' => $date,
                'user_id' => 1,
                'car_id' => random_int(1, 10),
            ])->make();
        }
        
    }
}
