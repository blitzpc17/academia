@extends('layout')


@section('title', 'Asignacion de asignacion')

@push('css')


@endpush


@section('contenido')


<div class="row">

    <div class="col-sm-12">

        <div class="card">

            <div class="card-header">
                <h3>Asignacion de asignacion</h3>
            </div>

            <div class="card-body">

            <div style="display:flex; justify-content: right;">                
                <button onclick="nuevo()" class="btn btn-primary">Nuevo registro</button>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="">Tipo</label>
                    <select class="form-control" name="stipo" id="stipo">
                        <option value="">Seleccione una opción</option>
                        <option value="E">Estudiante</option>
                        <option value="D">Docente</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                <label for="" id="lblBusqueda"> </label>
                    <select class="form-control" name="spersona" id="spersona"></select>
                </div>
            </div>

            <div clasS="table-responsive">

                <table id="tb-registros" class="table">
                    <thead>
                        <tr>
                            <th>#</th>      
                            <th>Materia</th>                           
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>

            </div>
                

            </div>


        </div>



    </div>



</div>




<!-- Modal -->
<div class="modal fade" id="md-registro" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
            <div class="modal-body">
                <div class="container-fluid">

                    <form id="frm-registro" >
                        <input id="op" type="hidden" name="op">
                        <input id="id" type="hidden" name="id">

                        <div class="form-group">
                            <label for="">Tipo</label>
                            <select class="form-control" name="tipo" id="tipo">
                                <option value="">Seleccione una opción</option>
                                <option value="E">Estudiante</option>
                                <option value="D">Docente</option>
                            </select>
                        </div> 
                        
                        <div class="form-group">
                            <label for="">Nombre</label>
                            <select class="form-control" name="persona" id="persona">
                                <option value="">Seleccione una opción</option>
                            </select>
                        </div>  

                        <div class="form-group">
                            <label for="">Materia</label>
                            <select class="form-control" name="materia" id="materia">
                                <option value="">Seleccione una opción</option>
                            </select>
                        </div>  

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
</form>
            </div>
        </div>
    </div>
</div>




@endsection



@push('js')

<script>

    let tabla;
    let persona;

    $(document).ready(function () {
        console.log("running....")
     

        $('#frm-registro').on('submit', function (e) {
             e.preventDefault();
             save($('#op'));
        });

       

        $('#tipo').on('change', function(){
            if($(this).val()==null || $(this).val()==''){
                swal("Advertencia", "Debe elegir una opción válida", "warning")
            }else{
                cargarPersonas($(this).val())
                cargarMaterias($(this).val())
            }
            
        });


        $('#stipo').on('change', function(){
            if($(this).val()==null || $(this).val()==''){
                swal("Advertencia", "Debe elegir una opción válida", "warning")
            }else{
                cargarPersonas($(this).val(), 'spersona')
            }            
        });


        $('#spersona').on('change', function(){
            if($(this).val()==null || $(this).val()==''){
                swal("Advertencia", "Debe elegir una opción válida", "warning")
            }else{
                //listar relaciones
                listar($('#stipo').val(), $(this).val());
            }            
        });



    });  


 
    
    
    function cargarPersonas(tipo, ctrl = null){
        $.ajax({
            method: "GET",
            url: "{{route('personas.listar')}}",
            data: {"tipo":tipo},
            dataType: "json",
            success: function (res) {
                console.log(ctrl)
                ctrl = ctrl??"persona";
                $('#'+ctrl).empty();
                $('#'+ctrl).append(`<option value="">Seleccione una opción</option>`)
                $.each(res, function (i, val) { 
                    $('#'+ctrl).append(`<option value="${val.id}">${val.nombre}</option>`)
                });  
                
                if(persona!=null || persona!=undefined){
                    $('#persona').val(persona)
                }
            }
        });
    }

    function cargarMaterias(tipo, id){
        console.log(tipo)
        $.ajax({
            method: "GET",
            url:  tipo=="D"?"{{route('materias.listar')}}":"{{route('asignacion.docentes.listar')}}",          
            success: function (res) {
                console.log(res)
                $('#materia').empty();
                $('#materia').append(`<option value="">Seleccione una opción</option>`)
                if(res.length<=0){
                    swal("Advetencia", "No se encontraron registros para mostras", "warning")
                    return;
                }
                $.each(res, function (i, val) { 
                    $('#materia').append(`<option value="${val.id}">${val.nombre}</option>`)
                });  
            }
        });
    }

    function nuevo(){
        LimpiarFormulario();
        $('.modal-title').text('Nuevo Registro')
        $('#op').val('I')
        $('#id').val(null)
        $('#md-registro').modal('toggle')
    }

    function save(op){    

        let data = new FormData();
        data.append('tipo', $('#tipo').val())     
        data.append('persona', $('#persona').val())     
        data.append('materia', $('#materia').val())          
        data.append('id', $('#id').val())
        data.append('op', $('#op').val())
        

        $.ajax({
            method: "POST",
            url: "{{route('asignacion.save')}}",
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            dataType:"json",
            success: function (res) {
                if(res.code==200){
                    swal("Aviso", res.msj, "success").then(()=>{
                        LimpiarFormulario();
                        $('#md-registro').modal('toggle')
                    });
                  
                }else{
                    swal("Advertencia", "Ocurrio un problema mientras se actualizaba el registro. Verifique su información e intentelo nuevamente", "warning");
                }
            }
        });

    }

    function listar(tipo, persona){
        let data =  {"tipo":tipo, "id":persona}
        console.log(data)
        $.ajax({
            method: "GET",
            url: "{{route('asignacion.listar')}}",
            data: data,
            dataType: "json",
            success: function (res) {
                if(tabla!=null||tabla!=undefined){
                    tabla.destroy()                    
                }
                $('#tb-registros tbody').empty()
                let html=''
                $.each(res, function (i, val) { 
                     html+=`<tr>
                                <td>${i+1}</td>
                                <td>${val.nombre}</td>
                                <td>                                                               
                                    <button onclick="Baja(${val.id})" class="btn btn-icon btn-danger"><i class="fas fa-trash"}"></i></button>
                                </td>
                            </tr>`
                });
                $('#tb-registros tbody').html(html)

              

                tabla = $('#tb-registros').DataTable()

            }
        });

    }   

    function LimpiarFormulario(){       
        $('#tipo').val(null)
        $('#persona').val(null)
        $('#materia').val(null)    
        $('#stipo').val(null)
        $('#spersona').val(null)
        $('#id').val(null)
        $('#op').val(null)
        if(tabla!=null||tabla!=undefined){
            tabla.destroy()                    
        }
        $('#tb-registros tbody').empty()
        tabla = $('#tb-registros').DataTable()
        persona = null;
    }

    function Baja(id, tipo){
        $.get("{{route('asignacion.eliminar')}}", {
            "id":id,           
            "tipo":tipo
        },
            function (res) {
                if(res.code==200){
                    swal("Aviso", res.msj, "success").then(() =>{
                        LimpiarFormulario();
                    })

                }else{
                    swal("Advertencia", "Ocurrio un problema mientras se actualizaba el registro. Verifique su información e intentelo nuevamente", "warning");
                }
            },
            "json"
        );
    }


</script>

@endpush