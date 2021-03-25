FROM phpdockerio/php80-fpm:latest
WORKDIR "/application"

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install  php8.0-pgsql php8.0-sqlite3 php8.0-dba php8.0-gd php8.0-gmp php8.0-imagick php8.0-imap php8.0-ldap php8.0-odbc php8.0-soap php8.0-ssh2 php8.0-sybase php8.0-xmlrpc php8.0-xsl php8.0-xhprof php8.0-yaml \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*