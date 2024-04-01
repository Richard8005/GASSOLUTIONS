<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    use HasFactory;
    protected $fillable = [
        "calificacion",
        "agendamiento_id",
    ];
    public $timestamps = false;

    public function agendamiento() {
    return $this->belongsTo(Servicio::class, 'agendamiento_id', 'id');
    }

}
