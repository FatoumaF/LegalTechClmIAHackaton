// assets/controllers/chart_controller.js
import { Controller } from '@hotwired/stimulus';
import Chart from 'chart.js/auto';

export default class extends Controller {
  static values = { chartData: Object };

  connect() {
    console.log('Chart Data:', this.chartDataValue); // Vérifiez les données


    const ctx = this.element.getContext('2d');
    console.log('Canvas Context:', ctx); // Ajoutez ceci pour vérifier le contexte

    new Chart(ctx, {
      type: 'bar', // Type du graphique
      data: this.chartDataValue,
      options: {
        responsive: true,
        plugins: {
          legend: {
            display: true,
          },
          tooltip: {
            callbacks: {
              label: function(context) {
                return `${context.dataset.label}: ${context.raw}`;
              }
            }
          }
        }
      }
    });
  }
}
