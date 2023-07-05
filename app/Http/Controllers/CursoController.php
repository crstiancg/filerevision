<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Carrera;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cursos = Curso::with('carrera','user')->get();
        $carre = Carrera::all();

        // dd($cursos);
        return Inertia::render('Cursos/Index',['cursos'=>$cursos,'carreras'=>$carre]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Curso::create([
            'nombre'=>$request->nombre,
            'estado'=>$request->estado,
            'descripcion' =>$request->descripcion,
            'user_id' => auth()->user()->id,
            'carrera_id' => $request->carrera_id,
            ]);

        return redirect('cursos');
    }

    /**
     * Display the specified resource.
     */
    public function show(Curso $curso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Curso $curso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Curso $curso)
    {
        $curso->update([
            'nombre'=>$request->nombre,
            'estado'=>$request->estado,
            'descripcion' =>$request->descripcion,
            'user_id' => auth()->user()->id,
            'carrera_id' => $request->carrera_id,
            ]);

        return redirect('cursos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curso $curso)
    {
        $curso->delete();
        return redirect('cursos');
    }
}