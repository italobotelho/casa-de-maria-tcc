@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/pacientes-medicos.css') }}">
@endsection

@section('title')
@stop

@section('content')

<div class="col-md-6">
    <h1 class="display-5">BUSCAR PROFISSIONAL</h1>
</div>

<div class="col-md-10">
    <p class="display-8">Listagem dos últimos médicos cadastrados e busca geral.</p>
</div>

<div class="container border border-1 rounded shadow-sm">

    <div class="my-4 mx-1"><button class="btn novoMedico" onclick="window.location.href='/form_medico'">CADASTRAR NOVO MÉDICO</button></div>

    <div class="my-3 mx-1"><h2 class="text-uppercase">Filtros para Busca:</h2></div>

    <div class="my-3 mx-1"><h3 class="text-uppercase">Resultados:</h3></div>

    <table class="table border">
        <thead>
            <tr>
                <th scope="col">CRM</th>
                <th scope="col">NOME</th>
                <th scope="col">ESPECIALIDADE</th>
                <th scope="col">TELEFONE</th>
                <th scope="col">E-MAIL</th>
            </tr>
        </thead>
        <tbody>
            @forelse($medicos as $medico)
                <tr>
                    <th scope="row">{{ $medico->pk_crm_med }}</th>
                    <td>{{ $medico->nome_med }}</td>
                    <td>{{ $medico->especialidade1_med }}</td>
                    <td>{{ $medico->telefone_med }}</td>
                    <td>{{ $medico->email_med }}</td>
                    {{-- <td>
                <div class="d-flex gap-1">
                <a href="/pacientes/{{$paciente->id}}" class="btn btn-secondary">Editar</a>
                <form action="/pacientes/{{$paciente->id}}" method="POST">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger">
                        Excluir
                    </button>
                </form>
                </div>
            </td> --}}
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center fs-4">
                        Nenhum médico cadastrado
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection