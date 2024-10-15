@extends('layouts.app')

@section('title', 'BUSCAR PACIENTE')
    
@section('content')

<table class="table">
    <thead>
        <tr>
        <th scope="col">codigo</th>
        <th scope="col">Nome</th>
        <th scope="col">Data nascimento</th>
        <th scope="col">Convenio</th>
        <th scope="col">Telefone</th>
        <th scope="col">CPF</th>
        <th scope="col">Cidade</th>
        <th scope="col">Nome Responsavel</th>
        <th scope="col">CPf Responsavel</th>

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
@endsection