<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Cadastrar Paciente</title>
</head>
<body>
    <div class="container">
        <h1>CADASTRE UM NOVO PACIENTE</h1>

        <form action="{{ route('paciente.store') }}" method="POST">
            @csrf

            <!-- Nome -->
            <div class="form-group">
                <label for="nome_paci">Nome</label>
                <input type="text" class="form-control" id="nome_paci" name="nome_paci" value="{{ old('nome_paci') }}" required>
            </div>

             <!-- Telefone -->
             <div class="form-group">
                <label for="telefone_paci">Telefone</label>
                <input type="text" class="form-control" id="telefone_paci" name="telefone_paci" value="{{ old('telefone_paci') }}" required>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email_paci">Email</label>
                <input type="email" class="form-control" id="email_paci" name="email_paci" value="{{ old('email_paci') }}" required>
            </div>

            <!-- Data de Nascimento -->
            <div class="form-group">
                <label for="data_nasci_paci">Data de Nascimento</label>
                <input type="date" class="form-control" id="data_nasci_paci" name="data_nasci_paci" value="{{ old('data_nasci_paci') }}" required>
            </div>

            <!-- CPF do Responsável -->
            <div class="form-group">
                <label for="cpf_responsavel_paci">CPF</label>
                <input type="text" class="form-control" id="cpf_responsavel_paci" name="cpf_responsavel_paci" value="{{ old('cpf_responsavel_paci') }}" required>
            </div>


         <!-- Cidade -->
            <div class="form-group">
                <!-- Rótulo para o campo de seleção de cidade -->
                <label for="fk_cidade">Cidade</label>
                <!-- Campo de seleção de cidade -->
                <select class="form-control" id="fk_cidade" name="fk_cidade" required>
                    <!-- Opção padrão desabilitada, solicitando ao usuário que selecione uma cidade -->
                    <option value="" disabled {{ old('fk_cidade') == '' ? 'selected' : '' }}>Selecione a cidade</option>
                    <option value="1" {{ old('fk_cidade') == 1 ? 'selected' : '' }}>Jaguariúna</option> <!---old('fk_cidade'): Se o formulário foi submetido e houve um erro de validação, o valor anterior de fk_cidade será reutilizado.-->
                    <option value="2" {{ old('fk_cidade') == 2 ? 'selected' : '' }}>Amparo</option>
                    <option value="3" {{ old('fk_cidade') == 3 ? 'selected' : '' }}>Campinas</option>
                </select>
            </div>

            <!-- Convênio -->
            <div class="form-group">
                <!-- Rótulo para o campo de seleção de convênio -->
                <label for="fk_convenio_paci">Convênio</label>

                <!-- Campo de seleção de convênio -->
                <select class="form-control" id="fk_convenio_paci" name="fk_convenio_paci" required>
                    <!-- Opção padrão desabilitada, solicitando ao usuário que selecione um convênio -->
                    <option value="" disabled {{ old('fk_convenio_paci') == '' ? 'selected' : '' }}>Selecione o convênio</option>

                    <option value="1" {{ old('fk_convenio_paci') == 1 ? 'selected' : '' }}>Convênio 1</option>
                    <option value="2" {{ old('fk_convenio_paci') == 2 ? 'selected' : '' }}>Convênio 2</option>
                </select>
            </div>

             <!-- Carteira do Convênio -->
             <div class="form-group">
                <label for="carteira_convenio_paci">Carteira do Convênio</label>
                <input type="text" class="form-control" id="carteira_convenio_paci" name="carteira_convenio_paci" value="{{ old('carteira_convenio_paci') }}" required>
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



            <br>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Cadastrar Paciente</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
</body>
</html>
