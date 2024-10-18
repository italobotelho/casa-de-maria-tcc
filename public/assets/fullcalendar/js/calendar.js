// calendar.js
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
    
    eventDrop: function(element){

      let start= moment(element.event.start).format("YYYY-MM-DD HH:mm:ss");
      let end= moment(element.event.end).format("YYYY-MM-DD HH:mm:ss");

      let newEvent={
        _method: 'PUT',
        title: element.event.title,
        id: element.event.id,
        start: start,
        end: end
      };

      sendEvent(routeEvents('routeEventUpdate'), newEvent);
    },

    eventClick: function(element) {
    clearMessages('#message');
    resetForm("#formEvent");

    // Atualiza o título do modal com a data do evento
    let startDate = moment(element.event.start).format("DD/MM/YYYY"); // Formato da data
    $("#modalCalendar #titleModal").text('Alteração de agendamento para ' + startDate);

    $("#modalCalendar").modal('show');
    $("#modalCalendar button.deleteEvent").css("display", "flex");

    let id = element.event.id;
    $("#modalCalendar input[name='id']").val(id);

    let title = element.event.title;
    $("#modalCalendar input[name='title']").val(title);

    // Preencher os inputs com a hora do evento
    let startTime = moment(element.event.start).format("HH:mm"); // Apenas a hora
    $("#modalCalendar input[name='start']").val(startTime);

    let endTime = moment(element.event.end).format("HH:mm"); // Apenas a hora
    $("#modalCalendar input[name='end']").val(endTime);

    let color = element.event.backgroundColor;
    $("#modalCalendar input[name='color']").val(color);

    let description = element.event.extendedProps.description;
    $("#modalCalendar textarea[name='description']").val(description);
    },

    eventResize: function(element){
      let start= moment(element.event.start).format("YYYY-MM-DD HH:mm:ss");
      let end= moment(element.event.end).format("YYYY-MM-DD HH:mm:ss");

      let newEvent={
        _method: 'PUT',
        title: element.event.title,
        id: element.event.id,
        start: start,
        end: end
      };

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

    $("#modalCalendar input[name='color']").val("#9D9D9B");

    calendar.unselect(); // Desmarcar a seleção
    },

    events: routeEvents('routeLoadEvents'),

});

calendar.render();
});