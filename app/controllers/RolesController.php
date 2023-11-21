<?php

namespace Adso\controllers;

use Adso\libs\controller;
use Adso\libs\Helper;
use Adso\servicios\Transacciones;

class RolesController extends Controller
{

    protected $model;
    protected $model2;
    protected $model3;

  function __construct()
  {
    $this->model = $this->model("Role");
    $this->model2 = $this->model("Permisson");
    $this->model3 = $this->model("Permisson_Role");
  }

  function index()
  {
    $roles = $this->model->getRoles();

        $data = [
            "titulo" => "Roles",
            "subtitulo" => "Lista de roles",
            "menu" => true,
            "roles" => $roles
        ];

    $this->view('rol/index', $data, 'app');
  }
  function search()
  {
    $response = array(
      'status' => false,
      'data' => false,
      'message' => 'Está intentando acceder a información privada'
    );

    // Valida que la solicitud sea de tipo POST.
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Obtiene la información enviada en el cuerpo de la solicitud como JSON.
      $request = json_decode(file_get_contents("php://input"));
      // Obtiene el atributo "email" que se envió codificado.
      // Puede haber otros atributos adicionales en la solicitud.
      $buscar = $request->buscar;
      $filtros = $request->filtros;
      // Consulta con el modelo utilizando el correo proporcionado.
      $data = $this->model->getRolesFilter($buscar, $filtros);

      $response["datax"] = $data;
      // Verifica si se obtuvo algún dato de la consulta.
      if ($data) {
        // Si se encuentra un resultado, se actualiza el arreglo de respuesta.
        $response['filtros'] = $filtros;
        $response['buscar'] = $buscar;
        $response['status'] = 200;
        $response['data'] = true;
        $response['message'] = 'El correo se encuentra registrado';
       } else {
        // Si no se encuentra un resultado, se actualiza el mensaje de respuesta para indicar que el correo no está registrado.
        $response['status'] = 200;
        $response['message'] = 'Estoy sobrescribiendo el mensaje'; // Puedes personalizar este mensaje.
      } 

      // Codifica la respuesta como JSON y establece el código de respuesta HTTP.
      echo json_encode($response, http_response_code($response['status'])); 
     
    }
  }
  /**
   * Método para mostrar el formulario de creación de roles.
   */
  function create()
  {

    $data = [
      "titulo" => "Roles",
      "subtitulo" => "Creacion de roles",
      "menu" => true
    ];

    $this->view("rol/create", $data, "app");
  }

  function storage()
  {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      $errores = [];
      $roles = $_POST['rol_name'];

      if ($roles == "") {
        $errores["rol_error"] = "El rol esta vacio";
      }
      if (strlen($roles) > 50) {
        $errores["rol_error"] = "El rol supera el limite de caracteres";
      }

            if (empty($errores)) {

                $valores = [
                    "name_role" => $roles
                ];

        $this->model->storage($valores);

        header("Location: " . URL . "/roles");
      } else {
        $data = [
          "titulo" => "Roles",
          "subtitulo" => "Creacion de roles",
          "menu" => true,
          "errors" => $errores
        ];

        $this->view("rol/create", $data, "app");
      }
    } else {
    }
  }

  function editar($id)
  {

    $save = $this->model->getRole(["id_role" => Helper::decrypt($id)]);

    $data = [
      "titulo" => "Roles",
      "subtitulo" => "Actualizacion de roles",
      "menu" => true,
      "data" => $save,
      "id" => $id
    ];

    $this->view("rol/update", $data, "app");
  }

  /**
   * Método para procesar el formulario de edición de un rol.
   *
   * @param string $id El ID del rol a editar.
   */

  function update($id)
  {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      $errores = [];
      $roles = $_POST['rol_name'];

      if ($roles == "") {
        $errores["rol_error"] = "El rol esta vacio";
      }
      if (strlen($roles) > 50) {
        $errores["rol_error"] = "El rol supera el limite de caracteres";
      }

      if (empty($errores)) {

        $valores = [
          "name_role" => $roles,
          "id_role" => Helper::decrypt($id)
        ];

        $this->model->updateRole($valores);

        header("location:" . URL . "/roles");
      } else {
        $data = [
          "titulo" => "Roles",
          "subtitulo" => "Creacion de roles",
          "menu" => true,
          "errors" => $errores
        ];

        $this->view("rol/create", $data, "app");
      }
    } else {
    }
  }

  function delete($id)
  {

    $this->model->deleteRole(["id_role" => Helper::decrypt($id)]);
    header("Location: " . URL . "/roles");


    $data = [
      "titulo" => "Roles",
      "subtitulo" => "Eliminación de roles",
      "menu" => true,
      "id" => $id
    ];
  }

  /**
   * Este metodo es para administrar y asignar los permisos a cada rol
   * 
   * @access public
   * @param int $id
   * @return void
   */
  function manage($id)
  {
    //  $this->model = $this->model("Role");
    //   $this->model2 = $this->model("Permisson");
    //   $this->model3 = $this->model("Permisson_Role");
    /*Usa la el metodo getRole de RoleModel que a su vez usa el metodo getRowById 
    de Model que obtiene una fila por id
    */
    $role = $this->model->getRole(["id_role" => Helper::decrypt($id)]);
    /**Usa el metodo getPermisson de PermissonModel que a su vez usa el metodo select de 
     * Model que obtiene todos los datos de una tabla en especifico
     */
    $permit = $this->model2->getPermisson();
    /*Usa el metodo selectPermits de Permisson_RoleModel que a su vez usa el metodo getRowById 
    de Model que obtiene una fila por id
    */
    $permit_role = $this->model3->selectPermits(["id_role_fk" => $role["id_role"]]);

    $data = [
      "titulo" => "Roles",
      "subtitulo" => "Administrar permisos",
      "menu" => true,
      "rol" => $role,
      "permit" => $permit,
      "permit_role" => $permit_role //array
    ];

    $this->view("rol/manage", $data, "app"); // Renderizar la vista de actualización de roles con errores
  }

  /**
   * Este metodo es para asignarle los permisos a cada rol
   * 
   * @access public
   * @return void
   */
  function assing()
  {
    // $this->model = $this->model("Role");
    //   $this->model2 = $this->model("Permisson");
    //   $this->model3 = $this->model("Permisson_Role");
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $role = $_POST['rol'];
      $permits = $_POST['permisos'];
      // print_r($permits);
      // die();
      $valores = [
        "id_role_fk" => $role,
        "id_permisson_fk" => $permits
      ];
      $this->model3->storage($valores);
      header("Location: " . URL . "/roles");
    }
  }
}
