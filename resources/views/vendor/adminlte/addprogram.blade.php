@extends('adminlte::layouts.app')
@section('PageName', 'AddProgram')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection

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
				                         document.getElementById("categorias").innerHTML = categorias;
				                         document.getElementById("nombreCategoria").value = "";
				                        // document.getElementById("categoriasFinal").value = categorias;
				                    }
				                   
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
				                         //document.getElementById("categoriasFinal").value = categorias;
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
                                   //document.getElementById("categoriasFinal").value = categorias;
                               }

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
         </form>
         </div>
 </div>
  
@endsection