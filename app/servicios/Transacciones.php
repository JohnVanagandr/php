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

  // protected $connection;

  function __construct()
  {
    $this->db = new Database();
    // $this->connection   = $this->db->getConnection();
  }

  function model($model = "")
  {
    $model = 'Adso\model\\' . $model . 'Model';
    return new $model();
  }


  public function trsRegistro($valores)
  {


    try {
      $connection = $this->db->getConnection();



      $connection->beginTransaction();

      $id = 0;
      foreach ($valores as $key => $value) {

        $this->model = $this->model($key);

        if ($id != 0) {

          $lastItem = array_key_last($value);

          $value[$lastItem] = $id;

          $id = $this->model->storage($value, $connection);
        } else {

          $id = $this->model->storage($value, $connection);
        }
      }

      $connection->commit();
    } catch (\Exception $ex) {
      $connection->rollBack();
      echo "Fallo: " . $ex->getMessage();
    }
  }
}
