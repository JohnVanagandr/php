<?php


namespace Adso\model;

use Adso\libs\Model;

class Permisson_RoleModel extends Model
{
  private $tabla = "role_permisson";

    function __construct() {
        // Llama al constructor de la clase padre (Model).
        parent::__construct();
        
    }
  /**
   * Este metodo guarda los permisos chequeados
   * 
   * @access public
   * @param int $id
   * @return void
   */
  function storage($permisos, $comm = "")
  {

    if ($comm != "") {
      $this->connection = $comm;
    } else {
      $this->connection = $this->db->getConnection();
    }

    $idRol = $permisos["id_role_fk"];

    foreach ($permisos["id_permisson_fk"] as $value) {
      $valores = [
        "id_role_fk" => $idRol,
        "id_permisson_fk" => $value
      ];
      $data = $this->insert($this->tabla, $valores);
    }
    $this->connection = $this->db->closConnection();
  }

  function selectPermits($id_role)
  {

    $this->connection = $this->db->getConnection();
    $data = $this->getRowsById($this->tabla, $id_role);
    $this->connection = $this->db->closConnection();

    return $data;
  }
}
