<?php
define( 'WP_CACHE', true );
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
define( 'DB_NAME', "wordpress" );

/** MySQL database username */
define( 'DB_USER', "root" );

/** MySQL database password */
define( 'DB_PASSWORD', "Polubognonet1!" );

/** MySQL hostname */
define( 'DB_HOST', "localhost" );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '91fhcdjxdxzmv50bhur0lilhcmvygizv5eq7jmfhfakxxkoinzwccxgl4gabxvnf' );
define( 'SECURE_AUTH_KEY',  'dmxtoxd5xehjr5eb8jnm8mexvhl4ttp1qaajdkkn2zyuegccxqol4etx2otbpo89' );
define( 'LOGGED_IN_KEY',    '0j7p4a1sqrpzldi1by87yjasyyic4dqnjoxcc4etku4mmarvvyp2w95yuatqn4cv' );
define( 'NONCE_KEY',        'jded5ieey9k8lkmr66qqteeetngu0nkm8gvkplxuszhwdak8jy5oxd8elhafwyq9' );
define( 'AUTH_SALT',        'x3mwnc4q8rv3ndhrbibnvpnrmcueceykqdscfecvg4c0dkiatwinuhaiztc0gmrk' );
define( 'SECURE_AUTH_SALT', 'ognepsgrlbxemxfdiiwq7m20zjivzztqdf7m20cvjpe8jbol4givcidryitlsixd' );
define( 'LOGGED_IN_SALT',   '0cdtou91f5cnrptgprl05oiyhycqaiubreegbeevqurfr3gywrrstrji7sfekvfp' );
define( 'NONCE_SALT',       'enbrrumnphs8kk5uhyuu9lz56vtakszjicdcx7amhf3gst9wkbnrd8frdclnnnk6' );

define( 'WP_SITEURL', 'http://mrpnl.com' );

define( 'WP_HOME', 'http://mrpnl.com' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wptj_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
