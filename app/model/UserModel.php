<?php

namespace Adso\model;

use Adso\libs\Database;
use Adso\libs\Model;

class UserModel extends Model
{
    /**
     * Constructor de la clase UserModel.
     *
     * En el constructor, se establece la conexión a la base de datos llamando al constructor de la clase padre Model.
     *
     * @access public
     * @return void
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Es el metodo para obener todos los usuarios
     * 
     * Obtiene todos los usuarios de la base de datos por medio de la consulta SELECT * FROM users
     * despues en $stm obtenemos la conexion a la base de datos y preparamos dicha consulta para luego ejecutarla
     *
     * @access public
     * @return array|false Retorna un array con los datos de los usuarios o false si ocurre un error.
     */

    function getUsers()
    {
        $sql = "SELECT * FROM users";
        $stm = $this->connection->prepare($sql);
        $stm->execute();
        return $stm->fetchAll();
    }

    /**
     * getEmail es el metodo para obtener el correo electronico del usuario
     * 
     * Obtiene el correo mediante la consulta SELECT email FROM users  en donde pone la condicion que se 
     * lleve a cabo si el email que esta en la columna es igual al correo que obtenemos como parametro que es 
     * el que ingresan en la vista WHERE email = :correo"  , el correo que ingresan en la vista se pasa en bindvalue
     * para luego ejecutar dicha consulta
     *
     * @access public
     * @param string $correo El correo electrónico del usuario.
     * @return mixed|false Retorna el correo electrónico del usuario o false si no se encuentra.
     */
    function getEmail($correo)
    {
        $sql = "SELECT email FROM users WHERE email = :correo";
        $stm = $this->connection->prepare($sql);
        $stm->bindValue(":correo", $correo);
        $stm->execute();
        return $stm->fetch();
    }

    /**
     * Obtiene el nombre del Usuario siempre y cuando si coincide con el nombre que ingresan
     * 
     * Por medio de Select obtenemos el nombre de usuario con la condicion que si el nombre que llega por parametro
     * es igual al que se encuentra en la tabla, dicho parametro que se pasa es el que el usuario ingresa en la vista 
     * y se pasa por medio de bindValue para que de esta manera evitar las inyecciones sql 
     *
     * @access public
     * @param string $usuario El nombre de usuario del usuario.
     * @return mixed|false Retorna el nombre de usuario del usuario o false si no se encuentra.
     */
    function getUsuario($usuario)
    {
        $sql = "SELECT user_name FROM users WHERE BINARY user_name = :user";
        $stm = $this->connection->prepare($sql);
        $stm->bindValue(":user", $usuario);
        $stm->execute();
        return $stm->fetch();
    }

    /**
     * Actualiza la contraseña de un usuario.
     * 
     * Para poder actualizar la contraseña recibimos como parametro el id del usuario y su respectiva contraseña 
     * luego se utiliza para hash_hmac para encriptarla con el metodo sha512, contraseña, key que es la llave , se utiliza para que este proceso se lleve acabo 
     * luego si el id del usuario coincide con el usuario de la base de datos permitimos la actualizacion de contraseña
     *
     * @access public
     * @param int $id El ID del usuario.
     * @param string $password La nueva contraseña del usuario.
     * @return bool Retorna true si la actualización es exitosa, de lo contrario, false.
     */
    function updatePassword($id, $password)
    {
        $password = hash_hmac("sha512", $password, KEY);
        $password = substr($password, 0, 50);
        $connection = $this->db->getConnection();
        $sql = "UPDATE users SET password = :clave WHERE id_user = :id";
        $stm = $connection->prepare($sql);
        $stm->bindValue(":clave", $password);
        $stm->bindValue(":id", $id);
        return $stm->execute();
    }

    /**
     * Valida las credenciales de un usuario.
     * 
     * valida las credenciales que es como tal para que el usuario se pueda loguear , pasamos la contraseña enciprtada y se desencripta la contraseña recibida pasando 
     * como primer parametro la contraseña recibida desde la vista como segundo el indice osea de donde va a comenzar y 50 , son la cantidad 
     * de caracteres en la cual va a encriptarla , luego realizamos la consulta con SELECT * con la condicion que el correo y contraseña sean iguales a la de las base de datos 
     * dicho correo y contraseña se compran con los que ingresamos con los bindvalue para de esta manera la consulta sea segura 
     * 
     * @access public
     * @param string $user El correo electrónico del usuario.
     * @param string $password La contraseña del usuario.
     * @return mixed|false Retorna los datos del usuario si la validación es exitosa, de lo contrario, false.
     */
    function validate($user, $password)
    {
        $password = hash_hmac("sha512", $password, KEY);
        $password = substr($password, 0, 50);
        $connection = $this->db->getConnection();
        $sql = "SELECT * FROM users WHERE user_name = :username AND password = :clave";
        $stm = $connection->prepare($sql);
        $stm->bindValue(":clave", $password);
        $stm->bindValue(":username", $user);
        $stm->execute();
        // return $stm->fetch();
        return $stm->fetch();
    }
    

    /**
     * Comprueba si un usuario tiene un token de autenticación.
     * 
     * Como cada usuario contiene un token de auntenticacion , se verifica pasandole como paramertro el id del usuario , realizando el mismo proceso
     * para luego realizar la conexion a la base de datos y preparando dicha consulta y ejecutandola . al final retornamos el fetch  para obtener los resultados 
     * si el proceso se lleva acabo y si no retornaria falso
     *
     * @access public
     * @param int $id_user El ID del usuario.
     * @return mixed|false Retorna el token del usuario si existe, de lo contrario, false.
     */
    public function chekear($id_user)
    {
        $sql = "SELECT token FROM users WHERE id_user = :id_user";
        $stm = $this->connection->prepare($sql);
        $stm->bindValue(':id_user', $id_user);
        $stm->execute();
        $result = $stm->fetch();
        return $result;
    }

    /**
     * Actualiza el token de un usuario con la fecha y hora actuales.
     * 
     * Cuando un usuario actualiza la contraseña el token se registra con la hora y fecha de cambio de dicha 
     * para de esta manera manejar el registro de la actualizacion comparando como condicion el id_usuario
     *
     * @access public
     * @param int $id_user El ID del usuario.
     * @return void
     */
    function createtime($id_user)
    {
        $sql = "UPDATE users SET token = NOW() WHERE id_user = :id_user";
        $stm = $this->connection->prepare($sql);
        $stm->bindValue(':id_user', $id_user);
        $stm->execute();
    }

    /**
     * Establece la contraseña de un usuario como nula (NULL).
     *
     * @access public
     * @param int $id_user El ID del usuario.
     * @return void
     */
    function backnull($id_user)
    {
        $sql = "UPDATE users SET passwordtime = NULL WHERE id_user = :id_user";
        $stm = $this->connection->prepare($sql);
        $stm->bindValue(':id_user', $id_user);
        $stm->execute();
    }

    /**
     * Valida si un correo electrónico ya está en uso por un usuario.
     * 
     * Se hace uso de este metodo para verificar en el momento de registrarse de cada usuario tenga un unico 
     * correo ya que si dicho correo ya se encuentra en la base de datos no se lo permita ingresar a la pagina
     *
     * @access public
     * @param string $email El correo electrónico a validar.
     * @return mixed|false Retorna los datos del usuario si el correo está en uso, de lo contrario, false.
     */
    function validateEmail($email)
    {
        $sql = "SELECT id_user, email FROM users WHERE email = :correo";
        $connection = $this->db->getConnection();
        $stm = $connection->prepare($sql);
        $stm->bindValue(":correo", $email);
        $stm->execute();
        return $stm->fetch();
    }

    /**
     * Almacena los datos de un usuario en la base de datos.
     * 
     * recibe como parametros los valores y las columnas, en donde las columnas hacen referencia a los nombres de las columnas a la base de datos
     * y los valores son lo que se va a registrar en la base de datos  donde preguntamos que si de registro llega las columnas con valore se realice la conexion a la 
     * base de datos y registre en la tabla usuarios los valores que quieren registrar por medio de la trasaccion.
     * 
     * 
     *
     * @access public
     * @param array $valores Los valores a insertar en la tabla "users".
     * @param mixed $comm (opcional) Si se proporciona, se utilizará como conexión en lugar de la conexión por defecto.
     * @return mixed|false Retorna el resultado de la inserción o false si ocurre un error.
     */
    function storage($valores, $comm = "")
    {
        if ($comm != "") {
            $this->connection = $comm;
        } else {
            $this->connection = $this->db->getConnection();
        }
        // $this->connection = $this->db->closConnection();
        return $this->insert("users", $valores);
    }
    
}