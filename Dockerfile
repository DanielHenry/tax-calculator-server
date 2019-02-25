FROM php:7.1

RUN apt-get update
RUN apt-get install -y libmcrypt-dev mysql-client wget
RUN docker-php-ext-install mcrypt mbstring tokenizer pdo_mysql

RUN mkdir /tax-calculator-server
COPY . /tax-calculator-server
WORKDIR  /tax-calculator-server

# Add composer installer and run it.
COPY composer-setup.sh /usr/bin/
RUN chmod +x /usr/bin/composer-setup.sh
RUN composer-setup.sh

RUN cp .env.compose .env
RUN composer install --no-interaction
RUN php artisan key:generate
RUN php artisan config:clear

# Add execute permission for run-web-service.sh and wait-for-it.sh
RUN chmod +x run-web-service.sh
RUN chmod +x wait-for-it.sh
# Start the main process.
CMD ["./run-web-service.sh"]