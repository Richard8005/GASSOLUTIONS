<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;
    protected $fillable = [
        "fecha",
        "direccion",
        "hora",
        'estado',
        "tipos_id",
        "ciudades_id",
        "tecnicos_id",
    ];
    public $timestamps = false;

    public function agendamiento(){
        return $this->hasMany(Agendamiento::class, 'servicios_id', 'id');
    }

    public function ciudad(){
        return $this->belongsTo(Ciudad::class, 'ciudades_id', 'id');
    }

    public function evaluacion(){
        return $this->hasMany(Evaluacion::class, 'servicio_id', 'id');
    }

    public function tipo(){
        return $this->belongsTo(Tipo::class, 'tipos_id', 'id');
    }

}
