@extends('layout')


@section('title', 'Gestión de usuarios')

@push('css')


@endpush


@section('contenido')


<div class="row">

    <div class="col-sm-12">

        <div class="card">

            <div class="card-header">
                <h3>Gestión de usuarios</h3>
            </div>

            <div class="card-body">

            <div style="display:flex; justify-content: right;">
                <button onclick="nuevo()" class="btn btn-primary">Nuevo registro</button>
            </div>

            <div clasS="table-responsive">

                <table id="tb-registros" class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Tipo</th>
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
                                <label for="">Correo electrónico</label>
                                <input class="form-control" type="email" name="correo" id="correo">
                        </div>
                        <div class="form-group">
                            <label for="">Contraseña</label>
                            <input class="form-control" type="password" name="password" id="password">
                        </div>
                        <div class="form-group">
                            <label for="">Re-Contraseña</label>
                            <input class="form-control" type="password" id="repassword">
                        </div>

                        
                                               
                    

                        <div class="form-row">

                            <div class="form-group col-sm-12 col-md-6">
                                <label for="">Tipo</label>
                                <select id="tipo" name="tipo" class="form-control">
                                    <option value="">Seleccione una opción</option>
                                    <option value="E">Estudiante</option>
                                    <option value="D">Docente</option>
                                </select>
                            </div>   
                            <div class="form-group col-sm-12 col-md-6">
                                <label id="lbl-persona" for="">Personal a cargo:</label>
                                <select id="persona" name="persona" class="form-control">
                                    <option value="">Seleccione una opción</option>
                                </select>
                            </div>                           
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
        listar();

        $('#tipo').on('change', function(){
            if($(this).val()==null || $(this).val()==''){
                swal("Advertencia", "Debe elegir una opción válida", "warning")
            }else{
                cargarPersonas($(this).val())
            }
            
        });


        $('#persona').on('change', function(){
            if( $('#tipo').val()==null ||  $('#tipo').val()==''){
                swal("Advertencia", "Debe elegir el tipo de usuario primero", "warning")
            }else if($(this).val()==null || $(this).val()==''){
                swal("Advertencia", "No ha seleccionado el nombre del prospecto a usuario.", "warning")
            }
            
        });

        $('#frm-registro').on('submit', function (e) {
             e.preventDefault();
             save($('#op'));
        });

    });

    function cargarPersonas(tipo){
        $.ajax({
            method: "GET",
            url: "{{route('personas.listar')}}",
            data: {"tipo":tipo},
            dataType: "json",
            success: function (res) {
                console.log(res)
                $('#persona').empty();
                $('#persona').append(`<option value="">Seleccione una opción</option>`)
                $.each(res, function (i, val) { 
                    $('#persona').append(`<option value="${val.id}">${val.nombre}</option>`)
                });  
                
                if(persona!=null || persona!=undefined){
                    $('#persona').val(persona)
                }
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
        data.append('email', $('#correo').val())
        data.append('password', $('#password').val())
        data.append('tipo', $('#tipo').val())
        data.append('personasId', $('#persona').val())       
        data.append('id', $('#id').val())
        data.append('op', $('#op').val())
        

        $.ajax({
            method: "POST",
            url: "{{route('usuarios.save')}}",
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            dataType:"json",
            success: function (res) {
                if(res.code==200){
                    swal("Aviso", res.msj, "success").then(()=>{
                        listar()
                        LimpiarFormulario();
                        $('#md-registro').modal('toggle')
                    });
                  
                }else{
                    swal("Advertencia", "Ocurrio un problema mientras se actualizaba el registro. Verifique su información e intentelo nuevamente", "warning");
                }
            }
        });

    }

    function listar(){
        let data =  null
        $.ajax({
            method: "GET",
            url: "{{route('usuarios.listar')}}",
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
                                <td>${val.correo}</td>
                                <td>${val.NombreTipo}</td>
                                <td>
                                    <button onclick="Editar(${val.id})" class="btn btn-icon btn-warning"><i class="fas fa-edit"></i></button>                                
                                    <button onclick="Baja(${val.id},'D', ${val.activo==1?"0":"1"})" class="btn btn-icon btn-${val.activo==1?"danger":"primary"}"><i class="fas fa-thumbs-${val.activo==1?"down":"up"}"></i></button>
                                </td>
                            </tr>`
                });
                $('#tb-registros tbody').html(html)

              

                tabla = $('#tb-registros').DataTable()

            }
        });

    }

    function Editar(id){
        $.ajax({
            method: "GET",
            url: "{{route('usuarios.obtener')}}",
            data: {"id":id},
            dataType: "json",
            success: function (res) {
                SetDatos(res);
            }
        });
    }

    function SetDatos(obj){
        LimpiarFormulario();
        console.log(obj)
        $('#correo').val(obj.correo)
        $('#password').val(null)
        $('#repassword').val(null)      
       
        $('#tipo').val(obj.tipo)
        $('#tipo').val(obj.tipo).trigger('change');
        persona = obj.personasId;
            
        $('#id').val(obj.id)
        $('#op').val('U')

        $('#md-registro').modal('toggle')
    }

    function LimpiarFormulario(){
        $('#correo').val(null)
        $('#password').val(null)
        $('#repassword').val(null)
        $('#tipo').val(null)
        $('#persona').val(null)       
        $('#id').val(null)
        $('#op').val(null)
        persona = null;
    }

    function Baja(id, op, status){
        $.get("{{route('usuarios.baja')}}", {
            "id":id,
            "op":op,
            "status":status
        },
            function (res) {
                if(res.code==200){
                    swal("Aviso", res.msj, "success").then(() =>{
                        listar()
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