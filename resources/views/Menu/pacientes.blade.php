@extends('Layout/layout')

@section('main')

<div class="container">
    <hr>
    <hr>
    <div class="row justify-content-center">
        <div class="col-lg-8 mt-4">
        </div>
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-success text-white d-flex justify-content-between">
                   <h1 class="fw-bold">Pacientes</h1>
                </div>
                <div class="card-body p-4">
                    <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">codigo</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Data nascimento</th>
                        <th scope="col">Convenio</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Cidade</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pacientes as $paciente)
                            <tr>
                            <th scope="row">{{$paciente->pk_cod_paci}}</th>
                            <td>{{$paciente->nome_paci}}</td>
                            <td>{{$paciente->data_nasci_paci}}</td>
                           <td>{{$paciente->convenio->nome_conv}}</td>

                            <td>{{$paciente->telefone_paci}}</td>
                            <td>{{$paciente->cpf_paci}}</td>
                            <td>{{$paciente->nome_cidade}}</td>
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
                                    Nenhum paciente cadastrado
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    </table>
                </div>
            </div>
        </div><!-- fim da col -->
    </div><!-- fim da row -->
</div> <!-- fim do container -->
<a href="form_paciente">CADASTRAR PACIENTE</a> <hr>
<a href="menu">VOLTAR</a>
@endsection
