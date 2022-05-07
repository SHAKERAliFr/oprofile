<?php

function oprfile_initilize()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'oprfile_initilize');
