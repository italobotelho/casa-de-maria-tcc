@extends('layouts.app')

@section('title', 'PACIENTE')

@section('css')
    <style>
      label {
        font-weight: bold;
        text-transform: uppercase;
      }
    </style>
@endsection

@section('content')

<div class="container border rounded pb-3">
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

    <form action="{{ route('paciente.store') }}" method="POST" id="paciente-form">
        @csrf
    <div class="d-flex">
        <div class="container border rounded my-4 d-flex flex-column" style="flex: 1; align-self: flex-start; height: auto;">
            <div class="d-flex flex-column align-items-center text-center">
                <div class="profile-image-container mt-5 mb-2">
                    <h2>Nome do Paciente</h2>
                    <img id="profileImagePreview" src="img/default-profile-pic.png" alt="Imagem de Perfil" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                </div>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Ações foto
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Enviar Imagem</a></li>
                        <li><a class="dropdown-item" href="#">Capturar Imagem</a></li>
                        <li><a class="dropdown-item" href="#">Girar Foto</a></li>
                    </ul>
                </div>
            </div>
        
            <!-- Submit Button -->
            <div class="d-flex justify-content-center my-4">
                <button type="submit" class="btn btn-success">Salvar novo paciente</button>
            </div>
        </div>
        

        <div class="container border rounded my-3" style="flex: 2; background-color: #f7f7f7">
            
            {{-- Dados Pessoais --}}
            <div class="row g-3 my-2">
                <h1 class="fs-4">DADOS PESSOAIS</h1>
                <!-- Nome -->
                <div class="form-group col-md-8">
                    <label for="nome_paci">Nome Completo</label>
                    <input maxlength="54" type="text" class="form-control" id="nome_paci" name="nome_paci" value="{{ old('nome_paci') }}" required>
                </div>

                <!-- Data de Nascimento -->
                <div class="form-group col-md-4">
                    <label for="data_nasci_paci">Data de Nascimento</label>
                    <input type="date" class="form-control" id="data_nasci_paci" name="data_nasci_paci" value="{{ old('data_nasci_paci') }}" size="8" required>
                </div>

                {{-- Gênero --}}
                <div class="form-group col-md-2">
                    <label for="genero">Gênero</label>
                    <select name="genero" id="genero" class="form-select">
                        <option value="">Selecione</option>
                        <option value="masc" {{ old('genero') == 'masc' ? 'selected' : '' }}>Masculino</option>
                        <option value="fem" {{ old('genero') == 'fem' ? 'selected' : '' }}>Feminino</option>
                    </select>
                </div>

                <!-- Telefone -->
                <div class="form-group col-md-4">
                    <label for="telefone_paci">Telefone</label>
                    <input maxlength="15" class="form-control" id="telefone_paci" name="telefone_paci" value="{{ old('telefone_paci') }}" required oninput="aplicarMascaraTelefone(this);">
                </div>

                <!-- Email -->
                <div class="form-group col-md-6">
                    <label for="email_paci">E-mail</label>
                    <input maxlength="255" type="email" class="form-control" id="email_paci" name="email_paci" value="{{ old('email_paci') }}" required>
                </div>

                <!-- CPF Paciente -->
                <div class="form-group col-md-4">
                    <label for="cpf_paci">CPF</label>
                    <input maxlength="14" type="text" class="form-control" id="cpf_paci" name="cpf_paci" value="{{ old('cpf_paci') }}" required oninput="aplicarMascaraCPF(this);">
                    <span id="cpf-error" style="color: red;"></span>
                </div>

                <!-- Convênio -->
                <div class="form-group col-md-4">
                    <label for="fk_convenio_paci">Convênio</label>
                    <select name="fk_convenio_paci" class="form-select" id="fk_convenio_paci" required>
                        <option value="">Selecione um convênio</option>
                    </select>
                </div>

                <!-- Carteira do Convênio -->
                <div class="form-group col-md-4" id="carteira-convenio-field">
                    <label for="carteira_convenio_paci">Carteira do Convênio</label>
                    <input maxlength="12" type="text" class="form-control" id="carteira_convenio_paci" name="carteira_convenio_paci" value="{{ old('carteira_convenio_paci') }}" required>
                </div>
            </div>

            
            
            {{-- Endereço --}}
            <div class="row g-3 my-2">
                <h2 class="fs-4">ENDEREÇO</h2>
                <div class="form-group col-md-2">
                    <label for="inputCEP" >CEP</label>
                    <input type="text" class="form-control" id="cep_paci" name="cep_paci" onblur="pesquisacep(this.value)" maxlength="9">
                </div>
                
                <div class="form-group col-md-8">
                    <label for="inputLogradouro" >LOGRADOURO</label>
                    <input type="text" class="form-control" id="rua_paci" name="rua_paci" value="" size="60" maxlength="60">
                </div>
                <div class="form-group col-md-2">
                    <label for="inputNumeroEstabelecimento" >NÚMERO</label>
                    <input type="number" class="form-control" id="numero_paci" name="numero_paci" value="" size="10" maxlength="10">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputCBairro" >BAIRRO</label>
                    <input type="text" class="form-control" id="bairro_paci" name="bairro_paci" value="" size="40" maxlength="40">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputCidade" >CIDADE</label>
                    <input type="text" class="form-control" id="cidade_paci" name="cidade_paci" value="" size="40" maxlength="40">
                </div>
                <div class="form-group col-md-10">
                    <label for="inputComplemento" >COMPLEMENTO</label>
                    <input type="text" class="form-control" id="complemento_paci" name="complemento_paci" value="" size="40" maxlength="40">
                </div>
                
                <div class="form-group col-md-2">
                    <label for="inputUF" >UF (ESTADO)</label>
                    <input type="text" class="form-control" id="uf_paci" name="uf_paci" value="" size="2" maxlength="2">
                </div>
            </div>
            
            <!-- Campos do Responsável -->
            <div class="row g-3 my-2" id="responsavel-fields" style="display: none;">
                <h2 class="fs-4">DADOS FAMILIARES</h2>
                <div class="form-group col-md-7">
                    <label for="responsavel_paci">NOME RESPONSÁVEL</label>
                    <input maxlength="54" type="text" class="form-control" id="responsavel_paci" name="responsavel_paci" value="{{ old('responsavel_paci') }}" required>
                </div>
                <div class="form-group col-md-5">
                    <label for="cpf_responsavel_paci">CPF</label>
                    <input maxlength="14" type="text" class="form-control" name="cpf_responsavel_paci" id="cpf_responsavel_paci" value="{{ old('cpf_responsavel_paci') }}" required oninput="aplicarMascaraCPF(this);">
                    <span id="cpf-error-responsavel" style="color: red;"></span>
                </div>
            </div>
        </div>
    </div>
</form>
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
                responsavelFields.style.display = 'flex';
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
<script src="{{ asset('js/cep-paci.js') }}"></script>
<script src="{{ asset('js/validate-cep.js') }}"></script>
@endsection