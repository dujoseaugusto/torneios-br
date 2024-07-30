# Usa a imagem oficial do PHP com Apache
FROM php:7.4-apache

# Instala extensões necessárias para o PHP
RUN docker-php-ext-install mysqli

# Copia o código do projeto para o diretório padrão do Apache
COPY . /var/www/html/

# Define permissões corretas para o diretório
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# Habilita o módulo de reescrita do Apache
RUN a2enmod rewrite

# Exponha a porta padrão do Apache
EXPOSE 80

# Inicia o Apache
CMD ["apache2-foreground"]
