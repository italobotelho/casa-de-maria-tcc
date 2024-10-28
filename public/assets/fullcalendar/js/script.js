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

    // Configuração do AJAX para CSRF
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(".deleteEvent").click(function () {
        let id = $("#modalCalendar input[name='id']").val();
        let Event = { id: id, _method: 'DELETE' };
        let route = routeEvents('routeEventDelete');
        sendEvent(route, Event);
    });

    $(".saveEvent").click(function () {
        // Verifique se a mensagem de paciente não cadastrado está presente
        const pacienteNaoCadastrado = $('#pacienteSuggestions').text().includes('Paciente não cadastrado');
        if (pacienteNaoCadastrado) {
            alert('Não é possível agendar. Paciente não cadastrado.'); // Alerta ao usuário
            return; // Impede o agendamento
        }
    
        let id = $("#modalCalendar input[name='id']").val();
        let title = $("#modalCalendar input[name='paciente']").val();
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
            medico: medico // Inclua o médico no objeto Event
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
});

// Adiciona o evento de clique nos itens do dropdown
$(document).on('click', '.dropdown-item', function (e) {
    e.preventDefault(); // Impede o comportamento padrão do link
    const selectedColor = $(this).data('color'); // Obtém a cor do atributo data-color
  
    if (currentEvent) {
        // Altera a cor de fundo do evento
        currentEvent.setProp('backgroundColor', selectedColor);
        currentEvent.setProp('borderColor', selectedColor); // Altera a cor da borda do evento, se necessário
  
        // Captura outros dados necessários
        const title = currentEvent.title; // Supondo que o título esteja armazenado no evento
        const start = currentEvent.start; // Data e hora de início
        const end = currentEvent.end; // Data e hora de fim
        const convenio = currentEvent.convenio; // Verifique se este valor é capturado corretamente
        const medico = currentEvent.medico; // Verifique se este valor é capturado corretamente
        const procedimento_id = currentEvent.procedimento_id; // Verifique se este valor é capturado corretamente

        // Validações
        if (!title) {
            alert('O campo título é obrigatório.');
            return;
        }
        if (!procedimento_id) {
            alert('Selecione um procedimento.');
            return;
        }
        if (!convenio) {
            alert('O campo convênio é obrigatório.');
            return;
        }
        if (!medico) {
            alert('O campo médico é obrigatório.');
            return;
        }
        if (!moment(start).isValid()) {
            alert('Preencha uma data inicial com valor válido!');
            return;
        }
        if (!moment(end).isValid()) {
            alert('Preencha uma data final com valor válido!');
            return;
        }
        if (moment(start).isSameOrAfter(end)) {
            alert('A data/hora inicial deve ser menor que a data final');
            return;
        }

        // Envia a nova cor e outros dados para o servidor
        let newEventData = {
            id: currentEvent.id, // ID do evento
            color: selectedColor, // Nova cor
            title: title, // Adicione o título
            start: moment(start).format("YYYY-MM-DD HH:mm:ss"), // Formate a data de início
            end: moment(end).format("YYYY-MM-DD HH:mm:ss"), // Formate a data de fim
            convenio: convenio, // Adicione o convênio
            medico: medico, // Adicione o médico
            procedimento_id: procedimento_id, // Adicione o procedimento
            _method: 'PUT' // Método para atualização
        };
  
        // Chama a função para enviar a atualização
        let route = routeEvents('routeEventUpdate'); // Obtém a rota para atualização
        sendEvent(route, newEventData); // Envia a requisição para o servidor
    }
});
  
function sendEvent(route, data_) {
    $.ajax({
        url: route,
        data: data_,
        method: "POST",
        dataType: "json",
        success: function (json) {
            if (json) {
                location.reload(); // Recarrega a página após a atualização
            }
        },
        error: function (json) {
            let responseJSON = json.responseJSON.errors;
            $("#message").html(loadErrors(responseJSON));
        },
    });
}

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