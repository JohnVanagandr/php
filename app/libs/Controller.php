<<<<<<< HEAD
<?php
/**
 * Espacio de nombres: Adso\libs
 *
 * Este espacio de nombres se utiliza para agrupar clases relacionadas con la lógica
 * y utilidades del sistema.
 */
namespace Adso\libs;

/**
 * Clase Controller
 *
 * La clase Controller proporciona métodos comunes utilizados en el controlador de la aplicación.
 */
class Controller
{
    /**
     * Constructor de la clase Controller.
     * @access public      
     * realiza una funcion publica del modelo
     * El constructor de la clase no contiene lógica específica en este momento.
     */
    function __construct()
    {

    }
    /**
     * Cargar un modelo desde la carpeta Models.
     *
     * Este método se utiliza para cargar un modelo desde la carpeta Models del sistema.
     *
     * @param string $model El nombre del modelo que se desea cargar.
     * @access public  
     * realiza una funcion publica del modelo
     * @return object Instancia del modelo especificado.
     */
    public function model($model = "")
    {
        // Construye el nombre completo del modelo
        $model = 'Adso\model\\' . $model . 'Model';
        // Crea una nueva instancia del modelo y la retorna
        return new $model();
    }

    /**
     * se carga una vista desde la carpeta Views.
     *
     * Este método se utiliza para cargar una vista desde la carpeta Views.
     *  permite definir datos y un diseño (layout) para la vista.
     *
     * @param string $view   El nombre de la vista que se desea cargar.
     * @param array  $data   Datos que se pasan a la vista.
     * @param string $layout El diseño (layout) que envuelve la vista.
     * @return void para indicar que la función o método no produce un valor de retorno o, en términos simples, no devuelve ningún resultado.
         * @access public  
         * que significa que el elemento que se está documentando es de acceso público.
     */
    
    public function view($view = "", $data = [], $layout = "")
    {
        ob_start();
        // Define el nombre completo de la vista
        $view = $view . '.view';
        if (file_exists("../app/views/" . $view . ".php")) {
            // Si el archivo de vista existe, lo incluye
            require_once("../app/views/" . $view . ".php");
            $contend = ob_get_clean();
            // Captura la salida generada por la vista y almacena en 'contend'
            require_once('../app/views/layout/' . $layout . '.layout.php');
            // Incluye el archivo de diseño (layout) que envuelve la vista
        } else {
            die("La vista " . $view . " no existe");
            // En caso de que la vista no exista, muestra un mensaje de error
        }
    }
}

=======
<?php
/**
 * Espacio de nombres: Adso\libs
 *
 * Este espacio de nombres se utiliza para agrupar clases relacionadas con la lógica
 * y utilidades del sistema.
 */
namespace Adso\libs;

/**
 * Clase Controller
 *
 * La clase Controller proporciona métodos comunes utilizados en el controlador de la aplicación.
 */
class Controller
{
    /**
     * Constructor de la clase Controller.
     * @access public      
     * realiza una funcion publica del modelo
     * El constructor de la clase no contiene lógica específica en este momento.
     */
    function __construct()
    {

    }
    /**
     * Cargar un modelo desde la carpeta Models.
     *
     * Este método se utiliza para cargar un modelo desde la carpeta Models del sistema.
     *
     * @param string $model El nombre del modelo que se desea cargar.
     * @access public  
     * realiza una funcion publica del modelo
     * @return object Instancia del modelo especificado.
     */
    public function model($model = "")
    {
        // Construye el nombre completo del modelo
        $model = 'Adso\model\\' . $model . 'Model';
        // Crea una nueva instancia del modelo y la retorna
        return new $model();
    }



    public function libs($libs = "")
    {
        // Construye el nombre completo del modelo
        $libs = 'Adso\libs\\' . $libs;
        // Crea una nueva instancia del modelo y la retorna
        return new $libs();
    }

    /**
     * se carga una vista desde la carpeta Views.
     *
     * Este método se utiliza para cargar una vista desde la carpeta Views.
     *  permite definir datos y un diseño (layout) para la vista.
     *
     * @param string $view   El nombre de la vista que se desea cargar.
     * @param array  $data   Datos que se pasan a la vista.
     * @param string $layout El diseño (layout) que envuelve la vista.
     * @return void para indicar que la función o método no produce un valor de retorno o, en términos simples, no devuelve ningún resultado.
         * @access public  
         * que significa que el elemento que se está documentando es de acceso público.
     */
    
    public function view($view = "", $data = [], $layout = "")
    {
        ob_start();
        // Define el nombre completo de la vista
        $view = $view . '.view';
        if (file_exists("../app/views/" . $view . ".php")) {
            // Si el archivo de vista existe, lo incluye
            require_once("../app/views/" . $view . ".php");
            $contend = ob_get_clean();
            // Captura la salida generada por la vista y almacena en 'contend'
            require_once('../app/views/layout/' . $layout . '.layout.php');
            // Incluye el archivo de diseño (layout) que envuelve la vista
        } else {
            die("La vista " . $view . " no existe");
            // En caso de que la vista no exista, muestra un mensaje de error
        }
    }
}

>>>>>>> grupo_7
