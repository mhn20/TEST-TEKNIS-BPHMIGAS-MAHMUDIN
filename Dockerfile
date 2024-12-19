FROM php:7.4-apache
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Install Apache and enable required modules
RUN apt-get update && \
    apt-get install -y apache2 && \
    a2enmod rewrite

RUN apt-get update && apt-get install -y \
    libreoffice \
    unoconv \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    libzip-dev \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /var/www/html

# Copy your application code to the container
COPY . /var/www/html/

COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Copy custom php.ini to the container
COPY php.ini /usr/local/etc/php/

# Expose port 8000
EXPOSE 8000

# Start Apache
CMD ["apache2ctl", "-D", "FOREGROUND"]