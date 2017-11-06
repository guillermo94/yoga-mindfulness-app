<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

use Image;


class Accionejercicio extends Model
{
     public function getName(){
    	return $this->nombre;
    }
    protected $primaryKey = 'Id';
       protected $fillable = [
        'nombre', 'duracion', 'num_repeticiones', 'tipo','url_file', 'updated_at', 'seccionejercicio_Id', 'created_at',
    ];
    public function instrucciones()
    {
        return $this->hasMany('App\Instruccionejercicio');
    }

    public function setAttributes($idEjer, $posSec, $array, Request $request)
    {
        if (!empty($array['nombre'])) {
            $this->nombre = $array['nombre'];
        }
        if (!empty($array['duracion'])) {
            $this->duracion = $array['duracion'];
        }
        if (!empty($array['num_repeticiones'])) {
            $this->num_repeticiones = $array['num_repeticiones'];
        }

        $filepath = '/ficherosInstrucciones';
        $file = $request->file('file?'.$posSec.'&'.$array['pos']);
        $input['imagename'] = $idEjer . '_'.$posSec.'_'.$array['pos'].'.'.$file->getClientOriginalExtension();
        $destinationPath = public_path($filepath);

        $this->tipo = $array['tipo'];
        if($array['tipo'] == "Mediante imagen + texto") {
            if (!empty($array['instrucciones'])) {
                foreach ($array['instrucciones'] as $instruccion){
                    if(!empty($instruccion['id'])){$newInstruccion = Instruccionejercicio::findOrFail($instruccion['id']);}
                    else{
                        $newInstruccion = new Instruccionejercicio;
                        $newInstruccion->accionejercicio_Id = $this->Id;
                        $newInstruccion->save();
                    }
                    $newInstruccion->setAttributes($instruccion);
                }
            }


            $img = Image::make($file->getRealPath());
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['imagename']);
        }
        else{
            Storage::putFileAs(
                $filepath,$file, $input['imagename']
            );

           // $file->store($filepath.'/'.$input['imagename']);

        }

        $this->url_file= $filepath.'/'.$input['imagename'];
        $this->save();
    }
}
