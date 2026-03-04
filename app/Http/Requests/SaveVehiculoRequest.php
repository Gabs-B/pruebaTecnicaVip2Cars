<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveVehiculoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'placa' => 'required|string|max:15|unique:vehiculos,placa',
            'marca' => 'required|string|max:50',
            'modelo' => 'required|string|max:50',
            'anio_fabricacion' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'contacto_id' => 'required|exists:contactos,id',
        ];
    }

    public function messages(): array
    {
        return [
            'placa.required' => 'La placa es obligatoria.',
            'placa.unique' => 'Esta placa ya está registrada.',
            'marca.required' => 'La marca es obligatoria.',
            'modelo.required' => 'El modelo es obligatorio.',
            'anio_fabricacion.required' => 'El año de fabricación es obligatorio.',
            'anio_fabricacion.min' => 'El año de fabricación no puede ser menor a 1900.',
            'contacto_id.required' => 'Debe asignar un contacto al vehículo.',
            'contacto_id.exists' => 'El contacto seleccionado no existe.',
        ];
    }
}
