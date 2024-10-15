// calendar.js
document.addEventListener('DOMContentLoaded', function() {
var calendarEl = document.getElementById('calendar');
var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    locale: 'pt-br',
    navLinks: true,
    eventLimit: true,
    selectable: true,
    editable: true,
    droppable: true,
    select: function(event){
        alert('event Select');
    },
    events: routeEvents('routeLoadEvents'),
});
calendar.render();
});

