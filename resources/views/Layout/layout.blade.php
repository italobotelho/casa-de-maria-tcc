<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Casa de Maria</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container-fluid">
              <a class="navbar-brand" href="./menu"><img class="navimg" src="/img/logo.png" alt="Logo Casa de Maria" width="30" height="45"><img src="/img/titulo branco.png" alt="Casa de Maria" width="40" height="30"></a>  
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse d-flex justify-content-around" id="collapsibleNavbar">
                <ul class="navbar-nav ">
                  <li class="nav-item">
                    <a class="nav-link" href="#">Agenda</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Consultas</a>
                  </li>
                  <li class=" nav-item">
                    <a class="nav-link" href="#">Pacientes</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Profissionais</a>
                  </li>
                </ul>
              </div>
              <a class="navbar-brand" href="#"><img class="navimg" src="/img/conf.png" alt=""></a>
            </div> 
          </nav>
    </header>
    <main>
      @yield('carrosel')
    </main>
    <footer>

    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>