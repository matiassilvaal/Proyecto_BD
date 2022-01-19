<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicar videojuego</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    @include('includes.colors')
    @include('includes.login')
    @include('includes.icon')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</head>

<body class="dark:bg-gray-800">
    @include('includes.navbar')
    <div class="row text-center justify-content-center">
        <div class="card-3d-wrap mx-auto" style=" height: 1500px !important;">
            <div class="card-3d-wrapper">
                <div class="card-front">
                    <div class="center-wrap">
                        <form>
                            <div class="form-group">
                                <label for="gameName" class="mt-3">Nombre videojuego</label>
                                <input type="text" class="form-control" id="gameName" name="gameName" 
                                aria-describedby="gameHelp" placeholder="Ingresa nombre de tu videojuego">
                                <small id="gameHelp" class="form-text text-muted">Máximo 500 caracteres</small>
                            </div>
                            <div class="form-group">
                                <label for="gamePrice">Precio</label>
                                <input type="number" class="form-control" id="gamePrice" name="gamePrice"
                                placeholder="29990">
                            </div>
                            <div class="form-group">
                                <label for="gameDate">Fecha de publicación</label>
                                <input type="date" class="form-control" id="gameDate" name="gameDate">
                            </div>
                            <div class="form-group">
                                <label for="gameImage">Imagen</label>
                                <input type="url" class="form-control" id="gameImage" name="gameDate"
                                placeholder="Ingresa url de tu imagen">
                            </div>
                            <div class="form-group mt-3">
                                <label for="gameDescription">Descripción</label>
                                <textarea rows="4" cols="46" name="gameDescription" form="usrform"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="gameDownload">Link de descarga juego</label>
                                <input type="url" class="form-control" id="gameDownload" name="gameDownload"
                                placeholder="Ingresa url de descarga">
                            </div>
                            <div class="form-group">
                                <label for="gameDemo">Link de descarga demo</label>
                                <input type="url" class="form-control" id="gameDemo" name="gameDemo"
                                placeholder="Ingresa url de la demo">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="reqOS">Sistema Operativo</label>
                                <input type="text" class="form-control" id="reqOS" name="reqOS"
                                placeholder="Ingresa Sistema Operativo necesario">
                            </div>
                            <div class="form-group">
                                <label for="reqCPU">CPU</label>
                                <input type="text" class="form-control" id="reqCPU" name="reqCPU"
                                placeholder="Ingresa CPU mínimo">
                            </div>
                            <div class="form-group">
                                <label for="reqRAM">RAM</label>
                                <input type="text" class="form-control" id="reqRAM" name="reqRAM"
                                placeholder="Ingresa RAM mínima">
                            </div>
                            <div class="form-group">
                                <label for="reqGPU">GPU</label>
                                <input type="text" class="form-control" id="reqGPU" name="reqGPU"
                                placeholder="Ingresa GPU mínima">
                            </div>
                            <div class="form-group">
                                <label for="reqDX">DirectX</label>
                                <input type="text" class="form-control" id="reqDX" name="reqDX"
                                placeholder="Ingresa versión de DirectX necesaria">
                            </div>
                            <div class="form-group">
                                <label for="reqRED">Banda ancha</label>
                                <input type="text" class="form-control" id="reqRED" name="reqRED"
                                placeholder="Ingresa Banda ancha necesaria">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="reqHDD">Espacio de almacenamiento</label>
                                <input type="text" class="form-control" id="reqHDD" name="reqHDD"
                                placeholder="Ingresa tamaño del juego">
                            </div>
                            <br>
                            <label for="direccion">País del juego</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Seleccionar región a la que pertenece el juego</option>
                                @foreach ($direcciones as $direccion)
                                <option value="{{$direccion->id}}">{{$direccion->pais}}</option>
                                @endforeach
                            </select>
                            <label for="ageRes">Restricción de edad</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Restricción de edad de tu juego</option>
                                <option value="0">Para usuarios de 3 años o más</option>
                                <option value="1">Para usuarios de 7 años o más</option>
                                <option value="2">Para usuarios de 13 años o más</option>
                                <option value="3">Para usuarios de 16 años o más</option>
                                <option value="4">Para usuarios de 18 años o más</option>
                            </select> 
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>