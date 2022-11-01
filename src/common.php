<?php

namespace Deployer;

// Return path to the `wp` bin.
set('bin/wp', function () {

    // Backward compatibility for Deployer 6
    if (!function_exists('which')) {
        return locateBinaryPath('wp');
    }

    return which('wp');
});
