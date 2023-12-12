<?php

namespace Adso\libs;

use Adso\controllers\RolesController;
use Adso\model\RoleModel;

/** 
 * Clase Session
 * Esta clase gestiona la session del usuario 
 * @package Adso\libs;
 */

class Session
{

  /** 
   * @var bool $login 
   * Esta variable indica el estado de inicio de sesion es decir es true si el usuario esta autenticado
   * y false si no lo está.
   */

  private $login = false;

  /** @var array $user Datos del usuario autenticado.
   */

  private $user;


  /** 
   * Constructor de la clase Session
   * 
   * Esta funcion inicia la sesion y verifica si el usuario esta autenticado.
   * 
   * Llama a la función para iniciar o reanudar la sesión actual. Luego comprueba si existe una clave 'user',
   * si existe se asigna el valor 'user' al objeto user, que quiere decir que el usuario está autenticado. Luego el objeto login se establece en true para indicar que el usuario está autenticado.
   * 
   * Del caso contrario que no exista la clave en la variable session, elimina el objeto user en caso de que existiera y establece al objeto login
   * en false para indicar que el usuario no está autenticado. 
   * 
   *  @access public 
   */

  function __construct()
  {
    session_start();
    if (isset($_SESSION['user'])) {
      $this->user = $_SESSION['user'];
      $this->login = true;
    } else {
      unset($this->user);
      $this->login = false;
    }
  }


  /**
   * Iniciar sesion de usuario
   * 
   * Este metodo se usa para iniciar la sesion de un usuario.
   *  
   * El metodo verifica si el parametro $user contiene datos definidos, si este es válido le asigna su valor al objeto para representar al usuario autenticado. 
   * Luego almacena el valor del parámetro en la variable de session con la clave 'user', que indica que el usuario esta autenticado.
   * Y por ultimo establece al objeto login en true para indicar que el usuario ha iniciado sesión con éxito.
   * 
   *  @param mixed $user Datos del usuario que se va a autenticar.
   *  @return void
   */

  function loginStar($user)
  {
        
    if ($user) {
      $this->user = $_SESSION['user'] = $user;
      $this->login = true;
    }
  }

  /**
   * Cerrar sesión de usuario.
   * 
   * Este método se utiliza para cerrar la sesión de un usuario.
   *
   * El método se encarga de eliminar la clave de la variable sesión, lo que indica que el usuario ha cerrado sesión.
   * Tambien elimina el objeto, en caso de que existiera, para limpiar los datos del usuario autenticado.
   * Y establece el objeto login en false para indicar que el usuario ha cerrado sesión con éxito.
   * 
   * @return void
   */

  function loginDestroy()
  {
    unset($_SESSION['user']);
    unset($this->user);
    $this->login = false;
  }

  /** 
   * Obtiene el estado del inicio de sesion.
   *   
   * @return bool Estado de inicio de sesión devuelve true si el usuario está autenticado y false si no lo está.
   */

  function getLogin()
  {
    return $this->login;
  }


  /**
   * Obtiene los datos del usuario autenticado.
   * 
   *  @return mixed Datos del usuario autenticado
   * 
   */

  function getUser()
  {
    return $this->user;
  }



  function sesion()
  {
    if (!$this->login) {
      header("Location: " . URL . "/login");
      exit();
    }
  }
}
  }
}