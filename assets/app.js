// assets/app.js
import { Application } from '@hotwired/stimulus';
import ChartController from './controllers/chart_controller';
import Chart from 'chart.js/auto';
// assets/app.js
import './styles/dashboard.css';



// Initialise Stimulus
const application = Application.start();
application.register('chart', ChartController);

// Assurez-vous que Chart.js est installé et configuré

