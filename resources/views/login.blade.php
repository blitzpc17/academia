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

        .form-control:focus{
            border-color:#007E33;
            box-shadow:0 0 0 0.2rem rgba(0, 126, 51, 0.25);
        }

        span{
            display:block;
            width:100%;
            color:red;
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
                    <form action="{{route('us.auth')}}" method="post">
                        @csrf               
                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control" value="{{old('email')}}" placeholder="Correo Electronico">
                        </div>
                        @error('email') 
                            <span style="margin-top:-0.85rem;">{{$errors->first('email')}}</span>
                        @enderror
                        <div class="input-group mb-4">
                            <input  name="password" type="password" class="form-control" value="{{old('password')}}" placeholder="Contraseña">
                        </div>
                        @error('password') 
                            <span style="margin-top:-1.35rem;">{{$errors->first('password')}}</span>
                        @enderror
                        <button type="submit" class="btn btn-primary shadow-2 mb-4">Acceder</button>
                    </form>
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
