<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina principal</title>
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
    <section class="mt-5">
        <div class="container ">
            <h1 class="text-dark">Bienvenido a la tienda!</h1>
            <div class="row text-center mb-4">
                @foreach ($juegos as $juego)
                <div class="col-4 d-flex justify-content-center my-3">
                    <div class="card-3d-wrap mx-auto" style="height: 1100px !important;">
                        <div class="card-3d-wrapper">
                            <div class="card-front">
                                <div class="center-wrap">

                                    <img src="{{$juego->imagen}}" class="card-img-top" alt="Imagen">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$juego->nombre}}</h5>
                                        <p class="card-text">Precio: ${{$juego->precio}}</p>
                                        @if($juego->descuento > 0)
                                        <p class="card-text">Descuento: {{$juego->descuento}}%</p>
                                        @else
                                        <p class="card-text">Descuento: No</p>
                                        @endif
                                        @foreach ($usuarios as $usuario)
                                        @if($usuario->id == $juego->id_publisher)
                                        <p class="card-text">Publisher: {{$usuario->nombre}}</p>
                                        <p class="card-text">Descripcion: {{$juego->descripcion}}</p>
                                        @endif
                                        @endforeach
                                        @foreach ($requisitos as $requisito)
                                        @if($requisito->id == $juego->id_requisito)
                                        <p class="card-text">SO: {{$requisito->SO}}</p>
                                        <p class="card-text">CPU: {{$requisito->CPU}}</p>
                                        <p class="card-text">RAM: {{$requisito->RAM}} GB</p>
                                        <p class="card-text">GPU: {{$requisito->GPU}}</p>
                                        <p class="card-text">DirectX: {{$requisito->DirectX}}</p>
                                        <p class="card-text">RED: {{$requisito->RED}}</p>
                                        <p class="card-text">Uso de disco: {{$requisito->Uso_de_disco}} GB</p>
                                        @endif
                                        @endforeach
                                        <button class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#gamesModal">Comprar</a>
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