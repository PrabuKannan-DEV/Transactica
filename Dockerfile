FROM ubuntu
RUN apt-get update -y && apt-get install -y
RUN apt install software-properties-common -y
RUN add-apt-repository ppa:ondrej/php
RUN apt update
RUN apt install php8.0 libapache2-mod-php8.0 php-mbstring php-xml php-zip php-curl php-mysql -y
RUN apt install php8.0-fpm libapache2-mod-fcgid -y
RUN a2enmod proxy_fcgi setenvif
RUN a2enconf php8.0-fpm
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '906a84df04cea2aa72f40b5f787e49f22d4c2f19492ac310e8cba5b96ac8b64115ac402c8cd292b8a03482574915d1a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

COPY . /app
WORKDIR /app
RUN composer install
RUN composer update

EXPOSE 8000

CMD sleep 2 && php artisan migrate && php artisan serve --host=0.0.0.0 --port=8000
