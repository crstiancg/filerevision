<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Matricula extends Pivot
{
    use HasFactory;

    protected $table =  'matriculas';

    public function trabajos()
    {
        return $this->belongsToMany(Trabajo::class, 'tareas', 'matricula_id','trabajo_id')
        ->using(Tarea::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public static $rules=[
        'user_id'=>'required',
        'curso_id'=>'required'
    ];
}
