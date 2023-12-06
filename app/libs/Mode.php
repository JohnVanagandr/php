<?php

/**
 * Config
 * development
 * production
 * testing
 */

class Mode
{
    /**
     * Constructor de la clase Mode que establece la configuración del entorno de la aplicación.
     *
     * @param string $mode El modo de la aplicación, que puede ser 'development', 'production' o 'testing'.
     */
    function __construct($mode)
    {
        switch ($mode) {
            case 'development':
                // En el modo de desarrollo, se configuran los errores para que se muestren y se registren todos los tipos de errores.
                error_reporting(-1);
                ini_set('display_errors', 1);
                break;
            case 'testing':
            case 'production';
                // En los modos de prueba y producción, se ocultan los errores al usuario y se registran solo ciertos tipos de errores.
                ini_set('display_errors', 0);
                if (version_compare(PHP_VERSION, '5.3', '>=')) {
                    // Si la versión de PHP es 5.3 o superior, se registran ciertos tipos de errores.
                    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
                } else {
                    // Si la versión de PHP es anterior a 5.3, se registran ciertos tipos de errores.
                    error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
                }
                break;
            default:
                // Si se proporciona un modo no válido, se devuelve un error 503 y se muestra un mensaje de error.
                header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
                echo 'El medio ambiente de la apliacación no es correcto.';
                exit(1);
                break;
        }
    }
}