# Drupal Starter Project

Use this project as a starting point for your containerized Drupal projects.
It has the following features:

- Very lightweight. Ideal for local development.
- Dockerized: It uses 2 or 3 containers - web, php, db (optional if you use sqlite)
- `docker-compose.*.yml` files for mysql, pgsql, traefik etc.
- Includes `drupal` (core), `composer`, and `drush`
- PROD fallback: Allows your local dev environment to redirect requests for uploaded file assets to the PROD instance. That way you don't have to copy all of them from PROD to local.
- Pre-existing `entrypoint` scripts to set everything up for you every time you rebuild the containers

# Steps to use it

- `cp .env.example .env` and then edit .env to your taste.
- Edit email addresses and site URL in `drupal/drush/drush.yml`
- Optionally: Copy database dump files (`*.sql` and `*.sql.gz`) into `db-init`
- Bring up the containers ...

```
docker-compose up -d
```

- Wait for db container to be ready. Check with ...

```
docker-compose logs -f php
docker-compose logs -f db
docker-compose logs -f web
```

- If you did not restore an existing site, then create a new one with ...

```
docker-compose exec php drush site-install
```

- Now visit your website. Either use the public URL or use the following to find the Docker IP's URL.

```
echo "http://$(docker inspect -f '{{range.NetworkSettings.Networks}}{{.IPAddress}}{{end}}' $(docker-compose ps -q web))"
```

# Troubleshooting

- See what containers are running:

```
docker-compose ps
```

- Look at the logs

```
docker-compose logs
```

- Look at `php` logs

```
docker-compose logs php
```

- Tail the `php` logs

```
docker-compose logs -f php
```

# Optional Steps

You can add some useful extensions with ...

```
docker-compose exec php composer require drupal/admin_toolbar drupal/module_filter drupal/pathauto
docker-compose exec php drush -y en admin_toolbar_tools module_filter pathauto
```

And then configure Pathauto patterns.

If you want to use `xdebug`, change the command in docker-compose.override.yml to:

```
    command: php-fpm81 -F -d zend_extension=xdebug.so
```

Credit: https://github.com/skilld-labs/docker-php
