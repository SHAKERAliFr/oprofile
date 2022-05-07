<?php

require __DIR__ . '/includes/theme-configuration.php';
require __DIR__ . '/includes/load-assets.php';

function oprofile_excerpt($resume)
{

    return substr($resume, 0, 80) . "...";
}

add_filter('get_the_excerpt', 'oprofile_excerpt');
