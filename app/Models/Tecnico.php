<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tecnico extends Model
{
    use HasFactory;
    protected $fillable = [
        "direccion",
        'telefono',
        'user_id'
    ] ;
    public $timestamps = false;

    public function agendamientos() {
        return $this->hasMany(Agendamiento::class, 'tecnicos_id', 'id');
    }  
    
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
