@extends('adminlte::layouts.app')
@section('PageName', 'AddLesson')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection


<meta charset="utf-8">
@section('main-content')

    <!-- Initialize the editor. -->
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">

            <form id="form" method="post" class="form-horizontal" enctype="multipart/form-data">
                @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <fieldset>
                    <legend>Crear un nuevo ejercicio</legend>
                    <div class="form-group">
                        <label for="title" class="col-lg-2 control-label">Foto</label>
                        <input type="text" name="foto_perfil" id="foto_perfil">
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-lg-2 control-label">ID usuario</label>
                        <input type="text" name="user_id" id="user_id">
                    </div>
                    <button type="submit" class="btn btn-primary" id="submit">Aceptar</button>


                </fieldset>
        </form>

        <body>

@endsection
