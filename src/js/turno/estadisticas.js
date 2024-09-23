import { Dropdown } from "bootstrap";
import { Chart } from "chart.js/auto";

const canvas = document.getElementById('chartTurnos');
const ctx = canvas.getContext('2d');
const btnactualizar = document.getElementById('actualizar');

const data = {
    labels: [],
    datasets: [{
        label: 'turnos',
        data: [],
        borderWidth: 5,
        backgroundColor: []
    }]
};

const chartTurnos = new Chart(ctx, {
    type: 'bar',
    data: data,
});

const getEstadisticas = async () => {
    const url = '/las_aguilas_prueba/API/detalle/estadisticas';
    const config = { method: "GET" };
    const response = await fetch(url, config);
    const data = await response.json();

    if (data) {
        if (chartTurnos.data.datasets[0]) {
            chartTurnos.data.labels = [];
            chartTurnos.data.datasets[0].data = [];
            chartTurnos.data.datasets[0].backgroundColor = [];

            data.forEach(r => {
                chartTurnos.data.labels.push(r.cliente);
                chartTurnos.data.datasets[0].data.push(r.cantidad);
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

    const rebColor = `rgb(${r}, ${g}, ${b})`;
    return rebColor;
};

btnactualizar.addEventListener('click', getEstadisticas);