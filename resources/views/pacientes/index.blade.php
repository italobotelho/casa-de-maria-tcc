@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/pacientes-medicos.css') }}">
@endsection

@section('title')
@stop
    
@section('content')

<div class="col-md-6">
    <h1 class="display-5">BUSCAR PACIENTE</h1>
</div>

<div class="col-md-10">
    <p class="display-8">Listagem dos últimos pacientes cadastrados e busca geral.</p>
</div>

<div class="container border border-1 rounded shadow-sm">

    <div class="my-4 mx-1"><button class="btn novoMedico" onclick="window.location.href='/form_paciente'">CADASTRAR NOVO PACIENTE</button></div>

    <div class="my-3 mx-1"><h2 class="text-uppercase">Filtros para Busca:</h2></div>

    <div class="my-3 mx-1"><h3 class="text-uppercase">Resultados:</h3></div>

    <table class="table border">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">NOME</th>
            <th scope="col">DT. NASC.</th>
            <th scope="col">CONVÊNIO</th>
            <th scope="col">TELEFONE</th>
            <th scope="col">CPF</th>
            <th scope="col">CIDADE</th>
            <th scope="col">NOME RESPONSÁVEL</th>
            <th scope="col">CPF RESPONSÁVEL</th>

            </tr>
        </thead>
        <tbody>
            @forelse($pacientes as $paciente)
                <tr>
                <th scope="row">{{$paciente->pk_cod_paci}}</th>
            
                <td>
                    <a href="#" class="nome-paciente" data-id="{{ $paciente->pk_cod_paci }}" data-nome="{{ $paciente->nome_paci }}" data-data-nasci="{{ \Carbon\Carbon::parse($paciente->data_nasci_paci)->format('d/m/Y') }}" data-convenio="{{ $paciente->convenio->nome_conv }}" data-telefone="{{ $paciente->telefone_paci }}" data-cpf="{{ $paciente->cpf_paci }}" data-cidade="{{ $paciente->nome_cidade }}" data-responsavel="{{ $paciente->responsavel_paci }}" data-cpf-responsavel="{{ $paciente->cpf_responsavel_paci }}">
                        {{ $paciente->nome_paci }}
                    </a>
                    <button class="btn btn-warning btn-sm editar-paciente" 
                    data-id="{{ $paciente->pk_cod_paci }}" 
                    data-nome="{{ $paciente->nome_paci }}" 
                    data-email="{{ $paciente->email_paci }}" 
                    data-data-nasci="{{ \Carbon\Carbon::parse($paciente->data_nasci_paci)->format('Y-m-d') }}" 
                    data-convenio-id="{{ $paciente->fk_convenio_paci }}"
                    data-telefone="{{ $paciente->telefone_paci }}" 
                    data-cpf="{{ $paciente->cpf_paci }}" 
                    data-cidade="{{ $paciente->nome_cidade }}" 
                    data-responsavel="{{ $paciente->responsavel_paci }}"        
                    data-cpf-responsavel="{{ $paciente->cpf_responsavel_paci }}">
                    Editar
                </button>
            
                </td>
                

                <td>{{ \Carbon\Carbon::parse($paciente->data_nasci_paci)->format('d/m/Y') }}</td>
                <td>{{$paciente->convenio->nome_conv}}</td>
                <td>{{$paciente->telefone_paci}}</td>
                <td>{{$paciente->cpf_paci}}</td>
                <td>{{$paciente->nome_cidade}}</td>
                <td>{{$paciente->responsavel_paci}}</td>
                <td>{{$paciente->cpf_responsavel_paci}}</td>
                
            
            
            
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center fs-4">
                        Nenhum paciente cadastrado
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Modal de Paciente -->
<div class="modal fade" id="pacienteModal" tabindex="-1" aria-labelledby="pacienteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pacienteModalLabel">Detalhes do Paciente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nome:</strong> {{ $paciente->nome }}</p>
                <p><strong>CPF:</strong> {{ $paciente->cpf }}</p>
                <p><strong>Data de Nascimento:</strong> {{ $paciente->data_nascimento }}</p>
                <!-- Mais informações sobre o paciente -->
                
                <!-- Botão Editar -->
                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editarPacienteModal">Editar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Edição do Paciente -->
<div class="modal fade" id="editarPacienteModal" tabindex="-1" aria-labelledby="editarPacienteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarPacienteModalLabel">Editar Paciente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('perfil.updateProfile', $paciente->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome', $paciente->nome) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="cpf">CPF</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" value="{{ old('cpf', $paciente->cpf) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="data_nascimento">Data de Nascimento</label>
                        <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="{{ old('data_nascimento', $paciente->data_nascimento) }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<style>
    #convenio-suggestions {
    position: absolute;
    background-color: #f9f9f9;
    border: 1px solid #ccc;
    padding: 10px;
    width: 200px;
    z-index: 1000;
}

#convenio-suggestions li {
    padding: 5px;
    cursor: pointer;
}

#convenio-suggestions li:hover {
    background-color: #ccc;
}
</style>

<script src="js/paciente.js"></script>