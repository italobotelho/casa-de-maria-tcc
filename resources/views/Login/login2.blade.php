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
      
             <div class="row rounded-5 p-3 shadow box-area" style="border-radius: 1rem; background-color: #E5D5C0;">
      
          <!--------------------------- Left Box ----------------------------->
      
             <div class="col-md-6 rounded-4 flex-column left-box">
                 <div class="featured-image mb-3">
                  <img src="img/logo.png" class="img-fluid" style="background-color: rgb(201, 156, 101, 0.5); border-radius: 1rem; width: 250px;">
                 </div> 
             </div> 
      
          <!-------------------- ------ Right Box ---------------------------->
              
             <div class="col-md-6 d-flex right-box">
                <div class="row align-items-center">
                      <div class="header-text mb-4">
                           <h1 style="color: #795127;">SEU LOGIN</h1>
                      </div>
                      <div class="input-group mb-3">
                          <input type="text" class="form-control form-control-lg bg-light fs-6" placeholder="Email address">
                      </div>
                      <div class="input-group mb-1">
                          <input type="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password">
                      </div>
                      <div class="input-group mb-5 d-flex justify-content-between">
                      </div>
                      <div class="input-group mb-3">
                          <button class="btn btn-lg btn-primary w-100 fs-6">Login</button>
                      </div>
                </div>
             </div> 
      
            </div>
          </div>
      

    <!-- Link para o JavaScript do Bootstrap a partir de uma CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html> 
