<?php

namespace Adso\controllers;

use Adso\Libs\controller;

class UserController extends Controller
{
    protected $model;
    
    function __construct()
    {
        $this->model = $this->model("User");
    }

    
    function index()
    {

        $users = $this->model->getUsers();
        $data = [
            "titulo"    => "Users",
            "subtitulo" => "Somos MVC",
            'rows'      => $users
        ];
                
        $this->view("user", $data, 'app');
    }


}
