@extends('adminlte::layouts.app')

@section('PageName', 'ModifyLesson')

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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript">
    var opcionAccion1 = "Mediante vídeo";
    var opcionAccion2 = "Mediante imagen + texto";

</script>


<script type="text/javascript" language="javascript">


</script>


<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    * {
        box-sizing: border-box;
    }

    body {
        background-color: #f1f1f1;
        z-index: 1;
    }

    #regForm {
        background-color: #ffffff;
        margin: 100px auto;
        font-family: Raleway;
        padding: 40px;
        width: 70%;
        min-width: 300px;
    }

    h1 {
        text-align: center;
    }

    input {
        padding: 10px;
        width: 100%;
        font-size: 17px;
        font-family: Raleway;
        border: 1px solid #aaaaaa;
    }

    /* Mark input boxes that gets an error on validation: */
    input.invalid {
        background-color: #ffdddd;
    }

    /* Hide all steps by default: */
    .tab {
        display: none;
        text-decoration: none;
    }

    button {
        background-color: #4CAF50;
        color: #ffffff;
        border: none;
        padding: 10px 20px;
        font-size: 17px;
        font-family: Raleway;
        cursor: pointer;
    }

    button:hover {
        opacity: 0.8;
    }

    #prevBtn {
        background-color: #bbbbbb;
    }

    /* Make circles that indicate the steps of the form: */
    .step {
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbbbbb;
        border: none;
        border-radius: 50%;
        display: inline-block;
        opacity: 0.5;
    }

    .step.active {
        opacity: 1;
    }

    /* Mark the steps that are finished and valid: */
    .step.finish {
        background-color: #4CAF50;
    }
    textarea {
        resize: none;
    }


    .container {
        float: left;
        width: 100px;
        height: 100px;
        background: #000;
        margin: 0 2px 2px 0;
        position: relative;
        z-index: 1;
    }
    .help{
        color: black;

    }
    .miniatura{
        border-style:solid;
        border-color:blue;
        border-width: 1px;
    }
    .miniatura:hover{
        border-style:solid;
        border-color:blue;
        border-width: 2.5px;
    }
    .fa-times:hover {
        color: red;
    }
</style>
<body>
@section('main-content')
    <legend>Modificar una clase ya existente</legend>


    <form id="regForm"  method="post" class="form-horizontal" enctype="multipart/form-data">


        <div class="tab" id="numSecciones"> <a href="#" class="help" data-toggle="tooltip" title="Añadir la información principal de la clase que incluye la minuiatura que verán los usuarios en la lista de ejercicios, el nombre y una pequeña introducción a modo de resumen de la misma." data-placement="right">Información general:</a>
            <p><label for="title" class="control-label"><li>Miniatura:</li></label></p>
            <p><div class="image-upload">
                <label for="miniatura">
                    <img class="miniatura" id="output" title="Introduce la miniatura representativa de la clase"  height="100px" src="{!!URL::to('/')!!}{!! $ejercicio->miniatura !!}"/>
                </label>
                <input type="file" name="miniatura" id="miniatura"  style ="display:none;" onchange="loadFile(event)"/>
            </div></p>
            <p><input type="text" maxlength="22" placeholder="Nombre..." class="form-control" placeholder="Nombre" name="nombreEjercicio" id="nombreEjercicio" value="{!! $ejercicio->nombre !!}" required="required"></p>
            <p><textarea class="form-control" placeholder="Introducción..." rows="3" id="introduccionEjercicio" name="introduccionEjercicio">{!! $ejercicio->introduccion !!}</textarea></p>
        </div>
        <div class="tab"> <a href="#" class="help" data-toggle="tooltip" title="Añade categorías que sirven como etiquetas de la clase para que el usuario pueda filtrar ejercicios por ellas" data-placement="right">Añade y crea categorías:</a>

            <div class="row">
                <p><div class="col-lg-4">
                <p><input list="browsers" class="notrequired" name="nombreCategoria" id="nombreCategoria" oninput="this.className = 'notrequired'"/></p>
                <datalist id="browsers" >
                    @foreach($categoriaejercicios as $category)
                        <option value="{{$category->nombre}}">
                    @endforeach
                </datalist>
            </div>
            <div class="col-lg-2">
                <input type="button"  onclick="addCategory();" name="boton" value="Añadir" class="btn btn-primary btn-success">
            </div>
            <div class="col-lg-6">
                <p id="categorias"></p>
            </div>
        </div>
        </div>
        <div class="tab" ><a href="#" class="help" data-toggle="tooltip" title="Selecciona el número de secciones que se desea que tenga el ejercicio" data-placement="right">Número secciones:</a>
            <p><input class="form-control " onchange="dibujarSecciones();" type="number" name="numeroSecciones" id="numeroSecciones" value="{!! count($ejercicio['secciones']) !!}" min="1" max="50" required></p>

        </div>
        <p id="seccion"></p>


        <div class="tab">Número de opciones respuesta final (de peor a mejor):
            <!--Se solicita el número de opciones de la respuesta final-->

            <p> <input class="form-control" onchange="dibujarPreguntas();" type="number" name="numeroOpciones" id="numeroOpciones" value="{!! count($ejercicio['opcionespreguntafinal']) !!}" min="1" max="6" required>
            </p>

            <p id="preguntafinal"></p>
        </div>
        <input type="hidden" id="arrayFinal" name="arrayFinal">
        <input type="hidden" id="arrayPregunta" name="arrayPregunta">
        <input type="hidden" id="arrayCatergorias" name="arrayCatergorias">
        <div style="overflow:auto;">
            <div style="float:right;">
                <button type="button" id="prevBtn" onclick="nextPrev(-1)">Anterior</button>
                <button type="button" id="nextBtn" onclick="nextPrev(1)">Siguiente</button>
            </div>
        </div>
        <!-- Circles which indicates the steps of the form: -->
        <div style="text-align:center;margin-top:40px;">
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <p id="aditionalSteps"></p>
        </div>
    </form>

    <script>
         ejercicio= {!! json_encode($ejercicio) !!};


var opcionAccion1 = "Mediante vídeo";
        var opcionAccion2 = "Mediante imagen + texto";

        var seccionesTotales = [];
        var preguntasFinal = [];

        function submitForm()
        {
            var duracionEjercicio = 0;
            for(i=0;i<seccionesTotales.length;i++){
                if(i<ejercicio.secciones.length) {  //Se inician los IDs de las secciones, acciones e instrucciones

                    seccionesTotales[i].id=ejercicio.secciones[i].Id;
                }
                var idNombre = "nombreSeccion?"+(i+1);
                seccionesTotales[i].nombre = document.getElementById(idNombre).value;
                var arrayduracion = (document.getElementById('duracionSeccion?'+(i+1)).value).split(":");
                seccionesTotales[i].duracion = (arrayduracion[0]*3600)+(arrayduracion[1]*60)+(arrayduracion[2]*1);
                duracionEjercicio += seccionesTotales[i].duracion;
                for(j=0;j<seccionesTotales[i].acciones.length;j++){
                    if(j<ejercicio.secciones[i].acciones.length){
                        seccionesTotales[i].acciones[j].id=ejercicio.secciones[i].acciones[j].Id;
                    }
                    seccionesTotales[i].acciones[j].nombre=document.getElementById('nombreAccion?'+(i+1)+'&'+(j+1)).value;
                    seccionesTotales[i].acciones[j].repeticiones=document.getElementById('repeticiones?'+(i+1)+'&'+(j+1)).value;
                    seccionesTotales[i].acciones[j].duracion=document.getElementById('duracion?'+(i+1)+'&'+(j+1)).value;
                    seccionesTotales[i].acciones[j].tipo = document.getElementById('tipoAccion?'+(i+1)+'&'+(j+1)).value;
                    if(document.getElementById('file?'+(i+1)+'&'+(j+1)).value)seccionesTotales[i].acciones[j].fichero = document.getElementById('file?'+(i+1)+'&'+(j+1)).value;
                    if(seccionesTotales[i].acciones[j].tipo ==opcionAccion2 ){
                        for(n=0; n<seccionesTotales[i].acciones[j].instrucciones.length; n++){
                            if(n<ejercicio.secciones[i].acciones[j].instrucciones.length){
                                seccionesTotales[i].acciones[j].instrucciones[n].id=ejercicio.secciones[i].acciones[j].instrucciones[n].Id;
                            }
                            console.log("textoInstruccion?" +(i+1)+'&'+(j+1)+'&'+(n+1));

                            seccionesTotales[i].acciones[j].instrucciones[n].contenido=nicEditors.findEditor('textoInstruccion?'
                                +(i+1)+'&'+(j+1)+'&'+(n+1)).getContent();

                        }
                    }
                }
            }
            for(i=0;i<preguntasFinal.length;i++){
                preguntasFinal[i].contenido = document.getElementById("preguntafinal?"+(i+1)).value;
            }
            var ejercicioFinal = [];
            ejercicioFinal.push({id:{!! $ejercicio->Id !!},nombre:document.getElementById('nombreEjercicio').value,introduccion:document.getElementById('introduccionEjercicio').value,
                duracion:duracionEjercicio,miniatura:document.getElementById('miniatura').value, secciones:seccionesTotales});
            document.getElementById('arrayFinal').value = JSON.stringify(ejercicioFinal);
            document.getElementById('arrayPregunta').value = JSON.stringify(preguntasFinal);
            document.getElementById('arrayCatergorias').value = JSON.stringify(categorias);
            document.getElementById('regForm').submit(

            );
        }
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
        };

        var categorias =[];

    //Se inician las categorías
    </script>
    @foreach($ejercicio->categorias as $categoria)
        <script>
            categorias.push("{{ $categoria->nombre }}");

        </script>
    @endforeach
    <script>

       function iniciarCategorias() {
           var categoriasHTML = "";
           for(var i=0;i<categorias.length;i++){
               categoriasHTML+=categorias[i]+'<div onclick="delCategory('+i+')" style="display:inline;">\
            <span class="fa-stack fa-lg">\
            <i class="fa fa-circle fa-stack-2x"></i>\
            <i class="fa fa-times fa-stack-1x fa-inverse"></i>\
            </span>\
            </div>&nbsp;';
           }
           document.getElementById("categorias").innerHTML =  categoriasHTML;
       }
       function delCategory(index) {
           categorias.splice(index, 1);
           categoriasHTML ="";
           for(var i=0;i<categorias.length;i++){
               categoriasHTML+=categorias[i]+'<div onclick="delCategory('+i+')" style="display:inline;">\
                <span class="fa-stack fa-lg">\
                <i class="fa fa-circle fa-stack-2x"></i>\
                <i class="fa fa-times fa-stack-1x fa-inverse"></i>\
                </span>\
                </div>&nbsp;';
           }
           document.getElementById("categorias").innerHTML = categoriasHTML;

       }
       function addCategory() {
            var nuevaCategoria = document.getElementById("nombreCategoria").value;
            if(categorias.indexOf(nuevaCategoria) == -1){
                categorias.push(document.getElementById("nombreCategoria").value);
               // document.getElementById("categorias").innerHTML = categorias;
                document.getElementById("nombreCategoria").value = "";
            }
            categoriasHTML = "";
            console.log(categorias);
            for(var i=0;i<categorias.length;i++){
                categoriasHTML+=categorias[i]+'<div onclick="delCategory('+i+')" style="display:inline;">\
                <span class="fa-stack fa-lg">\
                <i class="fa fa-circle fa-stack-2x"></i>\
                <i class="fa fa-times fa-stack-1x fa-inverse"></i>\
                </span>\
                </div>&nbsp;';
            }
            console.log(categoriasHTML);
            document.getElementById("categorias").innerHTML = categoriasHTML;

        }

        var numSecciones = 0;

        function dibujarSecciones() {
            if(numSecciones!=(document.getElementById("numeroSecciones").value))
            {
                numSecciones = document.getElementById("numeroSecciones").value;
                var secciones ="";
                var steps = "";
                seccionesTotales.length = 0;
                for(i=1;i<=numSecciones;i++)
                {
                    secciones += '<div class="tab">\
                   <label for="title" class="control-label"><h3>{{ trans("adminlte_lang::message.addsection") }} '+i+' </h3></label><br> \
                   \
                        <div class="row"> \
                            <div class="col-lg-6"> \
                                <input type="text" class="form-control" id="nombreSeccion?'+i+'" placeholder="Nombre" name="nameSeccion'+i+'" required>\
                            </div>\
                            <div class="col-lg-6">\
                            </div>\
                        </div><br>\
                        \
                           <label for="title" class="control-label"><li>Duración Sección:</li></label><br>\
                            <input type="time" id="duracionSeccion?'+i+'" value="" style="width: 110px;" max="99:99:99" min="00:00:00" step="1" required>      (Horas:Minutos:Segundos)\
                        <hr> <p id="acciones'+i+'"></p> \
                        <div class="row">\
                         <div class="col-lg-4">\
                              <input type="button" onclick="dibujarAccion('+i+')" value="Añadir acción" class="btn btn-primary btn-success" >\
                             </div><div class="col-lg-4">\
                             <input type="button" onclick="borrarAccion('+i+')" value="Eliminar acción" class="btn btn-primary btn-danger">\
                            </div><div class="col-lg-4"></div>\
                      </div><hr> \</div>';
                    steps += '<span class="step"></span>';
                    seccionesTotales.push({pos:i,nombre:"",duracion:null, acciones:[]});

                }
                document.getElementById("seccion").innerHTML = secciones;
                document.getElementById("aditionalSteps").innerHTML = steps;

                for(i=1;i<=numSecciones;i++)
                {
                    //Se dibuja una primera acción para que sea obligatorio añadir al menos una
                    dibujarAccion(i);
                }
            }
        }
        var tiemposAcciones = [];

        function cambioTiempo(idSeccion, posAccion){

            var tiempoDespuesCambio = document.getElementById('duracion?'+idSeccion+'&'+posAccion).value;

            var difTiempo;
            var tiempoAnterior = seccionesTotales[idSeccion-1].acciones[posAccion-1].duracion;
            difTiempo = tiempoDespuesCambio - tiempoAnterior;
            console.log(difTiempo);
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

            var i = idSeccion-1;

            var nuevaPosAccionSec = seccionesTotales[i].acciones.length + 1;

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

            var nuevaAccion = {pos:nuevaPosAccionSec, nombre:null, repeticiones:null, duracion:tiempoAccionIni, tipo:null, fichero:null, instrucciones:[]};
            seccionesTotales[i].acciones.push(nuevaAccion);
            var nuevaAccionHTML = document.createElement('div');
            nuevaAccionHTML.id = "divAccion?"+idSeccion+"&"+nuevaPosAccionSec;


            nuevaAccionHTML.innerHTML='\
                <div style="margin-left: 60px;">\
                <label for="title" class="control-label"><h3>{{ trans("adminlte_lang::message.addaccion") }} '+nuevaPosAccionSec+' </h3></label><br>\
                <div class="row">\
                    <div class="col-lg-6">\
                        <input type="text" id="nombreAccion?'+idSeccion+'&'+nuevaPosAccionSec+'" class="form-control" id="title" placeholder="Nombre" name="name">\
                    </div>\
                    <div class="col-lg-6">\
                    </div>\
                </div><br>\
                <label for="title" class="control-label"><li>Número de repeticiones:</li></label><br>\
                    <p><input type="number" id="repeticiones?'+idSeccion+'&'+nuevaPosAccionSec+'" name="repeticiones" style="width: 70px;" value="1" max="100" min="1" step="1" required></p>\
                <br><div class="row">\
                 <div class="col-lg-5">\
                    <label for="title" class="control-label"><li>Duración Acción (%Sección)</li></label><br>\
                 </div>\
                 <div class="col-lg-7">\
                    <input type="range" id="duracion?'+idSeccion+'&'+nuevaPosAccionSec+'" onchange="cambioTiempo('+idSeccion+','+nuevaPosAccionSec+')" value="'+tiempoAccionIni+'" max="100" min="'+tiempoMin+'" step="1" required>\
                 </div>\
                </div>\
                <div class="row">\
                <div class=col-lg-12>\
               <label for="title" class="control-label"><li>Tipo de ejercicio:</li></label><br>\
               </div>\
               </div>\
               <div class="row">\
               <div class="col-lg-4"><label for="title" style="text-align: center;" class="control-label">Vídeo:</label><br><p><input class="notrequired" id="imageId'+idSeccion+'?'+nuevaPosAccionSec+'_0" type="image" src="{!!URL::to('/')!!}/images/logo_video.png" onclick="selecciontipoAccion('+idSeccion+','+nuevaPosAccionSec+',this)"></p></div>\
                <div class="col-lg-4"><label for="title" style="text-align: center;" class="control-label">Imagen + Texto:</label><br><p><input  class="notrequired" id="imageId'+idSeccion+'?'+nuevaPosAccionSec+'_1" type="image" src="{!!URL::to('/')!!}/images/logo_imagen_y_texto.png" onclick="selecciontipoAccion('+idSeccion+','+nuevaPosAccionSec+',this)"></p></div>\
                <div class="col-lg-4"></div>\
              </div>  \
                 <input type="hidden" id="tipoAccion?'+idSeccion+'&'+nuevaPosAccionSec+'">\
                <p id="contenidoaccion?'+idSeccion+'&'+nuevaPosAccionSec+'"></p> \
              <hr>\
                        '

            var nuevoTiempo = {idSeccion:idSeccion, posAccion:nuevaPosAccionSec, tiempo:tiempoAccionIni};
            tiemposAcciones.push(nuevoTiempo);
            var idAccion = "acciones"+idSeccion;
            var acciones = document.getElementById(idAccion);
            acciones.parentNode.insertBefore(nuevaAccionHTML, acciones);

            console.log(seccionesTotales);
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



            console.log(seccionesTotales);


        }



        function selecciontipoAccion(idSeccion, posAccion, el){

            var res = el.id.split("_");
            if(el.style.border!="3px solid blue") {
                el.style.border = "3px solid blue"
                if (res[1] == 0) document.getElementById(res[0] + "_1").style = "";
                else   document.getElementById(res[0] + "_0").style = "";


                var id = "contenidoaccion?" + idSeccion + "&" + posAccion;
                var idtipoAccion = "tipoAccion?" + idSeccion + "&" + posAccion;
                if (res[1] == 0) {
                    document.getElementById('tipoAccion?'+idSeccion+'&'+posAccion).value=opcionAccion1;
                    document.getElementById(id).innerHTML = '<div class="form-group">\
                                            <label>Introduce un vídeo explicativo de la acción a realizar por el usuario:</label>\
                                            <input type="file" class="file_multi_video_' + idSeccion + '_' + posAccion + '" id="file?' + idSeccion + '&' + posAccion + '" name="file?' + idSeccion + '&' + posAccion + '" required>\
                                        <br><video height="200" controls>\
                                    <source src="" id="file_' + idSeccion + '_' + posAccion + '">\
                                    Your browser does not support HTML5 video.\
                    </video>\                                        </div>';

                    jQuery(document).on("change", ".file_multi_video_" + idSeccion + '_' + posAccion, function(evt) {
                        var $source = $("#file_" + idSeccion + '_' + posAccion);
                        $source[0].src = URL.createObjectURL(this.files[0]);
                        $source.parent()[0].load();
                    });

                }
                else if (res[1] == 1) {
                    document.getElementById('tipoAccion?'+idSeccion+'&'+posAccion).value=opcionAccion2;
                    document.getElementById(id).innerHTML = '<div class="form-group">\
                                            <label>Introduce una imagen que represente el acción a realizar por el usuario:</label>\
                                            <p><div class="image-upload">\
                                            <div class="row"><div class="col-lg-2"></div><div class="col-lg-6"><label for="file?' + idSeccion + '&' + posAccion + '">\
                                            <img class="miniatura" id="output_'+idSeccion+'_'+posAccion+'" title="Introduce una imagen que represente el acción a realizar por el usuario"  height="200px" src=""/>\
                                            </label>\
                                            <input type="file" id="file?' + idSeccion + '&' + posAccion + '" name="file?' + idSeccion + '&' + posAccion + '" style ="display:none;" onchange="loadFileInstruccion(event, '+idSeccion+','+posAccion+')"/>\
                                            </div></div><div class="col-lg-4"></div></div></p>\
                                        </div>\
                                    <label>Ahora introduce instrucciones con texto para acompañar a la imagen:</label>\
                                    <p id="contenidoinstruccion?' + idSeccion + '&' + posAccion + '"></p> <hr>\
                                      <div class="row">\
                                        <div class="col-lg-4"><input type="button"  onclick="addInstruccion(' + idSeccion + ',' + posAccion + ');" name="boton" value="Añadir Instrucción" title="Las instrucciones constan de texto que se repartirá proporcionalmente en el tiempo de la acción" class="btn btn-primary btn-success">\
                                        </div><div class="col-lg-4"><input type="button"  onclick="delInstruccion(' + idSeccion + ',' + posAccion + ');" name="boton" value="Eliminar Instrucción" title="Las instrucciones constan de texto que se repartirá proporcionalmente en el tiempo de la acción" class="btn btn-primary btn-danger">\
                                        </div><div class="col-lg-4"></div><div class="col-lg-4"></div></div>\
                                      ';
                    addInstruccion(idSeccion, posAccion);


                }
            }

        }

       var loadFileInstruccion = function(event, idS, idAc) {
           console.log('output_'+idS+'_'+idAc);
           var output = document.getElementById('output_'+idS+'_'+idAc);
           output.src = URL.createObjectURL(event.target.files[0]);
       };


        function addInstruccion(idSeccion, posAccion){

            var i = idSeccion-1;
            var j = posAccion-1;

            nuevaPosInstruccion = seccionesTotales[i].acciones[j].instrucciones.length + 1;
            seccionesTotales[i].acciones[j].instrucciones.push({pos:nuevaPosInstruccion, contenido:null});
            var nuevaInstruccionHTML = document.createElement('div');
            nuevaInstruccionHTML.id = "divInstruccion?"+idSeccion+"&"+posAccion+"&"+nuevaPosInstruccion;
            console.log(seccionesTotales);
            nuevaInstruccionHTML.innerHTML= 'Instrucción: '+nuevaPosInstruccion+'<textarea required style="width: 300px; height: 100px;" id="textoInstruccion?'+idSeccion+'&'+posAccion+'&'+nuevaPosInstruccion+'" >\
                </textarea>';



            var id = "contenidoinstruccion?"+idSeccion+"&"+posAccion;
            var instrucciones = document.getElementById(id);

            instrucciones.parentNode.insertBefore(nuevaInstruccionHTML, instrucciones);

            console.log("textoInstruccion?"+idSeccion+'&'+posAccion+'&'+nuevaPosInstruccion);
            var area2 = new nicEditor({buttonList : ['bold','italic','underline','strikeThrough']}).panelInstance('textoInstruccion?'+idSeccion+'&'+posAccion+'&'+nuevaPosInstruccion);

        }


        function delInstruccion(idSeccion, posAccion){



            var i = idSeccion-1;
            var j = posAccion-1;

            var ultimaPosInstruccion = seccionesTotales[i].acciones[j].instrucciones.length - 1;

            if(ultimaPosInstruccion>0){
                ultimaInstruccion = document.getElementById("divInstruccion?"+idSeccion+"&"+posAccion+"&"+seccionesTotales[i].acciones[j].instrucciones[ultimaPosInstruccion].pos);

                var padre = ultimaInstruccion.parentNode;
                padre.removeChild(ultimaInstruccion);
                seccionesTotales[i].acciones[j].instrucciones.splice(ultimaPosInstruccion,1);
            }


        }

        var numOpciones = 0;

        function dibujarPreguntas() {
            if (numOpciones != (document.getElementById("numeroOpciones").value)) {
                numOpciones = document.getElementById("numeroOpciones").value;
                var preguntas = "";
                preguntasFinal.length = 0;
                for (i = 1; i <= numOpciones; i++) {
                    preguntas += '<hr><label for="title" class="control-label">Opcion '+i+' </label><br> \
                    <div style="margin-left: 30px;"> \
                            <div class="row"> \
                                <div class="col-lg-6"> \
                                    <input type="text" class="form-control" id="preguntafinal?' + i + '" placeholder="Contenido respuesta" name="preguntafinal?' + i + '" required>\
                                </div>\
                                <div class="col-lg-6">\
                                </div>\
                            </div>\
                        </div> \
        ';
                    preguntasFinal.push({pos:i,contenido:""});
                }
                document.getElementById("preguntafinal").innerHTML = preguntas;

            }
        }

        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the crurrent tab

        function showTab(n) {
            // This function will display the specified tab of the form...
            var x = document.getElementsByClassName("tab");

            x[n].style.display = "block";
            //... and fix the Previous/Next buttons:
            if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
            } else {
                document.getElementById("prevBtn").style.display = "inline";
            }
            if (n == (x.length - 1)) {
                document.getElementById("nextBtn").innerHTML = "Finalizar";
            } else {
                document.getElementById("nextBtn").innerHTML = "Siguiente";
            }
            //... and run a function that will display the correct step indicator:
            fixStepIndicator(n)
        }

        function nextPrev(n) {
            // This function will figure out which tab to display
            var x = document.getElementsByClassName("tab");
            // Exit the function if any field in the current tab is invalid:
            // if you have reached the end of the form...
            if (currentTab +n >= x.length) {
                // ... the form gets submitted:
                return submitForm();
                // document.getElementById("regForm").submit();
                // false;
            }
            else{
                if (n == 1 && !validateForm()) {
                    console.log("Invalid");
                    console.log("N= "+n);

                    return false;}
                // Hide the current tab:
                // Increase or decrease the current tab by 1:
                currentTab = currentTab + n;
                x[currentTab-n].style.display = "none";
            }
            if(currentTab== 1){
                iniciarCategorias();
                iniciarSecciones();
                console.log("Categorias");

            }
            // Otherwise, display the correct tab:
            showTab(currentTab);
        }

        function validateForm() {
            // This function deals with validation of the form fields
            var x, y, i, valid = true;
            x = document.getElementsByClassName("tab");
            y = x[currentTab].getElementsByTagName("input");
            // A loop that checks every input field in the current tab:
            for (i = 0; i < y.length; i++) {
                // If a field is empty...
                if (y[i].value == "" && !y[i].classList.contains("notrequired") && y[i].id!="miniatura") {
                    // add an "invalid" class to the field:
                    y[i].className += " invalid";
                    console.log("Fallo 1");
                    console.log("ID y: " +y[i].id);


                    // and set the current valid status to false
                    valid = false;
                }
            }
            // If the valid status is true, mark the step as finished and valid:
            if (valid) {
                document.getElementsByClassName("step")[currentTab].className += " finish";
                console.log("VALID");

            }
            return valid; // return the valid status
        }

        function fixStepIndicator(n) {
            // This function removes the "active" class of all steps...
            var i, x = document.getElementsByClassName("step");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            //... and adds the "active" class on the current step:
            x[n].className += " active";
        }

    </script>
    <!--Script para configurar el textEdit-->
    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
        bkLib.onDomLoaded(function() {
            new nicEditor({buttonList : ['bold','italic','underline']}).panelInstance('area4');
        });
    </script>


    <!--Iniciar los datos con el ejercicio a modificar-->
    <script>
        function iniciarSecciones(){
        if(numSecciones!=(document.getElementById("numeroSecciones").value))
        {
            var secciones ="";
            seccionesTotales.length = 0;
            console.log(ejercicio);
            var steps = "";

            for(i=1;i<=ejercicio.secciones.length;i++) {
                var horas = pad(Math.floor(ejercicio.secciones[i-1].duracion/3600), 2);
                var minutos = pad(Math.floor((ejercicio.secciones[i-1].duracion%3600)/60), 2);
                var segundos = pad(Math.floor((ejercicio.secciones[i-1].duracion%3600)%60), 2);

                secciones += '<div class="tab">\
                                   <label for="title" class="control-label"><h3>{{ trans("adminlte_lang::message.addsection") }} '+i+' </h3></label><br> \
                                   \
                                        <div class="row"> \
                                            <div class="col-lg-6"> \
                                                <input type="text" class="form-control" id="nombreSeccion?'+i+'" placeholder="Nombre" name="nameSeccion'+i+'"  value="'+ejercicio.secciones[i-1].nombre+'" required>\
                                            </div>\
                                            <div class="col-lg-6">\
                                            </div>\
                                        </div><br>\
                                        \
                                           <label for="title" class="control-label"><li>Duración Sección:</li></label><br>\
                                            <input type="time" id="duracionSeccion?'+i+'" value="'+horas+':'+minutos+':'+segundos+'" style="width: 110px;" max="99:99:99" min="00:00:00" step="1" required>      (Horas:Minutos:Segundos)\
                                        <hr> <p id="acciones'+i+'"></p> \
                                        <div class="row">\
                                         <div class="col-lg-4">\
                                              <input type="button" onclick="dibujarAccion('+i+')" value="Añadir acción" class="btn btn-primary btn-success" >\
                                             </div><div class="col-lg-4">\
                                             <input type="button" onclick="borrarAccion('+i+')" value="Eliminar acción" class="btn btn-primary btn-danger">\
                                            </div><div class="col-lg-4"></div>\
                                      </div><hr> \</div>';
                steps += '<span class="step"></span>';

                seccionesTotales.push({id:null ,pos: i, nombre: "", duracion: null, acciones: []});

            }
            document.getElementById("seccion").innerHTML =secciones;
            document.getElementById("aditionalSteps").innerHTML = steps;

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
                                        <div class=col-lg-12>\
                                       <label for="title" class="control-label"><li>Tipo de ejercicio:</li></label><br>\
                                       </div>\
                                       </div>\
                                       <div class="row">\
                                       <div class="col-lg-4"><label for="title" style="text-align: center;" class="control-label">Vídeo:</label><br><p><input class="notrequired" id="imageId'+j+'?'+nuevaPosAccionSec+'_0" type="image" src="{!!URL::to('/')!!}/images/logo_video.png" onclick="selecciontipoAccion('+j+','+nuevaPosAccionSec+',this)"></p></div>\
                                        <div class="col-lg-4"><label for="title" style="text-align: center;" class="control-label">Imagen + Texto:</label><br><p><input  class="notrequired" id="imageId'+j+'?'+nuevaPosAccionSec+'_1" type="image" src="{!!URL::to('/')!!}/images/logo_imagen_y_texto.png" onclick="selecciontipoAccion('+j+','+nuevaPosAccionSec+',this)"></p></div>\
                                        <div class="col-lg-4"></div>\
                                      </div>  \
                                         <input type="hidden" id="tipoAccion?'+j+'&'+nuevaPosAccionSec+'">\
                                        <p id="contenidoaccion?'+j+'&'+nuevaPosAccionSec+'"></p> \
                                      <hr>';

                    nuevaAccionHTML.innerHTML = contenido;


                    var nuevoTiempo = {idSeccion: j, posAccion: nuevaPosAccionSec, tiempo: tiempoAccionIni};
                    tiemposAcciones.push(nuevoTiempo);
                    var idAccion = "acciones" + j;
                    var acciones = document.getElementById(idAccion);
                    acciones.parentNode.insertBefore(nuevaAccionHTML, acciones);
                    var id = "contenidoaccion?"+j+"&"+nuevaPosAccionSec;

                    if(ejercicio.secciones[j-1].acciones[a].tipo==opcionAccion1){
                        document.getElementById('tipoAccion?'+j+'&'+nuevaPosAccionSec).value=opcionAccion1;
                        document.getElementById('imageId'+j+'?'+nuevaPosAccionSec+'_0').value=opcionAccion1;
                        document.getElementById("imageId"+j+"?"+nuevaPosAccionSec+"_0").style.border = "3px solid blue";
                        document.getElementById(id).innerHTML ='<div class="form-group">\
                                            <label>Introduce un vídeo explicativo de la acción a realizar por el usuario:</label>\
                                            <input type="file" class="file_multi_video_' + j + '_' + nuevaPosAccionSec + ' notrequired" id="file?' + j + '&' + nuevaPosAccionSec + '" name="file?' + j + '&' + nuevaPosAccionSec + '">\
                                        <br><video height="200" controls>\
                                    <source src="{!!URL::to('/')!!}'+ejercicio.secciones[j-1].acciones[a].url_file+'" id="file_' + j + '_' + nuevaPosAccionSec + '">\
                                    Your browser does not support HTML5 video.\
                        </video>                                      </div>';

                        jQuery(document).on("change", ".file_multi_video_" + j + '_' + nuevaPosAccionSec, function(evt) {
                            var $source = $("#file_" + (j-1) + '_' + nuevaPosAccionSec);
                            console.log("AAAA");
                            console.log("#file_" + (j-1) + '_' + nuevaPosAccionSec);
                            $source[0].src = URL.createObjectURL(this.files[0]);
                            $source.parent()[0].load();
                        });
                    }
                    else{

                        document.getElementById('tipoAccion?'+j+'&'+nuevaPosAccionSec).value=opcionAccion2;
                        document.getElementById("imageId"+j+"?"+nuevaPosAccionSec+"_1").value=opcionAccion2;
                        document.getElementById('imageId'+j+'?'+nuevaPosAccionSec+'_1').style.border = "3px solid blue";
                        document.getElementById(id).innerHTML = '<div class="form-group">\
                                            <label>Introduce una imagen que represente el acción a realizar por el usuario:</label>\
                                            <p><div class="image-upload">\
                                            <div class="row"><div class="col-lg-2"></div><div class="col-lg-6"><label for="file?' + j + '&' + nuevaPosAccionSec + '">\
                                            <img class="miniatura" id="output_'+j+'_'+nuevaPosAccionSec+'" title="Introduce una imagen que represente el acción a realizar por el usuario"  height="200px" src="{!!URL::to('/')!!}'+ejercicio.secciones[j-1].acciones[a].url_file+'"/>\
                                            </label>\
                                            <input type="file" class="notrequired" id="file?' + j + '&' + nuevaPosAccionSec + '" name="file?' + j + '&' + nuevaPosAccionSec + '" style ="display:none;" onchange="loadFileInstruccion(event, '+j+','+nuevaPosAccionSec+')"/>\
                                            </div></div><div class="col-lg-4"></div></div></p>\
                                        </div>\
                                    <label>Ahora introduce instrucciones con texto para acompañar a la imagen:</label>\
                                    <p id="contenidoinstruccion?' + j + '&' + nuevaPosAccionSec + '"></p> <hr>\
                                      <div class="row">\
                                        <div class="col-lg-4"><input type="button"  onclick="addInstruccion(' + j + ',' + nuevaPosAccionSec + ');" name="boton" value="Añadir Instrucción" title="Las instrucciones constan de texto que se repartirá proporcionalmente en el tiempo de la acción" class="btn btn-primary btn-success">\
                                        </div><div class="col-lg-4"><input type="button"  onclick="delInstruccion(' + j + ',' + nuevaPosAccionSec + ');" name="boton" value="Eliminar Instrucción" title="Las instrucciones constan de texto que se repartirá proporcionalmente en el tiempo de la acción" class="btn btn-primary btn-danger">\
                                        </div><div class="col-lg-4"></div><div class="col-lg-4"></div></div>\
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
                            console.log("posSec(z): "+j +" posA(y): "+nuevaPosAccionSec+" posI(nueva): "+nuevaPosInstruccion);


                            nuevaInstruccionHTML.innerHTML = 'Instrucción: ' + nuevaPosInstruccion + '<textarea required style="width: 300px; height: 100px;" id="textoInstruccion?'+j+'&'+nuevaPosAccionSec+'&'+nuevaPosInstruccion+'" >\
                                            '+ejercicio.secciones[j - 1].acciones[y].instrucciones[z].contenido+'</textarea>';

                            var id = "contenidoinstruccion?" + j + "&" + nuevaPosAccionSec;
                            var instrucciones = document.getElementById(id);

                            instrucciones.parentNode.insertBefore(nuevaInstruccionHTML, instrucciones);

                            var area4 = new nicEditor({buttonList: ['bold', 'italic', 'underline', 'strikeThrough']}).panelInstance('textoInstruccion?'+j+'&'+nuevaPosAccionSec+'&'+nuevaPosInstruccion);
                            console.log('textoInstruccion?'+j+'&'+nuevaPosAccionSec+'&'+nuevaPosInstruccion);
                        }


                    }
                }
            }


        }

            //Se incian las preguntas finales
            if (numOpciones != (document.getElementById("numeroOpciones").value)) {
                numOpciones = document.getElementById("numeroOpciones").value;
                var preguntas = "";
                preguntasFinal.length = 0;
                for (i = 1; i <= numOpciones; i++) {
                    preguntas += '<hr><label for="title" class="control-label">Opcion '+i+' </label><br> \
                    <div style="margin-left: 30px;"> \
                            <div class="row"> \
                                <div class="col-lg-6"> \
                                    <input type="text" class="form-control" id="preguntafinal?' + i + '" placeholder="Contenido respuesta" value="'+ejercicio.opcionespreguntafinal[i-1].contenido+'" name="preguntafinal?' + i + '" required>\
                                </div>\
                                <div class="col-lg-6">\
                                </div>\
                            </div>\
                        </div> \
        ';
                    preguntasFinal.push({pos:i,contenido:""});
                }
                document.getElementById("preguntafinal").innerHTML = preguntas;

            }



        }
        function pad (n, length) {
            var  n = n.toString();
            while(n.length < length)
                n = "0" + n;
            return n;
        }
    </script>

@endsection
