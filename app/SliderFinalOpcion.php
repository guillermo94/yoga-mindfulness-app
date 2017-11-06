<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SliderFinalOpcion extends Model
{
    protected $table = 'sliderfinalopcion';
    protected $primaryKey = 'Id';
    protected $fillable = [
        'contenido', 'ejercicio_Id'
    ];

}
