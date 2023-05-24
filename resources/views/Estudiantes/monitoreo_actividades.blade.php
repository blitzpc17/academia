@extends('layout')


@section('title', 'Gestión de actividades')

@push('css')

<style>

    .actividades{
        width:100%;
        height:75vh;
        background:#f1f1f1;
        border-radius:15px;
        overflow-y:auto;
        padding:0.65rem;
    }

    .actividades .item{
        height:250px;
        display:flex;
        background:white;
        border: 1px solid #ddd;
        border-radius:10px;
        padding:1rem;        
    }

    .actividades .item .detalle{
        width:65%;
        height:100%;
        display:flex;
        flex-direction:column;
    }



    .actividades .item .detalle h3{
        font-weight:700;
    }

    .actividades .item .detalle p{
        color:#999;
        font-weight:600;
    }


    .actividades .item .detalle .datos-actividad, 
    .actividades .item .detalle .datos-detalle
    {
        width:100%;
        height:180px;
    }


    .actividades .item .detalle .datos-detalle{
        display:flex; 
        flex-wrap: wrap;  
        height:70px;     
    }
    .actividades .item .detalle .datos-detalle p{
        width:50%;
        color:#999;  
        font-weight:700;        
    }
    .actividades .item .detalle .datos-detalle p span{
        color:black;
          
    }

    .actividades .item .acciones{
        width:35%;
        height:100%;
        display:flex;
        flex-direction:column;
        justify-content:center;
        align-items:center;
    }

    .actividades .item .acciones .datos-detalle{
        height:70px;
        display:flex; 
        flex-direction:column;
        margin-top: 70px;
    }
    .actividades .item .acciones .datos-detalle p{
        color:#999;  
        font-weight:700;
        margin-bottom:0;        
    }

    .actividades .item .acciones .datos-detalle span{
        color:black;          
    }


    


</style>

@endpush


@section('contenido')


<div class="row">

    <div class="col-sm-12">

        <div class="card">

            <div class="card-header">
                <h3>Monitoreo de actividades</h3>
            </div>

            <div class="card-body">


                <div class="actividades">

                    <div class="item">
                        <div class="detalle">
                            <div class="datos-actividad">
                                <h3>titulo</h3>
                                <p>Descripcion</p>
                            </div>
                            <div class="datos-detalle">
                                <p><span>Materia:</span> 20-05-2023 03:31</p>                               
                                <p><span>Fecha Publicación:</span> 20-05-2023 03:31</p>
                                <p><span>Fecha Limite Entrega:</span> 20-05-2023 03:31</p>
                                <p><span>Estado:</span>Pendiente</p>
                                <p><span>Fecha Subida:</span> 20-05-2023 03:31</p>
                                <p><span>Calificación:</span> 20-05-2023 03:31</p>
                            </div>
                        </div>
                        <div class="acciones">
                            <button class="btn btn-icon btn-primary"><i class="feather icon-upload"></i></button>                           
                        </div>
                        

                    </div>




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

        $('#md-registro').modal('toggle')
    }

    function SetMaterial(nombre){
        $('#archivo').empty();
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
    }

  


</script>

@endpush