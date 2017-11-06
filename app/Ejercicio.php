<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Image;


class Ejercicio extends Model
{
    //
    public function getName(){
    	return $this->nombre;
    }
    protected $primaryKey = 'Id';
       protected $fillable = [
        'nombre', 'introduccion', 'duracion', 'miniatura', 'puntuacion_media', 'num_votos', 'updated_at', 'created_at',
    ];

    public function secciones()
    {
        return $this->hasMany('App\Seccionejercicio');
    }

    public function comentarios()
    {
        return $this->hasMany('App\ComentarioEjercicio');
    }
    public function opcionespreguntafinal()
    {
        return $this->hasMany('App\SliderFinalOpcion');
    }

    public function setAttributes(Request $request)
    {
        $jsonResult = $request->input('arrayFinal');
        $array = json_decode($jsonResult, true);
        $array = $array[0];
        $this->nombre = $array['nombre'];
        if (!empty($array['introduccion'])) {
            $this->introduccion = $array['introduccion'];
        }



        $duracion = 0;
        if (!empty($array['secciones'])) {
            foreach ($array['secciones'] as $seccion){
                if(!empty($seccion['id'])){$newSeccion = Seccionejercicio::findOrFail($seccion['id']);}
                else{
                    $newSeccion = new Seccionejercicio;
                    $newSeccion->ejercicio_Id = $this->Id;
                    $newSeccion->save();
                }
                $newSeccion->setAttributes($this->Id, $seccion, $request);
                $duracion += $newSeccion->duracion;
            }
        }

        /*if (!empty($array['duracion'])) {
            $this->duracion = $array['duracion'];
        }*/
        if($duracion != 0){
            $this->duracion  = $duracion;
        }
        $this->save();

        if(!empty($array['miniatura'])){
            $filepath = '/miniaturas_ejercicios';
            $file = $request->file('miniatura');
            $img = Image::make($file->getRealPath());
            $input['imagename'] = $this->Id.".".$file->getClientOriginalExtension();
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path($filepath).'/'.$input['imagename']);

            $this->miniatura= $filepath.'/'.$input['imagename'];
            $this->save();
        }

    }

    protected $table = 'ejercicios';
}


