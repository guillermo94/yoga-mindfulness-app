<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RespuestaDuda extends Model
{
    protected $primaryKey = 'Id';
    protected $fillable = [
        'duda_Id', 'usuario_Id', 'contenido', 'created_at', 'updated_at',
    ];

    public function autor()
    {
        return $this->hasOne('App\Usuario', 'Id', 'usuario_Id');
    }
    protected $table = 'respuestas_dudas';

}
