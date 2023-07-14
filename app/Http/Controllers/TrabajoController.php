<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Trabajo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Inertia\Inertia;

class TrabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cursos = Curso::with('carrera','user')->where('user_id','=',auth()->user()->id)->get();
        
        $trabajos = Trabajo::with('curso')->get();
        // $trabajos = Curso::with('trabajos')->where('user_id','=',auth()->user()->id)->get();
        // dd($trabajos);
        return Inertia::render('Trabajos/Index',['trabajos'=>$trabajos,'cursos'=>$cursos]);
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
        $request->validate(Trabajo::$rules);
        Trabajo::create([
            'titulo'=>$request->titulo,
            'descripcion' =>$request->descripcion,
            'curso_id' => $request->curso_id,
            ]);

        return redirect('trabajos');
    }

    /**
     * Display the specified resource.
     */
    public function show(Trabajo $trabajo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trabajo $trabajo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trabajo $trabajo)
    {
        $request->validate(Trabajo::$rules);
        $trabajo->update([
            'titulo'=>$request->titulo,
            'descripcion' =>$request->descripcion,
            'curso_id' => $request->curso_id,
            ]);

        return redirect('trabajos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trabajo $trabajo)
    {
        $trabajo->delete();
        return redirect('trabajos');
    }
}
