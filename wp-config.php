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
define('DB_NAME', 'ivorio1q_wp914');

/** MySQL database username */
define('DB_USER', 'ivorio1q_wp914');

/** MySQL database password */
define('DB_PASSWORD', 'u(Yp]09S6x');

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
define('AUTH_KEY',         'k9jmmmxv9kjptykdhxogk2wshkp7fwa2ltbzfgg1vwia7g02qgfegrtqkdpczdg8');
define('SECURE_AUTH_KEY',  '2jm51uktqx0ygynvxqfvzjifjyk9azfffjodmmelcghlyvbbazy9vx0kd0jc2tq5');
define('LOGGED_IN_KEY',    'qxl3dy8kvjkq5loszjbkayb2ug1i0s4famm9zvnvy1uvgrsh35hkfa5mkalckstc');
define('NONCE_KEY',        'lmkjfnwqpkkdxjphxgslsl2y9apmm7cubef2kxgsviqnz5msqqzqc05pzbx5xmc7');
define('AUTH_SALT',        'raqgxvuyelq2lrm4wnpidhsatkdpn5zlmlavyndnvfz6h6hgrxbp7pw4fvq6loeq');
define('SECURE_AUTH_SALT', 'qfshpgnrc8oppujtp1bdvlphsz8hdydrwtshiavb0olviaw2odzgzv1e4zslvexu');
define('LOGGED_IN_SALT',   'wg0cvkfjhatsc0hcx9rywd7kwvxwwshtfptk4l9jtfrgk8e2vl56ic4tw70jlz76');
define('NONCE_SALT',       'rn9pudjjcnqvyb8z6haixn6k055lnsrrb404pufmmwlxjvdsgltfkc7yzptu5cmg');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpia_';

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
