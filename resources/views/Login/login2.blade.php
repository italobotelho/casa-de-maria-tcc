<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Casa de Maria</title>

    <!-- Link para o arquivo CSS de estilos personalizados da página de login -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css')}}" />
    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body style="background-color: #E5D5C0;">

    <section class="vh-100">  
        
        <!----------------------- Main Container -------------------------->

        <div class="container d-flex justify-content-center align-items-center min-vh-100">

            <!----------------------- Login Container -------------------------->
            <div class="row border rounded-5 p-3 bg-white shadow box-area">

                <!--------------------------- Left Box ----------------------------->
                <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #103cbe;">
                    <div class="featured-image mb-3">
                     <img src="img/logo.png" class="img-fluid" style="width: ;">
                    </div>  
                </div>

                <!-------------------- ------ Right Box ---------------------------->
        
                <div class="col-md-6 right-box">
                    <div class="row align-items-center">
                        <div class="header-text mb-4">
                            <h1 style="color: #795127;">SEU LOGIN</h1>
                        </div>
                        <div data-mdb-input-init class="form-outline mb-4 d-grid gap-2 col-10 mx-auto">
                            <input type="input" name="user" class="form-control form-control-lg rounded-pill shadow-sm border border-0" style="background-color: rgb(255, 255, 255, 0.5);"  id="inputEmailUser" aria-describedby="userHelp" placeholder="USUÁRIO">
                        </div>
      
                        <div data-mdb-input-init class="form-outline mb-4 d-grid gap-2 col-10 mx-auto">
                            <input type="password" name="senha" class="form-control form-control-lg rounded-pill shadow-sm border border-0" style="background-color: rgb(255, 255, 255, 0.5);" id="inputPassword" placeholder="SENHA">
                        </div>
                        <div class=" mb-4 d-grid gap-2 col-6 mx-auto">
                            <button data-mdb-button-init data-mdb-ripple-init class="btn btn-lg rounded-pill shadow-sm" style="background-color: rgb(138, 99, 58); color: white;" type="submit">ENTRAR</button>
                          </div>
                    </div>
                </div> 
            </div>
        </div>
      </section>

    <!-- Link para o JavaScript do Bootstrap a partir de uma CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html> 
