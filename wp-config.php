<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'villadelparque30');
//define('DB_NAME', 'jp000436_villadelparque30');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'root');
//define('DB_USER', 'jp000436');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', '');
//define('DB_PASSWORD', 'xahG2yi9Oi2x');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'x(U|TUHuz2@Iec+#tu06g/9_11cH6nLhu}_Nh*+<D$ ;J&h#KVxC|L/AJ%O;9s!y');
define('SECURE_AUTH_KEY', ';.j.E89(n1~p5L7+<ef@c:F17a{f5r!l!l]hpF[s_7|,E(B+L *Wz:?%Cdi Q3 Y');
define('LOGGED_IN_KEY', '<)NiVg*p|iR*F:IE=+@SfS|QR`+JL+oOA&( Y?VXP0.mrupT0Ug+gBXIyF-x?a <');
define('NONCE_KEY', '*[d<3gRduKO:Mmh-unAaGNrP7WK]j2r4(/fX_yP@`{6u.bbz0nhiV5t1)?[kFx p');
define('AUTH_SALT', ':7oR,?V:</d@C2bk~aI1KH7q#*dI01N/Jj*+4}sG9zpXX-z(!0Xe)u:c|mQq=|Xt');
define('SECURE_AUTH_SALT', '@vJxyN8FWc1W$h--vvjv$OjE6 _sEno#QIx<:,U dd;,iMS 4Q>Z2Zp&Z gmQ)51');
define('LOGGED_IN_SALT', 's`%=zk~6>S*NrvZ0CUu:p+fBf=.yAb12]rrpl-I1%;e]P7!%,3zGvaH2qm4h//?|');
define('NONCE_SALT', '|{VG}ellS_.q:Ld/=ox[Q]%odSjJq8qvknd#lC!r$HV{8 @=%yQYB)<X1& *7-yH');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

