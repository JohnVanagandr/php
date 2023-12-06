<?php

namespace Adso\controllers;

use Adso\Libs\controller;
use Adso\libs\Helper;
use Adso\servicios\Transacciones;

/**
 * Clase que representa el controlador para el registro de usuarios.
 */
class RegisterController extends controller
{
  // Propiedades para almacenar instancias de modelos y servicios.
  protected $model;
  protected $servicio;

  /**
   * Constructor de la clase RegisterController.
   * Aquí se inicializan las propiedades.
   */
  function __construct()
  {
    // Inicializa la propiedad $model con una instancia del modelo "User".
    $this->model = $this->model("User");

    // Inicializa la propiedad $servicio con una nueva instancia de la clase "Transacciones".
    $this->servicio = new Transacciones();
  }




  /**
   * Esta función se encarga de mostrar la página de registro.
   *
   * Carga la vista "register" con datos como el título y subtítulo para personalizar la página de registro.
   *
   * @return void No devuelve un valor explícito, pero carga la vista "register" para mostrar la página de registro.
   */
  function index()
  {
    // Define un arreglo de datos que se utilizarán en la vista.
    $data = [
      "titulo" => "Registro",          // Título de la página.
      "subtitulo" => "Formulario de registro" // Subtítulo o descripción de la página.
    ];

    // Carga la vista "register" y pasa los datos y el contexto 'auth'.
    $this->view('register', $data, 'auth');
  }

  /**
   * Esta función maneja la validación de datos para registrar un nuevo usuario en el sistema.
   *
   * Verifica si se ha recibido una solicitud POST y realiza una serie de validaciones en los datos proporcionados.
   * Si los datos son válidos, registra al usuario; de lo contrario, muestra errores en la página de registro.
   *
   * @return void No devuelve un valor explícito, pero registra un nuevo usuario o muestra errores en la página de registro.
   */
  function validate()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Inicializa un arreglo de errores.
      $errores = [];

      // Obtiene los datos del formulario.
      $name = $_POST['first_name'] ?? '';
      $last = $_POST['last_name'] ?? '';
      $email = $_POST['email'] ?? '';
      $user_name = $_POST['user_name'] ?? '';
      $phone = $_POST['phone'] ?? '';
      $pass = $_POST['password'] ?? '';
      $pass2 = $_POST['password_confirm'] ?? '';

      // Validaciones de datos.
      if (trim($name) == "") {
        $errores['name_error'] = "El nombre no está definido";
      } else {
        $nameWithoutSpaces = str_replace(' ', '', $name);
        if (!ctype_alpha($nameWithoutSpaces)) {
          $errores['name_error'] = "Solo se permiten caracteres alfabéticos en el nombre";
        }
      }

      if (trim($last) == "") {
        $errores['last_error'] = "El apellido no está definido";
      } else {
        $nameWithoutSpaces = str_replace(' ', '', $last);
        if (!ctype_alpha($nameWithoutSpaces)) {
          $errores['name_error'] = "Solo se permiten caracteres alfabéticos en el apellido";
        }
      }

      if (trim($user_name) == "") {
        $errores['username_error'] = "El username no está definido";
      } else {
        // Verificar si el username cumple con el patrón permitido
        $pattern = '/^[a-zA-Z0-9._]+$/';

        if (!preg_match($pattern, $user_name)) {
          $errores['username_error'] = "El username solo puede contener letras, nuemros, puntos (.) y guiones bajos (_)";
        }
      }

      if (trim($email) == "") {
        $errores['mail_error'] = "El correo no está definido";
      }

      if (trim($phone) == "") {
        $errores['phone_error'] = "El celular no está definido";
      } else {
        if (!ctype_digit(trim($phone))) {
          $errores['phone_error_string'] = "Solo se permiten datos numéricos";
        } else {
          if (strlen($phone) !== 10 || substr($phone, 0, 1) !== '3') {
            $errores['phone_error_length'] = "El número de celular debe tener 10 dígitos y un formato valido";
          }
        }
      }

      if ($pass == "") {
        $errores['pass_error'] = "La contraseña no está definida";
      } else {
        if (strlen($pass) < 8 || strlen($pass) > 50) {
          $errores['pass_error'] = "La contraseña debe tener entre 8 caracteres";
        } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d@$!%*?&]{8,50}$/', $pass)) {
          $errores['pass_error'] = "La contraseña debe contener al menos una letra mayúscula, una letra minúscula, un número";
        } else {
          if ($pass != $pass2) {
            $errores['verify_error'] = "La contraseña no coincide";
          }
        }

      }


      if (strlen($name) > 50) {
        $errores['name_error'] = "El nombre excede el límite de caracteres";
      }
      if (strlen($last) > 50) {
        $errores['last_error'] = "El apellido excede el límite de caracteres";
      }
      if (strlen($email) > 50) {
        $errores['mail_error'] = "El correo excede el límite de caracteres";
      }
      if (strlen($phone) > 15) {
        $errores['phone_error'] = "El celular excede el límite de caracteres";
      }


      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores['mail_error'] = "El correo no es válido";
      }

      $correoResult = $this->model->getEmail($email);
      if (is_array($correoResult)) {

        $correo = $correoResult['email'];
        if (isset($correo) && $correo == $email) {
          $errores['mail_duplicate'] = "El correo ya existe";
        }
      }

      $userResult = $this->model->getUsuario($user_name);
      if (is_array($userResult)) {
        $user = $userResult['user_name'];

        if (isset($user) && $user === $user_name) {
          $errores['user_duplicate'] = "El usuario ya existe";
        }

        if (empty($errores)) {
          // Si no hay errores, crea un arreglo con los valores del usuario y perfil.
          $valores = [
            "user" => [
              "user_name" => $user_name,
              "email" => strtolower($email),
              "password" => Helper::encrypt2($pass)
            ],
            "profile" => [
              "first_name" => $name,
              "last_name" => $last,
              "phone" => $phone,
              "user_id" => null
            ]
          ];

          // Realiza una transacción de registro a través del servicio.
          $transaccion = $this->servicio->trsRegistro($valores);
          header("Location:" . URL . "/admin");
        } else {
          // Si hay errores, crea un arreglo con los errores y muestra la página de registro nuevamente con los errores.
          $data = [
            "errors" => $errores
          ];
          $this->view("register", $data, "auth");
        }
      }
    }


    /**
     * Esta función maneja solicitudes relacionadas con la validación de direcciones de correo electrónico.
     *
     * Entra en acción cuando se recibe una solicitud HTTP de tipo POST.
     *
     * @return void No devuelve un valor explícito, pero responde con un mensaje JSON al cliente.
     */
    function email()
    {
      // Inicializa un arreglo de respuesta con valores predeterminados.
      $response = array(
        'status' => false,
        'data' => false,
        'message' => 'Está intentando acceder a información privada'
      );

      // Valida que la solicitud sea de tipo POST.
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Obtiene la información enviada en el cuerpo de la solicitud como JSON.
        $request = json_decode(file_get_contents("php://input"));
        // Obtiene el atributo "email" que se envió codificado.
        // Puede haber otros atributos adicionales en la solicitud.
        $email = $request->email;

        // Consulta con el modelo utilizando el correo proporcionado.
        $data = $this->model->getEmail($email);

        // Verifica si se obtuvo algún dato de la consulta.
        if ($data) {
          // Si se encuentra un resultado, se actualiza el arreglo de respuesta.
          $response['status'] = 200;
          $response['data'] = true;
          $response['message'] = 'El correo se encuentra registrado';
        } else {
          // Si no se encuentra un resultado, se actualiza el mensaje de respuesta para indicar que el correo no está registrado.
          $response['status'] = 200;
          $response['message'] = 'Estoy sobrescribiendo el mensaje'; // Puedes personalizar este mensaje.
        }

        // Codifica la respuesta como JSON y establece el código de respuesta HTTP.
        echo json_encode($response, http_response_code($response['status']));
      }
    }

    /**
     * Esta función maneja la validación de un usuario específico.
     *
     * Verifica si se ha recibido una solicitud POST y realiza una consulta en el modelo para verificar la existencia del usuario proporcionado.
     * Luego, devuelve una respuesta en formato JSON que indica si el usuario existe o no.
     *
     * @return void No devuelve un valor explícito, pero responde con una estructura JSON que indica si el usuario existe o no.
     */
    function user()
    {
      $response = array(
        'status' => false,
        'data' => false,
        'message' => 'Está intentando acceder a información privada'
      );

      // Valida que la solicitud sea por método POST.
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $request = json_decode(file_get_contents("php://input"));

        // Obtiene el atributo 'usuario' que se envió codificado.
        // Puede haber llegado otros atributos o múltiples atributos.
        $usuario = $request->usuario;

        // Consulta en el modelo si el usuario existe.
        $data = $this->model->getUsuario($usuario);

        // Verifica si se recibió algún dato de la consulta.
        if ($data) {
          $response['status'] = 200;
          $response['data'] = true;
          $response['message'] = 'El usuario se encuentra registrado';
        } else {
          $response['status'] = 200;
          $response['message'] = 'Estoy sobrescribiendo el mensaje';
        }

        // Codifica la respuesta en formato JSON y establece el código de respuesta HTTP.
        echo json_encode($response, http_response_code($response['status']));
      }
    }
  }
}