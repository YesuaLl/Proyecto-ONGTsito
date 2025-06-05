// Gráfico por género
const dataGenero = {
    labels: generoLabels,
    datasets: [{
        label: 'Cantidad de voluntarios por sexo',
        data: generoData,
        backgroundColor: ['#36A2EB', '#FF6384'],
    }]
};

const configGenero = {
    type: 'bar',
    data: dataGenero,
    options: {
        responsive: true,
        plugins: {
            legend: { display: false },
            title: { display: true, text: 'Voluntarios por sexo' }
        }
    },
};

new Chart(document.getElementById('graficoGenero'), configGenero);

// Gráfico por fechas
const dataFechas = {
    labels: fechaLabels,
    datasets: [{
        label: 'Eventos por fecha',
        data: fechaData,
        backgroundColor: '#4CAF50',
    }]
};

const configFechas = {
    type: 'bar',
    data: dataFechas,
    options: {
        responsive: true,
        plugins: {
            legend: { display: false },
            title: { display: true, text: 'Fechas con más eventos' }
        }
    },
};

new Chart(document.getElementById('graficoFechas'), configFechas);
