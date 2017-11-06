<?php

namespace App\Http\Controllers;

use App\Duda;
use App\RespuestaDuda;
use Illuminate\Http\Request;
use App\Usuario;
use App\DiasSemana;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ErrorException;

class UsuariosAppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     return view('vendor.adminlte.adduser');
    }
    public function index2()
    {
        return view('vendor.adminlte.addfoto');
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $usuarioArray = json_decode($request->input('jsonUsuario'), true);
        $newUsuario = new Usuario;
        $newUsuario->setAttributes($usuarioArray);
        $newUsuario->password = bcrypt($usuarioArray['password']);
        $newUsuario->save();
        $usuario = Usuario::where('email', '=', $newUsuario->email)->first();
        $diasSemana = new DiasSemana;
        $usuario->dias_semana()->save($diasSemana);
        $usuario->save();
        return "DONE";
    }


    public function show($email, $pass)
    {
        $usuario = Usuario::where('email', '=', $email)->first();
       if (!$usuario) {
           return "BAD_USER";
        }

        if (Hash::check($pass, $usuario->password)) {
           $usuario->dias_semana;
           if($usuario->programa_asignado != null) {
               $usuario->programa_asignado->ejercicios;
           }
            return $usuario;
        }
        else{ return "BAD_PASSWORD";}
        
    }

    public function showProgramasAsignados($id){
        $usuario = Usuario::findOrFail($id);
        $usuario->programas->each(function($programa)
        {
            $programa->ejercicios;
        });
        return $usuario->programas;
    }

    public function showProgramasCreados($id){
        $usuario = Usuario::findOrFail($id);
        $usuario->programas_creados->each(function($programa)
        {
            $programa->ejercicios;
        });
        return $usuario->programas_creados;
    }


    public function showDoubt($id){
        $usuario = Usuario::findOrFail($id);
        $usuario->dudas->each(function($duda)
        {
            $duda->respuestas->each(function($respuesta) {
                $respuesta->autor;
                });
        });
        return $usuario->dudas;
    }
    public function showAllDoubts(){
        $dudas = Duda::all();
        foreach ($dudas as $duda) {
            $duda->respuestas->each(function($respuesta) {
                $respuesta->autor;
            });
        }
        return $dudas;
    }
    public function newDoubtToUser(Request $request)
    {

        $dudaArray = json_decode($request->input('jsonDuda'), true);

        $duda = new Duda;
        $duda->usuario_Id = $dudaArray['usuario_Id'];
        if(!empty($dudaArray['titulo'])){$duda->titulo = $dudaArray['titulo'];}
        if(!empty($dudaArray['contenido'])){$duda->contenido = $dudaArray['contenido'];}
        $duda->save();
        return "DONE";

    }
    public function newResponseToUser(Request $request)
    {

        $respuesta_dudaArray = json_decode($request->input('jsonRespuestaDuda'), true);

        $respuesta_duda = new RespuestaDuda;
        $respuesta_duda->usuario_Id = $respuesta_dudaArray['usuario_Id'];
        $respuesta_duda->duda_Id = $respuesta_dudaArray['duda_Id'];
        if(!empty($respuesta_dudaArray['contenido'])){$respuesta_duda->contenido = $respuesta_dudaArray['contenido'];}
        $respuesta_duda->save();
        return "DONE";

    }
    public function edit($id)
    {
        
    }


    public function asignProgramToUser(Request $request)
    {
       // return $request['$idUsuario'] ." ID PROGRAMA: " .$request['$idPrograma'];
        $usuario = Usuario::findOrFail($request['$idUsuario']);
        $usuario->programas()->attach($request['$idPrograma'], ['progreso' => 0]);
        $usuario->save();
        return "DONE";

    }


    public function update(Request $request)
    {
        $usuarioArray = json_decode($request->input('jsonUsuario'), true);
        $usuario = Usuario::findOrFail($usuarioArray['Id']);
        $usuario->setAttributes($usuarioArray);
        $usuario->programas()->updateExistingPivot($usuario->id_program_act, array('progreso' => $usuario->progreso_prog_act), false);
        $usuario->save();
        return "DONE";
    }


    public function changeImgProfile(Request $request){

        $image = $request->input('foto_perfil');
        $name = $request->input('user_id');


        $binary = base64_decode(urldecode($image));
        header('Content-Type: bitmap; charset=utf-8');

        $f = finfo_open();
        $mime_type = finfo_buffer($f, $binary, FILEINFO_MIME_TYPE);
        $mime_type = str_ireplace('image/', '', $mime_type);

        $path = public_path('/fotos_perfil/' . $name . '.'.$mime_type);


        file_put_contents($path,base64_decode($image));

        $usuario = Usuario::findOrFail($request->input('user_id'));
        $usuario->foto_perfil = '/fotos_perfil/' . $name . '.'.$mime_type;
        $usuario->save();

        return "Successfully Uploaded";



        /*$usuario = Usuario::findOrFail($request->input('user_id'));
        $usuario->foto_perfil = $request->input('foto_perfil');
        $usuario->save();*/
        /*$path = '/fotos_perfil/';
        $base =  $request->input('foto_perfil');

        //$binary = base64_decode($base);
        $binary = base64_decode(urldecode($base));
        header('Content-Type: bitmap; charset=utf-8');

        $f = finfo_open();
        $mime_type = finfo_buffer($f, $binary, FILEINFO_MIME_TYPE);
        $mime_type = str_ireplace('image/', '', $mime_type);

        $filename = md5(\Carbon\Carbon::now()) . '.' . $mime_type;
        $file = fopen(public_path($path . $request->input('user_id') . '.'.$mime_type), 'wb');
        if (fwrite($file, $binary)) {
            return $filename;
        } else {
            return FALSE;
        }
        fclose($file);*/



       /* $img = Image::make($file->getRealPath());
        $input['imagename'] = $request->input("user_id").".".$file->getClientOriginalExtension();
        $img->resize(500, 500, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path($filepath).'/'.$input['imagename']);*/

       /* $this->miniatura= $filepath.'/'.$input['imagename'];
        $this->save();*/

       // return $filename;

    }

    public function destroy($id)
    {
        //
    }
}
