<?php
define('WP_AUTO_UPDATE_CORE', 'minor');
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
define( 'DB_NAME', 'astral_mojoboxx' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'RBI@M0ve@1980' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost');

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
define( 'AUTH_KEY',         'RE1~<$b+QplNk,dUrFxDKqbuftwRUj!:rTvk:s=mDJ?+K@C&)LadaOm9bVIk5+er' );
define( 'SECURE_AUTH_KEY',  'Nn^4di@m^ {t,XAbnOJi!CZw:ZnOpu]:R=ywS3l5}f~0Vbi~AW0e[CHg8G$G-~oE' );
define( 'LOGGED_IN_KEY',    'Qi=`Wi/c&O3~_qe?V*@|2_+es.+PT1cp/D,7GboU2yIps=8@l /v,%HKu%]fjMIz' );
define( 'NONCE_KEY',        'n~9O*!ULrgnlCmS*e5nla: UJSMXp(L8}/dRMnd|-zb+Wf$CErs08q@3 F[h`{^w' );
define( 'AUTH_SALT',        '&I?ph_K~v*l17PzB2Rz2}=08Y^&kyNO23#Hji 6X;U!UXutshKQB<zJ HoCa*w.^' );
define( 'SECURE_AUTH_SALT', 'G%i|;Vbu hE9{c9r[tj)Aq5kdy;v&}U5#:;IW^)ZK5#G)oHxhy/[+~7L%vQ!_]^O' );
define( 'LOGGED_IN_SALT',   'dhh;V10gABaDhDT@,1N$cgBN2gm_5Y6Ggd6>h[F9V}Q &rXqPh!5]&UGRmDF0uY?' );
define( 'NONCE_SALT',       'GETvZvr;8xM/V3p@P8)c).6{~fqIjb%M{WmE8eQ1(5wA?{3$_Kfl{] ](UI(&)6S' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'mb_';

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
