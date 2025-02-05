# Utiliser l'image officiel PHP avec Apache
FROM php:8.2-apache

# Installer les extensions PHP necessaires
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Activer le module de reecriture d'Apache (utile pour les frameworks php)
RUN a2enmod rewrite

# Definir le repertoire de travail
WORKDIR /var/www/html

# Copier le code source dan sle contenair
COPY . /var/www/html

# copie du config.php
COPY config.php /var/www/html/config.php

# Donner les bonnes permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Exposer le port 80 pour acceder a l'application
EXPOSE 80

# Demarrer Apache en mode foreground
CMD ["apache2-foreground"]


