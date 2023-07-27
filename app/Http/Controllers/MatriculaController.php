<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Models\User;
use App\Models\Curso;
use Illuminate\Http\Request;

use Inertia\Inertia;

class MatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Curso::with('users')->get();
        $matriculas = Matricula::with('user','curso')->get();
        $cursos = Curso::select('id','name')->get();
        $usuarios = User::select('id','name')->get();

        // dd($usuarios);
        $form_ = [
            'cursos'=>['label'=>'Cursos','type'=>'select','options'=>$cursos,'optikey'=>'name'],
            'users'=>['label'=>'Usuarios','type'=>'select','options'=>$usuarios,'optikey'=>'name'],
        ];

        $tableColumns = [
            ['key' => 'id', 'label' => 'ID'],
        ];
        return Inertia::render('Matriculas/Index',compact('matriculas','cursos', 'tableColumns',"form_"));
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
        // $request->validate(Matricula::$rules);
        foreach ($request->cursos as $curso){
            if($curso!==null){
                Matricula::create([
                    'user_id' => $request->user_id,
                    'curso_id' => $curso,
                ]);
            }
        }
        
        return redirect('matriculas');
    }

    /**
     * Display the specified resource.
     */
    public function show(Matricula $matricula)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Matricula $matricula)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Matricula $matricula)
    {
        $request->validate(Matricula::$rules);
        $matricula->update([
            'user_id' => $request->user_id,
            'curso_id' => $request->curso_id,
            ]);

        return redirect('matriculas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Matricula $matricula)
    {
        $matricula->delete();
        return redirect('matriculas');
    }
}
