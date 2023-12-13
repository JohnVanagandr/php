<?php

namespace Adso\controllers;

use Adso\Libs\controller;
use Adso\libs\Helper;
use Adso\libs\DateHelper;
use Adso\libs\Permisson;
use Adso\servicios\Transacciones;
use Adso\libs\Session;

class RolesController extends Controller
{
  // Propiedades del controlador
  protected $model;
  protected $model2;
  protected $model3;
  protected $servicio;
  protected $permission;
  protected $permit;
  protected $session;

  // Constante para el prefijo de permisos
  const PREFIJO = 'Roles';

  // Constructor del controlador
  function __construct()
  {
    // Instancia de la clase Permisson para gestionar permisos
    $this->permission = new Permisson();
    // Comprueba si el usuario tiene permisos para acceder a las funciones del controlador
    $this->permit = $this->permission->ifpermisson(self::PREFIJO);

    // Si el usuario tiene permisos
    if ($this->permit) {
      // Instancia de los modelos y servicios necesarios
      $this->model = $this->model("Role");
      $this->model2 = $this->model("Permisson");
      $this->model3 = $this->model("Permisson_Role");
      $this->servicio = new Transacciones();
    } else {
      // Si el usuario no tiene permisos, redirige a la página de error 403
      header("Location: " . URL . "/admin/error403");
    }
  }

  // Método para mostrar la lista de roles
  function index()
  {
    // Obtiene la lista de roles desde el modelo
    $roles = $this->model->getRoles();

    // Obtiene los permisos del usuario
    $permisos = $this->permission->permissionbool();

    // Datos para pasar a la vista
    $data = [
      "titulo" => "Roles",
      "subtitulo" => "Lista de roles",
      "menu" => true,
      "roles" => $roles,
      "permisos" => $permisos,
    ];

    // Carga la vista de la lista de roles
    $this->view('rol/index', $data, 'app');
  }

  // Método para realizar una búsqueda (incompleto en el código proporcionado)
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

    $permit = $this->model2->getPermisson();

    $data = [
      "titulo" => "Roles",
      "subtitulo" => "Creación de roles",
      "menu" => true,
      "permisos" => $permit
    ];


    $this->view("rol/create", $data, "app");
  }

  function storage()
  {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      $errores = [];
      $roles = $_POST['rol_name']; // Obtener el nombre del rol desde el formulario
      $permits = isset($_POST['permisos']) ? $_POST['permisos'] : [];

      // $permits = $_POST['permisos'];

      if ($roles == "") {
        $errores["rol_error"] = "El rol esta vacio";
      }
      if (empty($permits)) {
        $errores["rol_error"] = "Debes escoger al menos un permiso";
      }
      if (strlen($roles) > 50) {
        $errores["rol_error"] = "El rol supera el limite de caracteres";
      }

      if (empty($errores)) {

        $valores = [
          "role" => [
            "name_role" => $roles
          ],
          "Permisson_Role" => [
            "id_permisson_fk" => $permits,
            "id_role_fk" => null
          ]
        ];

        // Realiza una transacción de registro a través del servicio.
        print_r("fdgdfg");
        $transaccion = $this->servicio->trsRegistro($valores);

        // $valores = [
        //   "name_role" => $roles
        // ];

        // $this->model->storage($valores); // Almacenar el nuevo rol en la base de datos

        header("Location: " . URL . "/roles");
      } else {

        $permit = $this->model2->getPermisson();

        $data = [
          "titulo" => "Roles",
          "subtitulo" => "Creacion de roles",
          "menu" => true,
          "errors" => $errores,
          "permisos" => $permit
        ];

        $this->view("rol/create", $data, "app");
      }
    } else {
    }
  }

  function editar($id)
  {

    $save = $this->model->getRole(["id_role" => Helper::decrypt($id)]); // Obtener detalles del rol a editar
    $permit = $this->model2->getPermisson();

    $data = [
      "titulo" => "Roles",
      "subtitulo" => "Actualizacion de roles",
      "menu" => true,
      "data" => $save,
      "id" => $id,
      "permisos" => $permit
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
       // Verifica si la solicitud es de tipo POST
       if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
           // Inicializa un array para almacenar errores de validación
           $errores = [];
           // Obtiene el valor del rol desde la solicitud POST
           $roles = $_POST['rol_name'];
   
           // Realiza validaciones en el valor del rol
           if ($roles == "") {
               $errores["rol_error"] = "El rol está vacío";
           }
           if (strlen($roles) > 50) {
               $errores["rol_error"] = "El rol supera el límite de caracteres";
           }
   
           // Si no hay errores de validación
           if (empty($errores)) {
   
               // Prepara un array con los valores a actualizar en la base de datos
               $valores = [
                   "name_role" => $roles,
                   "id_role" => Helper::decrypt($id)
               ];
   
               // Llama al método updateRole del modelo para actualizar el rol en la base de datos
               $this->model->updateRole($valores);
   
               // Redirecciona a la página de roles después de la actualización
               header("location:" . URL . "/roles");
           } else {
               // Si hay errores de validación, prepara datos para la vista
               $data = [
                   "titulo" => "Roles",
                   "subtitulo" => "Creación de roles",
                   "menu" => true,
                   "errors" => $errores
               ];
   
               // Carga la vista de actualización con los datos y errores
               $this->view("rol/update", $data, "app");
           }
       } else {
           // El código aquí no realiza ninguna acción si la solicitud no es de tipo POST
       }
   }
   
   function delete($id)
   {
       // Llama al método deleteRole del modelo para eliminar el rol de la base de datos
       $this->model->deleteRole(["id_role" => Helper::decrypt($id)]);
   
       // Redirecciona a la página de roles después de la eliminación
       header("Location: " . URL . "/roles");
   
       // Prepara datos para la vista (aunque no se usan ya que hay una redirección anterior)
       $data = [
           "titulo" => "Roles",
           "subtitulo" => "Eliminación de roles",
           "menu" => true,
           "id" => $id
       ];
   
       // Realiza otra redirección a la página de roles (se ejecutará solo si no hay un exit anterior)
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
