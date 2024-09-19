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
                <input maxlength="54" type="text" class="form-control" id="nome_paci" name="nome_paci"
                    value="{{ old('nome_paci') }}" required>
            </div>

            <!-- Telefone -->
            <div class="form-group">
                <label for="telefone_paci">Telefone</label>
                <input maxlength="12" type="text" class="form-control" id="telefone_paci" name="telefone_paci"
                    value="{{ old('telefone_paci') }}" required>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email_paci">Email</label>
                <input maxlength="255" type="email" class="form-control" id="email_paci" name="email_paci"
                    value="{{ old('email_paci') }}" required>
            </div>

            <!-- CPF Paciente -->
            <div class="form-group">
                <label for="cpf_paci">CPF Paciente</label>
                <input maxlength="11" type="text" class="form-control" id="cpf_paci" name="cpf_paci"
                    value="{{ old('cpf_paci') }}" required>
            </div>

            <!-- Data de Nascimento -->
            <div class="form-group">
                <label for="data_nasci_paci">Data de Nascimento</label>
                <input type="date" class="form-control" id="data_nasci_paci" name="data_nasci_paci"
                    value="{{ old('data_nasci_paci') }}" required>
            </div>

            <!-- CPF do Responsável e Nome Responsável -->
            <div id="responsavel-fields" style="display: none;">
                <div class="form-group">
                    <label for="cpf_responsavel_paci">CPF do Responsável:</label>
                    <input maxlength="11" type="text" name="cpf_responsavel_paci" id="cpf_responsavel_paci"
                        value="{{ old('cpf_responsavel_paci') }}" required>
                </div>
                <div class="form-group">
                    <label for="responsavel_paci">Nome responsável</label>
                    <input maxlength="54" type="text" class="form-control" id="responsavel_paci"
                        name="responsavel_paci" value="{{ old('responsavel_paci') }}" required>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const dataNasciInput = document.getElementById('data_nasci_paci');
                    const responsavelFields = document.getElementById('responsavel-fields');
                    const cpfResponsavel = document.getElementById('cpf_responsavel_paci');
                    const nomeResponsavel = document.getElementById('responsavel_paci');

                    function toggleResponsavelFields() {
                        const birthDate = new Date(dataNasciInput.value);
                        const today = new Date();
                        const age = today.getFullYear() - birthDate.getFullYear();
                        const isMinor = age < 18;

                        if (isMinor) {
                            responsavelFields.style.display = 'block';
                            cpfResponsavel.setAttribute('required', true);
                            nomeResponsavel.setAttribute('required', true);
                        } else {
                            responsavelFields.style.display = 'none';
                            cpfResponsavel.removeAttribute('required');
                            nomeResponsavel.removeAttribute('required');
                        }
                    }

                    // Chamar a função ao carregar a página e ao alterar a data
                    dataNasciInput.addEventListener('input', toggleResponsavelFields);
                    toggleResponsavelFields(); // Executa ao carregar para garantir que funcione corretamente no primeiro carregamento
                });
            </script>

            <!-- Cidade -->
            <div class="form-group">
                <label for="nome_cidade">Cidade:</label>
                <input maxlength="100" type="text" class="form-control" id="nome_cidade" name="nome_cidade"
                    value="{{ old('nome_cidade') }}" required>
            </div>

            <!-- Convênio -->
            <div class="form-group">
                <label for="fk_convenio_paci">Convênio</label>
                <select name="fk_convenio_paci" id="fk_convenio_paci" required>
                    <option value="">Selecione um convênio</option>
                </select>
            </div>

            <!-- JavaScript para carregar os convênios -->
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
            <div class="form-group" id="carteira-convenio-field">
                <label for="carteira_convenio_paci">Carteira do Convênio</label>
                <input maxlength="12" type="text" class="form-control" id="carteira_convenio_paci"
                    name="carteira_convenio_paci" value="{{ old('carteira_convenio_paci') }}" required>
            </div>

       

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const convenioSelect = document.getElementById('fk_convenio_paci');
        const carteiraConvenioInput = document.getElementById('carteira_convenio_paci');
        const carteiraConvenioField = document.getElementById('carteira-convenio-field');

        function toggleCarteiraConvenio() {
    console.log('toggleCarteiraConvenio function called');
    if (convenioSelect) {
        const selectedOption = convenioSelect.options[convenioSelect.selectedIndex].text;
        console.log('Selected option:', selectedOption);
        if (selectedOption === 'Particular') {
            carteiraConvenioField.style.display = 'none'; // Hide the field
            carteiraConvenioInput.value = ''; // Set the value to null
            carteiraConvenioInput.removeAttribute('required'); // Remove the required attribute
            carteiraConvenioInput.disabled = true; // Disable the field
        } else {
            carteiraConvenioField.style.display = 'block'; // Show the field
            carteiraConvenioInput.setAttribute('required', true); // Set the required attribute
            carteiraConvenioInput.disabled = false; // Enable the field
        }
    } else {
        console.error('convenioSelect element not found');
    }
}

        // Execute the function when the page is loaded and when the convenio value is changed
        convenioSelect.addEventListener('change', toggleCarteiraConvenio);
        toggleCarteiraConvenio(); // Check on page load
    });
</script>

<!-- ... (rest of the code remains the same) ... -->
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
</body>

</html>
