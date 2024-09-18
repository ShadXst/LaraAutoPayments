ARG BUILDER_IMAGE_REGISTRY=""

FROM ${BUILDER_IMAGE_REGISTRY}composer:latest as composer

COPY composer.* /app/

RUN apk update && apk add --no-cache openssh-client
ARG COMPOSER_MODE="no-dev"

RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --no-progress \
    --prefer-dist \
    --${COMPOSER_MODE}

COPY . /app/
RUN composer dump-autoload --no-scripts --optimize --classmap-authoritative
RUN composer run-script post-update-cmd

FROM ${BUILDER_IMAGE_REGISTRY}debian:bullseye as add-apt-repositories

RUN apt update && apt install -y wget gnupg lsb-release \
    && sh -c 'echo "deb http://apt.postgresql.org/pub/repos/apt $(lsb_release -cs)-pgdg main" > /etc/apt/sources.list.d/pgdg.list' \
    && wget --quiet -O - https://www.postgresql.org/media/keys/ACCC4CF8.asc | apt-key add -

FROM ${BUILDER_IMAGE_REGISTRY}unit:1.32.0-php8.3

ARG UID=1000
ARG GID=1000
ENV UID=${UID}
ENV GID=${GID}

# Create non root user
RUN addgroup --gid $GID laravel \
    && adduser --uid $UID --gid $GID --shell /bin/bash --home /home/laravel/ laravel

# Postgresql repository configuration
COPY --from=add-apt-repositories /etc/apt/trusted.gpg /etc/apt/trusted.gpg
COPY --from=add-apt-repositories /etc/apt/sources.list.d/pgdg.list /etc/apt/sources.list.d/pgdg.list

# Install dependencies
RUN apt update && apt --no-install-recommends --no-install-suggests -y install \
    autoconf \
    curl \
    g++ \
    gifsicle \
    git \
    gnupg \
    jpegoptim \
    libpq-dev \
    libzip-dev \
    libxpm-dev \
    postgresql-client-14 \
    supervisor \
    unzip \
    zip \
    && apt clean  \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/* /var/www/html/* \
    && ln -sf /dev/stdout /var/log/unit.log

# Install PHP extensions
RUN pecl channel-update pecl.php.net && \
    pecl install redis && \
    rm -rf /tmp/pear

# Enable extensions
RUN docker-php-ext-enable redis

# Install extensions
RUN docker-php-ext-install pdo_pgsql zip exif pcntl opcache sockets

############################### SECURITY ###############################

# Remove existing crontabs, if any.
RUN rm -fr /var/spool/cron \
	&& rm -fr /etc/crontabs \
	&& rm -fr /etc/periodic

# Remove unnecessary accounts, excluding current app user and root
RUN sed -i -r "/^($APP_USER|root|nobody)/!d" /etc/group \
  && sed -i -r "/^($APP_USER|root|nobody)/!d" /etc/passwd

# Disable password login for everybody
RUN while IFS=: read -r username _; do passwd -l "$username"; done < /etc/passwd || true

# Remove temp shadow,passwd,group
RUN find /bin /etc /lib /sbin /usr -xdev -type f -regex '.*-$' -exec rm -f {} +

# Ensure system dirs are owned by root and not writable by anybody else.
RUN find /bin /etc /lib /sbin /usr -xdev -type d \
  -exec chown root:root {} \; \
  -exec chmod 0755 {} \;

## Remove dangerous commands
RUN find /bin /etc /lib /sbin /usr -xdev \( \
  -name hexdump -o \
  -name chgrp -o \
  -name chown -o \
  -name ln -o \
  -name od -o \
  -name strings -o \
#  -name su \
  -name sudo \
  \) -delete

# Remove init scripts since we do not use them.
RUN rm -fr /etc/init.d /lib/rc /etc/conf.d /etc/inittab /etc/runlevels /etc/rc.conf /etc/logrotate.d

# Remove kernel tunables
RUN rm -fr /etc/sysctl* /etc/modprobe.d /etc/modules /etc/mdev.conf /etc/acpi

# Remove root home dir
RUN rm -fr /root

# Remove fstab
RUN rm -f /etc/fstab

# Remove any symlinks that we broke during previous steps
RUN find /bin /etc /lib /sbin /usr -xdev -type l -exec test ! -e {} \; -delete


############################### SECURITY ###############################
# PHP configuration
COPY ./containers/app/php/*.ini /usr/local/etc/php/conf.d/

# Create work directory
WORKDIR /var/www/html
#RUN chown -R laravel:laravel /var/www/html && chmod -R 777 /var/www/html

# Supervisor configuration
COPY ./containers/app/supervisor/config.conf /etc/supervisor/supervisord.conf
COPY ./containers/app/supervisor/workers.conf /etc/supervisor/supervisord.d/workers.conf

# Nginx unit configuration
COPY ./containers/app/nginx-unit/config.json /docker-entrypoint.d/config.json

# Copy project code
RUN mkdir -p /var/www/html/public/vendor/
COPY --from=composer --chown=laravel:laravel /app/vendor /var/www/html/vendor/
# COPY --from=composer --chown=laravel:laravel /app/public/vendor /var/www/html/public/vendor/
COPY --chown=laravel:laravel . /var/www/html/
