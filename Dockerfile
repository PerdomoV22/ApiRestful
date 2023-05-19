FROM php:7.4-fpm

# Instala Nginx y otras dependencias necesarias
RUN apt-get update && apt-get install -y nginx

# Elimina la configuración predeterminada de Nginx
# RUN rm /etc/nginx/conf.d/default.conf

# Copia tu configuración personalizada de Nginx
COPY ./docker/nginx.conf /etc/nginx/sites-enabled/default

# Instala las extensiones de PHP necesarias
# RUN docker-php-ext-install <extensiones>

# Copia tu código fuente al directorio del servidor web
COPY . /var/www/html

# Establece los permisos adecuados para el directorio
RUN chown -R www-data:www-data /var/www/html

# Instalar dependencias requeridas por Composer
RUN apt-get update && \
    apt-get install -y git zip unzip

# Descargar e instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copia el script de inicio personalizado
COPY ./docker/start.sh /start.sh

# Otorga permisos de ejecución al script de inicio
RUN chmod +x /start.sh

# Exponer el puerto 80 para Nginx
EXPOSE 80

CMD ["/start.sh"]

