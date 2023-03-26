FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html/

RUN apt-get update

# Set memory limit and upload size
COPY memory_limit.ini $PHP_INI_DIR/conf.d/
COPY upload_size.ini $PHP_INI_DIR/conf.d/

# Install dependencies
RUN apt-get update && apt-get install -y \
  build-essential \
  libpng-dev \
  libjpeg62-turbo-dev \
  libfreetype6-dev \
  locales \
  zip \
  jpegoptim optipng pngquant gifsicle \
  unzip \
  git \
  curl \
  lua-zlib-dev \
  libmemcached-dev \
  nginx

# Install php extensions
RUN docker-php-ext-install pdo_mysql

# Install debug dependencies & composer
RUN apt-get install git -y \
    && apt-get install vim -y \
    && apt-get install curl -y \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY entrypoint.sh /usr/local/bin/entrypoint
RUN chmod +x /usr/local/bin/entrypoint

ENTRYPOINT ["entrypoint"]


