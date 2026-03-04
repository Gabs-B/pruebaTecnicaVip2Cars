<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveVehiculoRequest;
use App\Http\Requests\EditVehiculoRequest;
use App\Services\VehiculoService;
use App\Http\Resources\VehiculoResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    protected $vehiculoService;

    public function __construct(VehiculoService $vehiculoService)
    {
        $this->vehiculoService = $vehiculoService;
    }

    public function getAllVehiculos(Request $request): JsonResponse
    {
        $perPage = $request->query('per_page', 10);
        $search = $request->query('search');

        $vehiculos = $this->vehiculoService->getAllVehiculos($perPage, $search);

        return response()->json([
            'data' => VehiculoResource::collection($vehiculos),
            'meta' => [
                'total' => $vehiculos->total(),
                'current_page' => $vehiculos->currentPage(),
                'per_page' => $vehiculos->perPage(),
                'last_page' => $vehiculos->lastPage(),
            ]
        ]);
    }

    public function getVehiculoById($id): JsonResponse
    {
        $vehiculo = $this->vehiculoService->findVehiculoById($id);
        return response()->json(new VehiculoResource($vehiculo));
    }

    public function createVehiculo(SaveVehiculoRequest $request): JsonResponse
    {
        $vehiculo = $this->vehiculoService->createVehiculo($request->validated());
        return response()->json(new VehiculoResource($vehiculo), 201);
    }

    public function updateVehiculo(EditVehiculoRequest $request, $id): JsonResponse
    {
        $vehiculo = $this->vehiculoService->updateVehiculo($id, $request->validated());
        return response()->json(new VehiculoResource($vehiculo));
    }

    public function deleteVehiculo($id): JsonResponse
    {
        $this->vehiculoService->deleteVehiculo($id);
        return response()->json(['message' => 'Vehículo eliminado correctamente']);
    }
}
