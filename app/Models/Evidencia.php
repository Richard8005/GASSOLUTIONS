<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evidencia extends Model
{
    use HasFactory;
    protected $fillable = [
        "agendamiento_id",
    ] ;
    public $timestamps = false;

    public function agendamiento() {
        return $this->belongsTo(Agendamiento::class, 'agendamiento_id', 'id');
    }
    
}
