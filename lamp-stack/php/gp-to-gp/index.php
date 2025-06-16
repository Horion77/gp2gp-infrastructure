<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>GP-to-GP Dashboard</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="dashboard-grid">
  <div class="gp-box car-status">
    <h2>Données Voiture</h2>
    <div class="data-box"><span class="label">Temps au tour :</span> <span class="value">1:27.891</span></div>
    <div class="data-box"><span class="label">Usure pneus :</span> <span class="value">46%</span></div>
    <div class="data-box"><span class="label">Temp. freins AV/AR :</span> <span class="value">560°C / 470°C</span></div>
    <div class="data-box"><span class="label">Carburant restant :</span> <span class="value">20.7 L</span></div>
    <div class="data-box"><span class="label">DRS :</span> <span class="value">Actif</span></div>
  </div>

  <div class="gp-box weather">
    <h2>Conditions Météo</h2>
    <div class="data-box"><span class="label">Température piste :</span> <span class="value">45°C</span></div>
    <div class="data-box"><span class="label">Air ambiant :</span> <span class="value">35°C</span></div>
    <div class="data-box"><span class="label">Humidité :</span> <span class="value">38%</span></div>
  </div>

  <div class="gp-box dashboard-table">
    <h2>LIVE SESSION</h2>
    <table>
      <thead>
        <tr>
          <th>Pos</th>
          <th>Pilote</th>
          <th>Écurie</th>
          <th>Tour actuel</th>
          <th>Temps</th>
          <th>Pneus</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $stmt = $pdo->query("SELECT * FROM session ORDER BY position ASC");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>{$row['position']}</td>";
            echo "<td>{$row['pilote']}</td>";
            echo "<td>{$row['ecurie']}</td>";
            echo "<td>{$row['tour_actuel']}</td>";
            echo "<td>{$row['temps']}</td>";
            echo "<td>{$row['pneus']}</td>";
            echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <div class="gp-box car-info-image">
    <h2 style="text-align:center; color:#0ff;">CAR INFORMATION</h2>
    <img src="assets/f1_status.webp" alt="Car and Tyre Full Status Display" style="display:block; margin:20px auto; max-width:100%; border-radius:10px; box-shadow:0 0 10px 2px #0ff;">
  </div>
</div>

<div class="footer">
  Dashboard local LAMP — GP-to-GP System 2025
</div>

</body>
</html>
