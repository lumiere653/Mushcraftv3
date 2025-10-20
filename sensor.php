<?php
session_start();

// Use include_once for reliability and consistency
include_once 'config/db_connect.php';

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: auth/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Environmental Monitoring Dashboard - Mushcraft</title>
    <link rel="stylesheet" href="css/sensor.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>
</head>
<body>
<header>
    <div class="logo-container">
        <div class="logo-text">Mushcraft</div>
    </div>
    <nav>
        <a href="home.php" class="nav-button home-button">Return</a>
        <a href="auth/logout.php" class="nav-button login-button">Logout</a>
    </nav>
</header>

<div class="dashboard-container">
    <div class="dashboard-header">
        <div class="header-left">
            <h1>Environmental Monitoring Dashboard</h1>
            <p>Real-time greenhouse climate control and analytics</p>
        </div>
        <div class="system-status-card">
            <div class="status-indicator"></div>
            <div class="status-text">
                <h3 id="systemStatusText">All Systems Operational</h3>
                <p id="lastSystemUpdate">Updated just now</p>
            </div>
        </div>
    </div>

    <div class="summary-grid">
        <div class="summary-card green">
            <div class="summary-label">Avg Temperature</div>
            <div class="summary-value" id="avgTemp"></div>
            <div class="summary-change" id="tempChange"></div>
        </div>
        <div class="summary-card yellow">
            <div class="summary-label">Avg Humidity</div>
            <div class="summary-value" id="avgHumidity"></div>
            <div class="summary-change" id="humidityChange"></div>
        </div>
        <div class="summary-card blue">
            <div class="summary-label">Avg CO₂</div>
            <div class="summary-value" id="avgCO2"></div>
            <div class="summary-change" id="co2Change"></div>
        </div>
        <div class="summary-card purple">
            <div class="summary-label">System Uptime</div>
            <div class="summary-value" id="uptime"></div>
            <div class="summary-change" id="uptimeChange"></div>
        </div>
    </div>

    <div class="main-grid">
        <div class="sensors-section">
            <!-- Temperature Sensor -->
            <div class="sensor-card">
                <div class="sensor-header">
                    <div class="sensor-title">Temperature</div>
                    <div class="sensor-icon">🌡️</div>
                </div>
                <div class="sensor-value-container">
                    <span class="sensor-value" id="tempValue"></span>
                    <span class="sensor-unit">°C</span>
                </div>
                <div class="sensor-status status-optimal" id="tempStatus"></div>
                <div class="sensor-timestamp" id="tempTime"></div>
                <div class="mini-chart">
                    <canvas id="tempMiniChart"></canvas>
                </div>
            </div>

            <!-- Humidity Sensor -->
            <div class="sensor-card">
                <div class="sensor-header">
                    <div class="sensor-title">Humidity</div>
                    <div class="sensor-icon">💧</div>
                </div>
                <div class="sensor-value-container">
                    <span class="sensor-value" id="humidityValue"></span>
                    <span class="sensor-unit">%</span>
                </div>
                <div class="sensor-status status-optimal" id="humidityStatus"></div>
                <div class="sensor-timestamp" id="humidityTime"></div>
                <div class="mini-chart">
                    <canvas id="humidityMiniChart"></canvas>
                </div>
            </div>

            <!-- CO₂ Sensor -->
            <div class="sensor-card">
                <div class="sensor-header">
                    <div class="sensor-title">CO₂ Level</div>
                    <div class="sensor-icon">🌫️</div>
                </div>
                <div class="sensor-value-container">
                    <span class="sensor-value" id="co2Value"></span>
                    <span class="sensor-unit">ppm</span>
                </div>
                <div class="sensor-status status-optimal" id="co2Status"></div>
                <div class="sensor-timestamp" id="co2Time"></div>
                <div class="mini-chart">
                    <canvas id="co2MiniChart"></canvas>
                </div>
            </div>
        </div>

        <div class="actuators-section">
            <div class="section-title">Climate Controls</div>

            <div class="actuator-item" id="humidifierItem">
                <div class="actuator-header">
                    <div class="actuator-info">
                        <div class="actuator-icon">💨</div>
                        <div class="actuator-details">
                            <h4>Humidifier</h4>
                            <p>Moisture control</p>
                        </div>
                    </div>
                    <div class="toggle-switch" id="humidifierToggle"
                         role="button" tabindex="0"
                         onclick="toggleActuator('humidifier')"
                         onkeydown="if(event.key==='Enter'||event.key===' ') toggleActuator('humidifier')">
                        <div class="toggle-knob"></div>
                    </div>
                </div>
                <div class="actuator-stats">
                    <div class="stat-item">
                        <div class="stat-label">Status</div>
                        <div class="stat-value" id="humidifierStatus"></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Runtime</div>
                        <div class="stat-value" id="humidifierRuntime"></div>
                    </div>
                </div>
            </div>

            <div class="actuator-item" id="fanItem">
                <div class="actuator-header">
                    <div class="actuator-info">
                        <div class="actuator-icon">🌀</div>
                        <div class="actuator-details">
                            <h4>Ventilation Fan</h4>
                            <p>Air circulation</p>
                        </div>
                    </div>
                    <div class="toggle-switch" id="fanToggle"
                         role="button" tabindex="0"
                         onclick="toggleActuator('fan')"
                         onkeydown="if(event.key==='Enter'||event.key===' ') toggleActuator('fan')">
                        <div class="toggle-knob"></div>
                    </div>
                </div>
                <div class="actuator-stats">
                    <div class="stat-item">
                        <div class="stat-label">Status</div>
                        <div class="stat-value" id="fanStatus"></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Runtime</div>
                        <div class="stat-value" id="fanRuntime"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="charts-grid">
        <div class="chart-card">
            <div class="chart-header">
                <div class="chart-title">Environmental Trends</div>
                <div class="time-range">
                    <button class="time-btn" onclick="changeTimeRange('1h')">1H</button>
                    <button class="time-btn" onclick="changeTimeRange('6h')">6H</button>
                    <button class="time-btn active" onclick="changeTimeRange('24h')">24H</button>
                    <button class="time-btn" onclick="changeTimeRange('7d')">7D</button>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="mainChart"></canvas>
            </div>
        </div>

        <div class="activity-log">
            <div class="chart-header">
                <div class="chart-title">Activity Log</div>
            </div>
            <div class="log-list" id="activityLog"></div>
        </div>
    </div>
</div>

<script src="js/sensor.js"></script>
</body>
</html>
