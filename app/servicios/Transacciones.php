<?php

namespace Adso\servicios;

use Adso\libs\Database;
use Adso\model\UserModel;
use Adso\model\ProfileModel;

class Transacciones
{
  protected $db;
  protected $model;
  protected $model2;

  function __construct()
  {
    // Instancia de la clase Database para gestionar la conexión a la base de datos
    $this->db = new Database();
  }

  // Método para instanciar un modelo específico
  function model($model = "")
  {
    $model = 'Adso\model\\' . $model . 'Model';
    return new $model();
  }

  // Método para realizar transacciones de registro
  public function trsRegistro($valores)
  {
    try {
      // Obtiene la conexión a la base de datos
      $connection = $this->db->getConnection();
      
      // Inicia la transacción
      $connection->beginTransaction();

      $id = 0;

      // Itera a través de los valores proporcionados para el registro
      foreach ($valores as $key => $value) {

        // Instancia el modelo correspondiente
        $this->model = $this->model($key);

        // Si ya se tiene un ID, actualiza el último elemento del array con ese ID
        if ($id != 0) {
          $lastItem = array_key_last($value);
          $value[$lastItem] = $id;
          $id = $this->model->storage($value, $connection);
        } else {
          // Si no hay un ID, simplemente realiza el almacenamiento
          $id = $this->model->storage($value, $connection);
        }
      }

      // Confirma la transacción si todo fue exitoso
      $connection->commit();
    } catch (\Exception $ex) {
      // Deshace la transacción en caso de error
      $connection->rollBack();
      echo "Fallo: " . $ex->getMessage();
    }
  }
}
