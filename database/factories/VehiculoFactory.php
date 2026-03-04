<?php

namespace Database\Factories;

use App\Models\Contacto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehiculo>
 */
class VehiculoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $marcas = [
            'Toyota' => ['Corolla', 'Hilux', 'Yaris', 'Rav4'],
            'Nissan' => ['Sentra', 'Frontier', 'Versa', 'Kicks'],
            'Hyundai' => ['Accent', 'Tucson', 'Santa Fe', 'Elantra'],
            'Kia' => ['Rio', 'Sportage', 'Cerato', 'Picanto'],
            'Ford' => ['F-150', 'Ranger', 'Explorer', 'EcoSport']
        ];

        $marca = $this->faker->randomElement(array_keys($marcas));
        $modelo = $this->faker->randomElement($marcas[$marca]);

        return [
            'placa' => $this->faker->unique()->regexify('[A-Z]{3}-[0-9]{3}'),
            'marca' => $marca,
            'modelo' => $modelo,
            'anio_fabricacion' => $this->faker->numberBetween(2010, 2024),
            'contacto_id' => Contacto::factory(),
        ];
    }
}
