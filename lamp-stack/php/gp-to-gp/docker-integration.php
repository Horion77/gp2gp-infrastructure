<?php
// Intégration GP2GP : LAMP + Docker
header('Content-Type: text/html; charset=utf-8');

function getDockerData($endpoint) {
    $context = stream_context_create([
        'http' => [
            'timeout' => 5,
            'method' => 'GET'
        ]
    ]);
    
    $response = @file_get_contents("http://localhost:8080" . $endpoint, false, $context);
    return $response ? json_decode($response, true) : null;
}

$telemetryData = getDockerData('/api/telemetry/current');
$healthTelemetry = getDockerData('/health/telemetry');
$healthDashboard = getDockerData('/health/dashboard');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GP2GP - Intégration LAMP-Docker</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; }
        .header { background: #333; color: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
        .card { background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .status-ok { color: #4CAF50; font-weight: bold; }
        .status-error { color: #f44336; font-weight: bold; }
        .metric { font-size: 1.2em; margin: 10px 0; }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; }
        .btn { display: inline-block; padding: 10px 20px; background: #007cba; color: white; text-decoration: none; border-radius: 4px; margin: 5px; }
        .btn:hover { background: #005a8b; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🏎️ GP2GP - Infrastructure Edge Computing McLaren F1</h1>
            <p>Intégration LAMP-Docker pour le monitoring télémétrique temps réel</p>
        </div>

        <div class="card">
            <h2>État des Services</h2>
            <div class="grid">
                <div>
                    <h3>Service Télémétrie</h3>
                    <p>Status: <?php echo $healthTelemetry ? '<span class="status-ok">✅ Opérationnel</span>' : '<span class="status-error">❌ Indisponible</span>'; ?></p>
                </div>
                <div>
                    <h3>Dashboard Docker</h3>
                    <p>Status: <?php echo $healthDashboard ? '<span class="status-ok">✅ Opérationnel</span>' : '<span class="status-error">❌ Indisponible</span>'; ?></p>
                </div>
                <div>
                    <h3>Stack LAMP</h3>
                    <p>Status: <span class="status-ok">✅ Opérationnel</span></p>
                    <p>PHP: <?php echo PHP_VERSION; ?></p>
                </div>
            </div>
        </div>

        <?php if ($telemetryData): ?>
        <div class="card">
            <h2>Données Télémétrie Temps Réel</h2>
            <div class="grid">
                <div>
                    <h3>Performance</h3>
                    <div class="metric">Vitesse: <?php echo $telemetryData['data']['speed']; ?> km/h</div>
                    <div class="metric">Régime: <?php echo number_format($telemetryData['data']['rpm']); ?> RPM</div>
                    <div class="metric">Rapport: <?php echo $telemetryData['data']['gear']; ?></div>
                </div>
                <div>
                    <h3>Systèmes</h3>
                    <div class="metric">DRS: <?php echo $telemetryData['data']['drs_status']; ?></div>
                    <div class="metric">Temps Secteur: <?php echo $telemetryData['data']['sector_time']; ?>s</div>
                </div>
                <div>
                    <h3>Pneumatiques (bar)</h3>
                    <div class="metric">AV-G: <?php echo $telemetryData['data']['tire_pressure']['front_left']; ?></div>
                    <div class="metric">AV-D: <?php echo $telemetryData['data']['tire_pressure']['front_right']; ?></div>
                    <div class="metric">AR-G: <?php echo $telemetryData['data']['tire_pressure']['rear_left']; ?></div>
                    <div class="metric">AR-D: <?php echo $telemetryData['data']['tire_pressure']['rear_right']; ?></div>
                </div>
            </div>
            <p><small>Dernière mise à jour: <?php echo date('H:i:s', strtotime($telemetryData['data']['timestamp'])); ?></small></p>
        </div>
        <?php endif; ?>

        <div class="card">
            <h2>Accès aux Interfaces</h2>
            <a href="/" class="btn">🏠 Interface LAMP Principale</a>
            <a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>:8080" class="btn" target="_blank">📊 Dashboard Docker Temps Réel</a>
            <a href="/phpmyadmin" class="btn">🗄️ Base de Données</a>
            <a href="javascript:location.reload()" class="btn">🔄 Actualiser</a>
        </div>
    </div>

    <script>
        // Auto-refresh toutes les 5 secondes
        setTimeout(() => location.reload(), 5000);
    </script>
</body>
</html>
