<?php

namespace Deployer;

// Return path to the `wp` bin.
set('bin/wp', function () {
    return which('wp');
});
