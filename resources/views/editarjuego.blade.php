<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar juego</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    @include('includes.colors')
    @include('includes.login')
    @include('includes.icon')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</head>

<body class="dark:bg-gray-800">
    @include('includes.navbar')
    <div class="row text-center justify-content-center">
        <div class="card-3d-wrap mx-auto" style=" height: 750px !important;">
            <div class="card-3d-wrapper">
                <div class="card-front">
                    <div class="center-wrap">
                        <h6>Editar datos de tu juego</h6>
                        <form action="{{action('GameController@editarjuego')}}" method='PUT'>
                            <div class="form-group">
                                <select class="form-select" name="id_juego" id="id_juego"
                                    aria-label="Default select example">
                                    <option selected>Selecciona el juego</option>
                                    @foreach ($juegos as $juego)
                                    @if($juego->id_publisher == $user->id)
                                    <option value="{{$juego->id}}">{{$juego->nombre}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="gamePrice">Precio</label>
                                <input type="number" class="form-control" id="gamePrice" name="gamePrice"
                                    placeholder="Ingresa un precio">
                            </div>
                            <div class="form-group">
                                <label for="gameDiscount">Descuento</label>
                                <input type="number" class="form-control" id="gameDiscount" name="gameDiscount">
                                <small id="gameDiscountHelp" class="form-text text-muted">Descuento del 0 al 100</small>
                            </div>
                            <div class="form-group">
                                <label for="gameImage">Imagen</label>
                                <input type="url" class="form-control" id="gameImage" name="gameImage"
                                    placeholder="Ingresa url de tu imagen">
                            </div>
                            <div class="form-group">
                                <label for="gameDescription">Descripción</label>
                                <input type="text" class="form-control" id="gameDescription" name="gameDescription"
                                    placeholder="Ingresa una descripcion">
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
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>