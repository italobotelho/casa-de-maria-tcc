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

        <div class="my-4 mx-1"><button class="btn novoCadastro" onclick="window.location.href='/form_medico'">CADASTRAR NOVO MÉDICO</button></div>  

        <div class="my-3 mx-1"><h2 class="text-uppercase fs-5 fw-medium">Filtros para Busca:</h2>
             <!-- Formulário de busca -->
             <form action="{{ route('medico.buscar1') }}" method="GET" class="form-inline mb-4 d-flex align-items-center">

                    <div class="form-group me-3">
                        <label for="nome_paci" class="me-2">Nome:</label>
                        <input type="text" name="nome_med" id="nome_med" class="form-control" placeholder="Nome do médico">
                    </div>
                    <div class="form-group me-3">
                        <label for="data_nasc_paci" class="me-2">CRM:</label>
                        <input type="text" name="pk_crm_med" id="pk_crm_med" class="form-control" placeholder="CRM do medico">
                    </div>
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </form>  
        </div>

        <div class="my-3 mx-1"><h3 class="text-uppercase fs-5 fw-medium">Resultados:</h3></div>

                        <table class="table border">
                            <thead>
                                <tr>
                                    <th scope="col">CRM</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">1 Especialidade</th>
                                    <th scope="col">2 Especialidade</th>
                                    <th scope="col">Telefone</th>
                                    <th scope="col">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($medicos as $medico)
                                <tr>
                                    <th scope="row">{{ $medico->pk_crm_med }}</th>
                                    <td>
                                        <a href="#" class="nome-medico" 
                                           data-id="{{ $medico->pk_crm_med }}" 
                                           data-nome="{{ $medico->nome_med }}" 
                                           data-especialidade="{{ $medico->especialidade1_med }}" 
                                           data-especialidade2="{{ $medico->especialidade2_med }}" 
                                           data-telefone="{{ $medico->telefone_med }}" 
                                           data-email="{{ $medico->email_med }}">
                                            {{ $medico->nome_med }}
                                        </a>
                                        <button class="btn btn-warning btn-sm editar-medico" 
                                                data-id="{{ $medico->pk_crm_med }}" 
                                                data-nome="{{ $medico->nome_med }}" 
                                                data-especialidade="{{ $medico->especialidade1_med }}" 
                                                data-especialidade2="{{ $medico->especialidade2_med }}" 
                                                data-telefone="{{ $medico->telefone_med }}" 
                                                data-email="{{ $medico->email_med }}">
                                            Editar
                                        </button>
                                    </td>
                                    <td>{{ $medico->especialidade1_med }}</td>
                                    <td>{{ $medico->especialidade2_med }}</td>
                                    <td>{{ $medico->telefone_med }}</td>
                                    <td>{{ $medico->email_med }}</td>
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
                </div>
            </div><!-- fim da col -->
        </div><!-- fim da row -->
    </div> <!-- fim do container -->

<!-- Modal para exibir informações do médico -->
<div id="medicoModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Informações do Médico</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                
            </div>
            <div class="modal-body">
                <p><strong>Nome:</strong> <span id="nome-medico"></span></p>
                <p><strong> 1 Especialidade:</strong> <span id="especialidade"></span></p>
                <p><strong> 2 Especialidade:</strong> <span id="especialidade2"></span></p>
                <p><strong>Telefone:</strong> <span id="telefone"></span></p>
                <p><strong>Email:</strong> <span id="email"></span></p>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar informações do médico -->
<div class="modal fade" id="editarMedicoModal" tabindex="-1" role="dialog" aria-labelledby="editarMedicoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="editarMedicoModalLabel">Editar Médico</h3>

            </div>
            <form action="{{ route('medico.update') }}" id="formEditarMedico">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-body">
                    <input type="hidden" id="editar-id" name="id">
                    <div class="form-group">
                        <label for="editar-nome">Nome</label>
                        <input type="text" class="form-control" id="editar-nome" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label for="editar-especialidade">Especialidade</label>
                        <input type="text" class="form-control" id="editar-especialidade" name="especialidade" required>
                    </div>
                    <div class="form-group">
                        <label for="editar-especialidade2">2ª Especialidade</label>
                        <input type="text" class="form-control" id="editar-especialidade2" name="especialidade2">
                    </div>
                    <div class="form-group">
                        <label for="editar-telefone">Telefone</label>
                        <input type="text" maxlength="15" class="form-control" id="editar-telefone" name="telefone" required>
                    </div>
                    <div class="form-group">
                        <label for="editar-email">Email</label>
                        <input type="email" class="form-control" id="editar-email" name="email" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>

<script src="js/medico.js"></script>
<script>
    window.onload = function() {
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.pathname);
        }
    }
</script>
@endsection