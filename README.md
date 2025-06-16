# GP-to-GP : Projet Personnel d'Infrastructure Edge Computing F1

> Expérimentation personnelle d'une solution Edge Computing inspirée de la Formule 1

## À Propos du Projet

Ce projet est une **initiative personnelle**et a la fois un devoir scolaire visant à explorer et tester la mise en place d'une infrastructure Edge Computing dans le contexte de la Formule 1. L'objectif était de comprendre comment déployer une architecture multicouche robuste avec les moyens techniques disponibles, en simulant les contraintes d'un environnement de course automobile.

### Motivation

Passionné par la technologie et la Formule 1, j'ai voulu expérimenter la création d'une infrastructure capable de traiter des données télémétriques en temps réel, similaire à ce que pourraient utiliser les écuries. Ce projet m'a permis d'approfondir mes connaissances en :

- **Edge Computing** et traitement local des données
- **Architecture hybride** combinant technologies traditionnelles et modernes
- **Conteneurisation** et orchestration de services
- **Infrastructure as Code** avec Vagrant et Docker

### Approche Technique

Avec les ressources disponibles (serveur personnel, outils open-source), j'ai développé une solution multicouche qui simule un environnement de paddock F1 :

- **Couche Virtualisation** : VMs pour isolation et reproductibilité
- **Stack LAMP** : Base solide pour données historiques et interfaces web
- **Services Docker** : Microservices spécialisés pour le temps réel
- **Monitoring** : Surveillance automatique de l'infrastructure

## Performances Mesurées (Environnement de Test)

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

### Architecture Réseau Déployée
- **LAMP** : Port 80 (Apache), Port 3306 (MariaDB)
- **Docker** : Port 8080 (Proxy)
- **Bridge** : gp2gp-network (172.18.0.0/16)

## Environnement de Test

### Configuration Matérielle
- **Processeur** : AMD Ryzen 7 5800X 8-Core
- **RAM** : 3.8 GB disponible
- **OS** : AnduinOS 1.3.2 (Ubuntu-based)
- **Stockage** : 20 GB (9.0 GB utilisé)

### Technologies Utilisées
- **Virtualisation** : Vagrant + VirtualBox
- **Stack Web** : Apache 2.4.63, MariaDB 11.4.7, PHP 8.4.5
- **Conteneurisation** : Docker + Docker Compose
- **Monitoring** : Health checks automatiques

