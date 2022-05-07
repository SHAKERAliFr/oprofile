<?php

function oprofile_load_assets()
{
    wp_enqueue_style(
        'style', //nom du fichier css
        get_theme_file_uri('assets/css/style.css')
    );

    // changer le font wp
    wp_enqueue_style(
        'googlefont-0',
        'https://fonts.googleapis.com/css2?family=Open+Sans&family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&family=Roboto:wght@100&display=swap'
    );


    wp_enqueue_script(
        'main-js', //nom de script
        get_theme_file_uri(
            'assets/js/main.js'
        ),
        [],
        false,
        true // true pour que le scripte soit chargé avant la fermeture du body


    );
}
add_action('wp_enqueue_scripts', 'oprofile_load_assets');
