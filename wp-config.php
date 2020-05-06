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
define( 'DB_NAME', 'MNDL' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'PROTIKmondal1' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         '_e#2M}J)vsunb^lWq+M$xDW$)yT!]2b>B%3i{3F<Ye+}])Hq #Ku;&i4U ltqn0/' );
define( 'SECURE_AUTH_KEY',  '=MImHr<mu)G|)Zi]El+hH<gAQEpX&$OHY+CL:x7Re,Vt%A3?iog8$F.cuhs38wL,' );
define( 'LOGGED_IN_KEY',    'ilcpe--d^2. ~gmR9N:?)F3K)sF.$*7I1u-]JNbR,q_:vU;LzBakrxJ+yEH:hcn1' );
define( 'NONCE_KEY',        '.:k!a{1r_ZLdbm~0VH%zHu`z`cre,{>Z@Jjw_:d%:- N}15GjAK e.[xT{VaM4a>' );
define( 'AUTH_SALT',        ':Es~}g/_mc[un`IW] IvI_Q.8~b7QX&Nv5G9!]lSY;q{hoam`he$, 5}AL=r7{)b' );
define( 'SECURE_AUTH_SALT', 'fW1+fjPgX1aBE<r:M%s#b.j_Y8LAZcV3x%&0Ap9:P>1tD-Df,p!$W{TD<o9HxBo<' );
define( 'LOGGED_IN_SALT',   '88Lqs,d1)Khlj-2t/0jW)-q^5sW#09ydeKghRiK:gsw&EtVDhJvXY?uSC w}dF<)' );
define( 'NONCE_SALT',       'UXm.R(EFbxp>6]0>e&qqHVbkbx_eN=2>}fm=6PduZ}_S@8.Tw6xpFY5lvl-]oi$q' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
