<?php

namespace Adso\controllers;

use Adso\Libs\controller;
use Adso\libs\Helper;
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

        if($this->permit){
            $this->model = $this->model("Role");
            $this->model2 = $this->model("Permisson");
            $this->model3 = $this->model("Permisson_Role");
        }else{
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
    function assing(){

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

    public function manageid($id) {
        
        $data = [
            "titulo" => "Roles",
            "subtitulo" => "Administración de roles",
            "menu" => true,
            "user_id" => Helper::decrypt($id) // Pasa el ID de usuario a la vista
        ];
        // print_r($data);
            // die();

        $this->view("admin.manage", $data, "app");
    }
    

    public function updateRolUser($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errores = [];
            $RoleId = $_POST['TipoRol'];

            
            $userId = Helper::decrypt($id);
            
            $this->model->updateUserIdRole($userId, $RoleId);
            
            header("location:" . URL . "/admin");
        } else {
            
        }
    }
        
}
