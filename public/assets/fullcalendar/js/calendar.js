let currentEvent = null; // Variável global para armazenar o evento atual selecionado pelo usuário

// Quando o conteúdo do DOM estiver completamente carregado, inicia a configuração do calendário
document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar'); // Obtém o elemento do calendário pelo ID
  var calendar = new FullCalendar.Calendar(calendarEl, { // Cria uma nova instância do calendário
    headerToolbar: {
      left: 'prev,next today', // Botões de navegação: voltar, avançar e ir para hoje
      center: 'title', // Exibe o título do mês/semana/dia atual no centro
      right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek' // Vistas disponíveis: mês, semana, dia e lista
    },

    locale: 'pt-br', // Define a localização do calendário para português do Brasil
    navLinks: true, // Habilita a navegação através de links nas datas
    selectable: true, // Permite que o usuário selecione intervalos de tempo
    editable: true, // Permite edição de eventos
    droppable: true, // Permite que eventos sejam arrastados para o calendário

    // Função chamada quando um evento é arrastado e solto
    eventDrop: function(element) {
      let start = moment(element.event.start).format("YYYY-MM-DD HH:mm:ss"); // Formata a data de início do evento
      let end = moment(element.event.end).format("YYYY-MM-DD HH:mm:ss"); // Formata a data de fim do evento
      let color = 'brown'; // Define a nova cor para o evento
      let procedimentoId = element.event.procedimento_id || element.event.extendedProps.procedimento_id; // Obtém o ID do procedimento
      let medico = element.event.medico || element.event.extendedProps.medico; // Obtém o nome do médico
      let convenio = element.event.convenio || element.event.extendedProps.convenio; // Obtém o convênio

      let newEvent = { // Cria um novo objeto de evento com as informações atualizadas
          _method: 'PUT', // Método para atualização
          title: element.event.title, // Título do evento
          id: element.event.id, // ID do evento
          start: start, // Data de início
          end: end, // Data de fim
          color: color, // Cor do evento
          procedimento_id: procedimentoId, // ID do procedimento
          medico: medico, // Nome do médico
          convenio: convenio // Convênio
      };

      // Verifica se os campos obrigatórios estão preenchidos
      if (!medico || !procedimentoId || !convenio) {
          console.error('Um ou mais campos obrigatórios estão vazios.'); // Exibe um erro no console
          return; 
      }

      sendEvent(routeEvents('routeEventUpdate'), newEvent); // Envia a atualização do evento
    },

    // Função chamada quando um evento é clicado
    eventClick: function(element) {
      currentEvent = element.event; // Armazena o evento que foi clicado
      console.log('Evento clicado:', element); // Log do evento clicado

      let procedimentoId = element.event.procedimento_id || element.event.extendedProps.procedimento_id; // Obtém o ID do procedimento
      let medico = element.event.medico || element.event.extendedProps.medico; // Obtém o médico
      let convenio = element.event.convenio || element.event.extendedProps.convenio; // Obtém o convênio

      clearMessages('#message'); // Limpa mensagens anteriores
      resetForm("#formEvent"); // Reseta o formulário de evento

      let startDate = moment(element.event.start).format("DD/MM/YYYY"); // Formata a data de início
      $("#modalViewCalendar #modalViewCalendarLabel").text('Visualização de agendamento para ' + startDate); // Atualiza o título do modal
      $("#modalViewCalendar").modal('show'); // Exibe o modal de visualização

      $("#modalCalendar #titleModal").text('Alteração de agendamento para ' + startDate); // Atualiza o título do modal de alteração
      $("#modalCalendar button.deleteEvent").css("display", "flex"); // Exibe o botão de deletar

      // Preenche os campos do modal com os dados do evento
      $("#modalCalendar input[name='id']").val(element.event.id);
      $("#modalCalendar input[name='paciente']").val(element.event.title);
      $("#modalCalendar input[name='medico']").val(medico || '');
      $("#modalCalendar input[name='convenio_id']").val(convenio || '');
      $("#modalCalendar select[name='procedimento_id']").val(procedimentoId || '');

      let startTime = moment(element.event.start).format("HH:mm"); // Formata a hora de início
      $("#modalCalendar input[name='start']").val(startTime);

      let endTime = moment(element.event.end).format("HH:mm"); // Formata a hora de fim
      $("#modalCalendar input[name='end']").val(endTime);

      let eventDate = moment(element.event.start).format("YYYY-MM-DD"); // Formata a data do evento
      $("#modalCalendar input[name='eventDate']").val(eventDate);

      let color = element.event.backgroundColor || "#9D9D9B"; // Obtém a cor do evento
      $("#modalCalendar input[name='color']").val(color); // Define a cor no campo correspondente
    },

    // Função chamada quando um evento é redimensionado
    eventResize: function(element) {
      let start = moment(element.event.start).format("YYYY-MM-DD HH:mm:ss"); // Formata a nova data de início
      let end = moment(element.event.end).format("YYYY-MM-DD HH:mm:ss"); // Formata a nova data de fim
      let color = 'brown'; // Define a nova cor
      let procedimentoId = element.event.procedimento_id || element.event.extendedProps.procedimento_id; // Obtém o ID do procedimento
      let medico = element.event.medico || element.event.extendedProps.medico; // Obtém o médico
      let convenio = element.event.convenio || element.event.extendedProps.convenio; // Obtém o convênio

      let newEvent = { // Cria um novo objeto de evento com as informações atualizadas
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

      // Verifica se os campos obrigatórios estão preenchidos
      if (!medico || !procedimentoId || !convenio) {
          console.error('Um ou mais campos obrigatórios estão vazios.'); // Exibe um erro no console
          return; 
      }

      sendEvent(routeEvents('routeEventUpdate'), newEvent); // Envia a atualização do evento
    },

    // Função chamada quando um intervalo de tempo é selecionado
    select: function(element) {
      clearMessages('#message'); // Limpa mensagens anteriores
      resetForm("#formEvent"); // Reseta o formulário de evento

      let startDate = moment(element.start).format("DD/MM/YYYY"); // Formata a data de início
      $("#modalCalendar #titleModal").text('Novo agendamento para ' + startDate); // Atualiza o título do modal

      $("#modalCalendar").modal('show'); // Exibe o modal para novo agendamento
      $("#modalCalendar button.deleteEvent").css("display", "none"); // Esconde o botão de deletar

      // Preenche os campos do modal com dados iniciais
      let startTime = moment(element.start).format("HH:mm"); // Formata a hora de início
      $("#modalCalendar input[name='start']").val(startTime);

      let endTime = moment(element.end).format("HH:mm"); // Formata a hora de fim
      $("#modalCalendar input[name='end']").val(endTime);

      $("#modalCalendar input[name='eventDate']").val(moment(element.start).format("YYYY-MM-DD")); // Define a data do evento
      $("#modalCalendar input[name='color']").val("#9D9D9B"); // Define uma cor padrão

      // Limpa o campo do médico
      $("#modalCalendar input[name='medico']").val('');

      calendar.unselect(); // Desmarca a seleção do calendário
    },

    // Função chamada para carregar eventos no calendário
    events: function(fetchInfo, successCallback, failureCallback) {
      var medicoId = document.getElementById('medicoSelect').value; // Captura o ID do médico selecionado

      $.ajax({
        url: routeEvents('routeLoadEvents'), // URL para buscar eventos
        method: 'GET', // Método da requisição
        data: { medico_id: medicoId }, // Envia o ID do médico na requisição
        success: function(data) {
          successCallback(data); // Chama a função de sucesso com os dados retornados
        },
        error: function() {
          failureCallback(); // Chama a função de falha se a requisição falhar
        }
      });
    },
  });

  calendar.render(); // Renderiza o calendário na página

  // Adiciona um listener ao dropdown de médicos para recarregar eventos ao mudar de médico
  document.getElementById('medicoSelect').addEventListener('change', function() {
    calendar.refetchEvents(); // Recarrega os eventos quando um médico é selecionado
  });
});
