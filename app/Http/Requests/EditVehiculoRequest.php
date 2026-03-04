<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditVehiculoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id');

        return [
            'placa' => 'sometimes|required|string|max:15|unique:vehiculos,placa,' . $id,
            'marca' => 'sometimes|required|string|max:50',
            'modelo' => 'sometimes|required|string|max:50',
            'anio_fabricacion' => 'sometimes|required|integer|min:1900|max:' . (date('Y') + 1),
            'contacto_id' => 'sometimes|required|exists:contactos,id',
        ];
    }

    public function messages(): array
    {
        return [
            'placa.unique' => 'Esta placa ya pertenece a otro vehículo.',
            'contacto_id.exists' => 'El contacto seleccionado no existe.',
            'anio_fabricacion.integer' => 'El año de fabricación debe ser un número.',
        ];
    }
}
