<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admininstracion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    @include('includes.colors')
    @include('includes.login')
</head>

<body>
    @include('includes.navbar')
    <div class="row text-center justify-content-center">
        <div class="card-3d-wrap mx-auto" style=" height: 420px !important;">
            <div class="card-3d-wrapper">
                <div class="card-front">
                    <div class="center-wrap">
                        <a class="disabled btn btn-primary ">Administración de la pagina</a>
                        <ul class="list-group align-items-center">
                            <a href="create" class="list-group-item btn btn-primary mt-3 mb-3 w-50 ">Create</a>
                            <a href="read" class="list-group-item btn btn-primary mt-3 mb-3 w-50 ">Read</a>
                            <a href="update" class="list-group-item btn btn-primary mt-3 mb-3 w-50 ">Update</a>
                            <a href="delete" class="list-group-item btn btn-primary mt-3 mb-3 w-50 ">Delete</a>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('includes.footer')
</body>

</html>