<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 3; $i++) {
            DB::table('users')->insert(
                [
                    'name' => "Mecânico${i}",
                    'username' => "mecanico${i}",
                    'email' => "mecanico${i}" . '@gmail.com',
                    'password' => Hash::make('senha123'),
                ],
            );
        }

        for ($i = 0; $i < 10; $i++) {
            DB::table('vehicles')->insert(
                [
                    'user_id' => User::find(rand(1, 3))->id,
                    'model' => 'Gol ' . ($i + 1),
                    'brand' => 'Volkswagen ' . ($i + 1),
                    'license_plate' => chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90))
                        . rand(1, 9) . chr(rand(65, 90)) . rand(1, 9) . rand(1, 9),
                    'version' => '1.6',
                ],
            );
        }

        $descriptions = [
            'Barulho no motor',
            'Gato Preso no Escapamento',
            'Escapamento ruim',
            'Barulho estranho ao ligar',
            'Manutenção de Rotina',
            'Motor Desliga Sozinho',
        ];

        DB::table('status')->insert(
            [
                'status' =>  'Pendente',
            ],
        );

        DB::table('status')->insert(
            [
                'status' =>  'Realizado',
            ],
        );

        DB::table('status')->insert(
            [
                'status' =>  'Cancelado',
            ],
        );

        for ($i = 0; $i < 8; $i++) {
            DB::table('maintenances')->insert(
                [
                    'id_vehicle' => Vehicle::find(rand(1, 10))->id,
                    'description' => $descriptions[rand(0, sizeof($descriptions) - 1)],
                    'status_id' => rand(1, 3),
                    'deadline' =>  Carbon::now()->addDays(rand(1, 15)),
                ],
            );
        }
    }
}
