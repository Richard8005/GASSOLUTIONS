<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    use HasFactory;
    protected $fillable = [
        "descripcion",
    ] ;
    public $timestamps = false;

    public function servicio(){
        return $this->belongsTo(Servicio::class, 'tipo_id','id');
    }

}
