#!/bin/bash

# Script de setup complet du projet REGIME

echo "🚀 Démarrage du setup REGIME..."

# Run migrations
echo "📦 Exécution des migrations..."
php spark migrate

# Run seeders
echo "🌱 Peuplement de la base de données..."
php spark db:seed UserSeeder
php spark db:seed RegimeSeeder
php spark db:seed ActiviteSportiveSeeder
php spark db:seed CodeSeeder
php spark db:seed ObjectiveSeeder

echo "✅ Setup terminé!"
echo ""
echo "📝 Comptes de test disponibles:"
echo "   Email: jean@test.com"
echo "   Mot de passe: password123"
echo ""
echo "🔧 Compte admin:"
echo "   Email: admin@regime.local"
echo ""
echo "🎉 L'application est prête à l'emploi!"
