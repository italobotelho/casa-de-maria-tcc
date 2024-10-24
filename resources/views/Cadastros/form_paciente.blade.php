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
    <div class="container">
        <h1>CADASTRE UM NOVO PACIENTE</h1>

        <div class="card">
            <form action="{{ route('paciente.store') }}" method="POST">
                @csrf <!-- CSRF token for form submission -->

                <div class="section">
                    <div class="section-title">Dados Pessoais</div>

                    <div class="form-group">
                        <div class="dados-pessoais-left"> <!-- Coluna da esquerda -->
                            <!-- Nome -->
                            <div class="form-group">
                                <label for="nome_paci">Nome</label>
                                <input maxlength="54" type="text" class="form-control" id="nome_paci" name="nome_paci" value="{{ old('nome_paci') }}" required>
                            </div>

                            <!-- Email -->
                            <div class="form-group">
                                <label for="email_paci">Email</label>
                                <input maxlength="255" type="email" class="form-control" id="email_paci" name="email_paci" value="{{ old('email_paci') }}" required>
                            </div>

                            <!-- Telefone -->
                            <div class="form-group">
                                <label for="telefone_paci">Telefone</label>
                                <input maxlength="15" class="form-control" id="telefone_paci" name="telefone_paci" value="{{ old('telefone_paci') }}" required>
                            </div>
                        </div>

                        <div class="dados-pessoais-right"> <!-- Coluna da direita -->
                            <!-- CPF Paciente -->
                            <div class="form-group">
                                <label for="cpf_paci">CPF Paciente</label>
                                <input maxlength="14" type="text" class="form-control" id="cpf_paci" name="cpf_paci" value="{{ old('cpf_paci') }}" required oninput="aplicarMascaraCPF(this);">
                                <span id="cpf-error" style="color: red;"></span> <!-- Error message for CPF validation -->
                            </div>

                            <!-- Data de Nascimento -->
                            <div class="form-group">
                                <label for="data_nasci_paci">Data de Nascimento</label>
                                <input type="date" class="form-control" id="data_nasci_paci" name="data_nasci_paci" value="{{ old('data_nasci_paci') }}" required>
                            </div>


                            <!-- Carteira do Convênio -->
                            <div class="form-group" id="carteira-convenio-field">
                                <label for="carteira_convenio_paci">Carteira do Convênio</label>
                                <input maxlength="12" type="text" class="form-control" id="carteira_convenio_paci" name="carteira_convenio_paci" value="{{ old('carteira_convenio_paci') }}" required>
                            </div>

                            <!-- Convênio -->
                            <div class="form-group">
                                <label for="fk_convenio_paci">Convênio</label>
                                <select name="fk_convenio_paci" id="fk_convenio_paci" required>
                                    <option value="">Selecione um convênio</option>
                                </select>
                            </div>

                            
                        </div>
                    </div>

                    <!-- Campos do Responsável (se necessário) -->
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
                </div>

                <div class="section">
                    <div class="section-title">Endereço</div>

                    <!-- Cidade -->
                    <div class="form-group">
                        <label for="nome_cidade">Cidade:</label>
                        <input maxlength="100" type="text" class="form-control" id="nome_cidade" name="nome_cidade" value="{{ old('nome_cidade') }}" required>
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
       


        <script>
            // Funções de CPF e Responsável
            // Código JavaScript continua o mesmo
        </script>
    </body>

</html>


<script>
    // Função para aplicar a máscara de CPF
    function aplicarMascaraCPF(input) {
        let cpf = input.value.replace(/\D/g, ''); // Remove tudo que não for dígito
        if (cpf.length <= 11) {
            cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
            cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
            cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        }
        input.value = cpf;
    }

    // Função para validar CPF
    function TestaCPF(strCPF) {
        var Soma;
        var Resto;
        Soma = 0;

        // CPF inválido se todos os dígitos forem iguais
        if (/^(\d)\1{10}$/.test(strCPF)) return false;

        for (let i = 1; i <= 9; i++) Soma += parseInt(strCPF.charAt(i - 1)) * (11 - i);
        Resto = (Soma * 10) % 11;

        if (Resto === 10 || Resto === 11) Resto = 0;
        if (Resto !== parseInt(strCPF.charAt(9))) return false;

        Soma = 0;
        for (let i = 1; i <= 10; i++) Soma += parseInt(strCPF.charAt(i - 1)) * (12 - i);
        Resto = (Soma * 10) % 11;

        if (Resto === 10 || Resto === 11) Resto = 0;
        return Resto === parseInt(strCPF.charAt(10));
    }

    // Função para alternar campos de responsável com base na idade
    document.addEventListener('DOMContentLoaded', function () {
        const dataNasciInput = document.getElementById('data_nasci_paci');
        const responsavelFields = document.getElementById('responsavel-fields');

        function toggleResponsavelFields() {
            const birthDate = new Date(dataNasciInput.value);
            const age = new Date().getFullYear() - birthDate.getFullYear();

            if (age < 18) {
                responsavelFields.style.display = 'block';
                document.getElementById('cpf_responsavel_paci').setAttribute('required', true);
                document.getElementById('responsavel_paci').setAttribute('required', true);
            } else {
                responsavelFields.style.display = 'none';
                document.getElementById('cpf_responsavel_paci').removeAttribute('required');
                document.getElementById('responsavel_paci').removeAttribute('required');
            }
        }

        dataNasciInput.addEventListener('input', toggleResponsavelFields);
        toggleResponsavelFields(); // Check on page load
    });

    // Função para carregar convênios
    document.addEventListener('DOMContentLoaded', function () {
        fetch('/convenio')
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById('fk_convenio_paci');
                data.forEach(convenio => {
                    const option = document.createElement('option');
                    option.value = convenio.pk_id_conv; // ID do convênio
                    option.text = convenio.nome_conv; // Nome do convênio
                    select.add(option);
                });
            })
            .catch(error => console.error('Erro ao carregar convênios:', error));
    });

    // Função para alternar campo da Carteira do Convênio
    document.addEventListener('DOMContentLoaded', function () {
        const convenioSelect = document.getElementById('fk_convenio_paci');
        const carteiraConvenioField = document.getElementById('carteira-convenio-field');
        const carteiraConvenioInput = document.getElementById('carteira_convenio_paci');

        convenioSelect.addEventListener('change', function () {
            // Substitua '2' pelo ID correto do convênio "Particular"
            if (this.value === '1') { 
                carteiraConvenioField.style.display = 'none';
                carteiraConvenioInput.removeAttribute('required');
            } else {
                carteiraConvenioField.style.display = 'block';
                carteiraConvenioInput.setAttribute('required', true);
            }
        });
    });


    // Função para aplicar máscara de telefone
    function aplicarMascaraTelefone(input) {
        let telefone = input.value.replace(/\D/g, '');
        telefone = telefone.replace(/(\d{2})(\d)/, '($1) $2');
        telefone = telefone.replace(/(\d{4})(\d)/, '$1-$2');
        input.value = telefone;
    }

    document.addEventListener('DOMContentLoaded', function () {
        const cpfInput = document.getElementById('cpf_paci');
        cpfInput.addEventListener('input', function () {
            aplicarMascaraCPF(cpfInput);
        });

        // Aplica a máscara no campo de telefone
        const telefoneInput = document.getElementById('telefone_paci');
        telefoneInput.addEventListener('input', function () {
            aplicarMascaraTelefone(telefoneInput);
        });
    });


   

</script>

