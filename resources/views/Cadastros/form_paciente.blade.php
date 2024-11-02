<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8"> <!-- Changed charset to 'utf-8' for better compatibility -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/cadastro.css">
    <title>Cadastrar Paciente</title>
</head>

<body>
    <h1>CADASTRE UM NOVO PACIENTE</h1>

    <div class="container">
        <div class="card">
            <form action="{{ route('paciente.store') }}" method="POST" id="paciente-form">
                @csrf

                <div class="section">
                    <div class="section-title">
                        <img src="img/dados-pessoais.png">
                        Dados Pessoais
                    </div>

                    <div class="row"> <!-- Use Bootstrap's grid system -->
                        <div class="col-md-6"> <!-- Left Column -->
                            <div class="form-group">
                                <label for="nome_paci">Nome</label>
                                <input maxlength="54" type="text" class="form-control" id="nome_paci" name="nome_paci" value="{{ old('nome_paci') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="email_paci">Email</label>
                                <input maxlength="255" type="email" class="form-control" id="email_paci" name="email_paci" value="{{ old('email_paci') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="telefone_paci">Telefone</label>
                                <input maxlength="15" class="form-control" id="telefone_paci" name="telefone_paci" value="{{ old('telefone_paci') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6"> <!-- Right Column -->
                            <div class="form-group">
                                <label for="cpf_paci">CPF Paciente</label>
                                <input maxlength="14" type="text" class="form-control" id="cpf_paci" name="cpf_paci" value="{{ old('cpf_paci') }}" required oninput="aplicarMascaraCPF(this);">
                                <span id="cpf-error" style="color: red;"></span>
                            </div>

                            <div class="form-group">
                                <label for="data_nasci_paci">Data de Nascimento</label>
                                <input type="date" class="form-control" id="data_nasci_paci" name="data_nasci_paci" value="{{ old('data_nasci_paci') }}" required>
                            </div>
                        </div>
                    </div>

                    <!-- Campos do Responsável (se necessário) -->
                    <div id="responsavel-fields" style="display: none;">
                        <div class="form-group">
                            <label for="cpf_responsavel_paci">CPF do Responsável:</label>
                            <input maxlength="14" type="text" class="form-control" name="cpf_responsavel_paci" id="cpf_responsavel_paci" value="{{ old('cpf_responsavel_paci') }}" required oninput="aplicarMascaraCPF(this);">
                            <span id="cpf-error-responsavel" style="color: red;"></span>
                        </div>
                        <div class="form-group">
                            <label for="responsavel_paci">Nome responsável</label>
                            <input maxlength="54" type="text" class="form-control" id="responsavel_paci" name="responsavel_paci" value="{{ old('responsavel_paci') }}" required>
                        </div>
                    </div>
                </div>

                <div class="section-divider"></div> <!-- Linha divisória -->

                <div class="section">
                    <div class="section-title">
                        <img src="img/endereco.png">
                        Outras informações
                    </div>

                    <div class="form-group">
                        <label for="nome_cidade">Cidade:</label>
                        <input maxlength="100" type="text" class="form-control" id="nome_cidade" name="nome_cidade" value="{{ old('nome_cidade') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="fk_convenio_paci">Convênio</label>
                        <select name="fk_convenio_paci" class="form-control" id="fk_convenio_paci" required>
                            <option value="">Selecione um convênio</option>
                        </select>
                    </div>

                    <div class="form-group" id="carteira-convenio-field">
                        <label for="carteira_convenio_paci">Carteira do Convênio</label>
                        <input maxlength="12" type="text" class="form-control" id="carteira_convenio_paci" name="carteira_convenio_paci" value="{{ old('carteira_convenio_paci') }}" required>
                    </div>
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

                <!-- Submit Button -->
                <div style="text-align: right; margin-top: 20px;"> <!-- Alinhando o botão à direita -->
                    <button type="submit">Cadastrar Paciente</button> <!-- Botão alinhado à direita -->
                </div>

                <br><br>
            </form>
        </div>
        <br>
        <a href="pacientes" class="btn btn-primary voltar">VOLTAR</a>

        <!-- JavaScript Section -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>

        <script>
            function aplicarMascaraCPF(input) {
                let cpf = input.value.replace(/\D/g, '');
                if (cpf.length <= 11) {
                    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
                    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
                    cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                }
                input.value = cpf;
            }

            function TestaCPF(strCPF) {
                let Soma = 0;
                let Resto;
                strCPF = strCPF.replace(/\D/g, '');
                if (!/^\d{11}$/.test(strCPF) || /^(\d)\1{10}$/.test(strCPF)) return false;

                for (let i = 1; i <= 9; i++) {
                    Soma += parseInt(strCPF.charAt(i - 1)) * (11 - i);
                }
                Resto = (Soma * 10) % 11;
                if (Resto === 10 || Resto === 11) Resto = 0;
                if (Resto !== parseInt(strCPF.charAt(9))) return false;

                Soma = 0;
                for (let i = 1; i <= 10; i++) {
                    Soma += parseInt(strCPF.charAt(i - 1)) * (12 - i);
                }
                Resto = (Soma * 10) % 11;
                if (Resto === 10 || Resto === 11) Resto = 0;

                return Resto === parseInt(strCPF.charAt(10));
            }

            document.addEventListener('DOMContentLoaded', function () {
                const form = document.getElementById('paciente-form');
                const cpfInput = document.getElementById('cpf_paci');

                form.addEventListener('submit', function (event) {
                    const cpfValue = cpfInput.value.replace(/\D/g, '');
                    if (!TestaCPF(cpfValue)) {
                        event.preventDefault();
                        document.getElementById('cpf-error').textContent = 'CPF inválido!';
                    } else {
                        document.getElementById('cpf-error').textContent = '';
                    }
                });

                cpfInput.addEventListener('input', function () {
                    const cpfValue = cpfInput.value.replace(/\D/g, '');
                    if (cpfValue.length < 11) {
                        document.getElementById('cpf-error').textContent = '';
                    }
                });
            });
        </script>
    </div>
</body>

</html>
