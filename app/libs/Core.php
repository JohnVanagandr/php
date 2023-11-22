<?php

namespace Adso\libs;

class Core
{
    /** 
    * Esta clase recibe las URL y se encarga de enrutar la solicitud al respectivo método del controlador en el que se va a trabajar.
    *
    * Esta clase se contiene un constructor y un método llamado getUrl que contiene funciones propias de php que permite crear una estructura para recibir y trabajar las URL del proyecto para así mandar al respectivo controlador que la solicitud de la URL quiere.

    * @access protected
    * @param string $controller nombre del controlador 
    * @param string $method nombre del método
    * @param array $parameters parámetros que se van a pasar
    */

    protected $controller = "MainController";
    protected $method = "index";
    protected $parameters = [];

    public function __construct()
    {
        /** 
         * Constructor
         * 
         * Recibe y almacena la URL solicitada, se realiza una primera validación en donde si la URL no está vacía convierte la primera letra de la URL en mayúscula con la función ucwords y si el archivo  existe en el directorío establecido para proceder a actualizar el nombre del controlador y luego usa la función unset para destruir el indice 0 de la url que sería igual al nombre del controlador.
         * 
         * Se crea una variable que tiene nombre completo de la clase con el namespace y el controlador al que se está haciendo referencia.
         * Se instancia el controlador 
         * 
         * La segunda validación mira si la URL tiene un segundo indice, este segundo indice hace referencia al método, dentro de esta validación existe otra que pregunta si el método existe en el controlador para proceder a actualizar el nombre del método y luego usa la función unset para destruir el indice 1 de la url.
         * Finalmente almacenará los demás elementos que están despúes del controlador y el método y los almacenará como parámetros para luego actualizar el método con los parámetros.
         * 
         * @access public
         * @param string $url almacena la url 
        */

        $url = Url::getUrl();

        if ($url != "" && file_exists('../app/controllers/' . ucwords($url[0]) . 'Controller.php')) {
            $this->controller = ucwords($url[0])."Controller";
            unset($url[0]);
        }

        $obj = 'Adso\\controllers\\'.$this->controller;
        $this->controller = new  $obj;

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->parameters = $url ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->method], $this->parameters);
    }

}
