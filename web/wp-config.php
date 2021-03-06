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


/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '?-m#A-gJ]JV x0eemcxDKG7C#Y~r5F[T+w;7dW&CFs11K|7`x@|#*xl^uyq(+!XZ');
define('SECURE_AUTH_KEY',  'ZzhFju*sak2![XXzw>b98$HBNi#V|7b`:+8-O_F<tGDT}<](8rhs8tvvY!dG%4qA');
define('LOGGED_IN_KEY',    'A9|~<[U h&fV%z/{_oVDpNm/tY=!p<n>=&S9yQ$;M9y ]cpD1k6&JFT /tdGw=KD');
define('NONCE_KEY',        'i-SF?rR.HH5d@ZJJ.!E%)2IwKjH^D/unkt<-9xha-:$>_V@8^B+rG6cuB[i@sqj,');
define('AUTH_SALT',        'FT2~jtF#br:{N3F.@f*6YzU#+Cr.lE!)$DABs:aMumT;SoPP~V=].Iq5L[^GN7Ju');
define('SECURE_AUTH_SALT', '(tNvPkD3YK3I+ky0{h5OsK|}5KRw&`OfRubTTy6L/zeg)c89LFoB?c8+5R=xeX|2');
define('LOGGED_IN_SALT',   'OA>@jA=,G]A3xNn!E`QSC|gc9ly!u%i6fxv7]Z %a;dz&`VT46g(P)jV{]|VmZ*E');
define('NONCE_SALT',       '>U%_Dy6_~dGs5-Ci5H_oL:fW8LQ^k{ch(v_-2cGqe^<[/<X`]iVbk[=ISKLdDD U');

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
