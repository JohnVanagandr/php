<?php

namespace Adso\controllers;

use Adso\Libs\controller; 

class MainController extends Controller
{
    function __construct()
    {
    }

    function index()
    {
        $data = [
            "titulo"    => "Home",
            "subtitulo" => "Saludo del sistema",
            "menu" => false
        ];
        $this->view("home", $data, 'app');
    }
}
