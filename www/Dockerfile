FROM ubuntu:18.04

# Install needed packages

RUN echo 'debconf debconf/frontend select Noninteractive' | debconf-set-selections
# python-selenium package
RUN echo 'deb http://archive.ubuntu.com/ubuntu trusty multiverse' >> /etc/apt/sources.list

# google-chrome
RUN apt-get update \
 && apt-get install -y   gnupg \
                         software-properties-common \
                         wget

# for php5.6
RUN LC_ALL=C.UTF-8 add-apt-repository -y ppa:ondrej/php

RUN apt-get update \
  && apt-get install -y  apache2 \
                         curl \
                         libapache2-mod-php5.6 \
                         locales \
                         logrotate \
                         lsof \
                         mysql-client \
                         php5.6-gd \
                         php5.6-mbstring \
                         php5.6-mysql \
                         php5.6-sybase \
                         php-xdebug \
                         php5.6-xml \
                         python3-pip \
                         rsync \
                         time \
                         unzip \
                         xvfb \
 && apt-get clean \
 && rm -rf /var/lib/apt/lists/*

# Setup Apache

COPY cake.conf /etc/apache2/sites-available/cake.conf
RUN a2enmod rewrite && a2enmod ssl \
    && rm -f /etc/apache2/sites-enabled/000-default.conf \
    && ln -s /etc/apache2/sites-available/cake.conf /etc/apache2/sites-enabled/cake.conf \
    && sed -i 's/memory_limit = .*/memory_limit = 1024M/' /etc/php/5.6/*/php.ini \
    && sed -i 's/.*max_input_vars.*/max_input_vars = 4000/' /etc/php/5.6/*/php.ini
ENV APACHE_RUN_DIR /var/www/html
ENV APACHE_LOG_DIR /cake/app/tmp/logs

EXPOSE 80

ENV PATH /cake/scripts:$PATH

RUN echo "cd /cake" >> ~/.bashrc

RUN locale-gen hu_HU && locale-gen hu_HU.UTF-8 && update-locale


HEALTHCHECK --interval=60s --timeout=3s \
  CMD wget -O /dev/null http://localhost/ || exit 1

ENV LANG C.UTF-8

CMD /cake/scripts/entrypoint.sh

