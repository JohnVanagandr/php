<?php

namespace Adso\controllers;

use Adso\libs\Controller;
use Adso\libs\Helper;

/**
 * Clase PermissonController 
 * 
 * El controlador PermissonController maneja todas las acciones relacionadas con los permisos en la pagina. Esto incluye la creación, edición, eliminación y visualización de permisos. Además, se encarga de almacenar nuevos permisos en la base de datos y actualizar permisos existentes.
 */
class PermissonController extends Controller
{

  protected $model = "";

  /**
   * Constructor de PermissonController.
   * 
   * Este método se encarga de inicializar el controlador, estableciendo una instancia del modelo de permisos para su uso posterior.
   */
  function __construct()
  {

    $this->model = $this->model('Permisson');
  }

  /**
   * Acción Index
   *
   * Este método maneja la acción de mostrar la lista de permisos en la página.
   * 
   *Recupera la lista de permisos desde el modelo, prepara los datos necesarios para la vista y luego muestra la vista que presenta los permisos al usuario. Esta acción proporciona una visión general de los permisos disponibles en la aplicación.
   * @access public
   * @return void
   */
  function index()
  {
    $permisos = $this->model->getPermisson();

    $data = [
      "titulo" => "permisos",
      "subtitulo" => "Lista de permisos",
      "menu" => true,
      "permisos" => $permisos
    ];

    $this->view('permisson/index', $data, 'app');
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
      $data = $this->model->getPermissonFilter($buscar, $filtros);
      
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
   * Acción Create
   *
   * Este método maneja la acción de mostrar la vista para crear un nuevo permiso.
   * 
   *  Prepara los datos necesarios para la vista, establece el título y el subtítulo, y luego muestra la vista que permite al usuario crear un nuevo permiso en la aplicación.
   *
   * @access public
   * @return void
   */
  function create()
  {
    $data = [
      "titulo" => "permisos",
      "subtitulo" => "Crear un permisos",
      "menu" => true
    ];

    $this->view('permisson/create', $data, 'app');
  }
  /**
   * Acción Storage
   *
   * Este método maneja el almacenamiento de un nuevo permiso en la base de datos.
   * 
   * Si se recibe una solicitud POST, valida los datos enviados, como el nombre del permiso. Si los datos son válidos, almacena el nuevo permiso en la base de datos y redirige al usuario a la página de permisos. Si hay errores en los datos, muestra la vista de creación nuevamente con los mensajes de error correspondientes.
   *
   * @access public
   * @return void
   */

  function storage()
  {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $errors = array();
      $permiso = $_POST['per_name'];

      if ($permiso == "") {
        $errors['per_error'] = "el campo esta vacio";
      }

      if (strlen($permiso) > 50) {
        $errors['per_error'] = "el permiso supera el limite de caracteres";
      }

      if (empty($errors)) {

        $valores = [
          "name_permisson" => $permiso
        ];

        $this->model->storage($valores);

        header("Location: " . URL . "/permisson");
      } else {
        $data = [
          "titulo" => "permisos",
          "subtitulo" => "Crear un permisos",
          "menu" => true,
          "errors" => $errors
        ];

        $this->view('permisson/create', $data, 'app');
      }
    }
  }
  /**
   * Acción Editar
   *
   * Este método maneja la acción de mostrar la vista de edición de un permiso existente.
   *
   * Recibe un ID de permiso como parámetro, recupera los datos del permiso correspondiente desde el modelo y prepara los datos necesarios para la vista de edición. Luego, muestra la vista que permite al usuario editar el permiso existente.
   * 
   * @param string $id ID del permiso a editar.
   * @access public
   * @return void
   */

  function editar($id)
  {

    $param = $this->model->getId(["id_permission" => Helper::decrypt($id)]);

    $data = [
      "titulo" => "permisos",
      "subtitulo" => "editar un permisos",
      "menu" => true,
      "data" => $param,
      "id" => $id
    ];

    $this->view('permisson/update', $data, 'app');
  }

  /**
   * Acción Update
   *
   * Este método maneja la actualización de un permiso existente en la base de datos.
   * 
   *  Recibe un ID de permiso como parámetro y, si se recibe una solicitud POST, valida los datos enviados, como el nombre del permiso. Si los datos son válidos, actualiza el permiso existente en la base de datos y redirige al usuario a la página de permisos. Si hay errores en los datos, muestra la vista de edición nuevamente con los mensajes de error correspondientes.
   *
   * @param string $id ID del permiso a actualizar.
   * @access public
   * @return void
   */

  function update($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      $errores = [];
      $roles = $_POST['per_name'];

      if ($roles == "") {
        $errores["per_error"] = "el rol esta vacio";
      }
      if (strlen($roles) > 50) {
        $errores["per_error"] = "el rol supera el limite de caracteres";
      }

      if (empty($errores)) {

        $valores = [
          "name_permisson" => $roles,
          "id_permission" => Helper::decrypt($id)
        ];

        $this->model->updatePermisson($valores);


        header("location:" . URL . "/permisson");
      } else {
        $data = [
          "titulo" => "Roles",
          "subtitulo" => "Creacion de roles",
          "menu" => true,
          "errors" => $errores
        ];

        $this->view("permisson/update", $data, "app");
      }
    } else {
    }
  }

  /**
   * Acción Delete
   *
   * Este método maneja la eliminación de un permiso de la base de datos.
   * 
   * Recibe un ID de permiso como parámetro y elimina el permiso correspondiente en la base de datos. Luego, redirige al usuario a la página de permisos, mostrando la lista actualizada de permisos sin el permiso eliminado.
   *
   * @param string $id ID del permiso a eliminar.
   * @access public
   * @return void
   */
  function delete($id)
  {

    $this->model->deletePermisson(["id_permission" => Helper::decrypt($id)]);
    //print_r($id);
    //die($id);
    // $data = [
    //     "titulo" => "permisos",
    //     "subtitulo" => "editar un permisos",
    //     "menu" => true,            
    //     "id" => $id
    // ];
    header("Location: " . URL . "/permisson");


    //$this->view('permisson/update', $data, 'app');
  }
}
