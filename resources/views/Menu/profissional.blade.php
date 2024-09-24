    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="pt-br">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Medicos</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>

    <body>
        <a href="form_medico">CADASTRAR MEDICO</a>
        <h1>PROFISSIONAL</h1>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 mt-4">
                </div>
                <div class="col-lg-8">
                    <div class="card shadow">
                        <div class="card-header bg-success text-white d-flex justify-content-between">
                            <h1 class="fw-bold">Medicos</h1>
                        </div>
                        <div class="card-body p-4">
                            <table class="table table-striped">
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
                        </div>
                    </div>
                </div><!-- fim da col -->
            </div><!-- fim da row -->
        </div> <!-- fim do container -->



    </body>

    </html>
