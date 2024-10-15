@extends('layouts.app')

@section('title', 'BUSCAR PROFISSIONAIS')

@section('content')

<table class="table">
<thead>
    <tr>
        <th scope="col">CRM</th>
        <th scope="col">Nome</th>
        <th scope="col">Especialidade</th>
        <th scope="col">Telefone</th>
        <th scope="col">Email</th>
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
                Nenhum medico cadastrado
            </td>
        </tr>
    @endforelse
</tbody>
</table>
@endsection