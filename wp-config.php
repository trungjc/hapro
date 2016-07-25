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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'haprogroup');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '$W?oMHJt[?3YcQC{fY-Sg<:SNMtq5L7Gn@cB!32Oyd2G-dmjS_--5u+)2-#q@[sS');
define('SECURE_AUTH_KEY',  ' 0,}:?xG>?_Py--lp(/6@.J+Kh<r-6x[kYJJh%>,a5A<|cq)[gQT^4dD<klY!+I(');
define('LOGGED_IN_KEY',    '86#2Z%=m]QLRO/}4-|:~JN2P}31?y+8a`C~x{sZC11s89bK${V&7|P_<v-6F5X_9');
define('NONCE_KEY',        '3jW89@>SO]T]]L?LbaaMS .wd.]N`NITH)SG`+LKug+MwrEJBS`p%.0M.](E$7V#');
define('AUTH_SALT',        'k0z|mYPo_9lq9o$WB*0MbUKWVkB[k?.mfY:u-<41LhF-#a&yt}~nQ5)I /24KQ&l');
define('SECURE_AUTH_SALT', 'uY 3ZPFI3T&hAnW&o?#]@RCiu7JJ*rWdQf7iC#NKXS}cLW-b&} u#Q!?^Jguj%m`');
define('LOGGED_IN_SALT',   'v/6Y[5^Bwc^y9%hK4P^QOjqHIk Q~(>`qWIN2:3ZU= -J6bH?~K[,$NXj,C;EIG]');
define('NONCE_SALT',       '@$:+t,<2>x`27|!EN~_-o@ui%tTx1b)wp>x@)hZVKI=X<LtC|x,7I#$o=bU|9#~K');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'jc_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
