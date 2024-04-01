<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable = [
        'direccion',
        'telefono',
        'user_id'
    ] ;
    public $timestamps = false;

    /*public function servicio_tipo(){
        return $this->belongsTo(Tipo::class, 'servicios', 'tipo_id','ciudad_id')
        ->withPivot("id","fecha","hora")->using(Servicio::class);
    }*/

    public function servicios(){
        return $this->hasMany(Servicio::class, 'servicios', 'cliente_id','id');

    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}

