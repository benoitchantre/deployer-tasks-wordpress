<?php

namespace Deployer;

desc('Backup the remote database');
task('database:backup', function() {
    $db_backup_path = get('db_backups_path', '{{deploy_path}}/db-backups');

    // Create db-backups directory if it does not exist.
    run("mkdir -p $db_backup_path"); // @phpstan-ignore-line

    within(
        '{{release_path}}',
        function(): void {
            // Exit early when WordPress is not yet installed.
            if (! test('wp core is-installed')) {
                writeln('<comment>Aborted: WordPress is not yet installed.</comment>');
                return;
            }

            // Export the database in the db-backups dir.
            run('wp db export {{db_backups_path}}/$(date +"%F_%T").sql');
        }
    );
});

desc('Purge old remote database backups');
task('database:cleanup_backups', function() {
    $db_backup_path = get('db_backups_path', '{{deploy_path}}/db-backups');

    // Create db-backups directory if it does not exist.
    run("mkdir -p $db_backup_path"); // @phpstan-ignore-line

    within(
        $db_backup_path, // @phpstan-ignore-line
        function(): void {
            $keep_db_backups = (int) get('keep_db_backups', 3) + 1; // @phpstan-ignore-line
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
