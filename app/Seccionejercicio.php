<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Seccionejercicio extends Model
{
    //
    public function getName(){
    	return $this->nombre;
    }
    protected $primaryKey = 'Id';
       protected $fillable = [
        'nombre', 'duracion', 'updated_at', 'created_at', 'ejercicio_Id',
    ];

    public function acciones()
    {
        return $this->hasMany('App\Accionejercicio');
    }

    public function setAttributes($idEjer, $array, Request $request)
    {
        if (!empty($array['nombre'])) {
            $this->nombre = $array['nombre'];
        }
        if (!empty($array['duracion'])) {
            $this->duracion = $array['duracion'];
        }
        if (!empty($array['acciones'])) {
            foreach ($array['acciones'] as $accion){
                if(!empty($accion['id'])){$newAccion = Accionejercicio::findOrFail($accion['id']);}
                else{
                    $newAccion = new Accionejercicio;
                    $newAccion->seccionejercicio_Id = $this->Id;
                    $newAccion->save();
                }
                $newAccion->setAttributes($idEjer, $array['pos'], $accion, $request);
            }
        }
        $this->save();
    }
}
