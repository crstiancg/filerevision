<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','descripcion','estado','user_id', 'carrera_id'];

    public function carrera()
    {
        return $this->belongsTo(Carrera::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trabajos()
    {
        return $this->hasMany(Trabajo::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'matriculas',  'curso_id','user_id')
        ->using(Matricula::class);
    }
}
