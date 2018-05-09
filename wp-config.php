<?php
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
define('DB_NAME', 'cuaucalderon');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'cuau');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', 'ccalderon2018');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY', 'FdP*@#6Z7kk~ wk]%{65vwT_>d^VK<iIBb-h>i+LoCc9EW@T$[{>pPXWyjviBdci');
define('SECURE_AUTH_KEY', 'wmnZ|~g%jVy1If?%N]b~>T+/vgF)sAbr{XqjXpD{jI,Y$Mr!tc<TeL!+=vV`JI?S');
define('LOGGED_IN_KEY', '7;uO%wMNJa@m$BCM;#*y>{1id|P`,52/ePslRHS8B6L&@mIbos3*?iNH_as|M1*r');
define('NONCE_KEY', '~S|I{k`h#=khE[CDwgQcK[f9+3i^c(7g6d}KBF&>I{((QchVbK ,Zy-<<clFc,zN');
define('AUTH_SALT', '^{Q[m^`wvU^ite9JQ0bIj=x|TE J&F{)N8:;T8bUn*1$>Del0cP6.r}cIz`m.g`y');
define('SECURE_AUTH_SALT', 'VVRJ~k[Ax<mUAb0)W}|-tmP^[#AYoYta7prT.!9d6kmuAE}I>uH<xXy5<t#e40:B');
define('LOGGED_IN_SALT', 'c@[oVX3,X97%vhlBIQ`f#4zRH,~jZAGa6|$4y_010t?_G`:D-{>}C?j*&r$;]1L=');
define('NONCE_SALT', 'MX$i,:e0XX*n]W{s*Krx|laE@wmIH@8[t[tRTz ?;GLen@Nb2kbUDh0h])cs+WBJ');

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

