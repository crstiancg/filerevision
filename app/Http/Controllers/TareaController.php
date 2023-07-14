<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\Trabajo;
use App\Models\Matricula;
use Illuminate\Http\Request;

use Inertia\Inertia;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Trabajo::with('matriculas')->get();
        $trabajos = Trabajo::all();
        $matriculas = Matricula::with('user')->get();
        $tareas = Tarea::with(['trabajo','matricula'=>function($query){
            $query->with('user');
        }])->get();
        // $trabajos = Curso::with('trabajos')->where('user_id','=',auth()->user()->id)->get();
        // dd($matriculas);
        return Inertia::render('Tareas/Index',['tareas'=>$tareas,'trabajos'=>$trabajos,'matriculas'=>$matriculas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarea $tarea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarea $tarea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarea $tarea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarea $tarea)
    {
        //
    }
}
