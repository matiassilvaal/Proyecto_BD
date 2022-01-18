<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read - CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    @include('includes.colors')
    @include('includes.login')
</head>

<body>
    @include('includes.navbar')
    @include('includes.volveradmin')
    <div class="row text-center justify-content-center">
        <div class="card-3d-wrap mx-auto" style=" height: 420px !important;">
            <div class="card-3d-wrapper">
                <div class="card-front">
                    <div class="center-wrap">
                        <a class="disabled btn btn-primary ">Administración de la pagina</a>
                        <ul class="list-group bottom-50 align-items-center">
                            <a class="list-group-item btn btn-primary mt-3 mb-3 w-50" data-bs-toggle="modal" data-bs-target="#gamesModal">Juegos</a>
                            <a class="list-group-item btn btn-primary mt-3 mb-3 w-50" data-bs-toggle="modal" data-bs-target="#usersModal">Usuarios</a>
                            <a class="list-group-item btn btn-primary mt-3 mb-3 w-50" data-bs-toggle="modal" data-bs-target="#commentsModal">Comentarios</a>
                            <a class="list-group-item btn btn-primary mt-3 mb-3 w-50" data-bs-toggle="modal" data-bs-target="#libraryModal">Biblioteca</a>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="gamesModal" tabindex="-1" aria-labelledby="gamesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="gamesModalLabel">Leer juegos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Publicador</th>
                                <th scope="col">Requisitos</th>
                                <th scope="col">Ubicacion</th>
                                <th scope="col">Restriccion</th>
                                <th scope="col">Fecha de Lanzamiento</th>
                                <th scope="col">Descuento</th>
                                <th scope="col">Imagen</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Descarga</th>
                                <th scope="col">Demo</th>
                                <th scope="col">Soft Delete?</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($juegos as $game)
                            <tr>
                                <th scope="row">{{$game->id}}</th>
                                <td>{{$game->nombre}}</td>
                                <td>{{$game->precio}}</td>
                                <td>{{$game->id_publisher}}</td>
                                <td>{{$game->id_requisito}}</td>
                                <td>{{$game->id_ubicacion}}</td>
                                <td>{{$game->id_restriccion}}</td>
                                <td>{{$game->fecha_de_lanzamiento}}</td>
                                <td>{{$game->descuento}}</td>
                                <td>{{$game->imagen}}</td>
                                <td>{{$game->descripcion}}</td>
                                <td>{{$game->descarga}}</td>
                                <td>{{$game->demo}}</td>
                                <td>{{$game->soft}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="usersModal" tabindex="-1" role="dialog" aria-labelledby="usersModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Rol</th>
                                <th scope="col">Fecha de Nacimiento</th>
                                <th scope="col">Dirección</th>
                                <th scope="col">Moneda</th>
                                <th scope="col">Billetera</th>
                                <th scope="col">Contraseña</th>
                                <th scope="col">Soft Delete?</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $user)
                            <tr>
                                <th scope="row">{{$user->id}}</th>
                                <td>{{$user->nombre}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->rol}}</td>
                                <td>{{$user->fecha_de_nacimiento}}</td>
                                <td>{{$user->dirección}}</td>
                                <td>{{$user->moneda}}</td>
                                <td>{{$user->billetera}}</td>
                                <td>{{$user->contraseña}}</td>
                                <td>{{$user->soft}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="commentsModal" tabindex="-1" aria-labelledby="commentsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="commentsModalLabel">Leer comentario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Juego</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Texto</th>
                                <th scope="col">Fecha de Creación</th>
                                <th scope="col">Soft Delete?</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comentarios as $comment)
                            <tr>
                                <th scope="row">{{$comment->id}}</th>
                                <td>{{$comment->id_juego}}</td>
                                <td>{{$comment->id_usuario}}</td>
                                <td>{{$comment->id_comment_type}}</td>
                                <td>{{$comment->texto}}</td>
                                <td>{{$comment->fecha_de_creacion}}</td>
                                <td>{{$comment->soft}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="libraryModal" tabindex="-1" aria-labelledby="libraryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="libraryModalLabel">Leer libreria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Juego</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Horas Jugadas</th>
                                <th scope="col">Soft Delete?</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bibliotecas as $lib)
                            <tr>
                                <th scope="row">{{$lib->id}}</th>
                                <td>{{$lib->id_juego}}</td>
                                <td>{{$lib->id_usuario}}</td>
                                <td>{{$lib->horas_jugadas}}</td>
                                <td>{{$lib->soft}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    @include('includes.footer')
</body>

</html>