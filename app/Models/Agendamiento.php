<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamiento extends Model
{
    use HasFactory;
    protected $fillable = [
        'hora',
        'estado','fecha',
        'servicios_id',
        'tecnicos_id',
        'cotizaciones_id',
        ];    
    public $timestamps = false;

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'cotizacionesmateriales', 'cotizacion_id', 'material_id');
    }

    public function servicio() {
    return $this->belongsTo(Servicio::class, 'servicios_id', 'id');
    }

}
