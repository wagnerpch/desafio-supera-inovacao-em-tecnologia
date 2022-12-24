<?php

namespace Database\Seeders;
use App\Models\Car;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 1; $i <= 10; $i++){

            $carsArgs = array(
                array(
                    'car' => 'Amarok',
                    'brand' => 'VW',
                    'model' => 'picapes'
                ),
                array(
                    'car' => 'Fusca',
                    'brand' => 'VW',
                    'model' => 'hatchs'
                ),
                array(
                    'car' => 'Kombi',
                    'brand' => 'VW',
                    'model' => 'utilitários'
                ),
                array(
                    'car' => 'Jeep',
                    'brand' => 'Jeep',
                    'model' => 'Picapes'
                ),
                array(
                    'car' => 'Saveiro',
                    'brand' => 'VW',
                    'model' => 'utilitários'
                ),
                array(
                    'car' => 'Saveiro',
                    'brand' => 'VW',
                    'model' => 'utilitários'
                ),
                array(
                    'car' => 'Sandeiro',
                    'brand' => 'Renault',
                    'model' => 'hacths'
                ),
                array(
                    'car' => 'Strada',
                    'brand' => 'FIAT',
                    'model' => 'utilitários'
                )
            );

            $carsIndex = array_rand($carsArgs, 1);

            $licenseT = array('0'=>'A', '1'=>'B', '2'=>'C', '3'=>'D', '4'=>'E', '5'=>'F');
            $licenseS = array_rand($licenseT,3);

            $versions = array("1.0", "1.4", "1.6", "2");

            $newLicense = $licenseT[$licenseS[0]].$licenseT[$licenseS[1]].$licenseT[$licenseS[2]].'-'.random_int(0, 9).random_int(0, 9).random_int(0, 9).random_int(0, 9);

            Car::create([
                'car' => $carsArgs[$carsIndex]['car'],
                'license' => $newLicense,
                'brand' => $carsArgs[$carsIndex]['brand'],
                'model' => $carsArgs[$carsIndex]['model'],
                'version' => $versions[array_rand($versions, 1)],
                'user_id' => 1,
            ])->make();
        }

    }

}
