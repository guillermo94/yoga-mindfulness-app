<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    protected $primaryKey = 'Id';
    protected $fillable = [
        'nombre', 'dificultad', 'usuario_Id', 'num_ejercicios', 'updated_at', 'created_at',
    ];
    protected $table = 'programas';


    public function ejercicios(){
        return $this->belongsToMany('\App\Ejercicio','programas_ejercicios');
    }


}
