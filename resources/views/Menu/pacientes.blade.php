<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="">
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
                                    <button class="btn btn-warning btn-sm editar-paciente" data-id="{{ $paciente->pk_cod_paci }}" data-nome="{{ $paciente->nome_paci }}" data-data-nasci="{{ \Carbon\Carbon::parse($paciente->data_nasci_paci)->format('Y-m-d') }}" data-convenio="{{ $paciente->convenio->nome_conv }}" data-telefone="{{ $paciente->telefone_paci }}" data-cpf="{{ $paciente->cpf_paci }}" data-cidade="{{ $paciente->nome_cidade }}" data-responsavel="{{ $paciente->responsavel_paci }}" data-cpf-responsavel="{{ $paciente->cpf_responsavel_paci }}">
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
  <!-- Remove the duplicate modal -->
<div class="modal fade" id="pacienteModal" tabindex="-1" role="dialog" aria-labelledby="pacienteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="pacienteModalLabel">Detalhes do Paciente</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <p><strong>Nome:</strong> <span id="nome-paciente"></span></p>
            <p><strong>Data de Nascimento:</strong> <span id="data-nascimento"></span></p>
            <p><strong>Convênio:</strong> <span id="convenio"></span></p>
            <p><strong>Telefone:</strong> <span id="telefone"></span></p>
            <p><strong>CPF:</strong> <span id="cpf"></span></p>
            <p><strong>Cidade:</strong> <span id="cidade"></span></p>
            <p><strong>Responsável:</strong> <span id="responsavel"></span></p>
            <p><strong>CPF do Responsável:</strong> <span id="cpf-responsavel"></span></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>

        </div>
      </div>
    </div>
  </div>


  {{-- modal edicao --}}
  <div class="modal fade" id="editarPacienteModal" tabindex="-1" role="dialog" aria-labelledby="editarPacienteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarPacienteModalLabel">Editar Paciente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formEditarPaciente">
                <div class="modal-body">
                    <input type="hidden" id="editar-id" name="id">
                    <div class="form-group">
                        <label for="editar-nome">Nome</label>
                        <input type="text" class="form-control" id="editar-nome" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label for="editar-data-nasci">Data de Nascimento</label>
                        <input type="date" class="form-control" id="editar-data-nasci" name="data_nasci" required>
                    </div>
                    <div class="form-group">
                        <label for="editar-convenio">Convênio</label>
                        <input type="text" class="form-control" id="editar-convenio" name="convenio" required>
                    </div>
                    <div class="form-group">
                        <label for="editar-telefone">Telefone</label>
                        <input type="text" class="form-control" id="editar-telefone" name="telefone" required>
                    </div>
                    <div class="form-group">
                        <label for="editar-cpf">CPF</label>
                        <input type="text" class="form-control" id="editar-cpf" name="cpf" required>
                    </div>
                    <div class="form-group">
                        <label for="editar-cidade">Cidade</label>
                        <input type="text" class="form-control" id="editar-cidade" name="cidade" required>
                    </div>
                    <div class="form-group">
                        <label for="editar-responsavel">Nome do Responsável</label>
                        <input type="text" class="form-control" id="editar-responsavel" name="responsavel" required>
                    </div>
                    <div class="form-group">
                        <label for="editar-cpf-responsavel">CPF do Responsável</label>
                        <input type="text" class="form-control" id="editar-cpf-responsavel" name="cpf_responsavel" required>
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

  

</body>
</html>
<script>
// Adiciona um evento de clique nos nomes dos pacientes
$(document).ready(function() {
    $('.nome-paciente').click(function() {
        var id = $(this).data('id');
        var nome = $(this).data('nome');
        var dataNasci = $(this).data('data-nasci');
        var convenio = $(this).data('convenio');
        var telefone = $(this).data('telefone');
        var cpf = $(this).data('cpf');
        var cidade = $(this).data('cidade');
        var responsavel = $(this).data('responsavel'); // Adicione essa linha
        var cpfResponsavel = $(this).data('cpf-responsavel'); // Adicione essa linha
        
        abrirModalPaciente(id, nome, dataNasci, convenio, telefone, cpf, cidade, responsavel, cpfResponsavel);
    });
});

// Função para abrir o modal
function abrirModalPaciente(id, nome, dataNasci, convenio, telefone, cpf, cidade, responsavel, cpfResponsavel) {
    // Preenche os campos do modal com as informações do paciente
    $('#nome-paciente').text(nome);
    $('#data-nascimento').text(dataNasci);
    $('#convenio').text(convenio);
    $('#telefone').text(telefone);
    $('#cpf').text(cpf);
    $('#cidade').text(cidade);
    $('#responsavel').text(responsavel);
    $('#cpf-responsavel').text(cpfResponsavel);
    // Abre o modal
    $('#pacienteModal').modal('show');
}


    // sript para abri o modal e preencher 
    $(document).ready(function() {
        $('.editar-paciente').click(function() {
        var id = $(this).data('id');
        var nome = $(this).data('nome');
        var dataNasci = $(this).data('data-nasci');
        var convenio = $(this).data('convenio');
        var telefone = $(this).data('telefone');
        var cpf = $(this).data('cpf');
        var cidade = $(this).data('cidade');
        var responsavel = $(this).data('responsavel');
        var cpfResponsavel = $(this).data('cpf-responsavel');

        // Preenche os campos do formulário
        $('#editar-id').val(id);
        $('#editar-nome').val(nome);
        $('#editar-data-nasci').val(dataNasci);
        $('#editar-convenio').val(convenio);
        $('#editar-telefone').val(telefone);
        $('#editar-cpf').val(cpf);
        $('#editar-cidade').val(cidade);
        $('#editar-responsavel').val(responsavel);
        $('#editar-cpf-responsavel').val(cpfResponsavel);

        // Verifica se a pessoa é maior de idade
        var birthDate = new Date(dataNasci);
        var today = new Date();
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }

        // Mostra ou esconde os campos do responsável
        if (age >= 18) {
            $('#editar-responsavel').closest('.form-group').hide();
            $('#editar-cpf-responsavel').closest('.form-group').hide();
        } else {
            $('#editar-responsavel').closest('.form-group').show();
            $('#editar-cpf-responsavel').closest('.form-group').show();
        }

        $('#editarPacienteModal').modal('show');
    });

    // Enviar o formulário de edição
    $('#formEditarPaciente').submit(function(event) {
        event.preventDefault();
        // Aqui você pode adicionar a lógica para atualizar os dados via AJAX ou outro método
        alert('Dados do paciente atualizados!');
        $('#editarPacienteModal').modal('hide');
    });


});

// Enviar o formulário de edição
$('#formEditarPaciente').submit(function(event) {
    event.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        type: 'POST',
        url: '/update-paciente', // Update this URL to your server-side endpoint
        data: formData,
        success: function(data) {
            // Update the table row with the new data
            var pacienteId = $('#editar-id').val();
            var pacienteRow = $('tr[data-id="' + pacienteId + '"]');
            pacienteRow.find('td:eq(1)').text($('#editar-nome').val());
            pacienteRow.find('td:eq(2)').text($('#editar-data-nasci').val());
            pacienteRow.find('td:eq(3)').text($('#editar-convenio').val());
            pacienteRow.find('td:eq(4)').text($('#editar-telefone').val());
            pacienteRow.find('td:eq(5)').text($('#editar-cpf').val());
            pacienteRow.find('td:eq(6)').text($('#editar-cidade').val());
            pacienteRow.find('td:eq(7)').text($('#editar-responsavel').val());
            pacienteRow.find('td:eq(8)').text($('#editar-cpf-responsavel').val());
            // Close the modal
            $('#editarPacienteModal').modal('hide');
            alert('Dados do paciente atualizados!');
        },
        error: function(xhr, status, error) {
            console.error(error);
            alert('Erro ao atualizar dados do paciente!');
        }
    });
});



</script>