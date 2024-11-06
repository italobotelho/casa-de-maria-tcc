$(document).ready(function () {
    // Função para aumentar ou diminuir o horário
    function adjustTime(selector, adjustment) {
        let currentTime = $(selector).val();
        if (currentTime) {
            let newTime = moment(currentTime, "HH:mm").add(adjustment, 'minutes').format("HH:mm");
            $(selector).val(newTime);
        }
    }

    // Quando o modal for aberto
    $('#modalCalendar').on('show.bs.modal', function () {
        // Carregar procedimentos apenas uma vez ou adicionar lógica para verificar se já foram carregados
        if ($("#modalCalendar select[name='procedimento_id'] option").length === 0) {
            $.ajax({
                url: '/get-procedimentos',
                method: 'GET',
                success: function (data) {
                    let select = $('#procedimento_id');
                    select.empty();
                    select.append('<option selected>Selecione um Procedimento</option>');
                    $.each(data, function (index, procedimento) {
                        select.append('<option value="' + procedimento.pk_cod_proc + '">' + procedimento.nome_proc + '</option>');
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Erro ao carregar procedimentos:', error);
                }
            });
        }

        // Carregar convênios
        $.ajax({
            url: '/get-convenios',
            method: 'GET',
            success: function (data) {
                let select = $('#convenio_id'); // Certifique-se de que o ID do select é correto
                select.empty();
                select.append('<option selected>Selecione um Convênio</option>');
                $.each(data, function (index, convenio) {
                    select.append('<option value="' + convenio.id + '">' + convenio.nome + '</option>');
                });
            },
            error: function (xhr, status, error) {
                console.error('Erro ao carregar convênios:', error);
            }
        });

    // Carregar dados do evento 
    let id = $("#modalCalendar input[name='id']").val(); 
    if (id) {
        $.ajax({
            url: `/get-event/${id}`, // Substitua pela URL correta para obter o evento
            method: 'GET',
            success: function (data) {
                // Preencher outros campos do modal

                 $("#modalCalendar").on('shown.bs.modal', function() {
                // Forçar o preenchimento do campo quando o modal é exibido
                 $("#modalCalendar input[name='paciente']").val(data.paciente);
                 });
                 
                $("#modalCalendar select[name='procedimento_id']").val(data.procedimento_id);
                $("#modalCalendar input[name='convenio_id']").val(data.convenio);
                $("#modalCalendar input[name='eventDate']").val(moment(data.start).format("YYYY-MM-DD"));
                $("#modalCalendar input[name='start']").val(moment(data.start).format("HH:mm"));
                $("#modalCalendar input[name='end']").val(moment(data.end).format("HH:mm"));
                $("#modalCalendar input[name='medico']").val(data.medico); // Definindo o médico aqui
                $("#modalCalendar input[name='paciente_id']").val(data.paciente_id);

                // Verificar se o médico está cadastrado
                if (!data.medico || data.medico === 'Médico não cadastrado') {
                    $('#medicoSuggestions').text('Médico não cadastrado');
                } else {
                    $('#medicoSuggestions').text(data.medico);
                }

                if (!data.paciente_id || data.paciente_id === 'Paciente não cadastrado') {
                    $('#pacienteSuggestions').text('Paciente não cadastrado');
                } else {
                    $('#pacienteSuggestions').text(data.paciente_id);
                }
            },
            error: function (xhr, status, error) {
                console.error('Erro ao carregar os dados do evento:', xhr.responseText); // Exibir a resposta completa
            }
        });
    }
});


    // Mostrar botões ao clicar no input
    $("#start").focus(function () {
        $("#startButtons").show();
    });

    $("#end").focus(function () {
        $("#endButtons").show();
    });

    // Manter os botões visíveis quando o mouse estiver sobre eles
    $("#startButtons").mouseenter(function () {
        $(this).show();
    }).mouseleave(function () {
        $(this).hide();
    });

    $("#endButtons").mouseenter(function () {
        $(this).show();
    }).mouseleave(function () {
        $(this).hide();
    });

    // Aumentar e diminuir horários
    $("#increaseStartTime").click(function () {
        adjustTime("#start", 30);
    });

    $("#decreaseStartTime").click(function () {
        adjustTime("#start", -30);
    });

    $("#increaseEndTime").click(function () {
        adjustTime("#end", 30);
    });

    $("#decreaseEndTime").click(function () {
        adjustTime("#end", -30);
    });

    // Adiciona o evento de clique para os itens do dropdown
    $('.dropdown-item').click(function () {
        let color = $(this).data('color'); // Obtém a cor do item clicado
        $("#color").val(color); // Atualiza o campo oculto de cor no modal

        // Se você quiser também mudar a cor do evento no calendário imediatamente
        if (currentEvent) {
            currentEvent.setProp('backgroundColor', color); // Muda a cor do evento no calendário
        }

        // Envia a nova cor para o backend
        let eventId = currentEvent ? currentEvent.id : null; // Obtém o ID do evento atual
        if (eventId) {
            let route = '/event-update-color'; // Nova rota para atualização de cor
            let updatedColor = {
                id: eventId,
                color: color
            };

            // Envia a requisição AJAX para salvar a nova cor
            $.ajax({
                url: route,
                method: 'POST',
                data: updatedColor,
                success: function (response) {
                    // Atualiza a página ou o calendário após a resposta
                    location.reload(); // Atualiza a página
                },
                error: function (xhr) {
                    console.error('Erro ao salvar a cor:', xhr.responseText);
                }
            });
        }
    });

    // Configuração do AJAX para CSRF
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(".deleteEvent").click(function () {
        // Abre o modal de confirmação
        $('#confirmDeleteModal').modal('show');
    });

    // Quando o botão de confirmação no modal de exclusão é clicado
    $('#confirmDeleteButton').click(function () {
        let id = $("#modalCalendar input[name='id']").val();
        let Event = { id: id, _method: 'DELETE' };
        let route = routeEvents('routeEventDelete');
        sendEvent(route, Event);
        $('#confirmDeleteModal').modal('hide'); // Fecha o modal de confirmação após a exclusão
        $('#successMessage').hide(); // Esconde a mensagem de sucesso
    });

    $(".saveEvent").click(function () {
        const pacienteNaoCadastrado = $('#pacienteSuggestions').text().includes('Paciente não cadastrado');
        if (pacienteNaoCadastrado) {
            alert('Não é possível agendar. Paciente não cadastrado.');
            return;
        }
        
        let id = $("#modalCalendar input[name='id']").val();
        let title = $("#modalCalendar input[name='paciente']").val();
        let pacienteId = $("#modalCalendar input[name='paciente_id']").val(); // Certifique-se de que este valor está correto
         console.log("Paciente ID:", pacienteId); // Adicione este log para depuração
        let procedimentoId = $("#modalCalendar select[name='procedimento_id']").val();
        let convenioId = $("#modalCalendar input[name='convenio_id']").val();
        let selectedDate = $("#modalCalendar input[name='eventDate']").val();
        let startTime = $("#modalCalendar input[name='start']").val();
        let endTime = $("#modalCalendar input[name='end']").val();
        let medico = $("#modalCalendar input[name='medico']").val();
        let color = $("#modalCalendar input[name='color']").val() || "#9D9D9B"; // Captura o ID do médico

        if (!procedimentoId || procedimentoId === 'Selecione um Procedimento') {
            alert('Procedimento não selecionado. Por favor, escolha um procedimento para continuar.');
            return;
        }

        if (!selectedDate || !startTime || !endTime) {
            console.error("Data ou horário não definidos.");
            return;
        }


        let start = moment(`${selectedDate}T${startTime}`, "YYYY-MM-DDTHH:mm").format("YYYY-MM-DD HH:mm:ss");
        let end = moment(`${selectedDate}T${endTime}`, "YYYY-MM-DDTHH:mm").format("YYYY-MM-DD HH:mm:ss");

        let Event = {
          title: title,
          start: start,
          end: end,
          color: color,
          procedimento_id: procedimentoId,
          convenio: convenioId,
          medico: medico,
          paciente_id: pacienteId
        };

        let route;
        if (id === '') {
            route = routeEvents('routeEventStore');
        } else {
            route = routeEvents('routeEventUpdate');
            Event.id = id;
            Event._method = "PUT";
        }

        sendEvent(route, Event);
    });

    $(".saveEvent").off("click").on("click", function () {

        // Verifique se a mensagem de paciente não cadastrado está presente
        const pacienteNaoCadastrado = $('#pacienteSuggestions').text().includes('Paciente não cadastrado');
        if (pacienteNaoCadastrado) {
            alert('Não é possível agendar. Paciente não cadastrado.'); // Alerta ao usuário
            return; // Impede o agendamento
        }

        // Verifique se a sugestão de médico está vazia ou se contém "Médico não cadastrado"
        const medicoSuggestionsText = $('#medicoSuggestions').text();
        if (!medicoSuggestionsText || medicoSuggestionsText.includes('Médico não cadastrado')) {
            alert('Não é possível agendar. Médico não cadastrado.'); // Alerta ao usuário
            return; // Impede o agendamento
        }

        let id = $("#modalCalendar input[name='id']").val();
        let title = $("#modalCalendar input[name='paciente']").val();
        let pacienteId = $("#modalCalendar input[name='paciente_id']").val(); // Certifique-se de que este valor está correto
          console.log("Paciente ID:", pacienteId); // Adicione este log para depuração
        let procedimentoId = $("#modalCalendar select[name='procedimento_id']").val();
        let convenioId = $("#modalCalendar input[name='convenio_id']").val(); // Acesse o valor do convênio aqui
        let selectedDate = $("#modalCalendar input[name='eventDate']").val();
        let startTime = $("#modalCalendar input[name='start']").val();
        let endTime = $("#modalCalendar input[name='end']").val();
        let medico = $("#modalCalendar input[name='medico']").val(); // Adicione esta linha para obter o médico

        // Verifique se o procedimento foi selecionado
        if (!procedimentoId || procedimentoId === 'Selecione um Procedimento') {
            alert('Procedimento não selecionado. Por favor, escolha um procedimento para continuar.');
            return; // Impede o agendamento
        }

        if (!selectedDate || !startTime || !endTime) {
            console.error("Data ou horário não definidos.");
            return;
        }

        let color = $("#modalCalendar input[name='color']").val() || "#9D9D9B";
        let start = moment(`${selectedDate}T${startTime}`, "YYYY-MM-DDTHH:mm").format("YYYY-MM-DD HH:mm:ss");
        let end = moment(`${selectedDate}T${endTime}`, "YYYY-MM-DDTHH:mm").format("YYYY-MM-DD HH:mm:ss");

        let Event = {
            title: title,
            start: start,
            end: end,
            color: color,
            procedimento_id: procedimentoId,
            convenio: convenioId, // Inclua o convênio no objeto Event
            medico: medico, // Inclua o médico no objeto Event
            paciente_id: pacienteId
        };

        let route;
        if (id === '') {
            route = routeEvents('routeEventStore');
        } else {
            route = routeEvents('routeEventUpdate');
            Event.id = id;
            Event._method = "PUT";
        }

        sendEvent(route, Event);
    });

    // Adiciona evento para o botão de fechar do modal
    document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(button => {
        button.addEventListener('click', function () {
            $('#successMessage').hide(); // Esconde a mensagem de sucesso
        });
    });
});

function sendEvent(route, data_, isDelete = false) {
    $.ajax({
        url: route,
        data: data_,
        method: "POST",
        dataType: "json",
        success: function (json) {
            if (json) {
                if (!isDelete) { // Verifica se não é uma operação de exclusão
                    let message;
                    if (data_.id) { // Verifica se é uma atualização
                        $('#successAlterationModal').modal('show'); // Mostra o modal de alteração realizada
                    } else {
                        $('#successModal').modal('show'); // Mostra o modal de cadastro realizado
                    }
                    $("#successMessageContent").text(message);
                    $('#modalCalendar').modal('hide');
                    //location.reload();
                }
            }
        },
        error: function (json) {
            let responseJSON = json.responseJSON.errors;
            $("#message").html(loadErrors(responseJSON));
        },
    });
}

// Quando o botão de confirmação no modal de exclusão é clicado
$('#confirmDeleteButton').click(function () {
    let id = $("#modalCalendar input[name='id']").val();
    let Event = { id: id, _method: 'DELETE' };
    let route = routeEvents('routeEventDelete');
    sendEvent(route, Event, true); // Passa 'true' para indicar que é uma exclusão
    $('#confirmDeleteModal').modal('hide'); // Fecha o modal de confirmação após a exclusão
    $('#successMessage').hide(); // Esconde a mensagem de sucesso
});


function loadErrors(response) {
    let boxAlert = `<div class="alert alert-danger">`;

    for (let fields in response) {
        boxAlert += `<span>${response[fields]}</span><br>`;
    }

    boxAlert += `</div>`;

    return boxAlert.replace(/\,/g, "<br>");
}

function routeEvents(route) {
    return document.getElementById("calendar").dataset[route];
}

function clearMessages(element) {
    $(element).text('');
}

function resetForm(form) {
    $(form)[0].reset();
}
// Limpar o modal ao ser fechado
$('#modalCalendar').on('hidden.bs.modal', function () {
    // Limpa os campos do modal
    $(this).find('input, select').val(''); // Limpa todos os campos de input e select
    $(this).find('select').prop('selectedIndex', 0); // Reseta os selects para o primeiro valor
    $(this).find('.alert').remove(); // Remove qualquer mensagem de erro ou alerta
    clearMessages('#message'); // Limpa as mensagens de erro ou sucesso
});
