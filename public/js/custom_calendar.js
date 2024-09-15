document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: '/admin/calendar/events', // URL pour charger les événements
        editable: true,
        selectable: true,
        eventClick: function(info) {
            alert('Event: ' + info.event.title);
        }
    });
    calendar.render();
});
