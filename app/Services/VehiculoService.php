<?php

namespace App\Services;

use App\Models\Vehiculo;

class VehiculoService
{
    public function getAllVehiculos(int $perPage = 10, ?string $search = null)
    {
        return Vehiculo::with('contacto')
            ->search($search)
            ->paginate($perPage);
    }

    public function findVehiculoById(int $id)
    {
        return Vehiculo::with('contacto')->findOrFail($id);
    }

    public function createVehiculo(array $data)
    {
        return Vehiculo::create($data);
    }

    public function updateVehiculo(int $id, array $data)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        $vehiculo->update($data);
        return $vehiculo;
    }

    public function deleteVehiculo(int $id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        return $vehiculo->delete();
    }
}
