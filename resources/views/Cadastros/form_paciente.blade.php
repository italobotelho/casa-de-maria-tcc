<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/cadastro.css">
    <title>Cadastrar Paciente</title>
</head>

<body>
    <h1>Cadastre um paciente</h1>

    <div class="container">
        <div class="card">
            <form action="{{ route('paciente.store') }}" method="POST">
                @csrf

                <div class="section">
                    <div class="section-title">
                        <img src="img/dados-pessoais.png" class="section-icon">
                        Dados Pessoais
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nome_paci">Nome</label>
                                <input maxlength="54" type="text" class="form-control" id="nome_paci" name="nome_paci"
                                    value="{{ old('nome_paci') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="email_paci">Email</label>
                                <input maxlength="255" type="email" class="form-control" id="email_paci" name="email_paci"
                                    value="{{ old('email_paci') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="telefone_paci">Telefone</label>
                                <input maxlength="15" class="form-control" id="telefone_paci" name="telefone_paci"
                                    value="{{ old('telefone_paci') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cpf_paci">CPF Paciente</label>
                                <input maxlength="14" type="text" class="form-control" id="cpf_paci" name="cpf_paci"
                                    value="{{ old('cpf_paci') }}" required oninput="aplicarMascaraCPF(this);">
                                <span id="cpf-error" style="color: red;"></span>
                            </div>

                            <div class="form-group">
                                <label for="data_nasci_paci">Data de Nascimento</label>
                                <input type="date" class="form-control" id="data_nasci_paci" name="data_nasci_paci"
                                    value="{{ old('data_nasci_paci') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="fk_convenio_paci">Convênio</label>
                                <select name="fk_convenio_paci" id="fk_convenio_paci" class="form-control" required>
                                    <option value="">Selecione um convênio</option>
                                </select>
                            </div>

                            <div class="form-group" id="carteira-convenio-field">
                                <label for="carteira_convenio_paci">Carteira do Convênio</label>
                                <input maxlength="12" type="text" class="form-control" id="carteira_convenio_paci"
                                    name="carteira_convenio_paci" value="{{ old('carteira_convenio_paci') }}" required>
                            </div>
                        </div>
                    </div>

                    <div id="responsavel-fields" style="display: none;">
                        <div class="form-group">
                            <label for="cpf_responsavel_paci">CPF do Responsável:</label>
                            <input maxlength="14" type="text" class="form-control" name="cpf_responsavel_paci"
                                id="cpf_responsavel_paci" value="{{ old('cpf_responsavel_paci') }}" required
                                oninput="aplicarMascaraCPF(this);">
                            <span id="cpf-error-responsavel" style="color: red;"></span>
                        </div>
                        <div class="form-group">
                            <label for="responsavel_paci">Nome responsável</label>
                            <input maxlength="54" type="text" class="form-control" id="responsavel_paci"
                                name="responsavel_paci" value="{{ old('responsavel_paci') }}" required>
                        </div>
                    </div>
                </div>

                <hr class="divider">

                <div class="section">
                    <div class="section-title">
                        <img src="img/endereco.png" class="section-icon">
                        Endereço
                    </div>

                    <div class="form-group">
                        <label for="nome_cidade">Cidade:</label>
                        <input maxlength="100" type="text" class="form-control" id="nome_cidade" name="nome_cidade"
                            value="{{ old('nome_cidade') }}" required>
                    </div>
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

                <button type="submit" class="btn btn-primary">Cadastrar Paciente</button>

                <br><br>
            </form>
        </div>
        <br>
        <a href="pacientes" class="btn btn-primary voltar">VOLTAR</a>

        <!-- JavaScript Section -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
        <script src="js/paciente.js"></script>
        
    </div>
</body>

</html>