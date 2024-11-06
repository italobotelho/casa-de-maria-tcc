
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8"> <!-- Changed charset to 'utf-8' for better compatibility -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Cadastrar Paciente</title>
</head>

<body>
    <div class="container">
        <h1>CADASTRE UM NOVO PACIENTE</h1>

        <div class="card">
        <form action="{{ route('paciente.store') }}" method="POST">
            @csrf <!-- CSRF token for form submission -->

            <!-- Nome -->
            <div class="form-group">
                <label for="nome_paci">Nome</label>
                <input maxlength="54" type="text" class="form-control" id="nome_paci" name="nome_paci" value="{{ old('nome_paci') }}" required>
            </div>

            <!-- Telefone -->
            <div class="form-group">
                <label for="telefone_paci">Telefone</label>
                <input maxlength="15" class="form-control" id="telefone_paci" name="telefone_paci" value="{{ old('telefone_paci') }}" required>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email_paci">Email</label>
                <input maxlength="255" type="email" class="form-control" id="email_paci" name="email_paci" value="{{ old('email_paci') }}" required>
            </div>

            <!-- CPF Paciente -->
            <div class="form-group">
                <label for="cpf_paci">CPF Paciente</label>
                <input maxlength="14" type="text" class="form-control" id="cpf_paci" name="cpf_paci" value="{{ old('cpf_paci') }}" required oninput="aplicarMascaraCPF(this);">
                <span id="cpf-error" style="color: red;"></span> <!-- Error message for CPF validation -->
            </div>

            <!-- Data de Nascimento -->
            <div class="form-group">
                <label for="data_nasci_paci">Data de Nascimento</label>
                <input type="date" class="form-control" id="data_nasci_paci" name="data_nasci_paci" value="{{ old('data_nasci_paci') }} " placeholder="dd/mm/aaaa" required pattern="\d{2}/\d{2}/\d{4}" " required>
            </div>

            <!-- Campos do Responsável -->
            <div id="responsavel-fields" style="display: none;">
                <div class="form-group">
                    <label for="cpf_responsavel_paci">CPF do Responsável:</label>
                    <input maxlength="14" type="text" name="cpf_responsavel_paci" id="cpf_responsavel_paci" value="{{ old('cpf_responsavel_paci') }}" required oninput="aplicarMascaraCPF(this);">
                    <span id="cpf-error-responsavel" style="color: red;"></span> <!-- Error message for responsible CPF -->
                </div>
                <div class="form-group">
                    <label for="responsavel_paci">Nome responsável</label>
                    <input maxlength="54" type="text" class="form-control" id="responsavel_paci" name="responsavel_paci" value="{{ old('responsavel_paci') }}" required>
                </div>
            </div>

            <!-- Cidade -->
            <div class="form-group">
                <label for="nome_cidade">Cidade:</label>
                <input maxlength="100" type="text" class="form-control" id="nome_cidade" name="nome_cidade" value="{{ old('nome_cidade') }}" required>
            </div>

            <!-- Convênio -->
            <div class="form-group">
                <label for="fk_convenio_paci">Convênio</label>
                <select name="fk_convenio_paci" id="fk_convenio_paci" required>
                    <option value="">Selecione um convênio</option>
                </select>
            </div>

            <!-- Carteira do Convênio -->
            <div class="form-group" id="carteira-convenio-field">
                <label for="carteira_convenio_paci">Carteira do Convênio</label>
                <input maxlength="12" type="text    " class="form-control" id="carteira_convenio_paci" name="carteira_convenio_paci" value="{{ old('carteira_convenio_paci') }}" required>
            </div>

            <!-- Error and Success Messages -->
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

    <br>
    <a href="pacientes">VOLTAR</a>

    <!-- JavaScript Section -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
    <script src="js/formsPaciente.js"></script>
   
</body>

</html>
