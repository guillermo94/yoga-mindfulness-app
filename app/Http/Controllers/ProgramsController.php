<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoriasprograma;
use App\Ejercicio;
use App\Programa;
use App\Usuario;

class ProgramsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $ejercicios = Ejercicio::all();
       // $ejercicioArray = json_decode($jsonResult, true);
          $categoriaprograma = Categoriasprograma::all();
        return view('vendor.adminlte.addprogram', compact('categoriaprograma', 'ejercicios'));
    }


    public function indexModify()
    {
        $programas = Programa::where('usuario_Id','=',null)->get();
        return view('vendor.adminlte.modifyprogram', compact('programas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newPrograma = new Programa;
        $newPrograma->num_ejercicios = 0;
        $newPrograma->save();
        $newPrograma->nombre = $request->input('nombrePrograma');
        $newPrograma->dificultad = $request->input('dificultad');
        $ejerciciosArray = json_decode(($request->input('idsEjercicios')), true);
        $numEjercicios = 0;
         foreach ($ejerciciosArray as $idejercicio) {
            $newPrograma->ejercicios()->attach($idejercicio);
            $numEjercicios++;

        }
        $newPrograma->num_ejercicios = $numEjercicios;
        $newPrograma->save();
        return $newPrograma;
    }


    public function storeExpertProgram(Request $request)
    {
        $newPrograma = new Programa;
        $newPrograma->num_ejercicios = 0;
        $newPrograma->save();
        $newPrograma->nombre = $request->input('nombrePrograma');
        $newPrograma->dificultad = $request->input('dificultad');
        $ejerciciosArray = json_decode(($request->input('idsEjercicios')), true);
        $numEjercicios = 0;
        foreach ($ejerciciosArray as $idejercicio) {
            $newPrograma->ejercicios()->attach($idejercicio);
            $numEjercicios++;

        }
        $newPrograma->num_ejercicios = $numEjercicios;
        $newPrograma->save();
        return $newPrograma;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeUserProgram(Request $request)
    {
     //   return $request->input('jsonPrograma');
         $programArray = json_decode($request->input('jsonPrograma'), true);
        $newPrograma = new Programa;

       
        $newPrograma->nombre = $programArray['nombre'];
        $newPrograma->dificultad = $programArray['dificultad'];
        $newPrograma->num_ejercicios = $programArray['num_ejercicios'];
        $newPrograma->usuario_Id = $programArray['usuario_Id'];
        $newPrograma->save();
        foreach ($programArray['ejercicios'] as $ejercicio) {
            $newPrograma->ejercicios()->attach($ejercicio['Id']);

        }
        $newPrograma->save();
        $usuario = Usuario::findOrFail($programArray['usuario_Id']);
        $usuario->programas()->attach($newPrograma->Id, ['progreso' => 0]);
       // $usuario->programasasignados()->attach($newPrograma->Id);

        $usuario->save();

        $newPrograma->ejercicios;
        return $newPrograma;

    }


     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAllDefault()
    {

        $programas = Programa::where('usuario_Id','=',null)->get();
        $programas->each(function($programa) 
        {
           $programa->ejercicios; 
        });

        return $programas;

    }
    public function showAllUsers()
    {

        $programas = Programa::where('usuario_Id','!=',null)->get();
        $programas->each(function($programa)
        {
            $programa->ejercicios;
        });

        return $programas;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function show($id)
    {
        $usuario = Usuario::findOrFail($id);


        foreach ( $usuario->programas as $programa)
        {
            $programa->pivot->progreso;
        }

    //    $usuario->programas;

        return $usuario;
    }*/


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $programa = Programa::findOrFail($id);
        $programa->ejercicios;
        return view('vendor.adminlte.editprogram', compact('programa'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ejercicio = Programa::findOrFail($id);
        $ejercicio->delete();
        return redirect('/editprogram')-> with('status',  'El programa '. $id .' ha sido eliminado del sisteama.');

    }
}
