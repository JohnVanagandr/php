<?php

namespace Adso\controllers;

use Adso\Libs\controller;
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




        // if (!isset($_GET['login'])) {
        //   header("location:" . URL . "/admin");
        // }





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
    $role = $this->model->getRole(["id_role" => Helper::decrypt($id)]);
    $permit = $this->model2->getPermisson();
    $permit_role = $this->model3->selectPermits(["id_role_fk" => $role["id_role"]]);

    $data = [
      "titulo" => "Roles",
      "subtitulo" => "Administrar permisos",
      "menu" => true,
      "rol" => $role,
      "permit" => $permit,
      "permit_role" => $permit_role
    ];

    // foreach ($permit as $value) {
    //     echo "<br>";
    //     echo "<pre>";
    //     print_r($value["id_permission"]);
    //     print_r($value["name_permisson"]);
    //     echo "</pre>";
    // }


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
    }
  }
}
