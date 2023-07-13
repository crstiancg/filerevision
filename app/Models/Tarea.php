<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Tarea extends Pivot
{
    use HasFactory;
    protected $fillable = ['titulo','descripcion','curso_id'];

    protected $table =  'tareas';

    public function revisions()
    {
        return $this->hasMany(Revision::class, 'tarea_id','id');
    }
}
