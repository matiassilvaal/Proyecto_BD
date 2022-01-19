@include('includes.colors')
<header class="mb-5">
    <nav class="navbar navbar-expand-lg bg-gray-100 dark:bg-gray-900" style="opacity: 0.85 !important;">
        <div class="container-fluid">
            <a href="#"><img class="img-fluid" src="https://i.gyazo.com/3d9ff47e2a0b3eb28b1615f2f901f5e0.png" ></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-gray-900 dark:text-white fw-bold" aria-current="page" href="/">Tienda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-gray-900 dark:text-white fw-bold" href="/cuenta">Mi cuenta</a>
                    </li>
                    
                    @auth('admin')
                    <li class="nav-item">
                        <a class="nav-link text-gray-900 dark:text-white fw-bold" href="/admin">Administración</a>
                    </li>
                    @endauth
                    @auth('publisher')
                    <li class="nav-item">
                        <a class="nav-link text-gray-900 dark:text-white fw-bold" href="/create_game">Crear juego</a>
                    </li>
                    @endauth
                    @auth('publisher')
                    <li class="nav-item">
                        <a class="nav-link text-gray-900 dark:text-white fw-bold" href="/edit_game">Editar juego</a>
                    </li>
                    @endauth
                    <li class="nav-item">
                        <a class="nav-link text-gray-900 dark:text-white fw-bold" href="/logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header> 