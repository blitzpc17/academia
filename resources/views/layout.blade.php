<!DOCTYPE html>
<html lang="en">

<head>
    <title>COBAEP - @yield('title')</title>
   
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="COBAEP"/>
    <meta name="keywords" content="COBAEP, PLATAFORMA, ESTUDIANTES">
    <meta name="author" content="cachimirow" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

     <!-- Favicon icon -->
     <link rel="icon" href="{{asset('assets/images/logos/favicon-16x16.png')}}" type="image/x-icon">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="{{asset('assets/fonts/fontawesome/css/fontawesome-all.min.css')}}">
    <!-- animation css -->
    <link rel="stylesheet" href="{{asset('assets/plugins/animation/css/animate.min.css')}}">   
    <!-- vendor css -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
     <!-- data tables css -->
     <link rel="stylesheet" href="{{asset('assets/plugins/data-tables/css/datatables.min.css')}}">
     <!-- material datetimepicker css -->
    <link rel="stylesheet" href="{{asset('assets/plugins/material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}">


    <style>       

        .form-control:focus{
            border-color:#007E33;
            box-shadow:0 0 0 0.2rem rgba(0, 126, 51, 0.25);
        }
    </style>

    @stack('css')

</head>

<body>    

    <!-- [ navigation menu ] start -->
    <nav class="pcoded-navbar">
        <div class="navbar-wrapper">
            <div class="navbar-brand header-logo">
                <a href="{{route('admin.index')}}" class="b-brand">
                    <div class="b-bg">
                        <img src="{{asset('assets/images/logos/cobaep-dark.png')}}" alt="cobaep" style="width:24px; height:32px;" srcset="">
                    </div>
                    <span class="b-title">COBAEP</span>
                </a>
                <a class="mobile-menu" id="mobile-collapse" href="{{route('admin.index')}}"><span></span></a>
            </div>
            <div class="navbar-content scroll-div">
                <ul class="nav pcoded-inner-navbar">
                <li data-username="landing page" class="nav-item active"><a href="{{route('admin.index')}}" class="nav-link" target="_blank"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Inicio</span></a></li>
                    
                    @if($cuenta->tipo=='S')
                   <li class="nav-item pcoded-menu-caption">
                        <label>Administración</label>
                    </li>
                    <li data-username="dashboard Default Ecommerce CRM Analytics Crypto Project" class="nav-item pcoded-hasmenu  pcoded-trigger">
                        <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-bookmark"></i></span><span class="pcoded-mtext">Docentes</span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="{{route('docentes')}}" class="">Captura y consulta</a></li>
                            <li class=""><a href="{{route('asignacion')}}" class="">Asignacion de Materias</a></li>                           
                        </ul>
                    </li> 
                    <li data-username="dashboard Default Ecommerce CRM Analytics Crypto Project" class="nav-item pcoded-hasmenu  pcoded-trigger">
                        <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-bookmark"></i></span><span class="pcoded-mtext">Estudiantes</span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="{{route('estudiantes')}}" class="">Captura y consulta</a></li>     
                            <li class=""><a href="{{route('estudiantes')}}" class="">Asignacion de Materias</a></li>                          
                        </ul>
                    </li>
                    <li data-username="dashboard Default Ecommerce CRM Analytics Crypto Project" class="nav-item pcoded-hasmenu  pcoded-trigger">
                        <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">Usuarios</span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="{{route('usuarios')}}" class="">Captura y consulta</a></li>                             
                        </ul>
                    </li> 
                    <li class="nav-item pcoded-menu-caption">
                        <label>Catálogos</label>
                    </li>
                    <li data-username="dashboard Default Ecommerce CRM Analytics Crypto Project" class="nav-item pcoded-hasmenu  pcoded-trigger">
                        <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-book"></i></span><span class="pcoded-mtext">Catálogos</span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="{{route('materias')}}" class="">Materias</a></li>
                            <li class=""><a href="{{route('tipo')}}" class="">Tipo Actividades</a></li>                           
                        </ul>
                    </li>  
                    @elseif($cuenta->tipo=='D')

                    <li class="nav-item pcoded-menu-caption">
                        <label>Actividades</label>
                    </li>
                    <li data-username="dashboard Default Ecommerce CRM Analytics Crypto Project" class="nav-item pcoded-hasmenu  pcoded-trigger">
                        <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-check-square"></i></span><span class="pcoded-mtext">Gestión de actividades</span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="{{route('actividadesdoc')}}" class="">Captura y consulta</a></li>                         
                        </ul>
                    </li>  
                    @elseif($cuenta->tipo=='E')

                    <li class="nav-item pcoded-menu-caption">
                        <label>Actividades</label>
                    </li>
                    <li data-username="dashboard Default Ecommerce CRM Analytics Crypto Project" class="nav-item pcoded-hasmenu  pcoded-trigger">
                        <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-check-square"></i></span><span class="pcoded-mtext">Actividades</span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="{{route('actividadesest')}}" class="">Seguimiento</a></li>                        
                        </ul>
                    </li>  

                    @endif





                </ul>
            </div>
        </div>
    </nav>
    <!-- [ navigation menu ] end -->

    <!-- [ Header ] start -->
    <header class="navbar pcoded-header navbar-expand-lg navbar-light">
        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse1" href="#!"><span></span></a>
            <a href="index.html" class="b-brand">
               <div class="b-bg">
                   <i class="feather icon-trending-up"></i>
               </div>
               <span class="b-title">COBAEP</span>
           </a>
        </div>
        <a class="mobile-menu" id="mobile-header" href="#!">
            <i class="feather icon-more-horizontal"></i>
        </a>
        <div class="collapse navbar-collapse">            
            <ul class="navbar-nav ml-auto">
                <li>
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="icon feather icon-bell"></i></a>
                        <div class="dropdown-menu dropdown-menu-right notification">
                            <div class="noti-head">
                                <h6 class="d-inline-block m-b-0">Notificaciones</h6>
                                <div class="float-right">
                                    <a href="#!" class="m-r-10">mark as read</a>
                                    <a href="#!">clear all</a>
                                </div>
                            </div>
                            <ul class="noti-body">
                                <li class="n-title">
                                    <p class="m-b-0">NEW</p>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="assets/images/user/avatar-1.jpg" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>John Doe</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>30 min</span></p>
                                            <p>New ticket Added</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="n-title">
                                    <p class="m-b-0">EARLIER</p>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="assets/images/user/avatar-2.jpg" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>Joseph William</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>30 min</span></p>
                                            <p>Prchace New Theme and make payment</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="assets/images/user/avatar-3.jpg" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>Sara Soudein</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>30 min</span></p>
                                            <p>currently login</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="noti-footer">
                                <a href="#!">Mostrar todo</a>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="dropdown drp-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon feather icon-settings"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-notification">
                            <div class="pro-head">
                                <img src="{{asset('assets/images/user/avatar-2.jpg')}}" class="img-radius" alt="cobaep">
                                <span>{{$cuenta->nombre}}</span>
                                <a href="auth-signin.html" class="dud-logout" title="Logout">
                                    <i class="feather icon-log-out"></i>
                                </a>
                            </div>
                            <ul class="pro-body">                             
                                <li><a href="{{route('us.logout')}}" class="dropdown-item"><i class="feather icon-lock"></i> Cerrar sesión</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </header>
    <!-- [ Header ] end -->  

   

    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <!-- [ breadcrumb ] start -->

                    <!-- [ breadcrumb ] end -->
                    <div class="main-body">
                        <div class="page-wrapper">
                            <!-- [ Main Content ] start -->
                          
                            @section('contenido')


                            @show

                            <!-- [ Main Content ] end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->


    <!-- Required Js -->
    <script src="{{asset('assets/js/vendor-all.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery/js/jquery.min.js')}}"></script>

	<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>    
    <script src="{{asset('assets/js/pcoded.min.js')}}"></script>

     <!-- datatable Js -->
    <script src="{{asset('assets/plugins/data-tables/js/datatables.min.js')}}"></script>

    <!-- sweet alert Js -->
    <script src="{{asset('assets/plugins/sweetalert/js/sweetalert.min.js')}}"></script>
    <!-- material datetimepicker Js -->
    <script src="{{asset('assets/plugins/moment/js/moment.js')}}"></script>
    <script src="{{asset('assets/plugins/material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @stack('js')



    

</body>

</html>
