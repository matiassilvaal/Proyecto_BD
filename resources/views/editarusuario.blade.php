<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar datos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </script>
    @include('includes.colors')
    @include('includes.login')
</head>

<body>
    @include('includes.navbar')
    <div class="row text-center justify-content-center">
        <div class="card-3d-wrap mx-auto" style=" height: 450px !important;">
            <div class="card-3d-wrapper">
                <div class="card-front">
                    <div class="center-wrap">
                        <form method="PUT" action="{{action('UserController@actualizaruser')}}">
                            @if($errors->any())
                            <h6>{{$errors->first()}}</h6>
                            @endif
                            <div class="form-group">
                                <label for="gameName" class="mt-3">Nombre de usuario</label>
                                <input type="text" class="form-control" id="nombre" name="nombre"
                                    aria-describedby="gameHelp" placeholder="Ingresa nuevo nombre de usuario"
                                    autocomplete="off">
                                <small id="gameHelp" class="form-text text-muted">Minimo 4 caracteres</small>
                            </div>
                            <div class="form-group">
                                <label for="gamePrice">Correo</label>
                                <input type="email" name="email" class="form-style" placeholder="ejemplo@hotmail.com"
                                    id="logemail" autocomplete="off" value="">
                            </div>
                            <div class="form-group">
                                <label for="gameDate">Contraseña</label>
                                <input type="password" name="password" class="form-style" placeholder="*******"
                                    id="logpass" autocomplete="off" value="">
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('includes.footer')
</body>

</html>