<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;
    protected $fillable = [
        "costo",
    ] ;

    public $timestamps = false;
    public function materials()
    {
        return $this->belongsToMany(Material::class, 'cotizacionesmateriales', 'cotizacions_id', 'materials_id');
    }
  
}