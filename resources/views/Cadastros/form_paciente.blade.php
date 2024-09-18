<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Cadastrar Paciente</title>
    <link href="{{ asset('/css/cadastro.css') }}" rel="stylesheet">    
    
</head>

<body>

    <nav>
        <div>
            <img class="navimg" src="/img/logo.png" alt="Logo Casa de Maria" width="35" height="45" >
            <img src="/img/titulo branco.png" alt="Casa de Maria" width="55" height="30">
           <a  href="conf"> <button><img src="/img/conf.png" alt="Configurações"></button> </a>
        </div>
    </nav>

    <div class="container">
        <h1>CADASTRE UM NOVO PACIENTE</h1>

        <div class="card">
        <form action="{{ route('paciente.store') }}" method="POST">
            @csrf
            <!-- Nome -->
            <div class="form-group">
                <label for="nome_paci">Nome</label>
                <input type="text" class="form-control" id="nome_paci" name="nome_paci"
                    value="{{ old('nome_paci') }}" required>
            </div>

            <!-- Data de Nascimento -->
            <div class="form-group">
                <label for="data_nasci_paci">Data de Nascimento</label>
                <input type="date" class="form-control" id="data_nasci_paci" name="data_nasci_paci"
                    value="{{ old('data_nasci_paci') }}" required>
            </div>

            <!-- Telefone -->
            <div class="form-group">
                <label for="telefone_paci">Telefone</label>
                <input type="text" class="form-control" id="telefone_paci" name="telefone_paci"
                    value="{{ old('telefone_paci') }}" required>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email_paci">Email</label>
                <input type="email" class="form-control" id="email_paci" name="email_paci"
                    value="{{ old('email_paci') }}" required>
            </div>

            
            {{-- cpf paciente --}}
            <!-- CPF Paciente -->
            <div class="form-group">
                <label for="cpf_paci">CPF Paciente</label>
                <input type="text" class="form-control" id="cpf_paci" name="cpf_paci" value="{{ old('cpf_paci') }}"
                    required>
            </div>

            <hr style="color:#C99C65"><!--divisão dados do paciente e dados do responsavel-->

             {{-- nome responsavel --}}
             <div class="form-group">
                <label for="responsavel_paci">Nome responsavel</label>
                <input type="text" class="form-control" id="responsavel_paci" name="responsavel_paci"
                    value="{{ old('responsavel_paci') }}" required>
            </div>

            <!-- CPF do Responsável -->
            <div>
                <label for="cpf_responsavel_paci">CPF do Responsável:</label>
                <input type="text" name="cpf_responsavel_paci" id="cpf_responsavel_paci"
                    value="{{ old('cpf_responsavel_paci') }}" required>
            </div>

           
            <!-- Cidade -->
            <div class="form-group">
                <label for="nome_cidade">Cidade:</label>
                <input type="text" class="form-control" id="nome_cidade" name="nome_cidade"
                    value="{{ old('nome_cidade') }}" required>
            </div>

            <!-- Convênio -->
            {{-- <div class="form-group">
                <!-- Rótulo para o campo de seleção de convênio -->
                <label for="fk_convenio_paci">Convênio</label>

                <!-- Campo de seleção de convênio -->
                <select class="form-control" id="fk_convenio_paci" name="fk_convenio_paci" required>
                    <!-- Opção padrão desabilitada, solicitando ao usuário que selecione um convênio -->
                    <option value="" disabled {{ old('fk_convenio_paci') == '' ? 'selected' : '' }}>Selecione o convênio</option>
                    <option value="1" {{ old('fk_convenio_paci') == 1 ? 'selected' : '' }}>Unimed</option>
                    <option value="2" {{ old('fk_convenio_paci') == 2 ? 'selected' : '' }}>Particular</option>
                </select>
            </div> --}}


            <div class="form-group">
                <label for="fk_convenio_paci">Convênio</label>
                <select name="fk_convenio_paci" id="fk_convenio_paci" required>
                    <option value="">Selecione um convênio</option>
                </select>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    fetch('/convenio')
                        .then(response => response.json())
                        .then(data => {
                            let select = document.getElementById('fk_convenio_paci');
                            data.forEach(convenio => {
                                let option = document.createElement('option');
                                option.value = convenio.pk_id_conv; // Ajuste conforme o nome da chave primária
                                option.text = convenio.nome_conv; // Ajuste conforme o nome do convênio
                                select.add(option);
                            });
                        })
                        .catch(error => console.error('Erro ao carregar convênios:', error));
                });
            </script>


            <!-- Carteira do Convênio -->
            <div class="form-group">
                <label for="carteira_convenio_paci">Carteira do Convênio</label>
                <input type="text" class="form-control" id="carteira_convenio_paci" name="carteira_convenio_paci"
                    value="{{ old('carteira_convenio_paci') }}" required>
            </div>



            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif


            <br>

            
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Cadastrar Paciente</button>
        </form>

    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
</body>

</html>
