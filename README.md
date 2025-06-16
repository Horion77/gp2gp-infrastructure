# GP-to-GP : Infrastructure Edge Computing pour McLaren F1

> Solution d'Edge Computing multicouche déployée et validée

## Performances Mesurées

### Stack LAMP
- **Consommation** : 290.27 MB RAM
- **Apache 2.4.63** : 11 processus workers
- **MariaDB 11.4.7** : Base gp_to_gp opérationnelle
- **PHP 8.4.5** : Extensions optimisées

### Services Docker
- **gp2gp-telemetry** : 38.73 MiB (Node.js)
- **gp2gp-dashboard** : 27.55 MiB (Flask)
- **gp2gp-proxy** : 2.36 MiB (Nginx)
- **Total** : 68.67 MiB

## Architecture Réseau
- **LAMP** : Port 80 (Apache), Port 3306 (MariaDB)
- **Docker** : Port 8080 (Proxy)
- **Bridge** : gp2gp-network (172.18.0.0/16)

## Démarrage Rapide


