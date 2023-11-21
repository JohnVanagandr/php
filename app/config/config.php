<?php
define('URL', 'http://localhost/citas');
define('NAME', 'ADSO');
/*la kay es la llave de encriptaacion  */
define('KEY', 'mimamamemima');
/* la master es la llave que encripta */
define('MASTER', 'llaveparacodific');
/* el host ,db, user,password, charset son los parametros que requier la base de datos */
define('HOST', 'localhost');
define('DB', 'sena_login3');
define('USER', 'root');
define('PASSWORD', '');
define('CHARSET', 'utf8mb4');

// Definición de roles como un array asociativo
define('ROLES', [
    'admin' => 1,
    'user' => 2
]);
?>
