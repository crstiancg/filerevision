<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    use HasFactory;

    public function tarea()
    {
        return $this->belongsTo(Tarea::class);
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }
}
