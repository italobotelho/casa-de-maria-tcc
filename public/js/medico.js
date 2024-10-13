$(document).ready(function () {
    $(".nome-medico").click(function () {
        var id = $(this).data("id");
        var nome = $(this).data("nome");
        var especialidade = $(this).data("especialidade");
        var telefone = $(this).data("telefone");
        var email = $(this).data("email");

        abrirModalMedico(id, nome, especialidade, telefone, email);
    });

    $(".editar-medico").click(function () {
        var id = $(this).data("id");
        var nome = $(this).data("nome");
        var especialidade = $(this).data("especialidade");
        var telefone = $(this).data("telefone");
        var email = $(this).data("email");

        // Preenche os campos do formulário
        $("#editar-id").val(id);
        $("#editar-nome").val(nome);
        $("#editar-especialidade").val(especialidade);
        $("#editar-telefone").val(telefone);
        $("#editar-email").val(email);

        $("#editarMedicoModal").modal("show");
    });
});

    // Enviar o formulário de edição
    $("#formEditarMedico").submit(function (event) {
        event.preventDefault();

        var formData = $(this).serializeArray();
        var data = {};
        $.each(formData, function (index, field) {
            data[field.name] = field.value;
        });

        $.ajax({
            type: "POST",
            url: "/update-medico",
            data: JSON.stringify(data),
            contentType: "application/json",
            

            success: function (data) {
                if (data.success) {
                    // Atualize a tabela aqui
                    var medicoRow = $( 'tr[data-id="' + $("#editar-id").val() + '"]' );
                    medicoRow.find("td:eq(1)").text($("#editar-nome").val());
                    medicoRow.find("td:eq(2)").text($("#editar-especialidade").val());
                    medicoRow.find("td:eq(3)").text($("#editar-telefone").val());
                    medicoRow.find("td:eq(4)").text($("#editar-email").val());
                    $("#editarMedicoModal").modal("hide");
                    alert(data.message);
                } else {
                    alert(data.error);
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                console.log(status);
                console.log(error);
                alert("Erro ao atualizar dados do médico!");
            },
        });
    });


function abrirModalMedico(
    id,
    nome,
    especialidade,
    telefone,
    email
) {
    console.log("Dados do Médico:", {
        id,
        nome,
        especialidade,
        telefone,
        email
    });

    // Preenche os campos do modal
    $("#nome-medico").text(nome);
    $("#especialidade").text(especialidade);
    $("#telefone").text(telefone);
    $("#email").text(email);

    // Abre o modal
    $('#medicoModal').modal('show');
}

$('#editarMedicoModal').on('hidden.bs.modal', function () {
    $(this).removeData('bs.modal');
    $('#formEditarMedico')[0].reset();
});


            

        function aplicarMascaraTelefone(input) {
            let telefone = input.value.replace(/\D/g, '');
            telefone = telefone.replace(/(\d{2})(\d)/, '($1) $2');
            telefone = telefone.replace(/(\d{4})(\d)/, '$1-$2');
            input.value = telefone;
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Aplica a máscara no campo de telefone
            const telefoneInput = document.getElementById('telefone_med');
            telefoneInput.addEventListener('input', function () {
                aplicarMascaraTelefone(telefoneInput);
            });
        });

