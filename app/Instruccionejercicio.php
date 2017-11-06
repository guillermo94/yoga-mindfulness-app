<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instruccionejercicio extends Model
{
   
    protected $primaryKey = 'Id';
       protected $fillable = [
        'contenido', 'porcetaje_tiempo', 'audio', 'accionejercicio_Id', 'updated_at', 'created_at',
    ];

    public function setAttributes($array)
    {
        if (!empty($array['contenido'])) {
            $this->contenido = $array['contenido'];
        }
        if (!empty($array['contenido'])) {
            $this->contenido = $array['contenido'];
        }
        if (!empty($array['audio'])) {
            $this->audio = $array['audio'];
        }
        $this->save();
    }
}
