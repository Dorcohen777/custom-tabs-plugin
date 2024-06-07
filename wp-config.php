<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '{$|]!FPD]yUvhdGsY%qSccdMF,Hv{heG]]3ag+v$ahDn]V7F,5n{&V;kv}C/wEWh' );
define( 'SECURE_AUTH_KEY',  ' K<Y;.ZY/eKUc%t7T0:{9~l(Ih!W}B6E(D!5QbZ@[9qqI])@#+Yrk,tq0`d#l]KF' );
define( 'LOGGED_IN_KEY',    '>CU]e]LATe%#_bjU/FJ$(LqIul9W{v]A>,ChfP Sc 8_qC/qK-O7M<z>b[abXZ>i' );
define( 'NONCE_KEY',        'IDGzv#Bo,vyq?so(f;BrX24/qgH;D-T[D]Q0!chjY=xC:.$?,RFaLg[y@#+q2gv!' );
define( 'AUTH_SALT',        '>ll#Hn|AF>aB8mNv OmhlHQa1TXJo%>LTYbG/=6szoM$/X-_Iz:ELlQ5qGi[lr%K' );
define( 'SECURE_AUTH_SALT', ';`h1`<a~OXMc-4Ls|[hnf7G%PmltjFo&X8Psx![()U#LyNqqiRR0CqOame`7p|Jd' );
define( 'LOGGED_IN_SALT',   'Kz)fe}|OuHO1{)a~XjPwK0A`j,d@f$8[K{[kk8E{?Dzgz@nZ/gHPk2/_mi]!3X7r' );
define( 'NONCE_SALT',       '`4{}rL.G-u?4CLy~{ak4rr* 3O}1O`(dex}7l _4Cj,/kpU@G3$mHL^u<zaV%Nd ' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
