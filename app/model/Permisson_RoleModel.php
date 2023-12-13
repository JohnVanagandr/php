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
     
      if ($indice == 0) {
        $data = $this->deleteCheckout($this->tabla, $valores, $params);
        $indice++;
      }
      $data = $this->insert($this->tabla, $valores);

      print_r($indice);
    }

    $this->connection = $this->db->closConnection();
  }

  /**
 * Obtiene los permisos asociados a un determinado rol.
 *
 * Este método busca y devuelve los permisos relacionados con el ID del rol proporcionado.
 *
 * @param int $id_role El ID del rol para el cual se desean obtener los permisos.
 * @return array Los datos de los permisos asociados al rol.
 */
function selectPermits($id_role)
{
    // Establece la conexión a la base de datos
    $this->connection = $this->db->getConnection();

    // Obtiene los datos de los permisos por ID de rol
    $data = $this->getRowsById($this->tabla, $id_role);

    // Cierra la conexión a la base de datos
    $this->connection = $this->db->closConnection();

    return $data; // Retorna los datos de los permisos asociados al rol
}

}
