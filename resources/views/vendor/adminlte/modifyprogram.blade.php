@extends('adminlte::layouts.app')
@section('PageName', 'Modify lessons')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')

    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">


            <div class="panel-heading">
                <h2> Programas </h2>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if ($programas->isEmpty())
                <p> No hay $programas.</p>
            @else
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($programas as $programa)
                        <tr>
                            <td>{!! $programa->Id !!} </td>
                            <td>{!! $programa->nombre !!}</td>
                            <td><a href="{!! action('ProgramsController@edit', $programa->Id) !!}" class="btn btn-info">Editar</a><td>
                            <td>  <form method="post" action="{!! action('ProgramsController@destroy', $programa->Id) !!}" class="pull-left">
                                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                    <div>
                                        <button type="submit" class="btn btn-warning">Borrar</button>
                                    </div>
                                </form><td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection