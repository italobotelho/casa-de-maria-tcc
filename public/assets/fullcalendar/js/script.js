$(document).ready(function() {
    // Função para aumentar ou diminuir o horário
    function adjustTime(selector, adjustment) {
        let currentTime = $(selector).val();
        if (currentTime) {
            let newTime = moment(currentTime, "HH:mm").add(adjustment, 'minutes').format("HH:mm");
            $(selector).val(newTime);
        }
    }

    // Quando o modal for aberto
    $('#modalCalendar').on('show.bs.modal', function() {
        $.ajax({
            url: '/get-procedimentos', // URL para o método que retorna os procedimentos
            method: 'GET',
            success: function(data) {
                console.log('Dados retornados da API de procedimentos:', data); // Log para verificar a estrutura dos dados
                let select = $('#procedimento_id'); // Certifique-se de que o ID está correto
                select.empty(); // Limpa as opções existentes
                select.append('<option selected>Selecione um Procedimento</option>'); // Adiciona a opção padrão
                $.each(data, function(index, procedimento) {
                    select.append('<option value="' + procedimento.pk_cod_proc + '">' + procedimento.nome_proc + '</option>');
                });
                console.log('Procedimentos carregados no select:', select.html()); // Log para verificar as opções carregadas
            },
            error: function(xhr, status, error) {
                console.error('Erro ao carregar procedimentos:', error); // Log de erro
            }
        });
    });

    // Mostrar botões ao clicar no input
    $("#start").focus(function() {
        $("#startButtons").show();
    });

    $("#end").focus(function() {
        $("#endButtons").show();
    });

    // Manter os botões visíveis quando o mouse estiver sobre eles
    $("#startButtons").mouseenter(function() {
        $(this).show();
    }).mouseleave(function() {
        $(this).hide();
    });

    $("#endButtons").mouseenter(function() {
        $(this).show();
    }).mouseleave(function() {
        $(this).hide();
    });

    // Ocultar os botões quando o mouse sair do input e dos botões
    $("#start").mouseleave(function() {
        if (!$("#startButtons:hover").length) {
            $("#startButtons").hide();
        }
    });

    $("#end").mouseleave(function() {
        if (!$("#endButtons:hover").length) {
            $("#endButtons").hide();
        }
    });

    // Aumentar o horário inicial
    $("#increaseStartTime").click(function() {
        adjustTime("#start", 30); // Aumenta 30 minutos
    });

    // Diminuir o horário inicial
    $("#decreaseStartTime").click(function() {
        adjustTime("#start", -30); // Diminui 30 minutos
    });

    // Aumentar o horário final
    $("#increaseEndTime").click(function() {
        adjustTime("#end", 30); // Aumenta 30 minutos
    });

    // Diminuir o horário final
    $("#decreaseEndTime").click(function() {
        adjustTime("#end", -30); // Diminui 30 minutos
    });
});

$(function () {

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(".deleteEvent").click(function() {
        let id = $("#modalCalendar input[name='id']").val();

        let Event = {
            id: id,
            _method: 'DELETE',
        }

        let route = routeEvents('routeEventDelete');

        sendEvent(route, Event);
    })

    $(".saveEvent").click(function () {
        let id = $("#modalCalendar input[name='id']").val();
        let title = $("#modalCalendar input[name='paciente']").val();

        let procedimentoId = $("#modalCalendar select[name='procedimento_id']").val();
    
        // Obter a data armazenada no campo oculto
        let selectedDate = $("#modalCalendar input[name='eventDate']").val();
        let startTime = $("#modalCalendar input[name='start']").val();
        let endTime = $("#modalCalendar input[name='end']").val();
    
        // Verificar se todos os campos estão preenchidos
        if (!selectedDate || !startTime || !endTime) {
            console.error("Data ou horário não definidos.");
            return; // Interrompe a execução se algum valor estiver ausente
        }
    
        let color = $("#modalCalendar input[name='color']").val() || "#9D9D9B"; // Default color
    
        // Combinar a data com as horas, especificando o formato
        let start = moment(`${selectedDate}T${startTime}`, "YYYY-MM-DDTHH:mm").format("YYYY-MM-DD HH:mm:ss");
        let end = moment(`${selectedDate}T${endTime}`, "YYYY-MM-DDTHH:mm").format("YYYY-MM-DD HH:mm:ss");
    
        // Verifique se a data e a hora foram criadas corretamente
        if (!moment(start, "YYYY-MM-DD HH:mm:ss", true).isValid()) {
            console.error("Data/hora de início inválida:", start);
        }
        if (!moment(end, "YYYY-MM-DD HH:mm:ss", true).isValid()) {
            console.error("Data/hora de término inválida:", end);
        }
    
        let Event = {
            title: title,
            start: start,
            end: end,
            color: color,
            procedimento_id: procedimentoId
        };
    
        let route;
        if (id == '') {
            route = routeEvents('routeEventStore');
        } else {
            route = routeEvents('routeEventUpdate');
            Event.id = id;
            Event._method = "PUT";
        }
    
        sendEvent(route, Event);
    });
});

function sendEvent(route, data_) {
    $.ajax({
        url: route,
        data: data_,
        method: "POST",
        dataType: "json",
        success: function (json) {
            if (json) {
                location.reload();
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

function clearMessages(element){
    $(element).text('');
}

function resetForm(form) {
    $(form)[0].reset();
}   