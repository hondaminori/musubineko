FROM php:8.3-apache

# システム依存パッケージ・PHP拡張
RUN apt-get update && apt-get install -y \
    git unzip zip libpq-dev libonig-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring

# Apacheのmod_rewriteを有効化
RUN a2enmod rewrite

# Apache設定ファイルをコピー
COPY ../apache/default.conf /etc/apache2/sites-available/000-default.conf

# Composerインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 作業ディレクトリ
WORKDIR /var/www/html
