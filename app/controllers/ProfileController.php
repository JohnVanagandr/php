<?php

namespace Adso\controllers;

use Adso\libs\Controller;
use Adso\libs\Session;
use Adso\model\ImagenModel;
/*
    *class ProfileController
    *
    *sec creaa la clase profileController y se le hereda la clase lib/Controller

*/

class ProfileController extends Controller
{

  protected $model;
  /**
   *function __construct()
   *
   *es el metodo que primero se ejecuta de la clase el cual contiene el enrutado de profile para
   *abrir la coneccion hacia la base de datos
   *la ruta es la siguiente se ejecuta la clase de ProfileController se ejecuta el constructor lo 
   *redirije a libs/controller.php y como le esta pasando un parametro ("Profile"),dentro de
   *libs/controler.php ahce lo siguiente  $model = 'Adso\model\\' . $model . 'Model';
   *return new $model();
   *por lo cual la variable $model viene un dato adentro el cual es ("Profile") teniendo todo esto
   *el redireccionamiento va a terminar en model/ProfileModel.php en el cual es el encargado para
   *hacer la coneccion con la base de datos
   *
   *@access public
   *@return void 
   */
  function __construct()
  {
    $this->model = $this->model("Profile");
  }
  /**
   * funcion index
   * 
   * esta funcion principal mente esta encargada de realisar el en rutado hacia la vista de subida de imagen de 
   * perfil.
   * el !file_exists es una variable propia de php 
   * es la encargada de veridicar si existe la carpeta de ("assets/resourse") 
   * el mkdir se utiliza para crear un nuevo directorio o carpeta en el sistema de archivos. 
   * la variable $data es la en carga de almacenar en un array los parametros que se utilisaran 
   * para hacer el redireccionamiento en las vistas.
   * this-> view es aquel encargado para hacer el redireccionamiento entre las vistas se le pasa la ruta en la 
   * cual se va a dirijir y como previa mente en el $data se le pasaron unos parametros en espesifico ,por lo cual
   * el metodo view  va hacer la validacion que si existe esa vista o no y le pasa los ultimos parametros para poder 
   * redireccionarlo a la vista requerida.
   * 
   *  @access public
   *  @return void
   *  
   */
  function index()
  {
    if (!file_exists("assets/resourse")) {
      mkdir("assets/resourse", 0777, true);
    }
    $data = [
      'Titulo' => 'Perfiles',
      'subtitulos' => 'actualizar perfil',
    ];

    $this->view('profile/update', $data, 'auth');
  }
  /**
   * function update
   * 
   * este metodo es el encargado de la subida de archivos ("imagenes") a la base de datos 
   * la funcion de este metodo es la sigiente primero se hace una validacion en la cual mira si llegan datos
   * por el metodo post
   * se resiven los datos de el archivo ("imagen")que se cargo previa mente
   * $file        = nombre del archivo
   * $url_temp    = es la ruta del archivo
   * $file_size   = es el peso que tiene el archivo
   * $file_type   = es el que le coloca el tipo de la imagen ("png,jpg")
   * se hacen una serie de validaciones en el cual hace que los parametros que se fueron espesificados
   * $url_insert = es el en cargado de darle los paremetros  de la ruta don de se guardan los archivos
   * despues de hacer todas las validaciones  se en vian los datos a la metodo $model -> storage($valores);
   * el hace la coneccion con base de datos y lo redirige al model /insert el cual es el encargado de la 
   * subida de datos  a la base dedatos.
   * header('location:' . URL . '/admin'); se en carga re dirijir a la vista de admin
   * si hay algun error en algo lo redirije a la vista ingresar el archivo y le muestra los errores 
   * 
   *  @access public
   *  @param string $file
   *  @param string $url_temp 
   *  @param int $file_size
   *  @param string $file_type
   *  @param string $url_insert
   *  @return void
   *  
   * 
   */
  function update()
  {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      $errores = [];

      $file = $_FILES["fichero"]["name"];
      $url_temp = $_FILES["fichero"]["tmp_name"];
      $file_size = floor($_FILES["fichero"]["size"] / 1024);
      $file_type = ($_FILES["fichero"]["tmp_name"] != null) ? mime_content_type($_FILES["fichero"]["tmp_name"]) : "";

      if ($file == null) {
        $errores['error_file'] = "por favor seleccione un archivo";
      }

      if ($file_size > 5120) {
        $errores['error_size'] = "el archivo es muy pesado";
      }

      if ($file_type != "image/jpg" && $file_type != "image/jpeg" && $file_type != "image/png") {
        $errores['error_type'] = "el archivo tiene formato no permitido";
      }

      $url_insert = dirname(__FILE__, 3) . "\\public\\assets\\resourse\\";


      if (empty($errores)) {
        chmod($url_insert, 0777);

        if (move_uploaded_file($url_temp, $url_insert . $file)) {

          $sesion = new Session();

          $id_user = $sesion->getUser()['id_user'];

          $valores = ['user_id ' => $id_user];

          $data = $this->model->getProfile($valores);

          $valores = [
            "name" => $file,
            "descripcion" => $url_insert . $file,
            "id_profile_fk" => $data['id_profiles']
          ];

          $model = new ImagenModel();


          $model->storage($valores);

          header('location:' . URL . '/admin');
        } else {
          $errores['error_load'] = "el archivo no pudo se guardado";

          $data = [
            'Titulo' => 'Perfiles',
            'subtitulos' => 'actualizar perfil',
            "errores" => $errores
          ];

          $this->view('profile/update', $data, 'auth');
        }
      } else {
        $data = [
          'Titulo' => 'Perfiles',
          'subtitulos' => 'actualizar perfil',
          "errores" => $errores
        ];

        $this->view('profile/update', $data, 'auth');
      }
    } else {
      $data = [
        'Titulo' => 'Perfiles',
        'subtitulos' => 'actualizar perfil',
      ];

      $this->view('profile/update', $data, 'auth');
    }
  }
}
