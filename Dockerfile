FROM ubuntu:19.10

ENV DEBIAN_FRONTEND=noninteractive

RUN \
  apt-get update && \
  apt-get -y upgrade && \
  apt-get install -y nodejs && \
  apt-get install -y software-properties-common && \
  add-apt-repository ppa:ondrej/php && \
  apt update && \
  apt install php7.3 -y && \
  apt install php7.3-common php7.3-mysql php7.3-xml php7.3-xmlrpc php7.3-curl php7.3-gd php7.3-imagick php7.3-cli php7.3-dev php7.3-imap php7.3-mbstring php7.3-opcache php7.3-soap php7.3-zip php7.3-intl php7.3-bcmath php7.3-ctype php7.3-json php7.3-pdo php7.3-tokenizer php7.3-sqlite3 -y && \
  curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
  composer global require laravel/installer

ENV PATH ~/.composer/vendor/bin:$PATH

WORKDIR /app

COPY . /app

RUN touch database/atcheck.sqlite && \
  composer install && \
  composer dump-autoload && \
  php artisan migrate:fresh && \
  php artisan db:seed
