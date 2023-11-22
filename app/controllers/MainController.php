<?php

/**
 * Namespace y uso de clases para saber donde nos encontramos
 */

namespace Adso\controllers;

use Adso\Libs\Controller; // Importa la clase Controller del espacio de nombres Adso\Libs

/**
 * Clase MainController
 *
 * Esta clase se utiliza para controlar la página de inicio del sistema.
 */

class MainController extends Controller
{

  /**
   * Constructor de la clase
   *
   * El constructor de la clase MainController.
   * No contiene lógica específica en este momento.
   */
  function __construct()
  {
    // Constructor de la clase, no contiene lógica específica
  }
  /**
   * Método para mostrar la página de inicio
   *
   * Este método se encarga de mostrar la página de inicio del sistema.
   * Define un array de datos que se utilizará para la vista.
   *
   * @return void para indicar que la función o método no produce un valor de retorno o, en términos simples, no devuelve ningún resultado.
   *  @access public  
   *  que significa que el elemento que se está documentando es de acceso público.
   */

  function index()
  {
    // Define un array de datos para la vista
    $data = [
      "titulo" => "Home", // Título de la página
      "subtitulo" => "Saludo del sistema", // Subtítulo de la página
      "menu" => false // Indica si se muestra el menú (en este caso, no se muestra)
    ];
    // Carga la vista 'home' con los datos proporcionados y el contexto 'app'
    $this->view("home", $data, 'app');
  }
}
