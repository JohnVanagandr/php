<?php

/**
 * @author Jhoan Esteban Garcia Arenas <jegarcia155@misena.edu.co>
 */



/**
 * @package Adso/model
 *
 * Este archivo contiene la clase ImagenModel que se utiliza para interactuar
 * con la base de datos en relación con las imágenes.
 */

namespace Adso\model;
use Adso\libs\Model;

/**
 * Clase ImagenModel
 *
 * Esta clase extiende de Model y se utiliza para gestionar la interacción
 * con la base de datos en relación con las imágenes.
 */
class ImagenModel extends Model{
    /**
     * @var string $tabla El nombre de la tabla en la base de datos.
     */
    private $tabla = "imagens";
     /**
     * Constructor de la clase ImagenModel.
     */
    function __construct() {
        // Llama al constructor de la clase padre (Model).
        parent::__construct();
    }
/**
     * Almacena una imagen en la base de datos.
     *
     * Este método establece una conexión a la base de datos, inserta los valores
     * en la tabla especificada y luego cierra la conexión.
     *
     * @param array $valores Un arreglo de valores de imagen a almacenar.
     * @return void
     */
    function storage($valores) {
        // Establece la conexión a la base de datos.
        $this->connection = $this->db->getConnection();

        // Inserta los valores en la tabla especificada (en este caso, $tabla).
        $this->insert($this->tabla, $valores);

        // Cierra la conexión a la base de datos.
        $this->connection = $this->db->closConnection();
    }
}