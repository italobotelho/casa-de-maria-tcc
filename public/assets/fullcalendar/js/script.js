$(document).ready(function() {
    // Função para aumentar ou diminuir o horário
    function adjustTime(selector, adjustment) {
        let currentTime = $(selector).val();
        if (currentTime) {
            let newTime = moment(currentTime, "HH:mm").add(adjustment, 'minutes').format("HH:mm");
            $(selector).val(newTime);
        }
    }

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
    // Remover a máscara, pois não será mais necessária
    // $(".date-time").mask("00/00/0000 00:00:00");

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

        let title = $("#modalCalendar input[name='title']").val();

        // Apenas obter a hora, sem a data
        let start = $("#modalCalendar input[name='start']").val(); // Aqui não precisamos de formatação
        let end = $("#modalCalendar input[name='end']").val(); // Aqui também

        let color = $("#modalCalendar input[name='color']").val();

        let description = $(
            "#modalCalendar textarea[name='description']"
        ).val();

        let Event = {
            title: title,
            start: start,
            end: end,
            color: color,
            description: description,
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


