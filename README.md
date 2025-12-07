[![Code Quality](https://github.com/benoitchantre/deployer-tasks-wordpress/actions/workflows/code-quality.yml/badge.svg)](https://github.com/benoitchantre/deployer-tasks-wordpress/actions/workflows/code-quality.yml)

# Deployer Tasks WordPress

A collection of Deployer tasks to use with WordPress sites.

## Database tasks

- `database:backup`: Backup the database
- `database:cleanup_backup`: Purge old database backups
- `database:upgrade`: Run the WordPress database update procedure

Requirements for remote host : [WP-CLI](https://wp-cli.org/)

## OPcache tasks

- `opcache:clear`: Reset OPcache
- `opcache:invalidate_advanced_cache`: Invalidate wp-content/advanced-cache.php

Requirements for remote host : [WP-CLI](https://wp-cli.org/), [WP-CLI Clear OPcache](https://github.com/wearerequired/wp-cli-clear-opcache)

## WP Rocket tasks

- `wprocket:config:update-advanced-cache`: Update advanced-cache.php with current paths
- `wprocket:cache:clear`: Clear WP Rocket cache

Requirements for remote host : [WP-CLI](https://wp-cli.org/), [WP Rocket CLI](https://github.com/wp-media/wp-rocket-cli)

## LiteSpeed tasks

- `litespeed:cache:clear`: Clear LiteSpeed cache

Requirements for remote host : [WP-CLI](https://wp-cli.org/), [LiteSpeed Cache](https://wordpress.org/plugins/litespeed-cache/)
