<?php
define('WP_CACHE', false);
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
define( 'WP_HOME', 'https://suss.fireflydigital.dev' );
define( 'WP_SITEURL', 'https://suss.fireflydigital.dev' );


// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'suss.net.au_www' );

/** MySQL database username */
define( 'DB_USER', 'dev' );

/** MySQL database password */
define( 'DB_PASSWORD', 'F1refly5%' );

/** MySQL hostname */
define( 'DB_HOST', '127.0.0.1' );

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
define('AUTH_KEY',         'iurVvcIAfIyhyMOeoSMpphsB8rqHZgMYDTkOkUTAPy0LC0JiYw7AFQo8yssaUxuf');
define('SECURE_AUTH_KEY',  'tlDiZkJnCjofHwjPBJM8aEcU9wN9cssyiA1pnsap1c72Xh0dPVxjuBmEY95Nb0OT');
define('LOGGED_IN_KEY',    'eVbzrZXQf2QMmeZhdLDnPHPDjLWDdiPuD0N785feIfl0mHajdyJftAKcSg2z3flb');
define('NONCE_KEY',        'CYsxrR5y8F2ibkjErO01VyVDwd3hOBEp36J0BSTFLi5HghWuH3smoujFDtBhabvA');
define('AUTH_SALT',        'nDUdElenHG4vyrroHLds39bGxzlSXt5Mu8937OPXBb30ml4Qv3KHMEe4bs5CVN8D');
define('SECURE_AUTH_SALT', 'WQqWbJuZO798HSFEs8H1xdVGL9NH3GjfhlCWkEpFgb5H6WaJOupMNSXOhDrbuqFM');
define('LOGGED_IN_SALT',   'tbGDE3W8frikunR01Mwl5JlAl87vYO78yt3cKBNbj3IkYxaOemhs5hFFeDvhSm5o');
define('NONCE_SALT',       'u1CPui1LX5SBsEysYG9rIJwd8gY9InBoqy7RomCyDsrt8OIO0ilDWC4jjclJE96Q');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');
define('FS_CHMOD_DIR',0755);
define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed externally by Installatron.
 * If you remove this define() to re-enable WordPress's automatic background updating
 * then it's advised to disable auto-updating in Installatron.
 */
//define('AUTOMATIC_UPDATER_DISABLED', true);

// Disable Editing in Dashboard
define('DISALLOW_FILE_EDIT', true);

// auto apply security updates
define( 'WP_AUTO_UPDATE_CORE', 'minor' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'eg6b_';

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
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
