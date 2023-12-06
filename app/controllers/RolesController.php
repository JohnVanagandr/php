<?php

namespace Adso\controllers;

use Adso\Libs\controller;
use Adso\libs\Helper;
use Adso\libs\DateHelper;
use Adso\libs\Permisson;

class RolesController extends Controller
{

  protected $model;
  protected $model2;
  protected $model3;
  protected $permission;
  protected $permit;

  const PREFIJO = 'Roles';

  function __construct()
  {

    $this->permission = new Permisson();
    $this->permit = $this->permission->ifpermisson(self::PREFIJO);

    if ($this->permit) {
      $this->model = $this->model("Role");
      $this->model2 = $this->model("Permisson");
      $this->model3 = $this->model("Permisson_Role");
    } else {
      header("Location: " . URL . "/admin/error403");

    }

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

    $this->view('rol/index', $data, 'app'); // Renderizar la vista de lista de roles
  }
  function search()
  {
    $response = array(
      'status' => false,
      'data' => false,
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

      foreach ($data as $key => $value) {
        // Accede al elemento id_permission
        $id_role = $value['id_role'];
        $dateUpdate = DateHelper::shortDate($value['updated_at']);
        $dateCreate = DateHelper::shortDate($value['created_at']);
        // Encripta el id_permission
        $encrypted_id_role = Helper::encrypt($id_role); // Asegúrate de tener una función de encriptación definida

        // Reemplaza el id_permission original con el encriptado en el array
        $data[$key]['created_at'] = $dateCreate;
        $data[$key]['updated_at'] = $dateUpdate;
        $data[$key]['id_role'] = $encrypted_id_role;
      }
      $response["datax"] = $data;
      //$datax['id_role'] = Helper::encrypt($data['id_role']);
      // Verifica si se obtuvo algún dato de la consulta.
      if ($data) {
        // Si se encuentra un resultado, se actualiza el arreglo de respuesta.
        $response["accion"] = "roles";
        $response['filtro'] = $filtros;
        $response['buscar'] = $buscar;
        $response['status'] = 200;
        $response['data'] = true;
      } else {
        // Si no se encuentra un resultado, se actualiza el mensaje de respuesta para indicar que el correo no está registrado.
        $response['status'] = 200;
        $response['message'] = 'Estoy sobrescribiendo el mensaje';
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

    $this->view("rol/update", $data, "app"); // Renderizar la vista de actualización de roles
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

        $this->view("rol/update", $data, "app");
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
    header("Location: " . URL . "/roles");

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

    $this->view("rol/manage", $data, "app");


  }
  /**
   * Este metodo es para asignarle los permisos a cada rol
   * 
   * @access public
   * @return void
   */
  function assing()
  {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $role = $_POST['rol'];
      $permits = $_POST['permisos'];

      $valores = [
        "id_role_fk" => $role,
        "id_permisson_fk" => $permits
      ];
      $this->model3->storage($valores);
      header("Location: " . URL . "/roles");
    }
  }
}