<?php

namespace App\Http\Controllers;

use App\ComentarioEjercicio;
use Illuminate\Http\Request;
use App\Ejercicio;
use App\CategoriasEjercicio;
use App\SliderFinalOpcion;
use Image;

use Session;


class LessonsController extends Controller
{
    public function index()
    {
        Session::put('categoriaNuevoEjericio', array());
        Session::put('seccionesEjercicio', array());
        Session::pull('numSeccionesEjercicio', 'default');
        $categoriaejercicios = CategoriasEjercicio::all();
        return view('vendor.adminlte.addlesson', compact('categoriaejercicios'));
    }

    public function indexModify()
    {
        $ejercicios = Ejercicio::all();
        return view('vendor.adminlte.modifylesson', compact('ejercicios'));
    }



    public function create()
    {
        return view('vendor.adminlte.addlesson');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $jsonResult = $request->input('arrayFinal');
            $arrayEjercicio = json_decode($jsonResult, true);
        $arrayEjercicio = $arrayEjercicio[0];

        if (!empty($arrayEjercicio['id'])) {
            $newEjercicio = Ejercicio::findOrFail($arrayEjercicio['id']);
        } else {
            $newEjercicio = new Ejercicio;
            $newEjercicio->save();
        }
        $newEjercicio->setAttributes($request);
        $newEjercicio->save();


        $jsonResult2 = $request->input('arrayPregunta');
        $arrayPregunta = json_decode($jsonResult2, true);
        foreach ($arrayPregunta as $contenidoPregunta) {
            $newPregunta = new SliderFinalOpcion;
            $newPregunta->contenido = $contenidoPregunta['contenido'];
            $newPregunta->ejercicio_Id = $newEjercicio->Id;
            $newPregunta->save();

        }






      /*  foreach ($newEjercicio->secciones as $seccion) {
            $seccion->acciones;
            foreach ($seccion->acciones as $accion) {
                \Storage::disk('local')->put($newEjercicio->Id . ,  \File::get($accion->fichero));

                $accion->instrucciones;
            }
        }
        $arrayEjercicio = json_decode($newEjercicio, true);
*/
      /* foreach($arrayEjercicio['secciones'] as $seccion){
            foreach($seccion['acciones'] as $accion){
                //Storage::disk('local')->putFileAs('ficherosInstrucciones', $request->file('file?'.$seccion['pos'].
                 //   '&'.$accion['pos']), $newEjercicio->Id . '_'.$seccion['pos'].'_'.$accion['pos'].'.jpeg');
                $image = $request->file('file?'.$seccion['pos'].'&'.$accion['pos']);
                $input['imagename'] = $newEjercicio->Id . '_'.$seccion['pos'].'_'.$accion['pos'].'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/ficherosInstrucciones');
                $img = Image::make($image->getRealPath());
                $img->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$input['imagename']);


            }
         }*/

        return $arrayEjercicio;
    }

    

    public function showAll()
    {
        $ejercicios = Ejercicio::all();
        foreach ($ejercicios as $ejercicio) {
            $ejercicio->comentarios->each(function ($comentario) {
                $comentario->usuario;
            });
        }
        return $ejercicios;
    }

     public function show($id)
    {
        $ejercicio = Ejercicio::findOrFail($id);
        foreach ($ejercicio->secciones as $seccion) {
            $seccion->acciones;
            foreach ($seccion->acciones as $accion) {
                $accion->instrucciones;
            }
        }


        $ejercicio->opcionespreguntafinal;
        $ejercicio->comentarios->each(function($comentario)
        {
            $comentario->usuario;
        });
        return $ejercicio;
    }
    public function showInPanel($id)
    {
        $ejercicio = Ejercicio::findOrFail($id);
        foreach ($ejercicio->secciones as $seccion) {
            $seccion->acciones;
            foreach ($seccion->acciones as $accion) {
                $accion->instrucciones;
            }
        }
        return $ejercicio;
    }


    public function edit($id)
    {
        $ejercicio = Ejercicio::findOrFail($id);
        foreach ($ejercicio->secciones as $seccion) {
            $seccion->acciones;
            foreach ($seccion->acciones as $accion) {
                $accion->instrucciones;
            }
        }
        return view('vendor.adminlte.editlesson', compact('ejercicio'));
    }


    public function update(Request $request, $id)
    {


    }


    public function destroy($id)
    {
        $ejercicio = Ejercicio::findOrFail($id);
        $ejercicio->delete();
        return redirect('/editlesson')-> with('status',  'El ejercicio '. $id .' ha sido eliminado del sisteama.');
    }



    //---Métodos referentes a los comentarios
    public function showComments($id)
    {
        $ejercicio = Ejercicio::findOrFail($id);
        $ejercicio->comentarios->each(function($comentario)
        {
            $comentario->usuario;
        });
        return $ejercicio->comentarios;
    }

    public function newComment(Request $request)
    {
        $comentarioArray = json_decode($request->input('jsonComentario'), true);
        $comentario = new ComentarioEjercicio();
        $comentario->ejercicio_Id = $comentarioArray['ejercicio_Id'];
        $comentario->usuario_Id = $comentarioArray['usuario_Id'];
        if(!empty($comentarioArray['contendio'])){
            $comentario->contendio = $comentarioArray['contendio'];
        }
        if(!empty($comentarioArray['puntuacion'])){
            $comentario->puntuacion = $comentarioArray['puntuacion'];
        }
        $comentario->save();
        return "DONE";
    }
    public function isRated($id_ejercicio, $id_usuario)
    {

    }
}
