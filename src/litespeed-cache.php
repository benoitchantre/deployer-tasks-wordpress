<?php

namespace Deployer;

desc('Clear LiteSpeed cache');
task('litespeed:cache:clear', function() {
    within(
        '{{release_path}}',
        function() {
            // Exit early when LiteSpeed Cache is not installed.
            if (! test('wp plugin is-installed litespeed-cache')) {
                writeln('<comment>Aborted: LiteSpeed Cache is not installed.</comment>');
                return;
            }

            // Exit early when LiteSpeed Cache is not active.
            if (! test('wp plugin is-active litespeed-cache')) {
                writeln('<comment>Aborted: LiteSpeed Cache is disabled.</comment>');
                return;
            }

            // Exit early when LiteSpeed CLI is not installed.
            if (! test('wp cli has-command litespeed-purge')) {
                writeln('<error>Aborted: LiteSpeed Cache CLI is not installed.</error>');
                return 1;
            }

            run('wp litespeed-purge all');
        }
    );
});
