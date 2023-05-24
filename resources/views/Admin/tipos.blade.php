@extends('layout')


@section('title', 'Gestión de Tipos de actividades')

@push('css')


@endpush


@section('contenido')


<div class="row">

    <div class="col-sm-12">

        <div class="card">

            <div class="card-header">
                <h3>Gestión de tipos de actividades</h3>
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
                                <label for="">Nombre</label>
                                <input class="form-control" type="text" name="nombre" id="nombre">
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

        $('#frm-registro').on('submit', function (e) {
             e.preventDefault();
             save($('#op'));
        });

    });   

    function nuevo(){
        LimpiarFormulario();
        $('.modal-title').text('Nuevo Registro')
        $('#op').val('I')
        $('#id').val(null)
        $('#md-registro').modal('toggle')
    }

    function save(op){    

        let data = new FormData();
        data.append('nombre', $('#nombre').val())     
        data.append('id', $('#id').val())
        data.append('op', $('#op').val())
        

        $.ajax({
            method: "POST",
            url: "{{route('tipo.save')}}",
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
            url: "{{route('tipo.listar')}}",
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
                                    <button onclick="Editar(${val.id})" class="btn btn-icon btn-warning"><i class="fas fa-edit"></i></button>
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
            url: "{{route('tipo.obtener')}}",
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
        $('#nombre').val(obj.nombre)
        $('#id').val(obj.id)
        $('#op').val('U')

        $('#md-registro').modal('toggle')
    }

    function LimpiarFormulario(){       
        $('#nombre').val(null)       
        $('#id').val(null)
        $('#op').val(null)
        persona = null;
    }

   

</script>

@endpush