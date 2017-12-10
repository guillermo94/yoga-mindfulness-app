<?php

namespace App\Http\Controllers;

use App\ComentarioEjercicio;
use Illuminate\Http\Request;
use App\Ejercicio;
use App\Categoriasejercicio;
use App\SliderFinalOpcion;
use Image;
use LaravelFCM\Message\Topics;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use Session;

class LessonsController extends Controller
{
    public function index()
    {


       Session::put('categoriaNuevoEjericio', array());
        Session::put('seccionesEjercicio', array());
        Session::pull('numSeccionesEjercicio', 'default');
        $categoriaejercicios = CategoriasEjercicio::all();
        return view('vendor.adminlte.addlesson2', compact('categoriaejercicios'));
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
            //Se eliminan las categorias y las preguntas finales anteriores para añadir las nuevas
            $newEjercicio->categorias()->delete();
            $newEjercicio->opcionespreguntafinal()->delete();
            //Se eliminan los componentes anteriores del ejercicio para almacenar los nuevos
            foreach ($newEjercicio->secciones as $seccion) {
                $existeSeccion = False;
                foreach ($arrayEjercicio['secciones'] as $seccionRequest) {
                    if(array_key_exists('id', $seccionRequest)) {
                        if ($seccionRequest['id'] == $seccion->Id) {
                            $existeSeccion = True;
                            foreach ($seccion->acciones as $accion) {
                                $existeAccion = False;
                                foreach ($seccionRequest['acciones'] as $accionRequest) {
                                    if(array_key_exists('id', $accionRequest)) {
                                        if ($accionRequest['id'] == $accion->Id) {
                                            if($accionRequest['tipo'] == "Mediante imagen + texto" && $accionRequest['tipo'] == $accion->tipo) {
                                                $existeAccion = True;
                                                foreach ($accion->instrucciones as $instruccion) {
                                                    $existeInstruccion= False;
                                                    foreach ($accionRequest['instrucciones'] as $instruccionRequest) {
                                                        if(array_key_exists('id', $instruccionRequest)) {
                                                            if ($instruccionRequest['id'] == $instruccion->Id) {
                                                                $existeInstruccion=true;
                                                                break;
                                                            }
                                                        }
                                                    }
                                                    if(!$existeInstruccion){
                                                        $instruccion->delete();
                                                    }
                                                }
                                            }
                                            break;
                                        }
                                    }
                                }
                                if(!$existeAccion){
                                    $accion->delete();
                                }
                            }
                            break;
                        }
                    }
                }
                if(!$existeSeccion){
                    $seccion->delete();
                }

            }
        } else {
            $newEjercicio = new Ejercicio;
            $newEjercicio->save();
        }
        $newEjercicio->setAttributes($request);

        $jsonResult3 = $request->input('arrayCatergorias');
        $arrayCategorias = json_decode($jsonResult3, true);

        foreach ($arrayCategorias as $categoria){
            $newCategoria = Categoriasejercicio::where('nombre', '=', $categoria)->first();
            if (!$newCategoria) {
                $newCategoria = new Categoriasejercicio;
                $newCategoria->nombre = $categoria;
                $newCategoria->save();
            }
            $newEjercicio->categorias()->attach($newCategoria->Id);

        }
        $newEjercicio->save();


        $jsonResult2 = $request->input('arrayPregunta');
        $arrayPregunta = json_decode($jsonResult2, true);
        foreach ($arrayPregunta as $contenidoPregunta) {
            $newPregunta = new SliderFinalOpcion;
            $newPregunta->contenido = $contenidoPregunta['contenido'];
            $newPregunta->ejercicio_Id = $newEjercicio->Id;
            $newPregunta->save();

        }





         //Se envía una notificación a los usuarios que lo deseen
        $notificationBuilder = new PayloadNotificationBuilder('¡Nueva clase añadida!');
        $notificationBuilder->setBody('La clase "'.$newEjercicio->nombre. '" ha sido añadida y ya está disponible, ¡ACCEDE A ELLA!')
            ->setSound('default');//->setIcon('http://'.$_SERVER['SERVER_ADDR'].$newEjercicio->miniatura);

        $notification = $notificationBuilder->build();

        $topic = new Topics();
        $topic->topic('news');

        $topicResponse = FCM::sendToTopic($topic, null, $notification, null);

        $topicResponse->isSuccess();
        $topicResponse->shouldRetry();
        $topicResponse->error();

        return $arrayEjercicio;
    }

    

    public function showAll()
    {
        $ejercicios = Ejercicio::all();
        foreach ($ejercicios as $ejercicio) {
            $ejercicio->comentarios->each(function ($comentario) {
                $comentario->usuario;
            });
            $ejercicio->categorias;
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
        $ejercicio->categorias;
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
        $ejercicio->categorias;
        $ejercicio->opcionespreguntafinal;
        $categoriaejercicios = CategoriasEjercicio::all();

        return view('vendor.adminlte.editlesson2', compact('ejercicio', 'categoriaejercicios'));
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
