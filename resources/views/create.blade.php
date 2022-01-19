<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create - CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    @include('includes.colors')
    @include('includes.login')
    @include('includes.icon')
</head>

<body>
    @include('includes.navbar')
    @include('includes.volveradmin')
    <div class="row text-center justify-content-center ">
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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="gamesModalLabel">Crear juego</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group ">
                        <label for="gameName" class="mt-3">Nombre videojuego</label>
                        <input type="text" class="form-control" id="gameName" aria-describedby="gameHelp" placeholder="Ingresa nombre de tu videojuego">
                        <small id="gameHelp" class="form-text text-muted">Máximo 500 caracteres</small>
                    </div>
                    <div class="form-group">
                        <label for="gamePrice">Precio</label>
                        <input type="number" class="form-control" id="gamePrice" placeholder="29990">
                    </div>
                    <div class="form-group">
                        <label for="gameDate">Fecha de publicación</label>
                        <input type="date" class="form-control" id="gameDate">
                    </div>
                    <div class="form-group">
                        <label for="gameImage">Imagen</label>
                        <input type="url" class="form-control" id="gameImage" placeholder="Ingresa url de tu imagen">
                    </div>
                    <label for="gameDescription">Descripción</label>
                    <div class="form-group mt-3">
                        <textarea rows="4" cols="46" name="gameDescription" form="usrform"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="gameDownload">Link de descarga juego</label>
                        <input type="url" class="form-control" id="gameDownload" placeholder="Ingresa url de descarga">
                    </div>
                    <div class="form-group">
                        <label for="gameDemo">Link de descarga demo</label>
                        <input type="url" class="form-control" id="gameDemo" placeholder="Ingresa url de la demo">
                    </div>
                    <label for="gameRequirements">Requisitos del Juego</label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Click aquí para ver requisitos</option>
                        @foreach ($requisitos as $requisito)
                        <option value=" ">{{$requisito->CPU}} - {{$requisito->RAM}} GB</option>
                        @endforeach
                    </select>
                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <div class="modal-footer">
    </div>
    </div>
    </div>
    </div>
    <div class="modal fade" id="usersModal" tabindex="-1" aria-labelledby="usersModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="usersModalLabel">Crear usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group ">
                        <label for="userName" class="mt-3">Nombre Usuario</label>
                        <input type="text" class="form-control" id="userName" aria-describedby="userHelp" placeholder="Ingresa nombre del Usuario">
                        <small id="userHelp" class="form-text text-muted">Máximo 200 caracteres</small>
                    </div>
                    <div class="form-group">
                        <label for="userEmail">Correo</label>
                        <input type="text" class="form-control" id="userEmail" placeholder="correo@ejemplo.com">
                    </div>
                    <div class="form-group">
                        <label for="userBirth">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="userBirth">
                    </div>
                    <label for="userAddress">Pais Usuario</label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Click aquí para ver paises</option>
                        @foreach ($direcciones as $direccion)
                        <option value=" ">{{$direccion->pais}} </option>
                        @endforeach
                    </div>
                    <label for="gameDescription">Descripción</label>
                    <div class="form-group mt-3">
                        <textarea rows="4" cols="46" name="gameDescription" form="usrform"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="gameDownload">Link de descarga juego</label>
                        <input type="url" class="form-control" id="gameDownload" placeholder="Ingresa url de descarga">
                    </div>
                    <div class="form-group">
                        <label for="gameDemo">Link de descarga demo</label>
                        <input type="url" class="form-control" id="gameDemo" placeholder="Ingresa url de la demo">
                    </div>
                    <label for="gameRequirements">Requisitos del Juego</label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Click aquí para ver requisitos</option>
                        @foreach ($requisitos as $requisito)
                        <option value=" ">{{$requisito->CPU}} - {{$requisito->RAM}} GB</option>
                        @endforeach
                    </select>
                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="commentsModal" tabindex="-1" aria-labelledby="commentsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="commentsModalLabel">Crear comentario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Acá van los formularios pa crear comentarios
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="libraryModal" tabindex="-1" aria-labelledby="libraryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="libraryModalLabel">Agregar juego a libreria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Acá van los formularios pa la libreria agregar juego
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