@extends('layout')


@section('title', 'Gestión de actividades')

@push('css')

<style>
</style>

@endpush


@section('contenido')


<div class="row">

    <div class="col-sm-12">

        <div class="card">

            <div class="card-header">
                <h3>Gestión de actividades</h3>
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
                            <th>Actividad</th>
                            <th>Tipo</th>
                            <th>Estado</th>
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

                    <form id="frm-registro" enctype="multipart/form-data">
                        <input id="op" type="hidden" name="op">
                        <input id="id" type="hidden" name="id">

                        <div class="form-row">
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="">Materias</label>
                                <select class="form-control" name="docenteMateria" id="docenteMateria">
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($materias as $mat )
                                        <option value="{{$mat->id}}">{{$mat->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="">Tipo</label>
                                <select class="form-control" name="tipo" id="tipo">
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($tipos as $tip )
                                        <option value="{{$tip->id}}">{{$tip->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>                   
                        <div class="form-group">
                            <label for="">Titulo</label>
                            <textarea name="titulo" id="titulo" class="form-control" cols="30" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Descripción</label>
                            <textarea name="descripcion" id="descripcion" class="form-control" cols="30" rows="10"></textarea>
                        </div>                        

                        <div class="form-row">
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="">Fecha Publicación</label>
                                <input type="text" id="fechaInicio" name="fechaInicio" class="form-control">
                            </div>
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="">Fecha de entrega</label>
                                <input type="text" id="fechaEntrega" name="fechaEntrega" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Material de apoyo</label>
                            <input class="form-control" type="file" name="material" id="material">
                        </div>
                        <div style="width: 100%" id="archivo">
                                                  
                        </div>


                        <!-- Examen -->
                        <div id="frm-examen" style="width:100%">

                            <h3>Formulario de examen</h3>
                            <hr>
                            
                                @for ($i=1; $i<=10; $i++)
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="">Pregunta</label>
                                            <input type="text"
                                                class="form-control" name="preg-{{$i}}" id="preg-{{$i}}" aria-describedby="helpId" placeholder="">
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label for="">Respuesta</label>
                                            <input type="text"
                                                class="form-control" name="res-{{$i}}" id="res-{{$i}}" aria-describedby="helpId" placeholder="">
                                        </div>
                                    </div>
                                @endfor
                                <hr>
                        </div>

                        <!-- end examen-->

                        <div class="form-group">
                            <label for="">Estado</label>
                                <select class="form-control" name="estado" id="estado">
                                    <option value="">Seleccione una opción</option>
                                    <option value="1">Programada</option>
                                    <option value="2">Cerrada</option>
                                    <option value="3">Cancelada</option>
                                </select>
                        </div>
                        <!-- falta el apartado para examen-->
                  

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



<!-- modal revision-->

<!-- Modal -->
<div class="modal fade" id="md-revision" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title title-revision">sm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">

            
            <form id="frm-revision">
            <input type="hidden" id="idactest" name="idactest">
            <div class="form-group">
              <label for="">Alumnos matrículados</label>
              <select class="form-control" name="select-matriculados" id="select-matriculados"></select>
            </div>

            <div id="form-tarea">
                <center>
                    <iframe id="frameTareas" style="width:90%; height:600px;" src="https://www.w3schools.com" title="archivos adjuntos"></iframe>
                </center>  
            </div>

            <div id="form-examen">

            
            </div>

            <div class="form-group">
                <label for="">Calificación</label>
                <input type="text"
                    class="form-control" name="calificacion" id="calificacion" aria-describedby="helpId" placeholder="0">
                </div>                
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- emnd modal revision-->




@endsection



@push('js')

<script>

    let tabla;
    let actividadSeleccionada;

    $(document).ready(function () {
        console.log("running....")
        listar();



        $('#fechaInicio').bootstrapMaterialDatePicker({
            format: 'DD-MM-YYYY h:mm:ss a',
            time:true,
        }).on('change', function(e, date){
            $('#fechaEntrega').bootstrapMaterialDatePicker('setMinDate', date)
        })

        $('#fechaEntrega').bootstrapMaterialDatePicker({
            format: 'DD-MM-YYYY h:mm:ss a',
            time:true,
        });


        $('#frm-registro').on('submit', function (e) {
             e.preventDefault();
             save($('#op'));

        });

        $('#tipo').on('change', function(){
            if($(this).val()==2){ //tipo examen
                $('#frm-examen').show();
            }else{
                $('#frm-examen').hide();
            }
        })

        $('#select-matriculados').on('change', function(){
            CargarActividadRevision(actividadSeleccionada)
        });

        $('#frm-revision').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{route('actividadesest.examen.calificar')}}",
                data: {"id":$('#idactest').val(), "calificacion":$('#calificacion').val()},
                dataType: "json",
                success: function (res) {
                    swal("Aviso", res.msj, "success").then(()=>{
                        $('#md-revision').modal('toggle')
                    })
                   
                }
            });
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
        let fechaInicio = $('#fechaInicio').val()
        fechaInicio = moment(fechaInicio, "DD-MM-YYYY hh:mm:ss").format("YYYY-MM-DD hh:mm:ss") 
        let fechaEntrega = $('#fechaEntrega').val()
        fechaEntrega = moment(fechaEntrega, "DD-MM-YYYY hh:mm:ss").format("YYYY-MM-DD hh:mm:ss") 

        let data = new FormData();
        data.append('docenteMateria', $('#docenteMateria').val())
        data.append('tipo', $('#tipo').val())        
        data.append('titulo', $('#titulo').val())
        data.append('descripcion', $('#descripcion').val())
        data.append('fechaInicio', fechaInicio)       
        data.append('fechaEntrega', fechaEntrega)
        data.append('estado', $('#estado').val())
        data.append('material', $('#material')[0].files[0]==undefined?"": $('#material')[0].files[0])
        data.append('id', $('#id').val())
        data.append('op', $('#op').val())

        if($('#tipo').val()==2)//es examen
        {
            let examen=[];
            for(let i = 1; i<=10; i++){
                if($('#preg-'+i).val()==null|| $('#preg-'+i).val()=="")continue;

                examen.push({"id":i,"pregunta": $('#preg-'+i).val(), "respuesta": $("#res-"+i).val()})
            }
            data.append('examen', JSON.stringify(examen))
        }

        $.ajax({
            method: "POST",
            url: "{{route('actividadesdoc.save')}}",
            data: data,
            contentType: false,
            cache: false,
            processData: false,
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
        let data =  {"id":"{{$cuenta->personasId}}"}
        $.ajax({
            method: "GET",
            url: "{{route('actividadesdoc.listar')}}",
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
                                <td>${val.titulo}</td>
                                <td>${val.tipo}</td>
                                <td>${val.estado}</td>
                                <td>
                                    <button onclick="Editar(${val.id})" class="btn btn-icon btn-warning"><i class="fas fa-edit"></i></button>                                
                                    <button onclick="Revisar(${val.id}, '${val.titulo}')" class="btn btn-icon btn-info"><i class="fas fa-clipboard-check"></i></button>
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
            url: "{{route('actividadesdoc.obtener')}}",
            data: {"id":id},
            dataType: "json",
            success: function (res) {
                SetDatos(res);
            }
        });
    }

    function SetDatos(obj){
        LimpiarFormulario();
        $('.modal-title').text('Modificación de la actividad')
        $('#docenteMateria').val(obj.materiasId)
        $('#titulo').val(obj.titulo)
        $('#tipo').val(obj.tipoActividadesId)
        $('#fechaInicio').val(moment(new Date(obj.fechaInicio)).format("YYYY-MM-DD hh:mm:ss"))
        $('#fechaEntrega').val(moment(new Date(obj.fechaEntrega)).format("YYYY-MM-DD hh:mm:ss"))
        $('#descripcion').val(obj.descripcion)
        $('#titulo').val(obj.titulo)
        SetMaterial(obj.materialAdjunto);
        $('#estado').val(obj.estadoId)
        $('#id').val(obj.id)
        $('#op').val('U')

        //set examen frm-examen
        if(obj.tipoActividadesId==2){
            let dataExamen = JSON.parse(obj.examen);
            $.each(dataExamen, function (i, val) { 
                $('#preg-'+val.id).val(val.pregunta)
                $('#res-'+val.id).val(val.respuesta)
                $('#tipo').change();
            });
            
        }

        $('#md-registro').modal('toggle')
    }

    function SetMaterial(nombre){
        $('#archivo').empty();
        if(nombre==null)return;
        const html = `<div style="display:flex; flex-direction:column; align-items:center; justify-content:center;">
                                <a download="${nombre}" href="{{asset('actividades/docentes/materialapoyo')}}/${nombre}" style="width:32px: height:32px;" class="btn btn-icon btn-primary"><i class="fas fa-file"></i></a>
                                <p>${nombre}</p>
                            </div>`;
        $('#archivo').append(html);
    }

    function LimpiarFormulario(){
        $('#docenteMateria').val(null)
        $('#tipo').val(null)
        $('#titulo').val(null)
        $('#descripcion').val(null)
        $('#fechaInicio').val(null)
        $('#fechaEntrega').val(null)
        $('#material').val(null)
        $('#estado').val(null)
        $('#id').val(null)
        $('#op').val(null)

        for(let i = 1; i<=10; i++){
            $('#preg-'+i).val(null)
            $('#res-'+i).val(null)
        }

        $('#frm-examen').hide();


    }


    function Revisar(id, title){
        $('.title-revision').text(title)
        $('#form-tarea').hide()
        $('#form-examen').hide();
        $('#calificacion').val(null)
        actividadSeleccionada = id
        $.ajax({
            type: "GET",
            url: "{{route('actividades.estudiantes')}}",
            data: {"id":id},
            dataType: "json",
            success: function (res) {
                console.log(res)
                $('#select-matriculados').empty();
                $('#select-matriculados').append(`<option value="">Elija una opción</option>`)
                $.each(res, function (i, val) { 
                    $('#select-matriculados').append(`<option value="${val.id}">${val.nombre}</option>`)
                });                
                $('#md-revision').modal('toggle')
            }
        });


        
    }

    function CargarActividadRevision(id){       
        let data = {"id":id, "est":$('#select-matriculados').val()}
        console.log(data)
        $.ajax({
            method: "GET",
            url: "{{route('actividadesest.obtener')}}",
            data: data,
            dataType: "json",
            success: function (res) {
                console.log(res)
                if(res.data==null){
                    swal("Aviso", "El alumno no envio su actividad.", "warning")
                }else{
                    $('#idactest').val(res.data.id)
                    if(res.data.tipoActividadesId==2){                      
                        $('#form-examen').show();
                        let dataExamen = JSON.parse(res.data.productoEstudiante)
                        let examenDocente = JSON.parse(res.data.examen)
                        $('#form-examen').empty();
                        $.each(dataExamen, function (i, val) { 
                            $('#form-examen').append(`<p>${i+1}-. ${examenDocente[i].pregunta}</p><div class="width:100%; padding:1rem;"><input class="form-control" type="text" value="${val.respuesta}"/><p style="color:#bbb; font-weight:700; margin-left:1rem;">Respuesta: ${examenDocente[i].respuesta}</p></div>`);
                        });
                        $('#form-examen').show();
                    }else{
                        $('#frameTareas').attr('src', "{{asset('actividades/estudiantes/productos')}}/"+res.data.materialAdjunto);
                        $('#form-tarea').show()
                    }
                }
               
            }
        });      
    }

  


</script>

@endpush