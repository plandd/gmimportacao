<?php

/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'gmimport_gmi');

/** MySQL database username */
define('DB_USER', 'gmimport_gmi');

/** MySQL database password */
define('DB_PASSWORD', '9@y@8P24S9');

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
define('AUTH_KEY',         'jtxtk6xlpb53ooywysv8genueq0u4shkmjbflwiokvxy82aagwiqpn5wivyi0gf6');
define('SECURE_AUTH_KEY',  'jfc7hx0nc8tukzgbmiuqolqtgtcf2q8zupnvtyzruucypcl7o2s4g73jmnkmx2rg');
define('LOGGED_IN_KEY',    'kcydbfjppegtp1mxqh0jsip10ejlvnzwonvfstgyvp0ytwmeqtgfc2okygjcucoi');
define('NONCE_KEY',        'x3pihxdoxp12ljqdkomj0jbl5x53cskaitjcjdktqjdaeqazwtkylki5hejbtdwo');
define('AUTH_SALT',        'jguep7cuaite2vozsfzoh1ozmirciy3voszthofyols9nek8f0qiwx1yos89xznf');
define('SECURE_AUTH_SALT', '5genhdmng5s4hka3tc2kbz2wzpdvzsqihwrmkg4hpolpsgvm4wwkakogjevkadnp');
define('LOGGED_IN_SALT',   'i6wtjkiaiipkriu6dvkbnwbyvteiqs6uuyyyicvuavszdkpvrymwcnpcujlw3q9k');
define('NONCE_SALT',       'p23rpbuuojf3wtfafuru0ypa8gnbj2jdhlbifmu03mouc5ewunrbv8b0k9mu3w0q');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
