<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi cuenta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    @include('includes.colors')
    @include('includes.icon')
    @include('includes.login')
</head>

<body>
    @include('includes.navbar')
    <div class="row py-5 px-4">
        <div class="col-xl-4 col-md-6 col-sm-10 mx-auto">

            <!-- Profile widget -->
            <div class="bg-white shadow rounded overflow-hidden">
                <div class="px-4 pt-0 pb-4 dark:bg-gray-900">
                    <div class="media align-items-end profile-header">
                        <div class="profile mr-3"><img src="https://i.gyazo.com/bcdf65ea96a1bf49174bc28b3935cad6.png"
                                alt="..." width="130" class="rounded mb-2 "><a 
                                class="btn btn-dark btn-sm btn-block position-absolute top-0 end-0" href="/editarusuario">Editar datos</a>
                        </div>
                    </div>
                </div>

                <div class="bg-light p-4 d-flex justify-content-end text-center">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <h5 class="font-weight-bold mb-0 d-block"></h5><small class="text-muted"> <i
                                    class="fa fa-picture-o mr-1"></i></small>
                        </li>
                        <li class="list-inline-item">
                            <h5 class="font-weight-bold mb-0 d-block"></h5><small class="text-muted"> <i
                                    class="fa fa-user-circle-o mr-1"></i></small>
                        </li>
                    </ul>
                </div>

                <div class="py-4 px-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="mb-0 text-dark">Información personal</h5>
                    </div>
                    <div class="row">
                        <p class="text-center text-dark">Usuario: {{$user->nombre}}</p>

                        @if ($user->id_rol == 1)
                        <p class="text-center text-dark">Rol: Usuario</p>
                        @elseif ($user->id_rol == 2)
                        <p class="text-center text-dark">Rol: Publisher</p>
                        @elseif ($user->id_rol == 3)
                        <p class="text-center text-dark">Rol: Admin</p>
                        @endif
                        <p class="text-center text-dark">Correo: {{$user->email}}</p>
                        <p class="text-center text-dark">Fecha de nacimiento: {{$user->fecha_de_nacimiento}}</p>
                        <p class="text-center text-dark">Divisa: {{$moneda->Nombre}}</p>
                        <p class="text-center text-dark">Coins: {{$user->moneda}}</p>
                    </div>
                    <div class="py-4">
                        <h5 class="mb-3 text-dark">Comentarios</h5>
                        @foreach ($comentarios as $comentario)
                        <div class="p-4 bg-light rounded shadow-sm mt-3">
                            <p class="font-italic mb-0 text-end text-dark">{{$comentario->fecha_de_creacion}}. </p>
                            @foreach ($juegos as $juego)
                            @if ($comentario->id_juego == $juego->id)
                            <p class="font-italic mb-0 text-end text-dark">{{$juego->nombre}}. </p>
                            @endif
                            @endforeach
                            <p class="font-italic mb-0 text-dark">{{$comentario->texto}}. </p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div><!-- End profile widget -->

        </div>
    </div>
    @include('includes.footer')
</body>

</html>