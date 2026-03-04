<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveContactoRequest;
use App\Http\Requests\EditContactoRequest;
use App\Services\ContactoService;
use App\Http\Resources\ContactoResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    protected $contactoService;

    public function __construct(ContactoService $contactoService)
    {
        $this->contactoService = $contactoService;
    }

    public function getAllContactos(Request $request): JsonResponse
    {
        $perPage = $request->query('per_page', 10);
        $search = $request->query('search');
        
        $contactos = $this->contactoService->getAllContactos($perPage, $search);

        return response()->json([
            'data' => ContactoResource::collection($contactos),
            'meta' => [
                'total' => $contactos->total(),
                'current_page' => $contactos->currentPage(),
                'per_page' => $contactos->perPage(),
                'last_page' => $contactos->lastPage(),
            ]
        ]);
    }

    public function getContactoById($id): JsonResponse
    {
        $contacto = $this->contactoService->findContactoById($id);
        return response()->json(new ContactoResource($contacto));
    }

    public function createContacto(SaveContactoRequest $request): JsonResponse
    {
        $contacto = $this->contactoService->createContacto($request->validated());
        return response()->json(new ContactoResource($contacto), 201);
    }

    public function updateContacto(EditContactoRequest $request, $id): JsonResponse
    {
        $contacto = $this->contactoService->updateContacto($id, $request->validated());
        return response()->json(new ContactoResource($contacto));
    }

    public function deleteContacto($id): JsonResponse
    {
        $this->contactoService->deleteContacto($id);
        return response()->json(['message' => 'Contacto eliminado correctamente']);
    }
}
