// calendar.js
document.addEventListener('DOMContentLoaded', function() {

  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'timeGridDay,timeGridWeek,dayGridMonth,listWeek'
    },

    locale: 'pt-br',
    navLinks: true,
    selectable: true,
    editable: true,
    droppable: true,
    
    eventDrop: function(element) {
      let start = moment(element.event.start).format("YYYY-MM-DD HH:mm:ss");
      let end = moment(element.event.end).format("YYYY-MM-DD HH:mm:ss");
      let color = element.event.backgroundColor; // Get the color
  
      // Acesse o procedimento_id corretamente
      let procedimentoId = element.event.procedimento_id || element.event.extendedProps.procedimento_id;
  
      let newEvent = {
          _method: 'PUT',
          title: element.event.title,
          id: element.event.id,
          start: start,
          end: end,
          color: color, // Include color in the update
          procedimento_id: procedimentoId // Inclua o procedimento_id na atualização
      };
  
      // Verifique se o procedimento_id está definido antes de enviar
      if (!procedimentoId) {
          console.error('Procedimento ID não está disponível na atualização do evento.');
          return; // Interrompe a execução se o procedimento_id não estiver disponível
      }
  
      sendEvent(routeEvents('routeEventUpdate'), newEvent);
    },

    eventClick: function(element) {
      console.log('Evento clicado:', element); // Verifique a estrutura do elemento
  
      let procedimentoId = element.event.procedimento_id || element.event.extendedProps.procedimento_id;
      if (procedimentoId) {
          console.log('ID do procedimento:', procedimentoId);
      } else {
          console.error('Procedimento ID não está disponível no evento.');
      }
  
      clearMessages('#message');
      resetForm("#formEvent");
  
      let startDate = moment(element.event.start).format("DD/MM/YYYY");
      $("#modalCalendar #titleModal").text('Alteração de agendamento para ' + startDate);
      $("#modalCalendar").modal('show');
      $("#modalCalendar button.deleteEvent").css("display", "flex");
  
      // Preenchendo os campos do modal
      $("#modalCalendar input[name='id']").val(element.event.id);
      $("#modalCalendar input[name='paciente']").val(element.event.title);
      $("#modalCalendar input[name='medico']").val(element.event.medico); 
      $("#modalCalendar select[name='procedimento_id']").val(procedimentoId);
      $("#modalCalendar input[name='convenio']").val(element.event.convenio); 
  
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
      let color = element.event.backgroundColor; // Obter a cor
      let procedimentoId = element.event.procedimento_id || element.event.extendedProps.procedimento_id;
  
      // Crie o novo evento com todos os campos necessários
      let newEvent = {
          _method: 'PUT',
          title: element.event.title,
          id: element.event.id,
          start: start,
          end: end,
          color: color, // Inclua a cor
          procedimento_id: procedimentoId // Inclua o procedimento_id
      };
  
      // Verifique se o procedimento_id está definido antes de enviar
      if (!procedimentoId) {
          console.error('Procedimento ID não está disponível na atualização do evento.');
          return; // Interrompe a execução se o procedimento_id não estiver disponível
      }
  
      sendEvent(routeEvents('routeEventUpdate'), newEvent);
    },

    select: function(element) {
      clearMessages('#message');
      resetForm("#formEvent");
  
      // Atualiza o título do modal com a data selecionada
      let startDate = moment(element.start).format("DD/MM/YYYY"); // Formato da data
      $("#modalCalendar #titleModal").text('Novo agendamento para ' + startDate);
  
      $("#modalCalendar").modal('show');
      $("#modalCalendar button.deleteEvent").css("display", "none");
  
      // Preencher os inputs com a hora selecionada
      let startTime = moment(element.start).format("HH:mm"); // Apenas a hora
      $("#modalCalendar input[name='start']").val(startTime);
  
      let endTime = moment(element.end).format("HH:mm"); // Apenas a hora
      $("#modalCalendar input[name='end']").val(endTime);
  
      // Armazena a data selecionada em um campo oculto
      $("#modalCalendar input[name='eventDate']").val(moment(element.start).format("YYYY-MM-DD"));
  
      $("#modalCalendar input[name='color']").val("#9D9D9B");
  
      calendar.unselect(); // Desmarcar a seleção
    },

    events: routeEvents('routeLoadEvents'),
});

calendar.render();
});