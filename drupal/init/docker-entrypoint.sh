#!/bin/sh
set -e

DIR=$(dirname $0)/docker-entrypoint.d
if [[ -d "$DIR" ]]; then
  /bin/run-parts "$DIR"
fi

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
  set -- php-fpm81 "$@"
fi

# "command" is empty
if [ "x$@" = "x" ]; then
  set -- php-fpm81
fi

exec "$@"