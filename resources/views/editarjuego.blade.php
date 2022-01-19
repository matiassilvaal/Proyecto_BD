<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar juego</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    @include('includes.colors')
    @include('includes.login')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</head>

<body class="dark:bg-gray-800">
    @include('includes.navbar')
    <div class="row text-center justify-content-center">
        <div class="card-3d-wrap mx-auto" style=" height: 680px !important;">
            <div class="card-3d-wrapper">
                <div class="card-front">
                    <div class="center-wrap">
                        <h6>Editar datos de tu juego</h6>
                        <form>
                            <div class="form-group">
                                <label for="gamePrice">Precio</label>
                                <input type="number" class="form-control" id="gamePrice" name="gamePrice"
                                placeholder="29990">
                            </div>
                            <div class="form-group">
                                <label for="gameDiscount">Descuento</label>
                                <input type="number" class="form-control" id="gameDiscount" name="gameDiscount">
                                <small id="gameDiscountHelp" class="form-text text-muted">Descuento del 0 al 100</small>
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
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>