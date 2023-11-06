<?php

/** Esta línea establece el espacio de nombres actual para el archivo de código */
namespace Adso\controllers;


/** Esta línea importa la clase "controller" del espacio de nombres "Adso\Libs" */
use Adso\Libs\Controller;
/** Esta línea importa la clase "Permisson" del espacio de nombres "Adso\libs" */
use Adso\libs\Permisson;


/** Se define una clase llamada "AdminController" que hereda de la clase "Controller" 
 * 
 *  Este controlador maneja las acciones relacionadas con el administrador de la pagina
*/
class AdminController extends Controller
{

    /** 
     * Constructor de la clase AdminController, este es el metoddo que primero se ejecuta de la clase.
     * 
     * En este caso, el constructor está vacío, lo que significa que no realiza 
     * ninguna acción específica.
     *
    */
    function __construct()
    {
    }

    /**
     * Se define un método llamado "index", que es una acción que se puede invocar en el controlador.
     * 
     * Esta metodo lo que hace es preparar los datos y renderiza la vista "admin", 
     * Se crea un arreglo asociativo llamado "$data" que contiene información que se pasará a la vista que se renderizará.
     * 
     * @return void
     * 
    */


    function index()
    {

        $data = [
            "titulo"    => "Home",
            "subtitulo" => "Saludo del sistema",
            "menu"      => true
        ];

        /** Se llama al método "view" en la instancia actual para renderizar una vista*/
        $this->view("admin", $data, 'app');
    }
}

