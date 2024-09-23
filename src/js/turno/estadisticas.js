import { Dropdown } from "bootstrap";
import { Chart } from "chart.js/auto";

const canvas = document.getElementById('chartTurnosPuesto');
const ctx = canvas.getContext('2d');
const btnActualizar = document.getElementById('actualizarTurnos');

const data = {
    labels: [],
    datasets: [{
        label: 'Turnos',
        data: [],
        borderWidth: 5,
        backgroundColor: []
    }]
};

const chartTurnos = new Chart(ctx, {
    type: 'bar',
    data: data,
});

const getEstadisticasTurnos = async () => {
    const url = '/las_aguilas_prueba/API/detalle/turnosPorPuesto';
    const config = { method: "GET" };
    const response = await fetch(url, config);
    const data = await response.json();

    if (data) {
        if (chartTurnos.data.datasets[0]) {
            chartTurnos.data.labels = [];
            chartTurnos.data.datasets[0].data = [];
            chartTurnos.data.datasets[0].backgroundColor = [];

            data.forEach(r => {
                chartTurnos.data.labels.push(r.puesto);
                chartTurnos.data.datasets[0].data.push(r.cantidad_turnos);
                chartTurnos.data.datasets[0].backgroundColor.push(generateRandomColor());
            });
        }
    }
    chartTurnos.update();
};

const generateRandomColor = () => {
    const r = Math.floor(Math.random() * 256);
    const g = Math.floor(Math.random() * 256);
    const b = Math.floor(Math.random() * 256);

    return `rgb(${r}, ${g}, ${b})`;
};

btnActualizar.addEventListener('click', getEstadisticasTurnos);
