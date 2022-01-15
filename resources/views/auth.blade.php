<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autenticación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    @include('includes.colors')
    @include('includes.login')
</head>

<body class="dark:bg-gray-800">
    @include('includes.navbar')

    <div class="section">
        <div class="container fixed-top">
            <div class="row full-height justify-content-ñle">
                <div class="col-12 text-center align-self-center py-5">
                    <div class="section pt-5 pt-sm-3 text-center">
                        <h6 class="mb-0 pb-3 dark:text-white-border"><span>Login </span><span>Registrarse</span></h6>
                        <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
                        <label for="reg-log"></label>
                        <div class="card-3d-wrap mx-auto">

                            <div class="card-3d-wrapper">
                                <div class="card-front">
                                    <div class="center-wrap">

                                        <form method="GET" action="{{action('UserController@authenticate')}}">
                                            <div class="section text-center">
                                                <h4 class="mb-4 pb-3">Login</h4>
                                                @if($errors->any())
                                                <h6>{{$errors->first()}}</h6>
                                                @endif
                                                <div class="form-group">
                                                    <input type="email" name="email" class="form-style"
                                                        placeholder="ejemplo@hotmail.com" id="logemail"
                                                        autocomplete="off" value="">
                                                    <i class="input-icon uil uil-at"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="password" name="password" class="form-style"
                                                        placeholder="*******" id="logpass" autocomplete="off" value="">
                                                    <i class="input-icon uil uil-lock-alt"></i>
                                                </div>
                                                <button type="submit" class="btn mt-4">ingresar</button>
                                                <p class="mb-0 mt-4 text-center"><a href="#0" class="link">Olvidaste tu
                                                        contraseña?</a></p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="card-back">
                                    <div class="center-wrap">
                                        <div class="section text-center">
                                            <h4 class="mb-4 pb-3">Registrarse</h4>
                                            <div class="form-group">
                                                <input type="text" name="logname" class="form-style"
                                                    placeholder="Usuario" id="logname" autocomplete="off">
                                                <i class="input-icon uil uil-user"></i>
                                            </div>
                                            <div class="form-group mt-2">
                                                <input type="email" name="email" class="form-style"
                                                    placeholder="ejemplo@hotmail.com" id="regemail" autocomplete="off">
                                                <i class="input-icon uil uil-at"></i>
                                            </div>
                                            <div class="form-group mt-2">
                                                <input type="password" name="password" class="form-style"
                                                    placeholder="*******" id="regpass" autocomplete="off">
                                                <i class="input-icon uil uil-lock-alt"></i>
                                            </div>
                                            <a class="btn mt-4">ingresar</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('includes.footer')
</body>

</html>