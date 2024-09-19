<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link href="{{ asset('/css/menu.css') }}" rel="stylesheet">    
</head>
<body>
    
    <!--Navbar-->
    <nav>
        <div>
            <img class="navimg" src="/img/logo.png" alt="Logo Casa de Maria" width="35" height="45" >
            <img src="/img/titulo branco.png" alt="Casa de Maria" width="55" height="30">
           <a  href="conf"> <button><img src="/img/conf.png" alt="Configurações"></button> </a>
        </div>
    </nav>
     
    

    <!--Cards-->
   <div class="card-group"> 
     
     <div class="card">
     <a href="agenda">
            <img src="/img/agenda.png" alt="Ícone de agenda">
            <div class="card-body">
                <p class="card-text">AGENDA</p>
            </div>
     </div>
     </a>

        <div class="card">
         <a href="consulta">
            <img src="/img/consulta.png" class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text">CONSULTA </p>
            </div>
        </div>
        </a>

        <div class="card">
        <a href="pacientes">
            <img src="/img/paciente.png" class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text">PACIENTE</p>
            </div>
        </div>
        </a>

        <div class="card">
        <a href="profissional">
            <img src="/img/profissional.png" class="card-img-top"  alt="...">
            <div class="card-body">
                <p class="card-text">PROFISSIONAL </p>
            </div>
        </div>
        </a>

    </div>
</body>
</html>
