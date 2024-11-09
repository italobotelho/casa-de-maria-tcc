let currentEvent = null; // Variável global para armazenar o evento atual
var calendar;

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendarMonthEl = document.getElementById('calendarMonth');

    // Selecione todos os botões de navegação do FullCalendar
    const buttons = document.querySelectorAll('#calendar .fc-button-primary');

    buttons.forEach(function(button) {
      // Adiciona o evento de clique a cada botão
      button.addEventListener('click', function() {
        // Remove a classe "clicked" de todos os botões
        buttons.forEach(function(btn) {
          btn.classList.remove('clicked');
        });
        
        // Adiciona a classe "clicked" ao botão clicado
        button.classList.add('clicked');
      });
    });

    // Evento de criação do calendário principal
    calendar = new FullCalendar.Calendar(calendarEl, {

      themeSystem: 'bootstrap5',

      initialView: 'timeGridDay', // Definindo a visualização inicial como o "Day View"

      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'timeGridDay,timeGridWeek,dayGridMonth,listWeek'
      },

      businessHours: {
        daysOfWeek: [1, 2, 3, 4, 5], // Segunda - Sexta
        startTime: '10:00', // horário de início para dias úteis
        endTime: '18:00',   // horário de término para dias úteis
      },
  
      allDaySlot: false, // Remove o slot de "dia inteiro"
  
      // Limita a exibição do calendário ao horário de businessHours
      slotMinTime: '10:00', // Define o horário inicial para exibição
      slotMaxTime: '18:00', // Define o horário final para exibição
  
      slotDuration: '00:30', // duração dos slots de 30 minutos

      slotLabelInterval: '00:30',  // Exibe rótulos a cada 30 minutos

      slotLabelFormat: {
        hour: '2-digit',
        minute: '2-digit',
        omitZeroMinute: false,
        meridiem: false
      },

      noEventsContent: 'Não há agendamentos para mostrar',

      height: 'auto',
      locale: 'pt-br',

      navLinks: true,
      selectable: true,
      editable: true,
      droppable: true,

      // Adicionando o evento para sincronizar o mês
      datesSet: function(dateInfo) {
        // Atualiza o calendário mensal para o mesmo mês
        calendarMonth.gotoDate(dateInfo.start);
      },

      // Sincroniza a navegação ao clicar em um dia no calendário principal
      dateClick: function(info) {
          calendarMonth.gotoDate(info.date); // Sincroniza a navegação ao clicar em um dia no calendário principal
      },

      eventDrop: function(element) {
        let start = moment(element.event.start).format("YYYY-MM-DD HH:mm:ss");
        let end = moment(element.event.end).format("YYYY-MM-DD HH:mm:ss");
        let procedimentoId = element.event.extendedProps.procedimento_id;
        let pacienteId = element.event.extendedProps.paciente_id;
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
          convenio: convenio,
          paciente_id: pacienteId
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

        let eventoId = element.event.id; // ID do evento

        let pacienteId = element.event.extendedProps.paciente_id;
        console.log('ID do Paciente:', pacienteId);

        // Obtenha o ID do médico do evento
        let medico = element.event.extendedProps.medico;
        console.log('ID do Médico:', medico); // Log para verificar se o ID do médico foi encontrado

        // Limpa mensagens e reseta o formulário
        clearMessages('#message');
        resetForm("#formEvent");

        let startDate = moment(element.event.start).format("DD/MM/YYYY");

        // Configuração básica do modal
        $("#modalViewCalendar #modalViewCalendarLabel").text('Visualização de agendamento para ' + startDate);
        
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
        url: '/get-medico/' + medico,
        type: 'GET',
        success: function(response) {
          console.log('Resposta do servidor:', response);
          $('#modalCalendar input[name="medico_nome"]').val(response.nome_medico);
          $('#modalCalendar input[name="medico"]').val(medico); // Preenche o campo oculto com o ID do médico
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

      // AJAX para obter informações do evento
      $.ajax({
        url: `/get-event/${eventoId}`, // URL para obter o evento
        type: 'GET',
        success: function(response) {
            console.log('Resposta do servidor:', response);
            $('#medicoNome').text(response.medico.nome_med); // Preenche o nome do médico
            $('#horaInicial').text(moment(response.start).format("HH:mm")); // Preenche a hora inicial
            $('#horaFinal').text(moment(response.end).format("HH:mm")); // Preenche a hora final
        },
        error: function(xhr) {
            if (xhr.responseJSON && xhr.responseJSON.message) {
                alert('Erro ao buscar evento: ' + xhr.responseJSON.message);
            } else {
                alert('Erro ao buscar evento: ' + xhr.statusText);
            }
        }
      });

      $.ajax({
        url: '/get-paciente/' + pacienteId,
        type: 'GET',
        success: function(response) {
          console.log('Resposta do servidor:', response);
          $('#modalCalendar input[name="paciente"]').val(response.nome_paciente);
          $('#modalCalendar input[name="paciente_id"]').val(pacienteId); // Preenche o campo oculto com o ID do médico
          $('#pacienteNome').text(response.nome_paciente); // Preenche o nome do paciente
          $('#pacienteTelefone').text(response.telefone_paciente); // Preenche o telefone do paciente
          $('#pacienteConvenio').text(response.convenio);
          console.log('ID do Paciente preenchido:', $('#modalCalendar input[name="paciente_id"]').val());
        },
        error: function(xhr) {
            if (xhr.responseJSON && xhr.responseJSON.message) {
                alert('Erro ao buscar paciente: ' + xhr.responseJSON.message);
            } else {
                alert('Erro ao buscar paciente: ' + xhr.statusText);
            }
        }
      });

      $("#modalViewCalendar").modal('show');
      },

      eventResize: function(element) {
        let start = moment(element.event.start).format("YYYY-MM-DD HH:mm:ss");
        let end = moment(element.event.end).format("YYYY-MM-DD HH:mm:ss");
        let pacienteId = element.event.extendedProps.paciente_id;
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
          convenio: convenio,
          paciente_id: pacienteId
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
        var medico= document.getElementById('medicoSelect').value;

        $.ajax({
          url: routeEvents('routeLoadEvents'),
          method: 'GET',
          data: { medico: medico },
          success: function(data) {
            successCallback(data);
          },
          error: function() {
            failureCallback();
          }
        });
      },
    });

    // Inicialização do calendário mensal
    var calendarMonth = new FullCalendar.Calendar(calendarMonthEl, {

      height: '100%',
      contentHeight: 'auto',

      initialView: 'dayGridMonth', // Visualização inicial do mês
  
      // Personalização da barra de navegação
      headerToolbar: {
        left: 'prev',    // Adiciona as setas de navegação (prev e next)
        center: 'title',  // Exibe apenas o título do mês
        right: 'next'  // Não adiciona nada no lado direito
      },

      businessHours: {
        daysOfWeek: [1, 2, 3, 4, 5], // Segunda - Sexta
      },

      locale: 'pt-br',
      fixedWeekCount: false,
      selectable: true,

      events: calendar.getEvents(), // Sincroniza eventos entre os dois calendários

      dateClick: function(info) {
        calendar.gotoDate(info.date); // Sincroniza a navegação com o calendário principal
      },

    });

    // Sincroniza a navegação ao clicar em um dia no calendário principal
  calendar.on('dateClick', function(info) {
    calendarMonth.gotoDate(info.date); // Sincroniza a navegação ao clicar em um dia no calendário principal
  });

    // Renderiza ambos os calendários
    calendar.render();
    calendarMonth.render();
  
    document.getElementById('medicoSelect').addEventListener('change', function() {
    calendar.refetchEvents();

    });
  });