[![Code Quality](https://github.com/benoitchantre/deployer-extended-wordpress/actions/workflows/code-quality.yml/badge.svg)](https://github.com/benoitchantre/deployer-extended-wordpress/actions/workflows/code-quality.yml)

# Deployer Extended WordPress

A collection of Deployer tasks to use with WordPress sites.

## Database tasks

- `database:backup`: Backup the database
- `database:cleanup_backup`: Purge old database backups
- `database:upgrade`: Run the WordPress database update procedure

## OPcache tasks

- `opcache:clear`: Reset OPcache

## WP Rocket tasks

- `wprocket:config:update-advanced-cache`: Update advanced-cache.php with current paths
- `wprocket:cache:clear`: Clear WP Rocket cache
