<?php

/**
 * @author Andres Vargas <afvargas325@misena.edu.co>
 */

namespace Adso\model;

use Adso\libs\Model;


class RoleModel extends Model
{

    /**
     * @access private
     * @var string
     */
    private $tabla = "roles";

    /**
     * Constructor de la clase.
     * 
     * El constructor se utiliza para inicializar la instancia de la clase y puede realizar
     * acciones de inicialización necesarias, como llamar al constructor de la clase padre.
     */
    function __construct()
    {
        parent::__construct(); // Llama al constructor de la clase padre.
    }

    function getPermissonPage($numPagina = 0)
    {
        $this->connection = $this->db->getConnection();
        $table = "permissions";
        $columns = ['id_permission', 'name_permisson', 'created_at', 'updated_at'];
        $data = $this->selectLimit($table, $columns, $numPagina);
        $this->connection = $this->db->closConnection();
        return $data;
    }


    /**
     * Nos retona una array llamada "data" para obtener el Rol
     *
     * En esta funcion establecemos la conexion para acceder a la base de datos 
     * asi podremos acceder y obtener la información de los Roles llamando a la función "select" con el nombre de la tabla del atributo que
     * establecimos anteriormente. Alfinal cerramos la conexión a la base de datos y
     * devolvemos el array que contiene la información de los Roles.
     *
     * @access protected
     * @return array $data
     */
    function getRoles()
    {
        $this->connection = $this->db->getConnection(); //Establecemos la conexion para acceder a la base de datos
        $data = $this->select($this->tabla); //Obtenemos la información de los Roles llamando a la función "select" con el nombre de la tabla.
        $this->connection = $this->db->closConnection(); //Cerramos la conexión a la base de datos.

        return $data; //Devolvemos el array que contiene la información de los Roles.
    }

    /**
     * Almacena datos en la base de datos.
     *
     * Esta función establece una conexión con la base de datos, inserta los datos proporcionados en el parámetro $roles en la tabla correspondiente 
     * y luego cierra la conexión a la base de datos.
     * La usamos
     *
     * @access protected
     * @param array $roles
     */
    function storage($roles)
    {
        $this->connection = $this->db->getConnection(); // Establecemos una conexión con la base de datos.
        $data = $this->insert($this->tabla, $roles);     // Insertamos los datos contenidos en el parámetro $roles en la tabla correspondiente.
        $this->connection = $this->db->closConnection(); // Cerramos la conexión a la base de datos.
    }

    /**
     * Obtiene un Rol de la base de datos basado en su identificador ($id).
     *
     * Esta función establece una conexión con la base de datos, recupera los datos del Rol con el identificador proporcionado 
     * y luego cierra la conexión a la base de datos.
     *
     * @access protected
     * @param array $id
     * @return array $data 
     */

    function getRole($id)
    {
        $this->connection = $this->db->getConnection(); // Establecemos una conexión con la base de datos.
        $data = $this->getDataById($this->tabla, $id); // Recuperamos los datos del Rol con el identificador $id en la tabla correspondiente.
        $this->connection = $this->db->closConnection(); // Cerramos la conexión a la base de datos.
        return $data; // Devolvemos el array que contiene la información del Rol.
    }

    /**
     * Actualiza un Rol en la base de datos con los datos proporcionados.
     *
     * Esta función establece una conexión con la base de datos, actualiza el Rol en la tabla correspondiente con los datos proporcionados en el parámetro $roles y luego cierra la conexión a la base de datos.
     *
     * @access protected 
     * @param array $roles 
     * @return void
     */
    function updateRole($roles)
    {
        $this->connection = $this->db->getConnection(); // Establecemos una conexión con la base de datos.
        $data = $this->update($this->tabla, $roles); // Actualizamos el Rol en la tabla correspondiente con los datos proporcionados en $roles.
        $this->connection = $this->db->closConnection(); // Cerramos la conexión a la base de datos.
    }

    /**
     * Elimina un Rol de la base de datos basado en su identificador ($id).
     *
     * Esta función establece una conexión con la base de datos, elimina el Rol con el identificador
     * proporcionado ($id) en la tabla correspondiente y luego cierra la conexión a la base de datos.
     *
     * @access protected
     * @param array $id
     * @return void
     */
    function deleteRole($id)
    {
        $this->connection = $this->db->getConnection(); // Establecemos una conexión con la base de datos.
        $data = $this->delete($this->tabla, $id); // Eliminamos el Rol con el identificador $id en la tabla correspondiente.
        $this->connection = $this->db->closConnection(); // Cerramos la conexión a la base de datos.
    }
}