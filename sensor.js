// ====== GLOBAL CHARTS ======
let tempChart, humidityChart, co2Chart, mainChart;
let mainChartData = {
    labels: [],
    datasets: [
        { label: 'Temperature (°C)', data: [], borderColor: 'red', fill: false },
        { label: 'Humidity (%)', data: [], borderColor: 'blue', fill: false },
        { label: 'CO₂ (ppm)', data: [], borderColor: 'green', fill: false }
    ]
};

// ====== INIT MINI CHARTS ======
function initMiniCharts() {
    const tempCtx = document.getElementById('tempMiniChart').getContext('2d');
    tempChart = new Chart(tempCtx, { type: 'line', data: { labels: [], datasets: [{ data: [], borderColor: 'red', fill: false }] }, options: { responsive: true, plugins: { legend: { display: false } }, scales: { x: { display: false }, y: { display: false } } } });

    const humCtx = document.getElementById('humidityMiniChart').getContext('2d');
    humidityChart = new Chart(humCtx, { type: 'line', data: { labels: [], datasets: [{ data: [], borderColor: 'blue', fill: false }] }, options: { responsive: true, plugins: { legend: { display: false } }, scales: { x: { display: false }, y: { display: false } } } });

    const co2Ctx = document.getElementById('co2MiniChart').getContext('2d');
    co2Chart = new Chart(co2Ctx, { type: 'line', data: { labels: [], datasets: [{ data: [], borderColor: 'green', fill: false }] }, options: { responsive: true, plugins: { legend: { display: false } }, scales: { x: { display: false }, y: { display: false } } } });

    const mainCtx = document.getElementById('mainChart').getContext('2d');
    mainChart = new Chart(mainCtx, { type: 'line', data: mainChartData, options: { responsive: true, plugins: { legend: { position: 'top' } }, scales: { x: { title: { display: true, text: 'Time' } }, y: { title: { display: true, text: 'Value' } } } } });
}

// ====== UPDATE SENSOR STATUS ======
function updateSensorStatus(sensor, value, min, max) {
    const statusEl = document.getElementById(`${sensor}Status`);
    if (value < min) {
        statusEl.textContent = 'Low';
        statusEl.className = 'sensor-status status-low';
    } else if (value > max) {
        statusEl.textContent = 'High';
        statusEl.className = 'sensor-status status-high';
    } else {
        statusEl.textContent = 'Optimal';
        statusEl.className = 'sensor-status status-optimal';
    }
}

// ====== FETCH SENSOR DATA ======
async function fetchSensorData() {
    try {
        const response = await fetch('get_sensor_data.php');
        const data = await response.json();

        // Update individual sensor values
        document.getElementById('tempValue').textContent = data.temp.current.toFixed(1);
        document.getElementById('humidityValue').textContent = data.humidity.current.toFixed(1);
        document.getElementById('co2Value').textContent = data.co2.current.toFixed(0);

        // Update statuses
        updateSensorStatus('temp', data.temp.current, 20, 28);
        updateSensorStatus('humidity', data.humidity.current, 50, 75);
        updateSensorStatus('co2', data.co2.current, 350, 800);

        // Update timestamps
        document.getElementById('tempTime').textContent = data.time;
        document.getElementById('humidityTime').textContent = data.time;
        document.getElementById('co2Time').textContent = data.time;
        document.getElementById('lastSystemUpdate').textContent = data.time;

        // Update mini charts
        updateMiniChart(tempChart, data.temp.current);
        updateMiniChart(humidityChart, data.humidity.current);
        updateMiniChart(co2Chart, data.co2.current);

        // Update main chart
        updateMainChart(data);

        // Update system summary
        document.getElementById('avgTemp').textContent = data.temp.current.toFixed(1) + ' °C';
        document.getElementById('avgHumidity').textContent = data.humidity.current.toFixed(1) + ' %';
        document.getElementById('avgCO2').textContent = data.co2.current.toFixed(0) + ' ppm';
        document.getElementById('uptime').textContent = data.uptime || 'N/A';

        // Update activity log
        if (data.log) updateActivityLog(data.log);

    } catch (err) {
        console.error('Error fetching sensor data:', err);
    }
}

// ====== MINI CHART UPDATE ======
function updateMiniChart(chart, value) {
    const labels = chart.data.labels;
    const dataset = chart.data.datasets[0].data;
    const time = new Date().toLocaleTimeString();

    labels.push(time);
    dataset.push(value);

    if (labels.length > 20) { labels.shift(); dataset.shift(); }

    chart.update();
}

// ====== MAIN CHART UPDATE ======
function updateMainChart(data) {
    const time = new Date().toLocaleTimeString();

    mainChart.data.labels.push(time);
    mainChart.data.datasets[0].data.push(data.temp.current);
    mainChart.data.datasets[1].data.push(data.humidity.current);
    mainChart.data.datasets[2].data.push(data.co2.current);

    if (mainChart.data.labels.length > 50) {
        mainChart.data.labels.shift();
        mainChart.data.datasets.forEach(ds => ds.data.shift());
    }

    mainChart.update();
}

// ====== ACTUATOR TOGGLE ======
async function toggleActuator(actuator) {
    const toggle = document.getElementById(actuator + 'Toggle');
    const statusEl = document.getElementById(actuator + 'Status');
    const newState = toggle.classList.contains('active') ? 0 : 1;

    try {
        await fetch(`toggle_actuator.php?actuator=${actuator}&state=${newState}`);
        toggle.classList.toggle('active');
        statusEl.textContent = newState ? 'ON' : 'OFF';
    } catch (err) {
        console.error('Error toggling actuator:', err);
    }
}

// ====== ACTIVITY LOG UPDATE ======
function updateActivityLog(logs) {
    const container = document.getElementById('activityLog');
    container.innerHTML = '';
    logs.slice(-10).reverse().forEach(entry => {
        const div = document.createElement('div');
        div.className = 'log-entry';
        div.textContent = `[${entry.time}] ${entry.message}`;
        container.appendChild(div);
    });
}

// ====== TIME RANGE BUTTONS (MAIN CHART) ======
function changeTimeRange(range) {
    console.log('Time range selected:', range);
    // Could fetch historical data via PHP based on range
}

// ====== INIT ======
window.onload = () => {
    initMiniCharts();
    fetchSensorData();
    setInterval(fetchSensorData, 5000);
};
