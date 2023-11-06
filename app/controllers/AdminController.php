<?php

namespace Adso\controllers;

use Adso\Libs\controller;
use Adso\libs\Permisson;

class AdminController extends Controller
{
    /*se hace el metodo constructor que es el primero que se va a ejecutar a la hora de llamar el controlador Admin controler */
    function __construct()
    {

    }
    function index()
    {
        $data = [
            "titulo"    => "Home",
            "subtitulo" => "Saludo del sistema",
            "menu" => true
        ];
        $this->view("admin", $data, 'app');
    }
}
