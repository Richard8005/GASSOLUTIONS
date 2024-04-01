<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacionmaterial extends Model
{
    use HasFactory;
    protected $fillable = [
        "cotizacions_id",
        "materials_id",
    ] ;
    public $timestamps = false;
    protected $table = "cotizacionesmaterials";
    public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class, 'cotizacions_id', 'id');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'materials_id', 'id');
    }

}
