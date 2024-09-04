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
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
              <div class="card shadow-lg border border-0" style="border-radius: 1rem; background-color: #E5D5C0;">
                <div class="row g-0">
                  <div class="d-flex col-md-6 col-lg-5 d-md-block" >
                    <img src="img/logo.png" alt="Logo Casa de Maria" class="img-fluid" style="background-color: rgb(201, 156, 101, 0.5); border-radius: 1rem 0 0 1rem;"/>
                  </div>
                  <div class="col-md-6 col-lg-7 d-flex align-items-center">
                    <div class="card-body p-4 p-lg-5 text-black">
      
                      <form method="post" action="{{ route('login.page') }}">
      
                        @csrf
                        <div class="mb-3 icon icon-user">
                        
                            <!-- Exibição de mensagens de erro -->
                            @if ($errors->any()) <!-- Verifica se há erros -->
                                <div class="alert alert-danger">
                                    <ul>
                                        <!-- Itera sobre todas as mensagens de erro e as exibe em uma lista não ordenada -->
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
            
                            <!-- Exibe uma mensagem de sessão com chave 'danger' se existir -->
                            @if (session('danger'))
                                <div class="alert alert-danger">
                                    {{ session('danger') }}
                                </div>
                            @endif
                        <!-- Campo de entrada para o usuário -->

                        <div class="d-flex justify-content-center mb-3 pb-1">
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
                      </form>
                    </div>
                  </div>
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
