<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Duda extends Model
{

    protected $primaryKey = 'Id';
    protected $fillable = [
        'usuario_Id', 'titulo', 'contenido','tipo_usuario', 'created_at', 'updated_at',
    ];
    public function respuestas()
    {
        return $this->hasMany('App\RespuestaDuda');
    }
}
