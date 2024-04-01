<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;
    protected $fillable = ['nombre'] ;
    public $timestamps = false;

    public function servicio(){
        return $this->hasMany(Servicio::class, 'ciudad_id','id');
    }

}
