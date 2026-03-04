<?php

namespace App\Services;

use App\Models\Contacto;

class ContactoService
{
    public function getAllContactos(int $perPage = 10, ?string $search = null)
    {
        return Contacto::search($search)->paginate($perPage);
    }

    public function findContactoById(int $id)
    {
        return Contacto::findOrFail($id);
    }

    public function createContacto(array $data)
    {
        return Contacto::create($data);
    }

    public function updateContacto(int $id, array $data)
    {
        $contacto = Contacto::findOrFail($id);
        $contacto->update($data);
        return $contacto;
    }

    public function deleteContacto(int $id)
    {
        $contacto = Contacto::findOrFail($id);
        return $contacto->delete();
    }
}
