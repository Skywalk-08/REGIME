# Image PHP CLI
FROM php:8.2-cli

# Dossier de travail
WORKDIR /app

# Installer dépendances + extensions nécessaires
RUN apt-get update && apt-get install -y \
    libicu-dev \
    unzip \
    && docker-php-ext-install intl pdo pdo_mysql mysqli

# Copier le projet
COPY . /app

# Donner les permissions pour writable (important)
RUN chmod -R 777 /app/writable

# Exposer le port du serveur PHP
EXPOSE 8000

# Lancer le serveur PHP intégré sur le dossier public
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
