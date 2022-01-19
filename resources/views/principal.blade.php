<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    @include('includes.colors')
    @include('includes.login')
</head>

<body>
    @include('includes.navbar')
    <section class="mt-5">
        <div class="container ">
            <h4 class="mb-5">Elige un juego:</h4>
            <div class="row text-center mb-4">
                @foreach ($juegos as $juego)
                <div class="col-4 d-flex justify-content-center my-3">
                    <div class="card-3d-wrap mx-auto" style=" height: 550px !important;">
                        <div class="card-3d-wrapper">
                            <div class="card-front">
                                <div class="center-wrap">

                                    <img src="{{$juego->imagen}}" class="card-img-top" alt="Imagen de curso">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$juego->nombre}}</h5>
                                        <p class="card-text">Precio: {{$juego->precio}}$</p>
                                        <a href="/course/{{ $juego->id }}" class="btn btn-primary">Ver mas información</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('includes.footer')
</body>

</html>