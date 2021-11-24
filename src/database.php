<?php

namespace Deployer;

// Default configuration
set('db_backups_path', '{{deploy_path}}/db-backups');
set('keep_db_backups', 3);

desc('Backup the remote database');
task('database:backup', function() {

    // Create db-backups directory if it does not exist.
    run('mkdir -p {{db_backups_path}}');

    within(
        '{{release_path}}',
        function(): void {
            // Exit early when WordPress is not yet installed.
            if (! test('wp core is-installed')) {
                writeln('<comment>Aborted: WordPress is not yet installed.</comment>');
                return;
            }

            // Export the database in the db-backups dir.
            run('wp db export - | gzip > {{db_backups_path}}/$(date +"%F_%T").sql.gz');
        }
    );
});

desc('Purge old remote database backups');
task('database:cleanup_backups', function() {

    // Create db-backups directory if it does not exist.
    run('mkdir -p {{db_backups_path}}');

    within(
        '{{db_backups_path}}',
        function(): void {
            $keep_db_backups = get('keep_db_backups', 3);
            $keep_db_backups++;
            $get_file_to_delete = "ls -t | tail -n +$keep_db_backups";

            // Exit early when db-backups directory has not enough files.
            if (test('[ ! -n "$(ls -A)" ]') || test('[ ! -n "$(' . $get_file_to_delete . ')" ]')) {
                writeln('<comment>Aborted: No enough backups to run.</comment>');
                return;
            }

            // Remove old backups.
            run("$get_file_to_delete | xargs rm");
        }
    );
});

desc('Run the WordPress database update procedure');
task('database:update', function() {
    within(
        '{{release_path}}',
        function(): void {
            // Exit early when WordPress is not yet installed.
            if (! test('wp core is-installed')) {
                writeln('<comment>Aborted: WordPress is not yet installed.</comment>');
                return;
            }

            run('wp core update-db');
        }
    );
});
