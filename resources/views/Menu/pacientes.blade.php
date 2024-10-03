<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="pt-br">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PACI</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


</head>
<body>

    <a href="form_paciente">CADASTRAR PACIENTE</a>


    <div class="container">
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
                                <td>{{ \Carbon\Carbon::parse($paciente->data_nasci_paci)->format('d/m/Y') }}</td>
                                <td>{{$paciente->convenio->nome_conv}}</td>
                                <td>{{$paciente->telefone_paci}}</td>
                                <td>{{$paciente->cpf_paci}}</td>
                                <td>{{$paciente->nome_cidade}}</td>
                             
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

    <a href="menu">VOLTAR</a>

</body>
</html>
