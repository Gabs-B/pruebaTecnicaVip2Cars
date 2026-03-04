<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombres',
        'apellidos',
        'numero_documento',
        'correo',
        'telefono',
    ];

    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class, 'contacto_id');
    }

    /**
     * Scope a query to search contactos.
     */
    public function scopeSearch($query, $search)
    {
        if (!$search) return $query;

        return $query->where(function ($q) use ($search) {
            $q->where('nombres', 'LIKE', "%{$search}%")
              ->orWhere('apellidos', 'LIKE', "%{$search}%")
              ->orWhere('numero_documento', 'LIKE', "%{$search}%")
              ->orWhere('correo', 'LIKE', "%{$search}%")
              ->orWhere('telefono', 'LIKE', "%{$search}%");
        });
    }
}
