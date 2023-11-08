<?php
// Definición de constantes para la URL y el nombre
define('URL', 'http://localhost/Motta/citas');
define('NAME', 'ADSO');

// Definición de claves para encriptación
define('KEY', 'mimamamemima');
/* la master es la llave que encripta */
define('MASTER', 'llaveparacodific');

// Definición de detalles de la base de datos
define('HOST', 'localhost');
define('DB', 'sena_login');
define('USER', 'root');
define('PASSWORD', '');
define('CHARSET', 'utf8mb4');

// Definición de roles como un array asociativo
define('ROLES', [
    'admin' => 1,
    'user' => 2
]);
?>
