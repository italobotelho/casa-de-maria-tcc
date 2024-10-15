// calendar.js
document.addEventListener('DOMContentLoaded', function() {

    var containerEl = document.getElementById('external-events-list');
    new FullCalendar.Draggable(containerEl, {
      itemSelector: '.fc-event',
      eventData: function(eventEl) {
        return {
          title: eventEl.innerText.trim()
        }
      }
    });

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
      droppable: true, // this allows things to be dropped onto the calendar
      drop: function(arg) {
        // is the "remove after drop" checkbox checked?
        if (document.getElementById('drop-remove').checked) {
          // if so, remove the element from the "Draggable Events" list
          arg.draggedEl.parentNode.removeChild(arg.draggedEl);
        }
      },
      eventDrop: function(event){
        alert('event Drop')
      },
      eventClick: function(event){
        alert('event Click')
      },
      eventResize: function(event){
        alert('event Resize')
      },
      eventSelect: function(event){
        alert('event Select')
      },
      // events: [
      //   {
      //     title: 'event1',
      //     start: '2024-01-11T10:00:00',
      //     end: '2024-01-11T16:00:00'
      //   },
      //   {
      //     title: 'event2',
      //     start: '2024-01-13T10:00:00',
      //     end: '2024-01-14T16:00:00'
      //   }
      // ],
      events: routeEvents('routeLoadEvents'),
});
calendar.render();

});

