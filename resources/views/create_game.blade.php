<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi cuenta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    @include('includes.colors')
    @include('includes.login')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</head>
<body class="dark:bg-gray-800">
@include('includes.navbar')

 <div class="container-fluid w-25  dark:bg-gray-900 pb-50" style="opacity: 0.95">
        <div class="row text-center justify-content-center">
            <form>
                <div class="form-group">
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
                <div class="form-group mt-3">
                    <label for="gameDescription">Descripción</label>
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
                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>