# Installation custom de Wordpress

## Dépots (supermarchés) qui nous seront utile

- Packagist (le supermarché PHP) : https://packagist.org/?query=wordpress
- WPackagist (le supermarché Wordpress) : https://wpackagist.org

## Etape 1 : Création/configuration du composer.json dans le dossier public

ATTENTION IL NE FAUT SURTOUT PAS DE COMMENTAIRES DANS LE FICHIER composer.json

```

{
  "repositories": [
    {
      "type": "composer",
      "url": "https://wpackagist.org",
      "only": [
        "wpackagist-plugin/*",
        "wpackagist-theme/*"
      ]
    }
  ],
  "extra": {
    "installer-paths": {
      "content/plugins/{$name}/": [
        "type:wordpress-plugin"
      ],
      "content/themes/{$name}/": [
        "type:wordpress-theme"
      ]
    },
    "wordpress-install-dir": "wp"
  },
  "require": {
    "johnpbloch/wordpress": "^5.6",
    "wpackagist-theme/twentytwentyone": "*",
    "wpackagist-plugin/user-role-editor": "*",
    "wpackagist-plugin/jwt-authentication-for-wp-rest-api": "^1.2"
  },
  "scripts": {
    "reload": [
      "wp plugin deactivate ocooking",
      "wp plugin activate ocooking"
    ],
    "activate-theme": "wp theme activate",
    "activate-plugins": "wp plugin activate --all",
    "activate-htaccess": "wp rewrite structure '/%year%/%monthnum%/%postname%/' --hard",
    "chmod": [
      "sudo chgrp -R www-data .",
      "sudo find . -type f -exec chmod 664 {} +",
      "sudo find . -type d -exec chmod 774 {} +",
      "touch .htaccess",
      "sudo chmod 775 .htaccess"
    ],
    "wp-install-application-passwords": "wp plugin install application-passwords --activate",
    "wp-install-jwt": "wp plugin install jwt-authentication-for-wp-rest-api --activate",
    "wp-install-classic-editor": "wp plugin install classic-editor --activate",
    "wp-install-html-editor-syntax-highlighter": "wp plugin install html-editor-syntax-highlighter --activate",
    "wp-install-all": [
      "wp plugin install classic-editor --activate",
      "wp plugin install html-editor-syntax-highlighter --activate",
      "wp plugin install user-role-editor --activate",
      "wp plugin install view-admin-as --activate",
      "wp plugin install jwt-authentication-for-wp-rest-api --activate",
      "wp plugin install fakerpress --activate",
      "wp plugin install custom-post-type-ui --activate",
      "wp plugin install advanced-custom-fields --activate",
      "wp plugin install acf-to-rest-api --activate"
    ]
  }
}
```

## Etape 2 : Lancer composer (toujours dans le dossier public)

Se placer en ligne de commande dans le dossier public, et faire la commande suivante :

```
composer install
```

## Etape 3 : ne SURTOUT PAS OUBLIER LE .gitignore

```
vendor
wp
content
composer.lock
```

## Etape 4 : Création de l'index.php dans public

```
<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define( 'WP_USE_THEMES', true );

/** Loads the WordPress Environment and Template */
require __DIR__ . '/wp/wp-blog-header.php';
```

## Etape 5 : créer un fichier wp-config.php (toujours dans public)

(Etape 5 bis créer la base de donnée avec adminer (ou autre) pour renseigner le wp-config.php)

ATTENTION a générer les clées uniques
ATTENTION a bien renseigner l'URL du dossier public sur la ligne define('WP_HOME', ...

```
<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'oprofile_xandar' );

/** MySQL database username */
define( 'DB_USER', 'oprofile_xandar' );

/** MySQL database password */
define( 'DB_PASSWORD', 'oprofile_xandar' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Z@;uIWWrkO?)fPax7r+11D+H+:HZV*6&46bJ@J!U<n%uT7PEd!26arzMO7FlvWmI');
define('SECURE_AUTH_KEY',  'qin.u*mo3o3]U]7g|Yl/MX$ZixO:B# e{Y0C>dtxQ67QqF*N2hN-@Oz/CD-j_<[Y');
define('LOGGED_IN_KEY',    'h#*$t-F4 HGdRr7m;CE]w6K^u!L:t_Y4z^Gxf?)WUd2CvME*~:HF2<t[}sVhC3NW');
define('NONCE_KEY',        '!}pd`V^PUlxWnp8[V!6Zz-#!|r-oU$y gqj!_v~^?v0^k~#N30ru4-V*i8y}AukV');
define('AUTH_SALT',        's3C~k+w#)sT5-/q=~SVNiv>ufJ;n565S8X.B+`Dd0y6BQJ.?GvBGhn6eow8}k}=h');
define('SECURE_AUTH_SALT', 'AfiH>.+h1JJoRV<pwuQ_?e.I*ecO=*+qCj8yB_7P|kQ -.n}qM=FFP+^~c@9{qPP');
define('LOGGED_IN_SALT',   '6Od?s:~:qor(k4N0WKmm{g>0TiDByZ6TZb4GB}{ajS#fT(S(HVi+>R ?KhpagUV+');
define('NONCE_SALT',       '6urMZA,&8jEK%aNN]%7tH>-)zg^ygO5mz|n$.v{|-Luq4PA<A2T!PDUXP>%7FHmm');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

//! url vers le dossier public de mon site
// ATTENTION A BIEN RENSEIGNER LA BONNE ADRESSE !!
define('WP_HOME', rtrim ( 'http://localhost/PROMO/XandarWp/S01/wp-demo-install-MikaSlayki/public', '/' ));


// nous spécifions dans quel dossier sont installés les fichiers de wordpress
define('WP_SITEURL', WP_HOME . '/wp');

define('WP_CONTENT_URL', WP_HOME . '/content');
define('WP_CONTENT_DIR', __DIR__ . '/content');


// on peut installer des plugins/theme directement depuis le backoffice
define('FS_METHOD','direct');


/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
```

## Etape 6 : (si pas déjà installé) Installation du logiciel wp-cli

```
curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
chmod +x wp-cli.phar
sudo mv wp-cli.phar /usr/local/bin/wp
# ne pas oublier d'appuyer sur la touche entrée
```

## Etape 7 : créer le fichier wp-cli.yml (toujours dans public)

```
path: wp
apache_modules:
  - mod_rewrite
```

## Etape 8 : Lancer la ligne de commande pour installer wordpress (toujours dans public)

```
wp core install --url="WORDPRESS_URL" --title="WORDPRESS_SITE_NAME" --admin_user="WORDPRESS_ADMIN_NAME" --admin_password="WORDPRESS_ADMIN_PASSWORD" --admin_email="WORDPRESS_ADMIN_EMAIL" --skip-email;
```

Exemple concret :
ATTENTION a la place de "WORDPRESS_URL" je viens préciser l'url du dossier public

```
wp core install --url="http://localhost/PROMO/XandarWp/S01/wp-demo-install-MikaSlayki/public" --title="Demo install WP" --admin_user="mika" --admin_password="mika" --admin_email="mika@buche.com" --skip-email;
```

Le terminal vas me répondre

> Success: WordPress installed successfully.

On a terminé l'install custom de WP :D !

## AVANT DERNIERE ETAPE :

**ATTENTION** On a le mot de passe de la BDD en CLAIR dans le fichier wp-config.php, il nous faut donc IMPERATIVEMENT ajouter ce fichier au gitignore

## Dernière étape, lancer les commandes composer "essentielles"

```
composer run chmod

```
