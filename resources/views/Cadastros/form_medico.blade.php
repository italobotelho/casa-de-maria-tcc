<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/cad-med.css">
    <title>Cadastrar Medico</title>
</head>

<body>
    <h1>CADASTRE UM NOVO MÉDICO</h1>
    <div class="card">
        <form action="{{ route('medico.store') }}" method="POST">
            @csrf

            <div class="section">
                <div class="section-title">
                    <img src="img/dados-pessoais.png" class="section-icon">
                    Dados Pessoais
                </div>
                <!-- Nome -->
                <div class="form-group">
                    <label for="nome_med">Nome:</label>
                    <input maxlength="50" type="text" class="form-control" id="nome_med" name="nome_med"
                        value="{{ old('nome_med') }}" required>
                </div>

                <!-- Telefone -->
                <div class="form-group">
                    <label for="telefone_med">Telefone:</label>
                    <input maxlength="15" type="text" class="form-control" id="telefone_med" name="telefone_med"
                        value="{{ old('telefone_med') }}" required>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email_med">Email:</label>
                    <input maxlength="255" type="email" class="form-control" id="email_med" name="email_med"
                        value="{{ old('email_med') }}" required>
                </div>
            </div>
            <br>

            <!-- Linha fina separadora -->
            <hr class="divider">


            <div class="section">
                <div class="section-title">
                    <img src="img/dados-profissionais.png" class="section-icon">
                    Dados profissionais
                </div>

                <br>

                <!-- UF -->
                <div class="form-group">
                    <label for="uf_med">UF:</label>
                    <input maxlength="2" type="text" class="form-control" id="uf_med" name="uf_med"
                        value="{{ old('uf_med') }}" required>
                </div>

                <!-- 1° Especialidade -->
                <div class="form-group">
                    <label for="especialidade1_med">1° Especialidade:</label>
                    <input maxlength="40" type="text" class="form-control" id="especialidade1_med" name="especialidade1_med"
                        value="{{ old('especialidade1_med') }}" required>
                </div>

                <!-- 2° Especialidade -->
                <div class="form-group">
                    <label for="especialidade2_med">2° Especialidade:</label>
                    <input maxlength="40" type="text" class="form-control" name="especialidade2_med" id="especialidade2_med"
                        value="{{ old('especialidade2_med') }}">
                </div>

                <!-- CRM -->
                <div class="form-group">
                    <label for="pk_crm_med">CRM:</label>
                    <input maxlength="6" class="form-control" type="text" name="pk_crm_med" id="pk_crm_med"
                        value="{{ old('pk_crm_med') }}" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Cadastrar Medico</button>
            <br>

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
        </form>
    </div>
    <a href="profissional" class="btn btn-primary voltar">VOLTAR</a>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
    <script src="js/medico.js"></script>

</body>

</html>
