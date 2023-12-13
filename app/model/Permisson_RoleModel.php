<?php


namespace Adso\model;

use Adso\libs\Model;

class Permisson_RoleModel extends Model
{
  private $tabla = "role_permisson";

  function __construct()
  {
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
    $params = $idRol;

    $indice = 0;
    foreach ($permisos["id_permisson_fk"] as $value) {



      $valores = [
        "id_role_fk" => $idRol,
        "id_permisson_fk" => $value
      ];
      // print_r($permisos["id_permisson_fk"]);
      // die();
      if ($indice == 0) {
        $data = $this->deleteCheckout($this->tabla, $valores, $params);
        $indice++;
      }
      $data = $this->insert($this->tabla, $valores);

      print_r($indice);
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
