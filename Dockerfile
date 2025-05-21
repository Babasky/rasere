FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    sqlite3 \
    libsqlite3-dev \
    libzip-dev \
    zip \
    && docker-php-ext-install pdo pdo_sqlite zip

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer
# Définir le dossier de travail
WORKDIR /app

# Copier les fichiers du projet
COPY . .

# Installer les dépendances PHP sans dev et optimiser l'autoloader
RUN composer install --no-dev --optimize-autoloader

# Exposer le port par défaut du serveur web PHP
EXPOSE 8000

# Commande de démarrage
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]


RUN php bin/console doctrine:schema:create --no-interaction