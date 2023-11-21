<?php

/**
 *  ubicacion en donde se encuentra ese archivo 
 */
namespace Adso\controllers;

/**
 *  utilizamos la libreria controller ubicada en la carpeta libs
 */
use Adso\Libs\controller;

/**
 *  Iniciamos la clase UserController
 *  Aqui extendemos la clase controller
 */
class UserController extends Controller
{

/**
 * @var object $model protected que se heredan de esta 
 */
    protected $model;

    /**
     *  Constructor de la clase user model
     */
    function __construct()
    {
        $this->model = $this->model("User");
    }


    /**
     *  Método que muestra una lista de usuarios.
     * 
     *  Aqui en este metodo obtenemos los datos de el modelo y todo lo que se hereda
     *  y lo mostramos sobre la vista correspondiente con los datos de la data
     *
     * @access public
     */
    function index()
    {

        /**
         *  Obtenemos la lista del modelo de users
         */
        $users = $this->model->getUsers();

        /**
         *  Datos que enviamos a la vista
         */
        $data = [
            "titulo"    => "Users",
            "subtitulo" => "Somos MVC",
            'rows'      => $users
        ];

        /**
         *  redirigimos la vista y pasamos los datos de la data
         */
        $this->view("user", $data, 'app');
    }
}
