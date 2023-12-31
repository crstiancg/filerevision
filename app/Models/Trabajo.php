<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajo extends Model
{
    use HasFactory;
    protected $fillable = ['titulo','descripcion','curso_id'];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function matriculas()
    {
        return $this->belongsToMany(Matricula::class, 'tareas','trabajo_id','matricula_id')
        ->using(Tarea::class);
    }

    public static $rules=[
        'titulo' => 'required',
        'descripcion'=>'required',
        'curso_id'=>'required'
    ];
}


