// assets/app.js

// Import Stimulus
import { Application } from '@hotwired/stimulus';
import ChartController from './controllers/chart_controller';
import Chart from 'chart.js/auto';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid'; 

// Import styles
import './styles/dashboard.css';

// Initialise Stimulus
const application = Application.start();
application.register('chart', ChartController);

// Initialisation de FullCalendar
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    if (calendarEl) {
        var calendar = new Calendar(calendarEl, {
            plugins: [dayGridPlugin],  // Assurez-vous que les plugins nécessaires sont inclus
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
    } else {
        console.error('Element with id "calendar" not found');
    }
});

// Assurez-vous que Chart.js est installé et configuré
// Autres configurations pour votre application
