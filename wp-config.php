<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'WPCACHEHOME', 'C:\xampp\htdocs\wordpress\wp-content\plugins\wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'hack');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '!2OA+8HHY4t#b`Xa^d!z1v|G|&A8&T~bf.X!GfZIb@*#fq0lx/k+1b;>gv,#e[[]');
define('SECURE_AUTH_KEY',  'K0v+P|XISSdoPDLJLm:w?duXj^p2i<Qg,%kG<,eRT.[/3RM,gTkx~TJ5?{iw|$7O');
define('LOGGED_IN_KEY',    'K=Wwg1tD*JYyQF<z{xF|%?xCIialJ;_[),AIRF_|D>S*~@=oyN7_nn(W?,tSLY`r');
define('NONCE_KEY',        'cj-aI+,?fdi!$;h+|P.f;D0~=ib)/?+IEL]ov-yrpQM$KiE5CG_b1l%HX5-H Use');
define('AUTH_SALT',        '-(w#&*`SYV,_uNC~-n1DMe62lKce`GyzP[}gxsw022+ g>,O}e%|2zD/z7|g=ti*');
define('SECURE_AUTH_SALT', '|G)S,/#RAc3{{0i{u)7$v8cTLMJ,rK+37G ~7FLx7O0rxojg0$TI&iU+Vzkw2_]1');
define('LOGGED_IN_SALT',   'obF-v!J2M2%NZc:|8<cFcNmVh(<(G3X0v(pSSK<|4Eo>$)gLJ1Yf%~OjH+owm4:7');
define('NONCE_SALT',       'gh~;jG)+*#|L|H4QsyS;n?|:N8z_1K5L5|(;9npsx)WVTUxOjZf-@`!1:toFKH0 ');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
