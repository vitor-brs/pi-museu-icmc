let janeiro, fevereiro, março, abril, maio, junho, julho, agosto, setembro, outubro, novembro, dezembro;
let ano;
const d = new Date();
ano = d.getFullYear();
const ctx = document.getElementById('myChart');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        datasets: [{
            label: 'Visitantes por mês '+ ano,
            data: [janeiro, fevereiro, março, abril, maio, junho, julho, agosto, setembro, outubro, novembro, dezembro],
            backgroundColor: [
                'rgba(17, 141, 255, 1)',
                'rgba(17, 141, 255, 1)',
                'rgba(17, 141, 255, 1)',
                'rgba(17, 141, 255, 1)',
                'rgba(17, 141, 255, 1)',
                'rgba(17, 141, 255, 1)'
            ],
            borderColor: [
                'rgba(17, 141, 255, 1)',
                'rgba(17, 141, 255, 1)',
                'rgba(17, 141, 255, 1)',
                'rgba(17, 141, 255, 1)',
                'rgba(17, 141, 255, 1)',
                'rgba(17, 141, 255, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

const ctxPie = document.getElementById('myChartPie');
const myChartPie = new Chart(ctxPie, {
    type: 'pie',
    data: {
        labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        datasets: [{
            label: 'Visitantes por mês '+ '2022',
            data: [janeiro, fevereiro, março, abril, maio, junho, julho, agosto, setembro, outubro, novembro, dezembro],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});