<?php
# copy (or mount for php container) this file to Drupal's sites/default directory
include $app_root . '/' . $site_path . '/default.settings.php';
# where we keep exported config YAML files
$settings['config_sync_directory'] = '../config/sync';

# set DRUPAL_HASHSALT in environment variables (see *.env files)
$settings['hash_salt'] = getenv('DRUPAL_HASHSALT') || '';

# set DRUPAL_DBTYPE in environment variables (see *.env files)
# defaults to sqlite
switch (getenv("DRUPAL_DBTYPE")) {
  case 'mysql':
    $databases['default']['default'] = [
      'database' => 'drupal',
      'username' => 'drupal',
      'password' => 'drupal',
      'prefix' => '',
      'host' => 'db',
      'port' => '3306',
      'namespace' => 'Drupal\\mysql\\Driver\\Database\\mysql',
      'driver' => 'mysql',
      'autoload' => 'core/modules/mysql/src/Driver/Database/mysql/',
    ];
    break;
  case 'pgsql':
    $databases['default']['default'] = array(
      'database' => 'postgres',
      'username' => 'postgres',
      'password' => 'postgres',
      'prefix' => '',
      'host' => 'db',
      'port' => '5432',
      'namespace' => 'Drupal\\pgsql\\Driver\\Database\\pgsql',
      'driver' => 'pgsql',
      'autoload' => 'core/modules/pgsql/src/Driver/Database/pgsql/',
    );
  default:
    $databases['default']['default'] = [
      'database' => '../drupal.sqlite',
      'prefix' => '',
      'namespace' => 'Drupal\\sqlite\\Driver\\Database\\sqlite',
      'driver' => 'sqlite',
      'autoload' => 'core/modules/sqlite/src/Driver/Database/sqlite/',
    ];
}

# see https://www.drupal.org/docs/installing-drupal/trusted-host-settings
$settings['trusted_host_patterns'] = [
  // getenv('HTTP_HOSTNAME')
  // '^example\.com$',
  // '^.+\.example\.com$',
  // '^example\.org$',
  // '^.+\.example\.org$',
];

# load any local overrides
if (file_exists($app_root . '/' . $site_path . '/settings.local.php')) {
  include $app_root . '/' . $site_path . '/settings.local.php';
}
