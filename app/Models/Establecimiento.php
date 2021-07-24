<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Establecimiento extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre', 'categoria_id', 'imagen_principal',
        'direccion', 'barrio', 'lat', 'lng', 'telefono',
        'descripcion', 'apertura', 'cierre', 'uuid', 'user_id'
    ];

    public function categoria()
    {
        # code...
        return $this->belongsTo(Categoria::class);
    }
}
