<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComentarioEjercicio extends Model

{

    protected $primaryKey = 'Id';
    protected $fillable = [
        'ejercicio_Id', 'usuario_Id', 'contendio', 'puntuacion', 'updated_at', 'created_at',
    ];

    public function usuario()
    {
        return $this->belongsTo('App\Usuario');
    }

    protected $table = 'comentariosejercicios';

}
