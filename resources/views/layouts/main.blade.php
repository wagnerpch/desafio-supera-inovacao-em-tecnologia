<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Desafio Supera Inovação em Tecnologia">
        <meta name="keywords" content="gestão de carros, manutenção de carros, aplicacao desenvolvida para o desafio supera inovação em tecnologia">
        <meta name="author" content="Wagner Chequeleiro Cordeiro">
        <!-- Título do site -->
        <title>@yield('title')</title>
        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="#">
        <!-- Fonte do Google -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto">
        <!-- Styles Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <!-- CSS da aplicação -->
        <link rel="stylesheet" href="/css/styles.css">
        <!-- JS da aplicação -->
        <script src="/js/scripts.js"></script>
    </head>
    <body class="container-fluid g-0">
        <header class="container-fluid g-0">
            <nav class="navbar navbar-expand-lg ">
                <div class="container p-0">
                    <a class="navbar-brand" href="/">
                        <!--img src="/img/hdcevents_logo.svg" alt="HDC Events" id="logo" class="rounded"-->
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            @auth
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/dashboard">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('cars') }}">Carros</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('maintenances') }}">Manutenções</a>
                            </li>
                            <li class="nav-item">
                                <form action="/logout" method="POST">
                                    @csrf
                                    <a class="nav-link" href="/logout" onclick="event.preventDefault(); this.closest('form').submit();">Sair</a>
                                </form>
                            </li>
                            @endauth
                            @guest
                            <li class="nav-item">
                                <a class="nav-link" href="/login">Entrar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/register">Cadastrar</a>
                            </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main class="container-fluid">
            <div class="row justify-content-center">
                @if(session('msg'))
                    <div class="col-4 my-2 text-center">
                        <p class="alert alert-primary text-center m-0" role="alert">{{session('msg')}}</p>
                    </div>
                @endif
            </div>
            @yield('content')
        </main>
        <footer class="container-fluid text-white bg-dark bottom">
            <div class="row justify-content-center">
                <div class="col">
                    <p class="fs-6 text-center my-4">Manutenção de carros &copy; 2022</p>
                </div>
            </div>
        </footer>
            <!-- JavaScript Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
            <!-- Ícones ionicons.com/usage -->
            <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>
</html>