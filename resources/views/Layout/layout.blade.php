<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Casa de Maria</title>
    @yield('head')
</head>
<body>
    <header>
        <!--Navbar-->
        <nav class="navbar navbar-expand-lg sticky-top" style="background-color: #795127;">
            <div class="container-fluid">
                <a class="navbar-brand" href="menu">
                    <img src="img/logo.png" alt="Logo" width="30" height="40" class="d-inline-block align-text-top">
                </a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                      <li class="nav-item">
                        <a class="nav-link text-white" href="agenda">Agenda</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link text-white" href="consulta">Consultas</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link text-white" href="pacientes">Pacientes</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link text-white" href="profissional">Médicos</a>
                      </li>
                    </ul>
                  </div>
                <a class="navbar-brand" href="gerais">
                    <img src="img/conf.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
                </a>
            </div>  
        </nav>
    </header>
    <main>
      <section class="vh-100">
        <div class="container py h-100">
          @yield('main')
        </div>
      </section>
    </main>
    <footer>

    </footer>
    @yield('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>