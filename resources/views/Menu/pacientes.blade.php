<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pacientes</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body>
    <br><br>
    <h1>Buscar paciente</h1>
    
    <a class="cad" href="form_paciente">CADASTRAR PACIENTE</a>

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

        <h3>RESULTADOS</h3>
        <div class="row justify-content-center">
            <div class="col-lg-8 mt-4"></div>
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header text-white d-flex justify-content-between"></div>
                    <div class="modal-content">
                        <div class="card-body p-4">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">CÓDIGO</th>
                                        <th scope="col">NOME</th>
                                        <th scope="col">DATA NASC.</th>
                                        <th scope="col">CONVÊNIO</th>
                                        <th scope="col">TELEFONE</th>
                                        <th scope="col">CPF</th>
                                        <th scope="col">CIDADE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pacientes as $paciente)
                                        <tr>
                                            <th scope="row">{{$paciente->pk_cod_paci}}</th>
                                            <td>{{$paciente->nome_paci}}</td>
                                            <td>{{ \Carbon\Carbon::parse($paciente->data_nasci_paci)->format('d/m/Y') }}</td>
                                            <td>{{$paciente->convenio->nome_conv}}</td>
                                            <td>{{$paciente->telefone_paci}}</td>
                                            <td>{{$paciente->cpf_paci}}</td>
                                            <td>{{$paciente->nome_cidade}}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center fs-4">Nenhum paciente cadastrado</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
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


    <a class="cad" href="menu">VOLTAR</a>
</body>
</html>
