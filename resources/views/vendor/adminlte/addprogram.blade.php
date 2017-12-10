@extends('adminlte::layouts.app')
@section('PageName', 'AddProgram')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection
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

@section('main-content')

 <div class="container col-md-10 col-md-offset-1">
        <div class="well well bs-component">

        <form id="form" method="post" class="form-horizontal" >
                @foreach ($errors->all() as $error)
                <p class="alert alert-danger">{{ $error }}</p>
                @endforeach
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <fieldset>
                    <legend>Crear un nuevo programa de ejercicios</legend>
                        <div class="tab" id="numSecciones"> <a href="#" class="help" data-toggle="tooltip" title="Añadir la información principal del programa que incluye el nombre y la dificultad estimada del mismo." data-placement="right">Información general:</a>

                            <div class="form-group">
                            <label for="title" class="col-lg-2 control-label">Nombre</label>
                            <div class="col-lg-10">
                                <input type="text" maxlength="22" class="form-control" id="title" placeholder="Nombre" name="nombrePrograma" required="required">
                            </div>
                        </div>
                       <div class="form-group">
                            <label for="content" class="col-lg-2 control-label">Dificultad</label>
                            <div class="col-lg-10">
                                 <select id="dificultad" name="dificultad" class="form-control"  required>
                                         <option disabled selected value="">Selecciona un nivel</option>
                                        <option value="Principiante">Principiante</option>
                                        <option value="Intermedio">Intermedio</option>
                                        <option value="Avanzado">Avanzado</option>
                                    </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="content" class="col-lg-2 control-label">Categorias</label>
	                     <div class="col-lg-3">
	                            <input list="browsers" class="form-control" name="nombreCategoria" id="nombreCategoria" />
	                            <datalist id="browsers">
	                                @foreach($categoriaprograma as $category)
	                                <option value="{{$category->nombre}}">
	                                @endforeach
	                            </datalist>
	                    </div>
	                     <div class="col-lg-1">
	                        <input type="button"  onclick="addCategory();" name="boton" value="Añadir" class="btn btn-primary btn-success">
	                    </div>
	                    <div class="col-lg-6" style="margin-left: 10px;">
	                        <p id="categorias" ></p>

	                    </div>


				           <script type="text/javascript">
				           var categorias =[];
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
                                   document.getElementById("categorias").innerHTML = categoriasHTML;

                               }

				           </script>
                            <span class="help-block">.</span>

                    </div>
                     <div class="form-group">
                        <label for="content" class="col-lg-2 control-label">Ejercicios</label>
	                     <div class="col-lg-3">

	                            <select id="nombreEjercicio" class="form-control">
	                             <option disabled selected value="">Selecciona un ejercicio</option>
	                                @foreach($ejercicios as $ejercicio)
	                                <option value="{{$ejercicio->Id}}|{{$ejercicio->nombre}}">{{$ejercicio->nombre}}</option>
	                                @endforeach
	                            </select>
	                    </div>
	                     <div class="col-lg-1">
	                        <input type="button"  onclick="addEjercicio();" name="boton" value="Añadir" class="btn btn-primary btn-success">
	                    </div>
	                    <div class="col-lg-6">
	                        <p id="ejercicios" style="margin-left: 10px;"></p>

	                    </div>


				           <script type="text/javascript">
				           var ejercicios =[];
				           var idsEjercicios = [];
				               function addEjercicio() {
				               		var result = document.getElementById("nombreEjercicio").value;
    								var resultArray = result.split("|");
    								var id = resultArray[0];
    								var nombre = resultArray[1];
				                    var nuevoEjercicio = nombre;
				                    if(ejercicios.indexOf(nuevoEjercicio) == -1){
				                        ejercicios.push(nuevoEjercicio);
				                        idsEjercicios.push(id);
				                         document.getElementById("ejercicios").innerHTML = ejercicios;
				                         document.getElementById("nombreEjercicio").value = "";
				                         document.getElementById('idsEjercicios').value = JSON.stringify(idsEjercicios);
				                    }

				             }
                           function delEjercicio(id) {
                               var result = document.getElementById("nombreEjercicio").value;
                               var resultArray = result.split("|");
                               var id = resultArray[0];
                               var nombre = resultArray[1];
                               var nuevoEjercicio = nombre;
                               if(ejercicios.indexOf(nuevoEjercicio) == -1){
                                   ejercicios.push(nuevoEjercicio);
                                   idsEjercicios.push(id);
                                   document.getElementById("ejercicios").innerHTML = ejercicios;
                                   document.getElementById("nombreEjercicio").value = "";
                                   document.getElementById('idsEjercicios').value = JSON.stringify(idsEjercicios);
                               }

                           }

				           </script>

                         <script>
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
                                     document.getElementById("nextBtn").innerHTML = "Submit";
                                 } else {
                                     document.getElementById("nextBtn").innerHTML = "Next";
                                 }
                                 //... and run a function that will display the correct step indicator:
                                 fixStepIndicator(n)
                             }

                             function nextPrev(n) {
                                 // This function will figure out which tab to display
                                 var x = document.getElementsByClassName("tab");
                                 // Exit the function if any field in the current tab is invalid:
                                 if (n == 1 && !validateForm()) return false;
                                 // Hide the current tab:
                                 x[currentTab].style.display = "none";
                                 // Increase or decrease the current tab by 1:
                                 currentTab = currentTab + n;
                                 // if you have reached the end of the form...
                                 if (currentTab >= x.length) {
                                     // ... the form gets submitted:
                                     document.getElementById("regForm").submit();
                                     return false;
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
                                     if (y[i].value == "") {
                                         // add an "invalid" class to the field:
                                         y[i].className += " invalid";
                                         // and set the current valid status to false
                                         valid = false;
                                     }
                                 }
                                 // If the valid status is true, mark the step as finished and valid:
                                 if (valid) {
                                     document.getElementsByClassName("step")[currentTab].className += " finish";
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
                            <span class="help-block">.</span>
                    </div>
                    <div class="col-lg-10 col-lg-offset-2">
                            <button class="btn btn-default">Cancelar</button>
                            <button type="submit" name="botonEnvio" class="btn btn-primary">Enviar</button>

                        </div>
                </fieldset>
                <input type="hidden" id="idsEjercicios" name="idsEjercicios">
                    <input type="hidden" id="arrayCategorias" name="arrayCategorias">

        </form>
         </div>
 </div>

@endsection
