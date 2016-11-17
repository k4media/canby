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
define('DB_NAME', 'canby');

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
define('AUTH_KEY',         'K/?O^18y=U.bua6pfsmpT;(I+1JU0C+2p[snUN(9lYX]s5a?p(:[B^WU{y_E;~VJ');
define('SECURE_AUTH_KEY',  '<S$#$:p_U~Q&dY;NauViPa1e jM6K`v#Pu6M[{mt0 n1z>aga5z;$!5oDvn[y8az');
define('LOGGED_IN_KEY',    '.oN2FTWFkUMwD6(r{j5U_V`l0jTO_YOx*AR&5@f}}9jbKRi$DPET{*$30J-W(5d(');
define('NONCE_KEY',        'MBD_fD%o~V~=1DlT1r,D=q>bU-VLJ@2uUs4mGf=97mGDnIS!K6)vi2-BnK N!w,8');
define('AUTH_SALT',        'N~l+7[zadGHsz=:%Zyi5g+_$?LaZCPgFM<$g^+o|XdHM|=i/lX=VS<{rCL/UEi]p');
define('SECURE_AUTH_SALT', '/^RrLXDblYJ*Y6XujQc<_9JZK$bk>.>w49EA7C8it@RIpt&^cEr Qi,Yjo?vEh%)');
define('LOGGED_IN_SALT',   '/6M=y~|ABlA(_{d_+clE?In+@F>|:q#0wo8ge/a(;tM6wD2{6X{ZWqjrl@Xob^T4');
define('NONCE_SALT',       'VcuIJJ:|6oyG]kg<4=[d!Ixe*O^%O%;:nw>1DZcTBQ0BWb9.EMDaY[VaaH`?3riM');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
