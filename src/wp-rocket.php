<?php

namespace Deployer;

require_once __DIR__ . '/common.php';

desc('Update advanced-cache.php with current paths');
task('wprocket:config:update-advanced-cache', function() {
    within(
        '{{release_path}}',
        function() {
            // Exit early when WP Rocket is not installed.
            if (! test('{{bin/wp}} plugin is-installed wp-rocket')) {
                writeln('<comment>Aborted: WP Rocket is not installed.</comment>');
                return;
            }

            // Exit early when WP Rocket is not active.
            if (! test('{{bin/wp}} plugin is-active wp-rocket')) {
                writeln('<comment>Aborted: WP Rocket is disabled.</comment>');
                return;
            }

            // Exit early when WP Rocket CLI is not installed.
            if (! test('{{bin/wp}} cli has-command rocket')) {
                writeln('<comment>Aborted: WP Rocket CLI is not installed.</comment>');
                return;
            }

            run('wp rocket regenerate --file=advanced-cache');
        }
    );
});

desc('Clear WP Rocket cache');
task('wprocket:cache:clear', function() {
    within(
        '{{release_path}}',
        function() {
            // Exit early when WP Rocket is not installed.
            if (! test('{{bin/wp}} plugin is-installed wp-rocket')) {
                writeln('<comment>Aborted: WP Rocket is not installed.</comment>');
                return;
            }

            // Exit early when WP Rocket is not active.
            if (! test('{{bin/wp}} plugin is-active wp-rocket')) {
                writeln('<comment>Aborted: WP Rocket is disabled.</comment>');
                return;
            }

            // Exit early when WP Rocket CLI is not installed.
            if (! test('{{bin/wp}} cli has-command rocket')) {
                writeln('<error>Aborted: WP Rocket CLI is not installed.</error>');
                return 1;
            }

            run('{{bin/wp}} rocket clean --confirm');
        }
    );
});
