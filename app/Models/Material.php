<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $fillable = [
        "descripcion",
    ] ;
    public $timestamps = false;
    public function cotizaciones() {
        return $this->belongsToMany(Cotizacion::class, 'cotizacionesmateriales', 'materials_id', 'cotizacions_id');
    }

}
