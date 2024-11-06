  let currentEvent = null; // Variável global para armazenar o evento atual

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
      },

      locale: 'pt-br',
      navLinks: true,
      selectable: true,
      editable: true,
      droppable: true,

      eventDrop: function(element) {
        let start = moment(element.event.start).format("YYYY-MM-DD HH:mm:ss");
        let end = moment(element.event.end).format("YYYY-MM-DD HH:mm:ss");
        let color = element.event.backgroundColor;
        let procedimentoId = element.event.extendedProps.procedimento_id;
        let medico = element.event.extendedProps.medico;
        let convenio = element.event.extendedProps.convenio;

        // Verifica se existe um item no dropdown que contém "Reagendado"
        let dropdownItem = $('.dropdown-item').filter(function() {
          return $(this).text().includes("Reagendado");
        });

        let newColor = element.event.backgroundColor; // Cor atual do evento

        // Se o item "Reagendado" foi encontrado, altera a cor
        if (dropdownItem.length > 0) {
          newColor = dropdownItem.data('color'); // Obtém a nova cor do item dropdown
          element.event.setProp('backgroundColor', newColor); // Atualiza a cor do evento no calendário
        }

        let newEvent = {
          _method: 'PUT',
          title: element.event.title,
          id: element.event.id,
          start: start,
          end: end,
          color: newColor,
          procedimento_id: procedimentoId,
          medico: medico,
          convenio: convenio
        };

        if (!medico || !procedimentoId || !convenio) {
          console.error('Um ou mais campos obrigatórios estão vazios.');
          return;
        }

        sendEvent(routeEvents('routeEventUpdate'), newEvent);
      },

      eventClick: function(element) {
        currentEvent = element.event; // Armazena o evento clicado
        
        console.log('Evento clicado:', element.event); // Log para verificar se o evento foi capturado

        // Obtenha o ID do médico do evento
        let medicoId = element.event.extendedProps.medico;
        console.log('ID do Médico:', medicoId); // Log para verificar se o ID do médico foi encontrado

        // Limpa mensagens e reseta o formulário
        clearMessages('#message');
        resetForm("#formEvent");

        let startDate = moment(element.event.start).format("DD/MM/YYYY");

        // Configuração básica do modal
        $("#modalViewCalendar #modalViewCalendarLabel").text('Visualização de agendamento para ' + startDate);
        $("#modalViewCalendar").modal('show');
        $("#modalCalendar #titleModal").text('Alteração de agendamento para ' + startDate);
        $("#modalCalendar button.deleteEvent").css("display", "flex");

        // Preencher os campos iniciais do modal
        $("#modalCalendar input[name='id']").val(element.event.id);
        $("#modalCalendar input[name='paciente']").val(element.event.title);
        $("#modalCalendar input[name='convenio_id']").val(element.event.extendedProps.convenio || '');

        // Preenchendo o campo de procedimento
        $("#modalCalendar select[name='procedimento_id']").val(element.event.extendedProps.procedimento_id || '').change();

        let startTime = moment(element.event.start).format("HH:mm");
        $("#modalCalendar input[name='start']").val(startTime);

        let endTime = moment(element.event.end).format("HH:mm");
        $("#modalCalendar input[name='end']").val(endTime);

        let eventDate = moment(element.event.start).format("YYYY-MM-DD");
        $("#modalCalendar input[name='eventDate']").val(eventDate);

        let color = element.event.backgroundColor || "#9D9D9B";
        $("#modalCalendar input[name='color']").val(color);

        // AJAX para obter informações do médico
  
      $.ajax({
        url: '/get-medico/' + medicoId,
        type: 'GET',
        success: function(response) {
          console.log('Resposta do servidor:', response);
          $('#modalCalendar input[name="medico_nome"]').val(response.nome_medico);
          $('#modalCalendar input[name="medico"]').val(medicoId); // Preenche o campo oculto com o ID do médico
          console.log('ID do Médico preenchido:', $('#modalCalendar input[name="medico"]').val());
        },
        error: function(xhr) {
            if (xhr.responseJSON && xhr.responseJSON.message) {
                alert('Erro ao buscar médico: ' + xhr.responseJSON.message);
            } else {
                alert('Erro ao buscar médico: ' + xhr.statusText);
            }
        }
      });
      },

      eventResize: function(element) {
        let start = moment(element.event.start).format("YYYY-MM-DD HH:mm:ss");
        let end = moment(element.event.end).format("YYYY-MM-DD HH:mm:ss");
        let color = element.event.backgroundColor;
        let procedimentoId = element.event.extendedProps.procedimento_id;
        let medico = element.event.extendedProps.medico;
        let convenio = element.event.extendedProps.convenio;

        // Verifica se existe um item no dropdown que contém "Reagendado"
        let dropdownItem = $('.dropdown-item').filter(function() {
          return $(this).text().includes("Reagendado");
        });

        let newColor = element.event.backgroundColor; // Cor atual do evento

        // Se o item "Reagendado" foi encontrado, altera a cor
        if (dropdownItem.length > 0) {
          newColor = dropdownItem.data('color'); // Obtém a nova cor do item dropdown
          element.event.setProp('backgroundColor', newColor); // Atualiza a cor do evento no calendário
        }

        let newEvent = {
          _method: 'PUT',
          title: element.event.title,
          id: element.event.id,
          start: start,
          end: end,
          color: newColor,
          procedimento_id: procedimentoId,
          medico: medico,
          convenio: convenio
        };

        if (!medico || !procedimentoId || !convenio) {
          console.error('Um ou mais campos obrigatórios estão vazios.');
          return;
        }

        sendEvent(routeEvents('routeEventUpdate'), newEvent);
      },

      select: function(element) {
        clearMessages('#message');
        resetForm("#formEvent");

        let startDate = moment(element.start).format("DD/MM/YYYY");
        $("#modalCalendar #titleModal").text('Novo agendamento para ' + startDate);

        $("#modalCalendar").modal('show');
        $("#modalCalendar button.deleteEvent").css("display", "none");

        let startTime = moment(element.start).format("HH:mm");
        $("#modalCalendar input[name='start']").val(startTime);

        let endTime = moment(element.end).format("HH:mm");
        $("#modalCalendar input[name='end']").val(endTime);

        $("#modalCalendar input[name='eventDate']").val(moment(element.start).format("YYYY-MM-DD"));
        $("#modalCalendar input[name='color']").val("#9D9D9B");

        $("#modalCalendar input[name='medico']").val('');

        calendar.unselect();
      },

      events: function(fetchInfo, successCallback, failureCallback) {
        var medicoId = document.getElementById('medicoSelect').value;

        $.ajax({
          url: routeEvents('routeLoadEvents'),
          method: 'GET',
          data: { medico_id: medicoId },
          success: function(data) {
            successCallback(data);
          },
          error: function() {
            failureCallback();
          }
        });
      },
    });

    calendar.render();

    document.getElementById('medicoSelect').addEventListener('change', function() {
      calendar.refetchEvents();
    });
  });