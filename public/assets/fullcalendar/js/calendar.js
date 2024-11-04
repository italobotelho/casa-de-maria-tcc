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
          let procedimentoId = element.event.procedimento_id || element.event.extendedProps.procedimento_id;
          let medico = element.event.medico || element.event.extendedProps.medico;
          let convenio = element.event.convenio || element.event.extendedProps.convenio;

          let newEvent = {
              _method: 'PUT',
              title: element.event.title,
              id: element.event.id,
              start: start,
              end: end,
              color: color,
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
        console.log('Evento clicado:', element.event); // Verifique a estrutura do evento

        // Obtenha o ID do paciente a partir do evento
        let pacienteId = element.event.id; // Supondo que o ID do evento é o ID do paciente

        // Requisição para buscar os dados do paciente
        fetch(`/paciente/${pacienteId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Paciente não encontrado');
                }
                return response.json();
            })
            .then(paciente => {
                // Preencher os campos do modal com os dados do paciente
                $("#modalViewCalendar #pacienteNome").text(paciente.nome_paci);
                $("#modalViewCalendar #pacienteTelefone").text(paciente.telefone_paci);
                $("#modalViewCalendar #pacienteEmail").text(paciente.email_paci);
                $("#modalViewCalendar #pacienteDataNascimento").text(moment(paciente.data_nasci_paci).format("DD/MM/YYYY"));
                $("#modalViewCalendar #pacienteCpf").text(paciente.cpf_paci);
                $("#modalViewCalendar #pacienteResponsavel").text(paciente.responsavel_paci);
                // Adicione outros campos conforme necessário

                // Exibir o modal
                $("#modalViewCalendar").modal('show');
            })
            .catch(error => {
                console.error('Erro ao buscar paciente:', error);
                alert('Erro ao buscar dados do paciente.');
            });

          // Obtenha os dados do evento
          let procedimentoId = element.event.procedimento_id || element.event.extendedProps.procedimento_id;
          console.log('Procedimento ID:', procedimentoId); // Verifique o ID do procedimento
          let medico = element.event.medico || element.event.extendedProps.medico;
          let convenio = element.event.convenio || element.event.extendedProps.convenio; // Aqui é onde a variável convenio é definida
      
          clearMessages('#message');
          resetForm("#formEvent");
      
          let startDate = moment(element.event.start).format("DD/MM/YYYY");
      
          $("#modalViewCalendar #modalViewCalendarLabel").text('Visualização de agendamento para ' + startDate);
          $("#modalViewCalendar").modal('show');
      
          $("#modalCalendar #titleModal").text('Alteração de agendamento para ' + startDate);
          $("#modalCalendar button.deleteEvent").css("display", "flex");
      
          // Preenchendo os campos do modal
          $("#modalCalendar input[name='id']").val(element.event.id);
          $("#modalCalendar input[name='paciente']").val(element.event.title);
          $("#modalCalendar input[name='medico']").val(medico || ''); // Preenche o campo oculto do médico
          $("#modalCalendar input[name='convenio_id']").val(convenio || ''); // Preenche o campo de convênio
      
          // Preenchendo o campo de procedimento
          if (procedimentoId) {
              $("#modalCalendar select[name='procedimento_id']").val(procedimentoId).change(); // Preenche o campo de procedimento e dispara o evento change
          } else {
              $("#modalCalendar select[name='procedimento_id']").val('').change(); // Caso não haja procedimento, define como vazio
          }

          // Adicione um listener para ver se o valor é redefinido
          $("#modalCalendar").on('shown.bs.modal', function() {
            console.log('Modal aberto, valor do campo:', $("#modalCalendar select[name='procedimento_id']").val());
          });
      
          let startTime = moment(element.event.start).format("HH:mm");
          $("#modalCalendar input[name='start']").val(startTime);
      
          let endTime = moment(element.event.end).format("HH:mm");
          $("#modalCalendar input[name='end']").val(endTime);
      
          let eventDate = moment(element.event.start).format("YYYY-MM-DD");
          $("#modalCalendar input[name='eventDate']").val(eventDate);
      
          let color = element.event.backgroundColor || "#9D9D9B";
          $("#modalCalendar input[name='color']").val(color);
      },

        eventResize: function(element) {
          let start = moment(element.event.start).format("YYYY-MM-DD HH:mm:ss");
          let end = moment(element.event.end).format("YYYY-MM-DD HH:mm:ss");
          let color = element.event.backgroundColor;
          let procedimentoId = element.event.procedimento_id || element.event.extendedProps.procedimento_id;
          let medico = element.event.medico || element.event.extendedProps.medico;
          let convenio = element.event.convenio || element.event.extendedProps.convenio;

          let newEvent = {
              _method: 'PUT',
              title: element.event.title,
              id: element.event.id,
              start: start,
              end: end,
              color: color,
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

          // Limpa o campo do médico
          $("#modalCalendar input[name='medico']").val('');

          calendar.unselect();
        },

        events: function(fetchInfo, successCallback, failureCallback) {
          var medicoId = document.getElementById('medicoSelect').value; // Captura o ID do médico selecionado

          $.ajax({
            url: routeEvents('routeLoadEvents'),
            method: 'GET',
            data: { medico_id: medicoId }, // Adiciona o ID do médico à requisição
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

      // Adiciona o listener para o dropdown de médicos
      document.getElementById('medicoSelect').addEventListener('change', function() {
        calendar.refetchEvents(); // Recarrega os eventos quando um médico é selecionado
      });
    });