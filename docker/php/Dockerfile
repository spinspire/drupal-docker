FROM skilldlabs/php:81-fpm
# needed only if you need pgsql support in PHP
RUN apk add --no-cache php8-pdo_pgsql git mysql-client postgresql-client

# Now, install drupal in the container using the following command ...
# composer create-project drupal/recommended-project drupal