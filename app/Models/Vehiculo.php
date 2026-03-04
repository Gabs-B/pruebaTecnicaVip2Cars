<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'placa',
        'marca',
        'modelo',
        'anio_fabricacion',
        'contacto_id',
    ];

    public function contacto()
    {
        return $this->belongsTo(Contacto::class, 'contacto_id');
    }

    /**
     * Scope a query to search vehiculos.
     */
    public function scopeSearch($query, $search)
    {
        if (!$search) return $query;

        return $query->where(function ($q) use ($search) {
            $q->where('placa', 'LIKE', "%{$search}%")
              ->orWhere('marca', 'LIKE', "%{$search}%")
              ->orWhere('modelo', 'LIKE', "%{$search}%")
              ->orWhere('anio_fabricacion', 'LIKE', "%{$search}%")
              ->orWhereHas('contacto', function ($childQuery) use ($search) {
                  $childQuery->search($search);
              });
        });
    }
}
