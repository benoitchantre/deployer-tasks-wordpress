<?php

namespace Deployer;

desc('Clear OPcache');
task('opcache:clear', function() {
    within(
        '{{release_path}}',
        function(): void {
            // Exit early OPcache is not available.
            if (! function_exists('opcache_reset')) {
                write('<comment>Aborted: OPcache is not available on the host.</comment>');
                return;
            }

            // Exit early when WP-CLI Clear OPcache is not installed.
            if (! test('wp cli has-command opcache')) {
                write('<comment>Aborted: WP-CLI Clear OPcache is not installed.</comment>');
                return;
            }

            run('wp opcache clear');
        }
    );
});
