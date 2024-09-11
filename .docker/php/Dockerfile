# Usa a imagem base php:fpm-alpine
FROM php:fpm-alpine

# Atualiza pacotes do sistema e instala dependências necessárias, incluindo autoconf, phpize e libtool para Xdebug
RUN apk update && apk add --no-cache \
    bash \
    autoconf \
    g++ \
    make \
    libtool \
    oniguruma-dev \
    linux-headers \
    $PHPIZE_DEPS

# Instala apenas as extensões necessárias (neste caso, mbstring)
RUN docker-php-ext-install mbstring

# Instala e configura o Xdebug
RUN pecl update-channels && pecl install xdebug

# Cria o diretório /var/log e ajusta as permissões para o usuário www-data
RUN mkdir -p /var/log && chown www-data:www-data /var/log

# Copia o arquivo de configuração do Xdebug
COPY .docker/php/90-xdebug.ini "${PHP_INI_DIR}/conf.d/debug.ini"

# Copia os arquivos do projeto para o diretório /var/www/html
WORKDIR /var/www/html
COPY . /var/www/html

# Define permissões corretas para os arquivos do projeto
RUN chown -R www-data:www-data /var/www/html

# Exposição de portas para Xdebug
EXPOSE 9003

# Define o comando padrão ao iniciar o container PHP com PHP-FPM
CMD ["php-fpm"]
