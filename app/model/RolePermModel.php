<?php

/**
 * @author Jhoan Esteban Garcia Arenas <jegarcia155@misena.edu.co>
 */


namespace Adso\model;

use Adso\libs\Model;

/**
 * Clase RoleAsogModel
 *
 * Esta clase extiende de Model y se utiliza para interactuar con la base de datos
 * en relación con los roles y permisos de usuario.
 *
 * @package Adso\model
 */
class RoleAsogModel extends Model {
    /**
     * @var string $table El nombre de la tabla en la base de datos.
     */
    protected $table = "role_permisson";

    /**
     * Constructor de la clase RoleAsogModel.
     */
    function __construct() {
        // Llama al constructor de la clase padre (Model).
        parent::__construct();
    }

    /**
     * Obtiene datos de la tabla de roles y permisos.
     *
     * Este método establece una conexión a la base de datos, selecciona todos los registros
     * de la tabla especificada y luego cierra la conexión.
     *
     * @return array Un arreglo de datos de roles y permisos.
     */
    function getData() {
        // Establece la conexión a la base de datos.
        $this->connection = $this->db->getConnection();

        // Realiza una consulta select en la tabla definida en $table.
        $data = $this->select($this->table);

        // Cierra la conexión a la base de datos.
        $this->connection = $this->db->closConnection();

        // Devuelve los datos obtenidos.
        return $data;
    }
}
