@extends('adminlte::layouts.app')
@section('PageName', 'AddLesson')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection


<meta charset="utf-8">

<!-- Include external CSS. -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">

<!-- Include Editor style. -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.6.0/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.6.0/css/froala_style.min.css" rel="stylesheet" type="text/css" />




<script type="text/javascript">
    var opcionAccion1 = "Mediante vídeo";
    var opcionAccion2 = "Mediante imagen + texto";

</script>


<style type="text/css">
    .btn-glyphicon {
        padding:8px;
        background:#ffffff;
        margin-right:4px;
    }
    .icon-btn {
        padding: 1px 15px 3px 2px;
        border-radius:50px;
        margin:10px; /* create gap between buttons for display, you can remove this*/
    }

</style>

<script type="text/javascript" language="javascript">
    var seccionesTotales = [];
    function submitForm()
    {
        var duracionEjercicio = 0;
        for(i=0;i<seccionesTotales.length;i++){
            var idNombre = "nombreSeccion?"+(i+1);
            seccionesTotales[i].nombre = document.getElementById(idNombre).value;
            var arrayduracion = (document.getElementById('duracionSeccion?'+(i+1)).value).split(":");
            seccionesTotales[i].duracion = (arrayduracion[0]*3600)+(arrayduracion[1]*60)+(arrayduracion[2]*1);
            duracionEjercicio += seccionesTotales[i].duracion;
            if(ejercicio.secciones[i]!=null) seccionesTotales[i].Id = ejercicio.secciones[i].Id;
            for(j=0;j<seccionesTotales[i].acciones.length;j++){
                if(ejercicio.secciones[i].acciones[j]!=null) seccionesTotales[i].acciones[j].Id = ejercicio.secciones[i].acciones[j].Id;
                seccionesTotales[i].acciones[j].nombre=document.getElementById('nombreAccion?'+(i+1)+'&'+(j+1)).value;
                seccionesTotales[i].acciones[j].repeticiones=document.getElementById('repeticiones?'+(i+1)+'&'+(j+1)).value;
                seccionesTotales[i].acciones[j].duracion=document.getElementById('duracion?'+(i+1)+'&'+(j+1)).value;
                seccionesTotales[i].acciones[j].tipo = document.getElementById('tipoAccion?'+(i+1)+'&'+(j+1)).value;
                for(n=0; n<seccionesTotales[i].acciones[j].instrucciones.length; n++){
                    if(ejercicio.secciones[i].acciones[j].instrucciones[n]!=null) seccionesTotales[i].acciones[j].instrucciones[n].Id = ejercicio.secciones[i].acciones[j].instrucciones[n].Id;
                    seccionesTotales[i].acciones[j].instrucciones[n].contenido=nicEditors.findEditor('textoInstruccion?'+(i+1)+'&'+(j+1)+'&'+(n+1)).getContent();
                }
            }

        }
        var ejercicioFinal = [];
        ejercicioFinal.push({Id:ejercicio.Id, nombre:document.getElementById('nombreEjercicio').value, introduccion:document.getElementById('introduccionEjercicio').value, duracion:duracionEjercicio, secciones:seccionesTotales});
        console.log(ejercicioFinal);

        document.getElementById('arrayFinal').value = JSON.stringify(ejercicioFinal);

    }
</script>
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
                    <legend>Crear un nuevo ejericicio</legend>
                    <div class="form-group">
                        <label for="title" class="col-lg-2 control-label">Nombre</label>
                        <div class="col-lg-10">
                            <input type="text" maxlength="22" value="{!! $ejercicio->nombre !!}" class="form-control" placeholder="Nombre" name="nombreEjercicio" id="nombreEjercicio" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="content" class="col-lg-2 control-label">Introduccion</label>
                        <div class="col-lg-10">
                            <textarea class="form-control" rows="3" id="introduccionEjercicio" name="introduccionEjercicio">{!! $ejercicio->introduccion !!}</textarea>
                            <span class="help-block">.</span>
                        </div>
                    </div>






                    <script type="text/javascript">
                        var categorias =[];
                        function addCategory() {
                            var nuevaCategoria = document.getElementById("nombreCategoria").value;
                            if(categorias.indexOf(nuevaCategoria) == -1){
                                categorias.push(document.getElementById("nombreCategoria").value);
                                document.getElementById("categorias").innerHTML = categorias;
                                document.getElementById("nombreCategoria").value = "";
                                document.getElementById("categoriasFinal").value = categorias;
                            }

                        }

                    </script>

                    <!--Se crea un input para pasar el resultado final de las categorias añadidas al controlador-->
                    <input type="hidden" name="categoriasFinal" id="categoriasFinal" value="">
                    <!--Input para mostrar las categorias añadidas-->
                    <div class="form-group">
                        <!--Se solicita el número de secciones del ejercicio-->
                        <label for="title" class="control-label">{{ trans('adminlte_lang::message.numersectionsmessage')}}</label><br>
                        <div class="col-lg-2">
                            <input class="form-control" onchange="dibujarSecciones();" type="number" name="numeroSecciones" id="numeroSecciones" value="{!! count($ejercicio['secciones']) !!}" min="1" max="50" required>
                        </div>
                        <!-- <div class="col-lg-10">
                             <input  type="button" onclick="dibujarSecciones()" value="Aceptar" style="width: 80px;" class="btn btn-primary form-control">
                         </div>-->
                    </div>


                    <input type="hidden" id="arrayInicial" name="arrayInicial">



                    <div class="form-group">
                        <script type="text/javascript">
                            var numSecciones = 0;

                            //dibujarSecciones();
                            function dibujarSecciones() {
                                if(numSecciones!=(document.getElementById("numeroSecciones").value))
                                {

                                    document.getElementById("seccion").innerHTML ="";
                                    numSecciones = document.getElementById("numeroSecciones").value;
                                    //console.log(numSecciones);
                                    var secciones ="";
                                    seccionesTotales.length = 0;

                                    for(i=1;i<=numSecciones;i++) {
                                        secciones += '<label for="title" class="control-label">{{ trans("adminlte_lang::message.addsection") }} ' + i + ' </label><br> \
                    <div style="margin-left: 30px;"> \
                        <div class="row"> \
                            <div class="col-lg-6"> \
                                <input type="text" class="form-control" id="nombreSeccion?' + i + '" placeholder="Nombre" name="nameSeccion' + i + '" value="" required>\
                            </div>\
                            <div class="col-lg-6">\
                            </div>\
                        </div>\
                        <div class="row">\
                         <div class="col-lg-4">\
                            <label for="title" class="control-label">Duración Sección: </label><br>\
                         </div>\
                         <div class="col-lg-8">\
                            <input type="time" id="duracionSeccion?' + i + '" value="" max="99:99:99" min="00:00:00" step="1" required>(Horas:Minutos:Segundos)\
                         </div>\
                        </div>\
                        <hr> <p id="acciones' + i + '"></p> \
                        <div class="row">\
                         <div class="col-lg-12">\
                              <input type="button" onclick="dibujarAccion(' + i + ')" value="Añadir acción" class="btn btn-primary btn-success" >\
                             <input type="button" onclick="borrarAccion(' + i + ')" value="Eliminar acción" class="btn btn-primary btn-danger">\
                            </div>\
                      </div>  \
                      </div><hr> \
                      ';
                                        seccionesTotales.push({pos: i, nombre: "", duracion: null, acciones: []});

                                    }
                                    //console.log(secciones);
                                    document.getElementById("seccion").innerHTML =secciones;
                                    //Se dibuja una primera acción para que sea obligatorio añadir al menos una
                                    for(i=1;i<=numSecciones;i++)
                                    {
                                        dibujarAccion(i);
                                    }


                                }
                            }

                            var porcentajeTiempo = 100;
                            var tiemposAcciones = [];
                            var accionesTotales = [];

                            function cambioTiempo(idSeccion, posAccion){

                                var tiempoDespuesCambio = document.getElementById('duracion?'+idSeccion+'&'+posAccion).value;

                                var difTiempo;
                                var tiempoAnterior = seccionesTotales[idSeccion-1].acciones[posAccion-1].duracion;
                                difTiempo = tiempoDespuesCambio - tiempoAnterior;
                               // console.log(difTiempo);
                                seccionesTotales[idSeccion-1].acciones[posAccion-1].duracion = tiempoDespuesCambio;

                                var cambioEnCadaAccion =(difTiempo /(seccionesTotales[idSeccion-1].acciones.length-1)) ;
                                if(cambioEnCadaAccion>0){
                                    cambioEnCadaAccion = Math.floor(cambioEnCadaAccion);
                                }
                                else{
                                    cambioEnCadaAccion = Math.ceil(cambioEnCadaAccion);
                                }

                                var restoTiempo =  difTiempo%(seccionesTotales[idSeccion-1].acciones.length-1);
                                var tiempoPrimeraAccion = cambioEnCadaAccion + restoTiempo;
                                var algunoNegativo = false;
                                for(i=0;i<seccionesTotales[idSeccion-1].acciones.length;i++){
                                    if(seccionesTotales[idSeccion-1].acciones[i].pos != posAccion){
                                        if((seccionesTotales[idSeccion-1].acciones[i].duracion - tiempoPrimeraAccion) < 0 ){
                                            algunoNegativo = true;
                                            break;
                                        }
                                    }
                                }

                                if(algunoNegativo){
                                    var tiempoPorAccion = (100-tiempoDespuesCambio) / (seccionesTotales[idSeccion-1].acciones.length-1);
                                    if(tiempoPorAccion>0){
                                        tiempoPorAccion = Math.floor(tiempoPorAccion);
                                    }
                                    else{
                                        tiempoPorAccion = Math.ceil(tiempoPorAccion);
                                    }
                                    var restoPrimero  = (100-tiempoDespuesCambio) % (seccionesTotales[idSeccion-1].acciones.length-1);
                                    var restoSumado = true;
                                    for(i=0;i<seccionesTotales[idSeccion-1].acciones.length;i++){
                                        if(seccionesTotales[idSeccion-1].acciones[i].pos != posAccion){
                                            if(restoSumado == true){
                                                seccionesTotales[idSeccion-1].acciones[i].duracion = tiempoPorAccion + restoPrimero;
                                                document.getElementById('duracion?'+seccionesTotales[idSeccion-1].pos+'&'+seccionesTotales[idSeccion-1].acciones[i].pos).value = tiempoPorAccion + restoPrimero;
                                                restoSumado = false;
                                            }else{
                                                seccionesTotales[idSeccion-1].acciones[i].duracion = tiempoPorAccion;
                                                document.getElementById('duracion?'+seccionesTotales[idSeccion-1].pos+'&'+seccionesTotales[idSeccion-1].acciones[i].pos).value = tiempoPorAccion;
                                            }
                                        }
                                    }
                                }
                                else{
                                    var primeroSumado = true;
                                    for(i=0;i<seccionesTotales[idSeccion-1].acciones.length;i++){
                                        if(seccionesTotales[idSeccion-1].acciones[i].pos != posAccion){

                                            if(primeroSumado == true){
                                                seccionesTotales[idSeccion-1].acciones[i].duracion -= tiempoPrimeraAccion;
                                                document.getElementById('duracion?'+seccionesTotales[idSeccion-1].pos+'&'+seccionesTotales[idSeccion-1].acciones[i].pos).value -= tiempoPrimeraAccion;
                                                primeroSumado = false;
                                            }
                                            else{
                                                seccionesTotales[idSeccion-1].acciones[i].duracion -= cambioEnCadaAccion;
                                                document.getElementById('duracion?'+seccionesTotales[idSeccion-1].pos+'&'+seccionesTotales[idSeccion-1].acciones[i].pos).value -= cambioEnCadaAccion;
                                                primeroSumado = false;
                                            }

                                        }
                                    }
                                }

                            }

                            function dibujarAccion(idSeccion) {

                                var nuevaPosAccionSec = 1;
                                var iSecc = 0;
                                var i = idSeccion-1;

                                nuevaPosAccionSec = seccionesTotales[i].acciones.length + 1;

                                // nuevaPosAccionSec++;
                                var tiempoAccionIni;
                                var tiempoMin;
                                if(seccionesTotales[i].acciones.length == 0){
                                    tiempoAccionIni = 100;
                                    tiempoMin = 100;
                                }
                                else{
                                    tiempoAccionIni = 0;
                                    tiempoMin = 0;
                                    document.getElementById('duracion?'+idSeccion+'&1').min = 0;
                                }

                                var nuevaAccion = {pos:nuevaPosAccionSec, nombre:null, repeticiones:null, duracion:tiempoAccionIni, tipo:null, instrucciones:[]};
                                seccionesTotales[i].acciones.push(nuevaAccion);
                                var nuevaAccionHTML = document.createElement('div');
                                nuevaAccionHTML.id = "divAccion?"+idSeccion+"&"+nuevaPosAccionSec;


                                nuevaAccionHTML.innerHTML='\
                <div style="margin-left: 60px;">\
                <label for="title" class="control-label">{{ trans("adminlte_lang::message.addaccion") }} '+nuevaPosAccionSec+' </label><br>\
                <div class="row">\
                    <div class="col-lg-6">\
                        <input type="text" id="nombreAccion?'+idSeccion+'&'+nuevaPosAccionSec+'" class="form-control" id="title" placeholder="Nombre" name="name">\
                    </div>\
                    <div class="col-lg-6">\
                    </div>\
                </div>\
                <div class="row">\
                 <div class="col-lg-5">\
                    <label for="title" class="control-label">Número de repeticiones</label><br>\
                 </div>\
                 <div class="col-lg-7">\
                    <input type="number" id="repeticiones?'+idSeccion+'&'+nuevaPosAccionSec+'" name="repeticiones" value="1" max="100" min="1" step="1" required>\
                 </div>\
                </div>\
                <div class="row">\
                 <div class="col-lg-5">\
                    <label for="title" class="control-label">Duración Acción (%Sección)</label><br>\
                 </div>\
                 <div class="col-lg-7">\
                    <input type="range" id="duracion?'+idSeccion+'&'+nuevaPosAccionSec+'" onchange="cambioTiempo('+idSeccion+','+nuevaPosAccionSec+')" value="'+tiempoAccionIni+'" max="100" min="'+tiempoMin+'" step="1" required>\
                 </div>\
                </div>\
                <div class="row">\
                 <select id="tipoAccion?'+idSeccion+'&'+nuevaPosAccionSec+'" onchange="selecciontipoAccion('+idSeccion+','+nuevaPosAccionSec+')" required>\
                    <option disabled selected value="">Selecciona una opcion para introducir el contenido de la acción</option>\
                    <option value="'+opcionAccion1+'">'+opcionAccion1+'</option>\
                    <option value="'+opcionAccion2+'">'+opcionAccion2+'</option>\
                </select>\
              </div>  \
                <p id="contenidoaccion?'+idSeccion+'&'+nuevaPosAccionSec+'"></p> \
              <hr>\
                        '

                                var nuevoTiempo = {idSeccion:idSeccion, posAccion:nuevaPosAccionSec, tiempo:tiempoAccionIni};
                                tiemposAcciones.push(nuevoTiempo);
                                var idAccion = "acciones"+idSeccion;
                                var acciones = document.getElementById(idAccion);
                                acciones.parentNode.insertBefore(nuevaAccionHTML, acciones);

                              //  console.log(seccionesTotales);
                            }

                            function borrarAccion(idSeccion) {

                                var i = idSeccion-1;
                                var utlimoElemento = seccionesTotales[i].acciones.length - 1;

                                //Se reajustan los porcetajes de tiempo de las acciones de la sección restantes
                                var difTiempo = 0 - (document.getElementById('duracion?'+idSeccion+'&'+(utlimoElemento+1)).value);
                                var cambioEnCadaAccion = difTiempo /(seccionesTotales[idSeccion-1].acciones.length-1);
                                if(cambioEnCadaAccion>0){
                                    cambioEnCadaAccion = Math.floor(cambioEnCadaAccion);
                                }else{
                                    cambioEnCadaAccion = Math.ceil(cambioEnCadaAccion);
                                }
                                var restoTiempo =  difTiempo%(seccionesTotales[idSeccion-1].acciones.length-1);
                                var tiempoPrimeraAccion = cambioEnCadaAccion + restoTiempo;
                                var primeroSumado = true;
                                for(j=0;j<seccionesTotales[idSeccion-1].acciones.length;j++){
                                    if(seccionesTotales[idSeccion-1].acciones[j].pos != (utlimoElemento+1)){
                                        if(primeroSumado == true){
                                            seccionesTotales[idSeccion-1].acciones[j].duracion -= tiempoPrimeraAccion;
                                            document.getElementById('duracion?'+seccionesTotales[idSeccion-1].pos+'&'+seccionesTotales[idSeccion-1].acciones[j].pos).value -= tiempoPrimeraAccion;
                                            primeroSumado = false;
                                        }
                                        else{
                                            seccionesTotales[idSeccion-1].acciones[j].duracion -= cambioEnCadaAccion;
                                            document.getElementById('duracion?'+seccionesTotales[idSeccion-1].pos+'&'+seccionesTotales[idSeccion-1].acciones[j].pos).value -= cambioEnCadaAccion;
                                            primeroSumado = false;
                                        }

                                    }
                                }

                                //Se borra los elementos del array total para las acciones
                                if(utlimoElemento>0)
                                {

                                    ultimaInstruccion = document.getElementById("divAccion?"+idSeccion+"&"+seccionesTotales[i].acciones[utlimoElemento].pos);
                                    var padre = ultimaInstruccion.parentNode;
                                    padre.removeChild(ultimaInstruccion);
                                    seccionesTotales[i].acciones.splice(utlimoElemento,1);
                                }



                            //    console.log(seccionesTotales);


                            }



                            function selecciontipoAccion(idSeccion, posAccion){
                                var id = "contenidoaccion?"+idSeccion+"&"+posAccion;
                                var idtipoAccion = "tipoAccion?"+idSeccion+"&"+posAccion;
                                if(document.getElementById(idtipoAccion).value == opcionAccion1){
                                    document.getElementById(id).innerHTML = '<div class="form-group">\
                                            <label>Introduce un vídeo explicativo de la acción a realizar por el usuario:</label>\
                                            <input type="file" required>\
                                        </div>';

                                }
                                else if(document.getElementById(idtipoAccion).value == opcionAccion2){
                                    document.getElementById(id).innerHTML = '<div class="form-group">\
                                            <label>Introduce una imagen que represente el acción a realizar por el usuario:</label>\
                                            <input type="file">\
                                        </div>\
                                    <label>Ahora introduce instrucciones con texto para acompañar a la imagen:</label>\
                                    <p id="contenidoinstruccion?'+idSeccion+'&'+posAccion+'"></p> <hr>\
                                      <input type="button"  onclick="addInstruccion('+idSeccion+','+posAccion+');" name="boton" value="Añadir Instrucción" title="Las instrucciones constan de texto que se repartirá proporcionalmente en el tiempo de la acción" class="btn btn-primary btn-success">\
                                      <input type="button"  onclick="delInstruccion('+idSeccion+','+posAccion+');" name="boton" value="Eliminar Instrucción" title="Las instrucciones constan de texto que se repartirá proporcionalmente en el tiempo de la acción" class="btn btn-primary btn-danger">\
                                      ' ;
                                    addInstruccion(idSeccion, posAccion);

                                }

                                // document.getElementById(id).innerHTML = document.getElementById(idtipoAccion).value;


                            }


                            var instruccionesTotales = [];
                            var personas = [];

                            function addInstruccion(idSeccion, posAccion){
                                var nuevaPosInstruccion = 0;
                                var iActual = 0;

                                var i = idSeccion-1;
                                var j = posAccion-1;

                                nuevaPosInstruccion = seccionesTotales[i].acciones[j].instrucciones.length + 1;
                                seccionesTotales[i].acciones[j].instrucciones.push({pos:nuevaPosInstruccion, contenido:null});
                                var nuevaInstruccionHTML = document.createElement('div');
                                nuevaInstruccionHTML.id = "divInstruccion?"+idSeccion+"&"+posAccion+"&"+nuevaPosInstruccion;
                              // console.log(seccionesTotales);
                                nuevaInstruccionHTML.innerHTML= 'Instrucción: '+nuevaPosInstruccion+'<textarea required style="width: 300px; height: 100px;" id="textoInstruccion?'+idSeccion+'&'+posAccion+'&'+nuevaPosInstruccion+'" >\
                </textarea>';



                                var id = "contenidoinstruccion?"+idSeccion+"&"+posAccion;
                                var instrucciones = document.getElementById(id);

                                instrucciones.parentNode.insertBefore(nuevaInstruccionHTML, instrucciones);

                                var area2 = new nicEditor({buttonList : ['bold','italic','underline','strikeThrough']}).panelInstance('textoInstruccion?'+idSeccion+'&'+posAccion+'&'+nuevaPosInstruccion);

                            }


                            function delInstruccion(idSeccion, posAccion){


                                var ultimaPosInstruccion = 0;
                                var iUltimoElemento= 0;
                                var jUltimoElemento= 0;

                                var i = idSeccion-1;
                                var j = posAccion-1;

                                ultimaPosInstruccion = seccionesTotales[i].acciones[j].instrucciones.length - 1;

                                if(ultimaPosInstruccion>0){
                                    ultimaInstruccion = document.getElementById("divInstruccion?"+idSeccion+"&"+posAccion+"&"+seccionesTotales[i].acciones[j].instrucciones[ultimaPosInstruccion].pos);

                                    var padre = ultimaInstruccion.parentNode;
                                    padre.removeChild(ultimaInstruccion);
                                    seccionesTotales[i].acciones[j].instrucciones.splice(ultimaPosInstruccion,1);
                                }


                            }

                        </script>

                        <input type="hidden" id="arrayFinal" name="arrayFinal">
                        <div id="seccion"></div>


                        <!--Script para configurar el textEdit-->
                        <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
                            bkLib.onDomLoaded(function() {
                                new nicEditor({buttonList : ['bold','italic','underline']}).panelInstance('area4');
                            });
                        </script>
                        <!-- <script type="text/javascript">dibujarSecciones();</script>-->

                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button class="btn btn-default">Cancelar</button>
                                <button type="submit" name="botonEnvio" class="btn btn-primary">Enviar</button>
                                <button type="submit" onclick="return enviarEjericio();" name="botonEnvio" class="btn btn-primary">Enviar2</button>
                                <input type="button" onclick="enviarEjericio()" class="btn btn-primary" value="Enviar3">
                                <button type="button" class="btn btn-primary" onclick="submitForm()" id="submit">Submit</button>

                            </div>
                        </div>

                   <!--Iniciar los datos con el ejercicio a modificar-->
                        <script>
                        if(numSecciones!=(document.getElementById("numeroSecciones").value))
                        {
                            //console.log(numSecciones);
                            var secciones ="";
                            seccionesTotales.length = 0;
                            ejercicio= {!! json_encode($ejercicio) !!};
                            console.log(ejercicio);

                            for(i=1;i<=ejercicio.secciones.length;i++) {
                                var horas = pad(Math.floor(ejercicio.secciones[i-1].duracion/3600), 2);
                                var minutos = pad(Math.floor((ejercicio.secciones[i-1].duracion%3600)/60), 2);
                                var segundos = pad(Math.floor((ejercicio.secciones[i-1].duracion%3600)%60), 2);
                                secciones += '<label for="title" class="control-label">{{ trans("adminlte_lang::message.addsection") }} ' + i + ' </label><br> \
                                <div style="margin-left: 30px;"> \
                                    <div class="row"> \
                                        <div class="col-lg-6"> \
                                            <input type="text" class="form-control" id="nombreSeccion?' + i + '" placeholder="Nombre" name="nameSeccion' + i + '" value="'+ejercicio.secciones[i-1].nombre+'" required>\
                                        </div>\
                                        <div class="col-lg-6">\
                                        </div>\
                                    </div>\
                                    <div class="row">\
                                        <div class="col-lg-4">\
                                            <label for="title" class="control-label">Duración Sección: </label><br>\
                                        </div>\
                                        <div class="col-lg-8">\
                                            <input type="time" id="duracionSeccion?' + i + '" value="'+horas+':'+minutos+':'+segundos+'" max="99:99:99" min="00:00:00" step="1" required>(Horas:Minutos:Segundos)\
                                        </div>\
                                    </div>\
                                    <hr> <p id="acciones' + i + '"></p> \
                                    <div class="row">\
                                        <div class="col-lg-12">\
                                            <input type="button" onclick="dibujarAccion(' + i + ')" value="Añadir acción" class="btn btn-primary btn-success" >\
                                            <input type="button" onclick="borrarAccion(' + i + ')" value="Eliminar acción" class="btn btn-primary btn-danger">\
                                        </div>\
                                    </div>  \
                                </div><hr> \
                                ';
                                seccionesTotales.push({pos: i, nombre: "", duracion: null, acciones: []});

                            }
                            //console.log(secciones);
                            document.getElementById("seccion").innerHTML =secciones;

                            //-------Se representan los datos de la acciones del ejercicio ya creado a modificar-------------
                            for(j=1;j<=ejercicio.secciones.length;j++)
                            {
                                for(a=0;a<ejercicio.secciones[j-1].acciones.length; a++)
                                {

                                    var nuevaPosAccionSec = 1;
                                    var iSecc = 0;
                                    var i = j - 1;

                                    nuevaPosAccionSec = seccionesTotales[i].acciones.length + 1;

                                    // nuevaPosAccionSec++;
                                    var tiempoAccionIni;
                                    var tiempoMin;
                                    if (ejercicio.secciones[j-1].acciones.length == 1) {
                                        tiempoAccionIni = 100;
                                        tiempoMin = 100;
                                    }


                                    var nuevaAccion = {
                                        pos: nuevaPosAccionSec,
                                        nombre: ejercicio.secciones[j-1].acciones[a].nombre,
                                        repeticiones: ejercicio.secciones[j-1].acciones[a].num_repeticiones,
                                        duracion: ejercicio.secciones[j-1].acciones[a].duracion,
                                        tipo: ejercicio.secciones[j-1].acciones[a].tipo,
                                        instrucciones: []
                                    };
                                    tiempoAccionIni = ejercicio.secciones[j-1].acciones[a].duracion;
                                    seccionesTotales[i].acciones.push(nuevaAccion);
                                    var nuevaAccionHTML = document.createElement('div');
                                    nuevaAccionHTML.id = "divAccion?" + j + "&" + nuevaPosAccionSec;

                                    var contenido = '\
                                    <div style="margin-left: 60px;">\
                                    <label for="title" class="control-label">{{ trans("adminlte_lang::message.addaccion") }} ' + nuevaPosAccionSec + ' </label><br>\
                                    <div class="row">\
                                        <div class="col-lg-6">\
                                            <input type="text" id="nombreAccion?' + j + '&' + nuevaPosAccionSec + '" value="'+nuevaAccion.nombre+'" class="form-control" id="title" placeholder="Nombre" name="name">\
                                        </div>\
                                        <div class="col-lg-6">\
                                        </div>\
                                    </div>\
                                    <div class="row">\
                                     <div class="col-lg-5">\
                                        <label for="title" class="control-label">Número de repeticiones</label><br>\
                                     </div>\
                                     <div class="col-lg-7">\
                                        <input type="number" id="repeticiones?' + j + '&' + nuevaPosAccionSec + '" value="'+nuevaAccion.repeticiones+'" name="repeticiones" value="1" max="100" min="1" step="1" required>\
                                     </div>\
                                    </div>\
                                    <div class="row">\
                                     <div class="col-lg-5">\
                                        <label for="title" class="control-label">Duración Acción (%Sección)</label><br>\
                                     </div>\
                                     <div class="col-lg-7">\
                                        <input type="range" id="duracion?' + j + '&' + nuevaPosAccionSec + '" onchange="cambioTiempo(' + j + ',' + nuevaPosAccionSec + ')" value="' + tiempoAccionIni + '" max="100" min="' + tiempoMin + '" step="1" required>\
                                     </div>\
                                    </div>\
                                    <div class="row">\
                                     <select id="tipoAccion?' + j + '&' + nuevaPosAccionSec + '" onchange="selecciontipoAccion(' + j + ',' + nuevaPosAccionSec + ')" required>\
                                        <option disabled  value="">Selecciona una opcion para introducir el contenido de la acción</option>\
                                 ';

                                    if(ejercicio.secciones[j-1].acciones[a].tipo==opcionAccion1){
                                        contenido+=' <option selected value="' + opcionAccion1 + '">' + opcionAccion1 + '</option>\
                                        <option value="' + opcionAccion2 + '">' + opcionAccion2 + '</option>\
                                            </select>\
                                          </div>  \
                                            <p id="contenidoaccion?' + j + '&' + nuevaPosAccionSec + '"></p> \
                                          <hr>\
                                        '
                                    }
                                    else{
                                        contenido+=' <option value="' + opcionAccion1 + '">' + opcionAccion1 + '</option>\
                                        <option selected value="' + opcionAccion2 + '">' + opcionAccion2 + '</optionselected>\
                                            </select>\
                                          </div>  \
                                            <p id="contenidoaccion?' + j + '&' + nuevaPosAccionSec + '"></p> \
                                          <hr>\
                                        '
                                    }

                                    nuevaAccionHTML.innerHTML = contenido;

                                    var nuevoTiempo = {idSeccion: j, posAccion: nuevaPosAccionSec, tiempo: tiempoAccionIni};
                                    tiemposAcciones.push(nuevoTiempo);
                                    var idAccion = "acciones" + j;
                                    var acciones = document.getElementById(idAccion);
                                    acciones.parentNode.insertBefore(nuevaAccionHTML, acciones);


                                    //-------Se representan los datos de las instrucciones del ejercicio ya creado a modificar-------------
                                    var id = "contenidoaccion?"+j+"&"+nuevaPosAccionSec;
                                    var idtipoAccion = "tipoAccion?"+j+"&"+nuevaPosAccionSec;
                                    if(document.getElementById(idtipoAccion).value == opcionAccion1){
                                        document.getElementById(id).innerHTML = '<div class="form-group">\
                                            <label>Introduce un vídeo explicativo de la acción a realizar por el usuario:</label>\
                                            <input type="file" required>\
                                        </div>';

                                    }
                                    else if(document.getElementById(idtipoAccion).value == opcionAccion2) {
                                        document.getElementById(id).innerHTML = '<div class="form-group">\
                                            <label>Introduce una imagen que represente el acción a realizar por el usuario:</label>\
                                            <input type="file">\
                                        </div>\
                                    <label>Ahora introduce instrucciones con texto para acompañar a la imagen:</label>\
                                    <p id="contenidoinstruccion?' + j + '&' + nuevaPosAccionSec + '"></p> <hr>\
                                      <input type="button"  onclick="addInstruccion(' + j + ',' + nuevaPosAccionSec + ');" name="boton" value="Añadir Instrucción" title="Las instrucciones constan de texto que se repartirá proporcionalmente en el tiempo de la acción" class="btn btn-primary btn-success">\
                                      <input type="button"  onclick="delInstruccion(' + j + ',' + nuevaPosAccionSec + ');" name="boton" value="Eliminar Instrucción" title="Las instrucciones constan de texto que se repartirá proporcionalmente en el tiempo de la acción" class="btn btn-primary btn-danger">\
                                      ';


                                        for (z = 0; z <ejercicio.secciones[j - 1].acciones[a].instrucciones.length; z++) {


                                            var nuevaPosInstruccion = 0;
                                            var iActual = 0;

                                            var x = j - 1;
                                            var y = nuevaPosAccionSec - 1;

                                            nuevaPosInstruccion = seccionesTotales[x].acciones[y].instrucciones.length + 1;
                                            seccionesTotales[x].acciones[y].instrucciones.push({
                                                pos: nuevaPosInstruccion,
                                                contenido: null
                                            });
                                            var nuevaInstruccionHTML = document.createElement('div');
                                            nuevaInstruccionHTML.id = "divInstruccion?" + j + "&" + nuevaPosAccionSec + "&" + nuevaPosInstruccion;
                                            // console.log(seccionesTotales);


                                            nuevaInstruccionHTML.innerHTML = 'Instrucción: ' + nuevaPosInstruccion + '<textarea required style="width: 300px; height: 100px;" id="textoInstruccion" >\
                                            </textarea>';

                                            var id = "contenidoinstruccion?" + j + "&" + nuevaPosAccionSec;
                                            var instrucciones = document.getElementById(id);

                                            instrucciones.parentNode.insertBefore(nuevaInstruccionHTML, instrucciones);

                                            var area4 = new nicEditor({buttonList: ['bold', 'italic', 'underline', 'strikeThrough']}).panelInstance('textoInstruccion');

                                          //  nicEditors.findEditor('textoInstruccion?' + j + '&' + nuevaPosAccionSec + '&' + nuevaPosInstruccion).setContent(ejercicio.secciones[j - 1].acciones[a].instrucciones[z].contenido);
                                        }

                                    }



                                    //  console.log(seccionesTotales);
                                }
                            }


                        }


                        function pad (n, length) {
                            var  n = n.toString();
                            while(n.length < length)
                                n = "0" + n;
                            return n;
                        }
                        </script>
                <!-- Final de la inciacion-->










                    </div>
        </div>
        </fieldset>
        </form>

        <body>

@endsection


