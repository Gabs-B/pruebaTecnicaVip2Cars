<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditContactoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id');

        return [
            'nombres' => 'sometimes|required|string|max:100',
            'apellidos' => 'sometimes|required|string|max:100',
            'numero_documento' => 'sometimes|required|string|max:20|unique:contactos,numero_documento,' . $id,
            'correo' => 'sometimes|required|email|max:150|unique:contactos,correo,' . $id,
            'telefono' => 'sometimes|required|string|max:25',
        ];
    }

    public function messages(): array
    {
        return [
            'nombres.required' => 'El nombre es obligatorio.',
            'numero_documento.unique' => 'Este número de documento ya pertenece a otro contacto.',
            'correo.email' => 'El formato del correo electrónico no es válido.',
            'correo.unique' => 'Este correo electrónico ya pertenece a otro contacto.',
        ];
    }
}
