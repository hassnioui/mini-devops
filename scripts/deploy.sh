#!/bin/bash
set -e

echo "[1/3] Arrêt des conteneurs en cours..."
docker compose down

echo "[2/3] Construction et démarrage des services..."
docker compose up -d --build

echo "[3/3] État des services..."
docker compose ps

echo "Application disponible sur http://localhost:8080"
