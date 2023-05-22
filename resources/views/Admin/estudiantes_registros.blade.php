@extends('layout')


@section('title', 'Gestión de estudiantes')

@push('css')

<style>
</style>

@endpush


@section('contenido')


<div class="row">

    <div class="col-sm-12">

        <div class="card">

            <div class="card-header">
                <h3>Gestión de estudiantes</h3>
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
                            <th>Mátricula</th>
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
                                <label for="">Nombre(s)</label>
                                <input class="form-control" type="text" name="nombres" id="nombres">
                        </div>
                        <div class="form-group">
                            <label for="">Apellido(s)</label>
                            <input class="form-control" type="text" name="apellidos" id="apellidos">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="">Fecha Nacimiento</label>
                                <input type="text" id="fechaNacimiento" name="fechaNacimiento" class="form-control">
                            </div>
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="">Sexo</label>
                                <select class="form-control" name="sexo" id="sexo">
                                    <option value="">Seleccione una opción</option>
                                    <option value="0">Femenino</option>
                                    <option value="1">Masculino</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="">Matricula</label>
                                <input type="text" id="matricula" name="matricula" class="form-control">
                            </div>
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="">Semestre</label>
                                <select class="form-control" name="semestre" id="semestre">
                                    <option value="">Seleccione una opción</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Fecha Inscripción</label>
                            <input class="form-control" type="text" name="fechaInscripcion" id="fechaInscripcion">
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

    $(document).ready(function () {
        console.log("running....")
        listar();



        $('#fechaNacimiento').bootstrapMaterialDatePicker({
            format: 'DD-MM-YYYY',
            time:false,
            minDate: moment('01-01-1985')
        });

        $('#fechaInscripcion').bootstrapMaterialDatePicker({
            format: 'DD-MM-YYYY',
            time:false,
            minDate: moment('01-01-1985')
        });


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
        let fechaNacimiento = $('#fechaNacimiento').val()
        fechaNacimiento = moment(fechaNacimiento, "DD-MM-YYYY").format("YYYY/MM/DD") 
        let fechaInscripcion = $('#fechaInscripcion').val()
        fechaInscripcion = moment(fechaInscripcion, "DD-MM-YYYY").format("YYYY/MM/DD") 

        let data = new FormData();
        data.append('nombres', $('#nombres').val())
        data.append('apellidos', $('#apellidos').val())
        data.append('fechaNacimiento', fechaNacimiento)
        data.append('sexo', $('#sexo').val())
        data.append('matricula', $('#matricula').val())
        data.append('semestre', $('#semestre').val())
        data.append('fechaInscripcion', fechaInscripcion)
        data.append('id', $('#id').val())
        data.append('op', $('#op').val())
        

        $.ajax({
            method: "POST",
            url: "{{route('estudiantes.save')}}",
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
            url: "{{route('estudiantes.listar')}}",
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
                                <td>${val.matricula}</td>
                                <td>${val.nombre}</td>
                                <td>
                                    <button onclick="Editar(${val.id})" class="btn btn-icon btn-warning"><i class="fas fa-edit"></i></button>                                
                                    <button onclick="Baja(${val.id},'D', ${val.baja?"0":"1"})" class="btn btn-icon btn-${val.baja?"primary":"danger"}"><i class="fas fa-thumbs-${val.baja?"up":"down"}"></i></button>
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
            url: "{{route('estudiantes.obtener')}}",
            data: {"id":id},
            dataType: "json",
            success: function (res) {
                SetDatos(res);
            }
        });
    }

    function SetDatos(obj){
        LimpiarFormulario();
        obj = obj[0];
        $('#nombres').val(obj.nombres)
        $('#apellidos').val(obj.apellidos)
        $('#fechaNacimiento').val(moment(new Date(obj.fechaNacimiento)).format("DD-MM-YYYY"))
        $('#fechaInscripcion').val(moment(new Date(obj.fechaInscripcion)).format("DD-MM-YYYY"))
        $('#sexo').val(obj.sexo)
        $('#semestre').val(obj.semestre)
        $('#matricula').val(obj.matricula)
        $('#id').val(obj.id)
        $('#op').val('U')

        $('#md-registro').modal('toggle')
    }

    function LimpiarFormulario(){
        $('#nombres').val(null)
        $('#apellidos').val(null)
        $('#fechaNacimiento').val(null)
        $('#fechaInscripcion').val(null)
        $('#sexo').val(null)
        $('#semestre').val(null)
        $('#matricula').val(null)
        $('#id').val(null)
        $('#op').val(null)
    }

    function Baja(id, op, status){
        $.get("{{route('estudiantes.baja')}}", {
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