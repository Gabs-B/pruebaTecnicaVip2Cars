<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Contacto;
use App\Models\Vehiculo;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Contacto::factory(20)->create()->each(function ($contacto) {
            $numVehiculos = rand(0, 2);
            if ($numVehiculos > 0) {
                Vehiculo::factory($numVehiculos)->create([
                    'contacto_id' => $contacto->id
                ]);
            }
        });
    }
}
