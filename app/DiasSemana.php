<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiasSemana extends Model
{
    protected $table = 'dias_semana';
    protected $primaryKey = 'Id';
    protected $fillable = [
        'usuario_Id', 'lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo',
    ];
}
