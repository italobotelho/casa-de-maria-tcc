<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Seus Pacientes</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
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


</head>

<body>
    {{-- testanddoo --}}

    <a href="form_paciente">CADASTRAR PACIENTE</a>


    <div class="container">
        <!-- Formulário de busca -->
        <form action="{{ url('/buscar_pacientes') }}" method="GET" class="form-inline mb-4">
            <div class="form-group">
                <label for="nome_paci">Nome:</label>
                <input type="text" name="nome_paci" id="nome_paci" class="form-control" placeholder="Nome do paciente">
            </div>
            <div class="form-group">
                <label for="data_nasc_paci">Data de Nascimento:</label>
                <input type="date" name="data_nasc_paci" id="data_nasc_paci" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>

<script>
    window.onload = function() {
        // Limpa os parâmetros da URL
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.pathname);
        }
    }
</script>

        <div class="row justify-content-center">
            <div class="col-lg-8 mt-4"></div>
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-success text-white d-flex justify-content-between">
                        <h1 class="fw-bold">Pacientes</h1>
                    </div>
                    <div class="card-body p-4">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Código</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Data Nascimento</th>
                                    <th scope="col">Convênio</th>
                                    <th scope="col">Carteira</th>
                                    <th scope="col">Telefone</th>
                                    <th scope="col">CPF</th>
                                    <th scope="col">Cidade</th>
                                    <th scope="col">Nome Responsável</th>
                                    <th scope="col">CPF Responsável</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pacientes as $paciente)
                                <tr>
                                    <th scope="row">{{ $paciente->pk_cod_paci }}</th>
                                    <td>
                                        <a href="#" class="nome-paciente"
                                            data-id="{{ $paciente->pk_cod_paci }}"
                                            data-nome="{{ $paciente->nome_paci }}"
                                            data-data-nasci="{{ \Carbon\Carbon::parse($paciente->data_nasci_paci)->format('d/m/Y') }}"
                                            data-convenio="{{ $paciente->convenio->nome_conv }}"
                                            data-telefone="{{ $paciente->telefone_paci }}"
                                            data-cpf="{{ $paciente->cpf_paci }}"
                                            data-cidade="{{ $paciente->nome_cidade }}"
                                            data-responsavel="{{ $paciente->responsavel_paci }}"
                                            data-cpf-responsavel="{{ $paciente->cpf_responsavel_paci }}"
                                            data-carteira-convenio="{{ $paciente->carteira_convenio_paci }}">
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
                                            data-cpf-responsavel="{{ $paciente->cpf_responsavel_paci }}"
                                            data-carteira-convenio="{{ $paciente->carteira_convenio_paci }}">
                                            Editar
                                        </button>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($paciente->data_nasci_paci)->format('d/m/Y') }}</td>
                                    <td>{{ $paciente->convenio->nome_conv }}</td>
                                    <td>{{ $paciente->carteira_convenio_paci }}</td>
                                    <td>{{ $paciente->telefone_paci }}</td>
                                    <td>{{ $paciente->cpf_paci }}</td>
                                    <td>{{ $paciente->nome_cidade }}</td>
                                    <td>{{ $paciente->responsavel_paci }}</td>
                                    <td>{{ $paciente->cpf_responsavel_paci }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="text-center fs-4">
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

    <a href="menu">VOLTAR</a>

    <div id="pacienteModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Informações do Paciente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Nome:</strong> <span id="nome-paciente"></span></p>
                    <p><strong>Data de Nascimento:</strong> <span id="data-nascimento"></span></p>
                    <p><strong>Convênio:</strong><span id="convenio"></span></p>
                    <p><strong>Carteira do Convênio:</strong><span id="carteira_convenio"></span></p>
                    <p><strong>Telefone:</strong> <span id="telefone"></span></p>
                    <p><strong>CPF:</strong><span id="cpf"></span></p>
                    <p><strong>Cidade:</strong><span id="cidade"></span></p>
                    <p><strong>Responavel:</strong><span id="responsavel"></span></p>
                    <p><strong>CPF do Responsavel:</strong><span id="cpf-responsavel"></span></p>
                </div>
            </div>
        </div>
    </div>



    {{-- modal edicao --}}

    <div class="modal fade" id="editarPacienteModal" tabindex="-1" role="dialog" aria-labelledby="editarPacienteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="editarPacienteModalLabel">Editar Paciente</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('paciente.update') }}" id="formEditarPaciente">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-body">
                        <input maxlength="54" type="text" id="editar-id" name="id">
                        <div class="form-group">
                            <label for="editar-nome">Nome</label>
                            <input type="text" class="form-control" id="editar-nome" name="nome" required>
                        </div>
                        <div class="form-group">
                            <label for="editar-email">E-mail</label>
                            <input type="email" maxlength="255" class="form-control" id="editar-email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="editar-data-nasci">Data de Nascimento</label>
                            <input type="date" class="form-control" id="editar-data-nasci" name="data_nasci" required>
                        </div>


                        <div class="form-group">
                            <label for="fk_convenio_paci">Convênio</label>
                            <select name="fk_convenio_paci" id="fk_convenio_paci">
                                @foreach($convenios as $convenio)
                                <option value="{{ $convenio->pk_id_conv }}"
                                    @if(isset($paciente) && $convenio->pk_id_conv === $paciente->fk_convenio_paci) selected @endif>
                                    {{ $convenio->nome_conv }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div id="carteira-convenio-field" style="display: none;">
                            <label for="editar-carteira-convenio">Carteira do Convênio:</label>
                            <input type="text" maxlength="255" id="editar-carteira-convenio" name="carteira_convenio">
                        </div>



                        <div class="form-group">
                            <label for="editar-telefone">Telefone</label>
                            <input type="text"
                                maxlength="15"
                                class="form-control" id="editar-telefone" name="telefone" required>
                        </div>
                        <div class="form-group">
                            <label for="editar-cpf">CPF</label>
                            <input type="text"
                                maxlength="14"
                                class="form-control" id="editar-cpf" name="cpf" required>
                        </div>
                        <div class="form-group">
                            <label for="editar-cidade">Cidade</label>
                            <input type="text"
                                maxlength="100" class="form-control" id="editar-cidade" name="cidade" required>
                        </div>
                        <div class="form-group">
                            <label for="editar-responsavel">Nome do Responsável</label>
                            <input type="text" class="form-control" id="editar-responsavel" name="responsavel">
                        </div>
                        <div class="form-group">
                            <label for="editar-cpf-responsavel">CPF do Responsável</label>
                            <input type="text" class="form-control" id="editar-cpf-responsavel" name="cpf_responsavel">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="js/paciente.js"></script>



</body>

</html>