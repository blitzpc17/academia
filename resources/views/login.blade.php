<!DOCTYPE html>
<html lang="en">

<head>
    <title>COBAEP - Iniciar sesión</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="author" content="crazysoft" />

    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('assets/images/logos/favicon-16x16.png')}}" type="image/x-icon">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="{{asset('assets/fonts/fontawesome/css/fontawesome-all.min.css')}}">
    <!-- animation css -->
    <link rel="stylesheet" href="{{asset('assets/plugins/animation/css/animate.min.css')}}">
    <!-- vendor css -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    <style>
        .auth-content .card{
            height:auto;
        }

        .auth-content .card h3{
            color:#007E33;
        }

        .auth-content .card button{
            background: #007E33;
            border:none;
        }

        .auth-content .card input:focus{
            border-color:#007E33;
            box-shadow:0 0 0 0.2rem rgba(0, 126, 51, 0.25);
        }
    </style>

</head>

<body>
    <div class="auth-wrapper aut-bg-img">
        <div class="auth-content">
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-4">
                        <img src="{{asset('assets/images/logos/cobaep-logo.png')}}" alt="cobaep" srcset="">
                    </div>
                    <h3 class="mb-4">Iniciar sesión</h3>                   
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Correo Electronico">
                    </div>
                    <div class="input-group mb-4">
                        <input type="password" class="form-control" placeholder="Contraseña">
                    </div>
                    <button class="btn btn-primary shadow-2 mb-4">Acceder</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Required Js -->
    <script src="{{asset('assets/js/vendor-all.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/pcoded.min.js')}}"></script>

</body>
</html>
