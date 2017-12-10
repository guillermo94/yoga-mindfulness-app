<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
	public $incrementing = false;
      protected $primaryKey = 'Id';
       protected $fillable = [
        'Id','email', 'password', 'nombre', 'apellidos', 'descripcion', 'sexo', 'edad', 'rol', 'id_program_act'
           ,'experiencia_total', 'progreso_prog_act', 'notif_activas', 'hora_notif', 'foto_perfil', 'updated_at', 'created_at',
    ];

    public function setAttributes($array) {
        $this->email = $array['email'];
        $this->password = $array['password'];
        if(!empty($array['nombre'])){$this->nombre = $array['nombre'];}
        if(!empty($array['apellidos'])){$this->apellidos = $array['apellidos'];}
       // $this->img_perfil = $array['img_perfil'];
        if(!empty($array['descripcion'])){$this->descripcion = $array['descripcion'];}
        if(!empty($array['sexo'])){$this->sexo = $array['sexo'];}
        if(!empty($array['edad'])){$this->edad = $array['edad'];}
        if(!empty($array['rol'])){$this->edad = $array['rol'];}
        if(!empty($array['id_program_act'])){$this->id_program_act = $array['id_program_act'];}
        else{$this->id_program_act=null;}
        if(!empty($array['experiencia_total'])){$this->experiencia_total = $array['experiencia_total'];}
        if(!empty($array['progreso_prog_act'])){$this->progreso_prog_act = $array['progreso_prog_act'];}
        if(!empty($array['notif_activas'])){$this->notif_activas = $array['notif_activas'];}
        if(!empty($array['hora_notif'])){$this->hora_notif = $array['hora_notif'];}
        if(!empty($array['modo_ejercicio'])){$this->modo_ejercicio = $array['modo_ejercicio'];}
        if(!empty($array['foto_perfil'])){$this->foto_perfil = $array['foto_perfil'];}

        if(!empty($array['dias_semana']))
        {
            $diasSemana = $this->dias_semana;
            $diasSemana->lunes = $array['dias_semana']['lunes'];
            $diasSemana->martes = $array['dias_semana']['martes'];
            $diasSemana->miercoles = $array['dias_semana']['miercoles'];
            $diasSemana->jueves = $array['dias_semana']['jueves'];
            $diasSemana->viernes = $array['dias_semana']['viernes'];
            $diasSemana->sabado = $array['dias_semana']['sabado'];
            $diasSemana->domingo = $array['dias_semana']['domingo'];
            $this->dias_semana()->save($diasSemana);
        }
    }

    public function programas(){
        return $this->belongsToMany('\App\Programa','programas_usuarios')
            ->withPivot('progreso')->withTimestamps();
    }
    public function dias_semana()
    {
        return $this->hasOne('App\DiasSemana');
    }

    public function programa_asignado()
    {
        return $this->hasOne('App\Programa', 'Id', 'id_program_act');
    }

    public function programas_creados()
    {
        return $this->hasMany('App\Programa');
    }

    public function dudas()
    {
        return $this->hasMany('App\Duda');
    }
   
}
