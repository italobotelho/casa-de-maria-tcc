@extends('layouts.app')

@section('title', 'CADASTRO DE PACIENTE')

@section('content')

<div class="container">

    <div class="card">
        <form action="{{ route('paciente.store') }}" method="POST" id="paciente-form">
            @csrf

            <!-- Nome -->
            <div class="form-group">
                <label for="nome_paci">Nome</label>
                <input maxlength="54" type="text" class="form-control" id="nome_paci" name="nome_paci" value="{{ old('nome_paci') }}" required>
            </div>

            <!-- Telefone -->
            <div class="form-group">
                <label for="telefone_paci">Telefone</label>
                <input maxlength="15" class="form-control" id="telefone_paci" name="telefone_paci" value="{{ old('telefone_paci') }}" required oninput="aplicarMascaraTelefone(this);">
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
                <span id="cpf-error" style="color: red;"></span>
            </div>

            <!-- Data de Nascimento -->
            <div class="form-group">
                <label for="data_nasci_paci">Data de Nascimento</label>
                <input type="date" class="form-control" id="data_nasci_paci" name="data_nasci_paci" value="{{ old('data_nasci_paci') }}" required>
            </div>

            <!-- Campos do Responsável -->
            <div id="responsavel-fields" style="display: none;">
                <div class="form-group">
                    <label for="cpf_responsavel_paci">CPF do Responsável:</label>
                    <input maxlength="14" type="text" name="cpf_responsavel_paci" id="cpf_responsavel_paci" value="{{ old('cpf_responsavel_paci') }}" required oninput="aplicarMascaraCPF(this);">
                    <span id="cpf-error-responsavel" style="color: red;"></span>
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
                <select name="fk_convenio_paci" class="form-control" id="fk_convenio_paci" required>
                    <option value="">Selecione um convênio</option>
                </select>
            </div>

            <!-- Carteira do Convênio -->
            <div class="form-group" id="carteira-convenio-field">
                <label for="carteira_convenio_paci">Carteira do Convênio</label>
                <input maxlength="12" type="text" class="form-control" id="carteira_convenio_paci" name="carteira_convenio_paci" value="{{ old('carteira_convenio_paci') }}" required>
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
            <button type="submit" class="btn btn-primary">Cadastrar Paciente</button>
        </form>
        <a href="pacientes">VOLTAR</a>
    </div>
    @endsection

    @section('scripts')
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

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('paciente-form');
            const cpfInput = document.getElementById('cpf_paci');

            form.addEventListener('submit', function(event) {
                const cpfValue = cpfInput.value.replace(/\D/g, '');
                if (!TestaCPF(cpfValue)) {
                    event.preventDefault();
                    document.getElementById('cpf-error').textContent = 'CPF inválido!';
                } else {
                    document.getElementById('cpf-error').textContent = '';
                }
            });

            cpfInput.addEventListener('input', function() {
                const cpfValue = cpfInput.value.replace(/\D/g, '');
                if (cpfValue.length < 11) {
                    document.getElementById('cpf-error').textContent = '';
                    return;
                }
                if (!TestaCPF(cpfValue)) {
                    document.getElementById('cpf-error').textContent = 'CPF inválido!';
                } else {
                    document.getElementById('cpf-error').textContent = '';
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const cpfResponsavelInput = document.getElementById('cpf_responsavel_paci');

            // Validação ao digitar no CPF do responsável
            cpfResponsavelInput.addEventListener('input', function() {
                const cpfValue = cpfResponsavelInput.value.replace(/\D/g, '');
                if (cpfValue.length < 11) {
                    document.getElementById('cpf-error-responsavel').textContent = '';
                    return;
                }
                if (!TestaCPF(cpfValue)) {
                    document.getElementById('cpf-error-responsavel').textContent = 'CPF inválido!';
                } else {
                    document.getElementById('cpf-error-responsavel').textContent = '';
                }
            });
        });
        // Função para alternar campos de responsável com base na idade
        document.addEventListener('DOMContentLoaded', function() {
            const dataNasciInput = document.getElementById('data_nasci_paci');
            const responsavelFields = document.getElementById('responsavel-fields');

            function toggleResponsavelFields() {
                const birthDate = new Date(dataNasciInput.value);
                const age = new Date().getFullYear() - birthDate.getFullYear();

                // Verificar se a idade é menor que 18 ou maior que 70 anos
                if (age < 18 || age > 69) {
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
        document.addEventListener('DOMContentLoaded', function() {
        fetch('/convenio')
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById('fk_convenio_paci');
                data.forEach(convenio => {
                    if (convenio.status === 'ativo') { // Verifica se o convênio está ativo
                        const option = document.createElement('option');
                        option.value = convenio.pk_id_conv;
                        option.text = convenio.nome_conv;
                        select.add(option);
                    }
                });
            })
            .catch(error => console.error('Erro ao carregar convênios:', error));
         });


        // Função para alternar campo da Carteira do Convênio
        document.addEventListener('DOMContentLoaded', function() {
            const convenioSelect = document.getElementById('fk_convenio_paci');
            const carteiraConvenioField = document.getElementById('carteira-convenio-field');
            const carteiraConvenioInput = document.getElementById('carteira_convenio_paci');

            convenioSelect.addEventListener('change', function() {
                if (this.value === '1') { // Altere o valor conforme necessário
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

        document.addEventListener('DOMContentLoaded', function() {
            const telefoneInput = document.getElementById('telefone_paci');
            telefoneInput.addEventListener('input', function() {
                aplicarMascaraTelefone(telefoneInput);
            });
        });
    </script>
    @endsection