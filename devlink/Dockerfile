FROM php:8.2-apache

# Instala dependências necessárias do Laravel
RUN docker-php-ext-install pdo pdo_mysql

# Ativa o mod_rewrite para rotas do Laravel
RUN a2enmod rewrite

# Copia arquivos do projeto para dentro do container
COPY . /var/www/html

# Define permissões
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Habilita o virtual host do Laravel
COPY ./docker/laravel.conf /etc/apache2/sites-available/000-default.conf
