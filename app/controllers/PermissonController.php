<?php

namespace Adso\controllers;

use Adso\libs\Controller;
use Adso\libs\Helper;

class PermissonController extends Controller
{

    protected $model = "";

    function __construct()
    {

        $this->model = $this->model('Permisson');
    }

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

    function create()
    {
        $data = [
            "titulo" => "permisos",
            "subtitulo" => "Crear un permisos",
            "menu" => true
        ];

        $this->view('permisson/create', $data, 'app');
    }

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

    function editar($id)
    {

        $param = $this -> model -> getId(["id_permission" => Helper::decrypt($id)]);
        
        

        $data = [
            "titulo" => "permisos",
            "subtitulo" => "editar un permisos",
            "menu" => true,
            "data" => $param,
            "id" => $id
        ];

        $this->view('permisson/update', $data, 'app');
    }
    function update($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        
            $errores = [];
            $roles = $_POST['per_name'];            

            if($roles == ""){
                $errores["per_error"] = "el rol esta vacio";
            }
            if(strlen( $roles) > 50 ){
                $errores["per_error"] = "el rol supera el limite de caracteres";
            }
            
            if(empty($errores)){

                $valores = [
                    "name_permisson" => $roles,
                    "id_permission" => Helper::decrypt($id)
                ];

                $this -> model -> updatePermisson($valores);


                header("location:".URL."/permisson");

            }else{
                $data = [
                    "titulo" => "Roles",
                    "subtitulo" => "Creacion de roles",
                    "menu" => true,
                    "errors" => $errores
                ];
    
                $this -> view("permisson/update", $data, "app");
            }
        }else{

        }
        
    }
    function delete($id)
    {
                
        $this->model->deletePermisson(["id_permission"=> Helper::decrypt($id)]);
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
