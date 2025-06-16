const express = require('express');
const cors = require('cors');
const app = express();

app.use(cors());
app.use(express.json());

// Simulation de données télémétrie F1
function generateTelemetryData() {
  return {
    timestamp: new Date().toISOString(),
    speed: Math.floor(Math.random() * 100) + 200, // 200-300 km/h
    rpm: Math.floor(Math.random() * 3000) + 10000, // 10000-13000 rpm
    tire_pressure: {
      front_left: (Math.random() * 0.5 + 2.0).toFixed(2),
      front_right: (Math.random() * 0.5 + 2.0).toFixed(2),
      rear_left: (Math.random() * 0.5 + 2.0).toFixed(2),
      rear_right: (Math.random() * 0.5 + 2.0).toFixed(2)
    },
    drs_status: Math.random() > 0.7 ? 'OPEN' : 'CLOSED',
    gear: Math.floor(Math.random() * 8) + 1,
    sector_time: (Math.random() * 10 + 20).toFixed(3)
  };
}

// API endpoints
app.get('/api/telemetry/current', (req, res) => {
  res.json({
    car_id: 'MCL-01',
    driver: 'Lando Norris',
    data: generateTelemetryData()
  });
});

app.get('/api/telemetry/stream', (req, res) => {
  res.writeHead(200, {
    'Content-Type': 'text/event-stream',
    'Cache-Control': 'no-cache',
    'Connection': 'keep-alive'
  });

  const interval = setInterval(() => {
    const data = JSON.stringify(generateTelemetryData());
    res.write(`data: ${data}\n\n`);
  }, 1000);

  req.on('close', () => {
    clearInterval(interval);
  });
});

app.get('/health', (req, res) => {
  res.json({ status: 'OK', service: 'telemetry' });
});

const PORT = process.env.PORT || 3001;
app.listen(PORT, '0.0.0.0', () => {
  console.log(`Service télémétrie GP2GP démarré sur le port ${PORT}`);
});
