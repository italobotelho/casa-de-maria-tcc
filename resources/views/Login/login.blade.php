<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Casa de Maria</title>

    <!-- Link para o arquivo CSS de estilos personalizados da página de login -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css')}}" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <section class="vh-100">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
              <div class="card" style="border-radius: 1rem;">
                <div class="row g-0">
                  <div class="col-md-6 col-lg-5 d-none d-md-block">
                    <img src=""
                      alt="Logo Casa de Maria" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
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

                        <div class="d-flex align-items-center mb-3 pb-1">
                          <span class="h1 fw-bold mb-0">Seu Login</span>
                        </div>
      
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="input" name="user" class="form-control form-control-lg rounded-pill" id="inputEmailUser" aria-describedby="userHelp">
                        </div>
      
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="password" name="senha" class="form-control form-control-lg rounded-pill" id="inputPassword">
                        </div>
      
                        <div class="pt-1 mb-4">
                          <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg rounded-pill" type="submit">Entrar</button>
                        </div>
      
                        <a href="#!" class="small text-muted">Terms de uso.</a>
                        <a href="#!" class="small text-muted">Políticas de Privacidade.</a>
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
