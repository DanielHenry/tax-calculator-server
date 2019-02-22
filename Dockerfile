FROM php:7-fpm

RUN apt-get update
RUN apt-get install -y libmcrypt-dev mysql-client
RUN pecl install mcrypt-1.0.2
RUN docker-php-ext-enable mcrypt
RUN docker-php-ext-install mbstring tokenizer pdo_mysql

RUN mkdir /tax-calculator-server
COPY . /tax-calculator-server
WORKDIR  /tax-calculator-server

# Add a script to be executed every time the container starts.
COPY entrypoint.sh /usr/bin/
RUN chmod +x /usr/bin/entrypoint.sh
ENTRYPOINT ["entrypoint.sh"]

# Start the main process.
CMD ["php", "artisan", "serve"]