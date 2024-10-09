

// Adiciona um evento de clique nos nomes dos pacientes
$(document).ready(function () {
    $('.nome-paciente').click(function () {
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


$(document).ready(function () {
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
        $('#fk_convenio_paci').val(convenio); // Preenche o campo de seleção de convênio com o valor do convênio do paciente
        $('#editar-telefone').val(telefone);
        $('#editar-cpf').val(cpf);
        $('#editar-cidade').val(cidade);
        $('#editar-responsavel').val(responsavel);
        $('#editar-cpf-responsavel').val(cpfResponsavel);
    
        // Selecione o convênio correto no campo de seleção
        $('#fk_convenio_paci').find('option').each(function() {
            if ($(this).text() == convenio) {
                $(this).prop('selected', true);
            }
        });
    
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




});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


// Enviar o formulário de edição
$('#formEditarPaciente').submit(function (event) {
    event.preventDefault();

    var formData = $(this).serialize();
    $.ajax({
        type: 'POST',
        url: '/update-paciente', // URL to update patient data
        data: formData,
        success: function (data) {
            if (data.success) {
                // Atualize a tabela aqui
                var pacienteRow = $('tr[data-id="' + $('#editar-id').val() + '"]');
                pacienteRow.find('td:eq(1)').text($('#editar-nome').val());
                pacienteRow.find('td:eq(2)').text($('#editar-data-nasci').val());
                pacienteRow.find('td:eq(3)').text($('#editar-convenio').val());
                pacienteRow.find('td:eq(4)').text($('#editar-telefone').val());
                pacienteRow.find('td:eq(5)').text($('#editar-cpf').val());
                pacienteRow.find('td:eq(6)').text($('#editar-cidade').val());
                pacienteRow.find('td:eq(7)').text($('#editar-responsavel').val());
                pacienteRow.find('td:eq(8)').text($('#editar-cpf-responsavel').val());
                $('#editarPacienteModal').modal('hide');
                alert(data.message);
            } else {
                alert(data.error);
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
            console.log(status);
            console.log(error);
            alert('Erro ao atualizar dados do paciente!');
        }
    });
});

function buscarConvenios() {
    return $.ajax({
        type: 'GET',
        url: '/covenios', // URL para buscar convênios
        success: function (data) {
            console.log(data); // Adicione essa linha
        }
    });
}
