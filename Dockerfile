FROM php:7.1

RUN apt-get update
RUN apt-get install -y libmcrypt-dev mysql-client wget
RUN docker-php-ext-install mcrypt mbstring tokenizer pdo_mysql

RUN mkdir /tax-calculator-server
COPY . /tax-calculator-server
WORKDIR  /tax-calculator-server

# Add a script to be executed every time the container starts.
COPY entrypoint.sh /usr/bin/
RUN chmod +x /usr/bin/entrypoint.sh
RUN entrypoint.sh
#ENTRYPOINT ["entrypoint.sh"]

RUN cp .env.compose .env
RUN composer install --no-interaction
RUN php artisan key:generate
RUN php artisan config:clear

# Start the main process.
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]