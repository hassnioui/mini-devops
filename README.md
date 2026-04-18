# Mini DevOps - Gestion de produits

## Objectif
Ce projet présente une mini application PHP/MySQL conteneurisée avec Docker Compose.

## Structure
- app : code PHP et feuille de style
- db : script d'initialisation MySQL
- scripts : automatisation du déploiement

## Lancement manuel
sudo docker-compose up -d --build

## Lancement automatisé
./scripts/deploy.sh

## Accès
http://localhost:8080

## Base de données
- Hôte : db
- Base : devops_exam
- Utilisateur : devops_user
- Mot de passe : devops_pass
