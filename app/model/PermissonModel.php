<?php

namespace Adso\model;

use Adso\libs\Model;

class PermissonModel extends Model
{
  private $tabla = "permissions";

  function __construct()
  {
    parent::__construct();
  }
  /**
   * Obtiene todos los registros de permisos de la base de datos.
   *
   * @return array|bool Arreglo de registros de permisos o `false` en caso de error.
   */
  function getPermisson()
  {
    $this->connection = $this->db->getConnection();
    $data = $this->select($this->tabla);
    $this->connection = $this->db->closConnection();
    return $data;
  }

  function getPermissonFilter($busqueda, $filtros)
  { // Comentario descriptivo de la función
    $this->connection = $this->db->getConnection(); //Establecemos la conexion para acceder a la base de datos
    $data = $this->selectSearch($this->tabla, $busqueda, $filtros); //Obtenemos la información de los Roles llamando a la función "select" con el nombre de la tabla.

    $this->connection = $this->db->closConnection(); //Cerramos la conexión a la base de datos.

    return $data; //Devolvemos el array que contiene la información de los Roles.
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

  function getId($permisos)
  {
    $this->connection = $this->db->getConnection();
    $data = $this->getDataById($this->tabla, $permisos);
    $this->connection = $this->db->closConnection();
    return $data;
  }

  function storage($permisos)
  {
    $this->connection = $this->db->getConnection();
    $data = $this->insert($this->tabla, $permisos);
    $this->connection = $this->db->closConnection();
  }
  function updatePermisson($permisos)
  {
    $this->connection = $this->db->getConnection();
    $data = $this->update($this->tabla, $permisos);
    $this->connection = $this->db->closConnection();
    return $data;
  }
  function deletePermisson($id)
  {
    $this->connection = $this->db->getConnection();
    $data = $this->delete($this->tabla, $id);
    $this->connection = $this->db->closConnection();
  }
}
