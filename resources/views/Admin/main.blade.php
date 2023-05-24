@extends('layout')


@push('css')

<style>
    .card-body .welcome{
        width:100%;
        display:flex;
    }

    .card-body .welcome img{
        width:250px;
        height:250px;
    }

    .card-body .welcome div h5,
    .card-body .welcome div p{
        color:#4B515D!important;
        font-weight:600!important;
    }

    .card-body .welcome div h3,
    .card-body .welcome div span{
        color:#3e2723!important;
        font-weight:700!important;
    }

</style>
    
@endpush


@section('title', 'Inicio')



@section('contenido')

<div class="card">
    <div class="card-body">

        <div class="welcome">
            <img src="{{asset('assets/images/logos/cobaep-full.jpg')}}" alt="logo" srcset="">
            <div>
                <h5>Bienvenido {{$cuenta->nombreTipo}}</h5>
                <h3>{{$cuenta->nombre}}</h3>
                <p>{{$cuenta->nombreTipo}}</p>
                <span>Fecha acceso: {{date('d-m-y H:i:s')}}</span>
            </div>
        </div>

    </div>
</div>


@endsection