@extends('Layout/layout')

@section('main')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/busca-med.css">
    <title>Médicos</title>
</head>

<body>
    <h1>Buscar médicos</h1>

    <div class="borda">
        <button>
            <a class="cad" href="form_medico">CADASTRAR MÉDICO</a>
        </button>

        <div class="container">
            <div class="row">
                <div class="col-lg-8 mt-4"></div>
                <div class="col-lg-8">
                    <div class="card shadow">
                        <div class="card-header text-white d-flex justify-content-between fund"></div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">CRM</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">1 Especialidade</th>
                                        <th scope="col">2 Especialidade</th>
                                        <th scope="col">Telefone</th>
                                        <th scope="col">Email</th>
                                        <th></th>
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
                                            </td>
                                            <td>{{ $medico->especialidade1_med }}</td>
                                            <td>{{ $medico->especialidade2_med }}</td>
                                            <td>{{ $medico->telefone_med }}</td>
                                            <td>{{ $medico->email_med }}</td>
                                            <td>
                                                <button class="editar-medico btn-sm" 
                                                        data-id="{{ $medico->pk_crm_med }}" 
                                                        data-nome="{{ $medico->nome_med }}" 
                                                        data-especialidade="{{ $medico->especialidade1_med }}" 
                                                        data-especialidade2="{{ $medico->especialidade2_med }}" 
                                                        data-telefone="{{ $medico->telefone_med }}" 
                                                        data-email="{{ $medico->email_med }}">
                                                    <img src="img/editar.png" alt="Ícone de edição" class="icon">
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center fs-4">
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

        <button>
            <a href="home">VOLTAR</a>
        </button>
    </div>

    <!-- Modal para exibir informações do médico -->
    <div id="medicoModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Informações do Médico</h5>
                </div>
                <div class="modal-body">
                    <p><strong>Nome:</strong> <span id="nome-medico"></span></p>
                    <p><strong>1 Especialidade:</strong> <span id="especialidade"></span></p>
                    <p><strong>2 Especialidade:</strong> <span id="especialidade2"></span></p>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <script src="js/medico.js"></script>
</body>

@endsection

</html>
