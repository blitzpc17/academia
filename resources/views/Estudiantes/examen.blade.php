@extends('layout')


@section('title', $examen->titulo)

@push('css')

<style>
    


</style>

@endpush


@section('contenido')


<div class="row">

    <div class="col-sm-12">

        <div class="card">

            <div class="card-header">
                <h3>{{$examen->titulo}}</h3>
            </div>

            <div class="card-body">

            <p>{{$examen->descripcion}}</p>


            <form id="frm-registro">

                <input id="id" type="hidden" name="id" value="{{$examen->id}}">
                @foreach ($preguntas as $preg )

                    <p>{{$loop->index + 1}}.- {{$preg->pregunta}}</p>
                    <input type="text" id="res-{{$loop->index + 1}}" name="res-{{$loop->index + 1}}" class="form-control">
                    
                @endforeach

                <br>
                <br>
                <hr>
                <br>

                <center>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Enviar</button>
                </center>
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
             save();

        });

    });

    function save(){     

        let data = new FormData();
        data.append('estudiante', "{{$cuenta->personasId}}")
        data.append('id', $('#id').val())

        let examen=[];
            for(let i = 1; i<=10; i++){
                if($('#res-'+i).val()==null|| $('#res'+i).val()=="")continue;

                examen.push({"id":i,"pregunta": $('#preg-'+i).val(), "respuesta": $("#res-"+i).val()})
            }
            data.append('examen', JSON.stringify(examen))

        

        $.ajax({
            method: "POST",
            url: "{{route('actividadesest.examen.save')}}",
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

  


</script>

@endpush