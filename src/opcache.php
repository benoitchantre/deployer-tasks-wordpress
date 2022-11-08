<?php

namespace Deployer;

desc('Clear OPcache');
task('opcache:clear', function() {
    within(
        '{{release_path}}',
        function(): void {
            // Exit early when `opcache` attribute is set to false for the host.
            if (! get('opcache', true)) {
                writeln('<comment>Aborted: OPcache is marked as not available for this host.</comment>');
                return;
            }

            // Exit early when WP-CLI Clear OPcache is not installed.
            if (! test('wp cli has-command opcache')) {
                writeln('<comment>Aborted: WP-CLI Clear OPcache is not installed.</comment>');
                return;
            }

            run('wp opcache clear');
        }
    );
});
