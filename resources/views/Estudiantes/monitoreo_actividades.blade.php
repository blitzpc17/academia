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
        flex-wrap: wrap;
        background:white;
        border: 1px solid #ddd;
        border-radius:10px;
        padding:1rem;        
    }

    .actividades .item .detalle h3{
        color:#007E33;
        font-weight:600;
    }
    .actividades .item .detalle{
        width:85%;
        height:135px;
        display:flex;
        flex-direction:column;
    }

    .actividades .item .acciones{
        width:15%;
        display:flex;
        align-items:center;
        justify-content:center;
        border-left: 1px solid #007E33;
    }

    .actividades .item .datos-detalle{
        width:100%;
        height:85px;
        display:flex;      
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }

    .actividades .item .datos-detalle span{    
        color:#757575;
        font-weight:700;
    }

    .actividades .item .datos-detalle p{ 
        width:33%;      
        color:#a1887f;
        font-weight:700;
        margin:0;
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

                    @foreach ($actividades as $item)
                        <div class="item">                        
                            <div class="detalle">
                            <h3>{{$item->titulo}}</h3>
                                <p>{{$item->descripcion}}</p>                                                     
                            </div>
                            <div class="acciones">
                                @if($item->tipoActividadesId==1 && $item->estadoId == 1)
                                    <button onclick="subir({{$item->id}})" class="btn btn-icon btn-primary"><i class="feather icon-upload"></i></button>  
                                @elseif($item->estadoEntregaId==null && $item->estadoId == 1)
                                    <a href="{{route('actividadesest.examen')}}?id={{$item->id}}" class="btn btn-icon btn-primary"><i class="fas fa-edit"></i></a>  
                                @else
                                <p style="color:red;">Entrega cerrada</p>
                                @endif
                            </div>
                            <div class="datos-detalle">
                                <p><span>Materia:</span> {{$item->materia}}</p>                               
                                <p><span>Fech. Publicación:</span> {{date_format(date_create($item->fechaInicio),"d-m-Y H:i")}} hrs</p>
                                <p><span>Tipo actividad:</span> {{$item->tipo}}</p>
                                <p><span>Estado:</span> {{$item->estadoEntrega}}</p>
                                <p><span>Fech. Lim. Entrega:</span> {{date_format(date_create($item->fechaEntrega),"d-m-Y H:i")}} hrs</p>  
                                <p><span>Material Adjunto:
                                    @if($item->materialAdjunto!=null)
                                    <a class="btn btn-icon btn-info" href="{{asset('actividades/docentes/materialapoyo')}}/{{$item->materialAdjunto}}"><i class="fas fa-file"></i></a>
                                    @else
                                    <span></span>
                                    @endif
                                </p>
                            </div> 
                        </div>
                    @endforeach

                    

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
                        <input id="id" type="hidden" name="id">
                        <input id="estudianteid" type="hidden" name="estudianteid" value="{{$cuenta->personasId}}">
                        <div class="form-group">
                            <label for="">Adjuntar archivo</label>
                            <input class="form-control" type="file" id="material" name="material">
                        </div>     
                        <div class="form-group">
                          <label for="">Comentarios</label>
                          <textarea class="form-control" name="observaciones" id="observaciones" rows="5"></textarea>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Subir</button>
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

        $('#frm-registro').on('submit', function (e) {
             e.preventDefault();
             save($('#op'));

        });

    });

    function subir(id){
        LimpiarFormulario();
        $('.modal-title').text('Subir actividad')       
        $('#id').val(id)
        $('#md-registro').modal('toggle')
    }

    function save(op){     

        let data = new FormData();
        data.append('estudiante', $('#estudianteid').val())
        data.append('observaciones', $('#observaciones').val())
        data.append('material', $('#material')[0].files[0]==undefined?"": $('#material')[0].files[0])
        data.append('id', $('#id').val())

        

        $.ajax({
            method: "POST",
            url: "{{route('actividadesest.save')}}",
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (res) {
                if(res.code==200){
                    swal("Aviso", res.msj, "success").then(()=>{  
                        window.location.replace("{{route('actividadesest')}}");
                    });
                  
                }else{
                    swal("Advertencia", "Ocurrio un problema mientras se actualizaba el registro. Verifique su información e intentelo nuevamente", "warning");
                }
            }
        });

    } 

    function LimpiarFormulario(){
        $('#observaciones').val(null)
        $('#material').val(null)
        $('#id').val(null)
    }

  


</script>

@endpush