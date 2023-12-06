<?php

/**
 * @author Jhoan Esteban Garcia Arenas <jegarcia155@misena.edu.co>
 */

 
namespace Adso\model;

use Adso\libs\Model;

/**
 * Clase ProfileModel
 *
 * Esta clase extiende de Model y se utiliza para gestionar la interacción
 * con la base de datos en relación con los perfiles de usuario.
 *
 * @package Adso\model
 */
class ProfileModel extends Model {
    /**
     * Constructor de la clase ProfileModel.
     */
    function __construct() {
        // Llama al constructor de la clase padre (Model).
        parent::__construct();
    }

    /**
     * Almacena un perfil de usuario en la base de datos.
     *
     * Este método establece una conexión a la base de datos, inserta los valores
     * en la tabla "profiles" y luego cierra la conexión.
     *
     * @param array $valores Un arreglo de valores del perfil de usuario a almacenar.
     * @param mixed $comm (Opcional) Un objeto de conexión personalizado (por defecto, se utiliza la conexión de la base de datos).
     * @return void
     */
    function storage($valores, $comm = "") {
        if ($comm != "") {
            // Usa la conexión personalizada si se proporciona.
            $this->connection = $comm;
        } else {
            // Utiliza la conexión de la base de datos.
            $this->connection = $this->db->getConnection();
        }

        // Inserta los valores en la tabla "profiles".
        $this->insert("profiles", $valores);

        // Cierra la conexión a la base de datos.
        $this->connection = $this->db->closConnection();
    }
}
