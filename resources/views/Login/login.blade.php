<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Seu Login!</title>

    <!-- Link para o arquivo CSS de estilos personalizados da página de login -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css')}}" />

    <!-- Link para o CSS do Bootstrap a partir de uma CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class=body>
    <div class="container">
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
                <label for="user" class="form-label">Usuário</label>
                <input type="user" name="user" class="form-control" id="exampleInputEmail1" aria-describedby="userHelp">
            </div>

            <div class="mb-3 icon icon-lock">
     
                <label for="senha" class="form-label">Senha</label>
                <input type="password" name="senha" class="form-control" id="exampleInputPassword1">
            </div>

            <!-- Botão para enviar o formulário -->
            <button type="submit" class="btn btn-primary">Entrar</button>
        </form>
    </div>

    <!-- Link para o JavaScript do Bootstrap a partir de uma CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html> 
