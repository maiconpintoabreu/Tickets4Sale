FROM php:7.2
RUN apt-get update -y && apt-get install -y openssl zip unzip git 
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo mbstring pdo_mysql
COPY ./run.sh /tmp/
RUN chmod +x /tmp/run.sh
WORKDIR /app
COPY . /app
RUN composer install
EXPOSE 8181