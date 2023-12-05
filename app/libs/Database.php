<?php

namespace Adso\libs;

use PDO;

class Database
{
    
    private $connection;

    /**
     * Constructor de la clase Database.
     * 
     * Crea una instancia de la clase y establece la conexión a la base de datos.
     * Construye la cadena de conexión a la base de datos utilizando constantes definidas.
     * Crea una instancia de PDO y establece la conexión a la base de datos.
     * Establece el conjunto de caracteres a UTF8 para la conexión.
     * 
     * @access public
     * 
     * 
     */
    public function __construct()
    {
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        
        $this->connection = "mysql:host=" . constant('HOST') . "; dbname=" . constant('DB') . "; charset=" . constant('CHARSET');
        $this->connection = new PDO($this->connection, constant('USER'), constant('PASSWORD'), $options);
        $this->connection->exec("SET CHARACTER SET UTF8");
    }

    /**
     * Obtiene la instancia de la conexión a la base de datos.
     *
     * 
     * @return PDO La instancia de la conexión a la base de datos.
     * 
     */
    function getConnection()
    {
        return $this->connection;
    }

    /**
     * Cierra la conexión a la base de datos.
     * 
     * @return void
     */
    function closConnection()
    {
        $this->connection = null;
    }
}
