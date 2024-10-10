

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
        var responsavel = $(this).data('responsavel');
        var cpfResponsavel = $(this).data('cpf-responsavel');

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
    $('.editar-paciente').click(function () {
        var id = $(this).data('id');
        var nome = $(this).data('nome');
        var email = $(this).data('email');
        var dataNasci = $(this).data('data-nasci');
        var telefone = $(this).data('telefone');
        var cpf = $(this).data('cpf');
        var cidade = $(this).data('cidade');
        var responsavel = $(this).data('responsavel');
        var cpfResponsavel = $(this).data('cpf-responsavel');
        var convenioId = $(this).data('convenio-id'); // Adicione esta linha

        // Preenche os campos do formulário
        $('#editar-id').val(id);
        $('#editar-nome').val(nome);
        $('#editar-email').val(email);
        $('#editar-data-nasci').val(dataNasci);
        $('#editar-telefone').val(telefone);
        $('#editar-cpf').val(cpf);
        $('#editar-cidade').val(cidade);
        $('#editar-responsavel').val(responsavel);
        $('#editar-cpf-responsavel').val(cpfResponsavel);
        
        // Selecione o convênio correto
        $('#fk_convenio_paci').val(convenioId); // Adicione esta linha

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
            $('#editar-responsavel').prop('required', false);
            $('#editar-cpf-responsavel').prop('required', false);
        } else {
            $('#editar-responsavel').closest('.form-group').show();
            $('#editar-cpf-responsavel').closest('.form-group').show();
            $('#editar-responsavel').prop('required', true);
            $('#editar-cpf-responsavel').prop('required', true);
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

    var formData = $(this).serializeArray();
    var data = {};
    $.each(formData, function (index, field) {
        if (field.name !== 'responsavel' && field.name !== 'cpf_responsavel' || $('#editar-responsavel').closest('.form-group').is(':visible')) {
            data[field.name] = field.value;
        }
    });
    data['email'] = $('#editar-email').val();
    data['fk_convenio_paci'] = $('#fk_convenio_paci').val(); // Atualiza o valor do campo fk_convenio_paci

    $.ajax({
        type: 'POST',
        url: '/update-paciente', 
        data: JSON.stringify(data), // Envia os dados como JSON
        contentType: 'application/json',
        success: function (data) {
            if (data.success) {
                // Atualize a tabela aqui
                var pacienteRow = $('tr[data-id="' + $('#editar-id').val() + '"]');
                pacienteRow.find('td:eq(1)').text($('#editar-nome').val());
                pacienteRow.find('td:eq(2)').text($('#editar-data-nasci').val());
                pacienteRow.find('td:eq(3)').text($('#fk_convenio_paci').val()); 
                pacienteRow.find('td:eq(4)').text($('#editar-telefone').val());
                pacienteRow.find('td:eq(5)').text($('#editar-cpf').val());
                pacienteRow.find('td:eq(6)').text($('#editar-cidade').val());
                pacienteRow.find('td:eq(7)').text($('#editar-responsavel').val());
                pacienteRow.find('td:eq(8)').text($('#editar-cpf-responsavel').val());
                pacienteRow.find('td:eq(9)').text($('#editar-email').val());
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
        url: '/covenios', 
        success: function (data) {
            console.log(data);
        }
    });
}

// Função para aplicar a máscara de CPF
function aplicarMascaraCPF(input) {
    let cpf = input.value.replace(/\D/g, ''); // Remove tudo que não for dígito
    if (cpf.length <= 11) {
        cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
        cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
        cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    }
    input.value = cpf;
}

// Função para aplicar máscara de telefone
function aplicarMascaraTelefone(input) {
    let telefone = input.value.replace(/\D/g, '');
    telefone = telefone.replace(/(\d{2})(\d)/, '($1) $2');
    telefone = telefone.replace(/(\d{4})(\d)/, '$1-$2');
    input.value = telefone;
}

// Add event listeners to the input fields
document.addEventListener('DOMContentLoaded', function () {
    const cpfInput = document.getElementById('editar-cpf');
    cpfInput.addEventListener('input', function () {
        aplicarMascaraCPF(cpfInput);
    });

    const telefoneInput = document.getElementById('editar-telefone');
    telefoneInput.addEventListener('input', function () {
        aplicarMascaraTelefone(telefoneInput);
    });
});
