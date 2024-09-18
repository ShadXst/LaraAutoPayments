FROM php:8.3

# Create non root user
ARG UID=1000
ARG GID=1000
ENV UID=${UID}
ENV GID=${GID}

RUN groupadd --gid $GID laravel && useradd --uid $UID --gid laravel --shell /bin/bash --create-home laravel

# Install dependencies
RUN apt-get update && apt-get install -y \
    autoconf \
    build-essential \
    curl \
    g++ \
    git \
    libjpeg62-turbo-dev \
    libpq-dev \
    libpng-dev \
    libxpm-dev \
    libzip-dev \
    mc \
    nano \
    openssl \
    procps \
    unzip \
    vim \
    wget \
    zip

# Install PHP extensions
RUN pecl channel-update pecl.php.net && \
    pecl install redis

# Enable extensions
RUN docker-php-ext-enable redis

# Install extensions
RUN docker-php-ext-install pdo_pgsql zip exif pcntl

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install nvm/node
ENV NVM_DIR /usr/local/nvm
ENV NODE_VERSION 20.5.0

RUN mkdir /usr/local/nvm
RUN curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.1/install.sh | bash \
    && . $NVM_DIR/nvm.sh \
    && . ~/.bashrc \
    && nvm install $NODE_VERSION \
    && npm i -g npm

ENV NODE_PATH $NVM_DIR/v$NODE_VERSION/lib/node_modules
ENV PATH $NVM_DIR/versions/node/v$NODE_VERSION/bin:$PATH

# Copy configs and aliases
ADD --chown=laravel:laravel https://raw.githubusercontent.com/laradock/laradock/master/workspace/aliases.sh /home/laravel/aliases.sh
COPY --chown=laravel:laravel ./containers/workspace/aliases.sh /home/laravel/custom_aliases.sh
COPY --chown=laravel:laravel --chmod=600 ./containers/app/ssh/* /home/laravel/.ssh/
COPY ./containers/app/php/*.ini /usr/local/etc/php/conf.d/

# Create work directory
WORKDIR /var/www/html
RUN chown -R laravel:laravel /var/www/html && chmod -R 775 /var/www/html

# Change current user to laravel
USER laravel

# User laravel Aliases
RUN echo "" >> ~/.bashrc && \
    echo "# Load Custom Aliases" >> ~/.bashrc && \
    echo "source ~/aliases.sh" >> ~/.bashrc && \
    echo "source ~/custom_aliases.sh" >> ~/.bashrc && \
    echo "" >> ~/.bashrc

# expose for xDebug
EXPOSE 9003

ENTRYPOINT ["tail", "-f", "/dev/null"]
