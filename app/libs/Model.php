<?php

namespace Adso\libs;

use Adso\libs\Database;

class Model
{
    protected $db;// Una propiedad protegida llamada $db en una clase
    protected $connection;// Otra propiedad protegida $connection en otra clase 

  /**
   * Constructor de la clase Model que inicializa la conexión a la base de datos.
   **/
  function __construct()
  {
    // Crear una nueva instancia de la clase Database
    $this->db = new Database();
    // $this->connection = $this->db->getConnection();
    
  }
  /**
   * Método para insertar registros en la base de datos.
   *
   * @param string $tabla El nombre de la tabla en la que se insertarán los datos.
   * @param array $columnas Un array asociativo de columnas y valores a insertar.
   *
   * @return mixed Retorna el ID del registro insertado si es exitoso, o un mensaje de error en caso contrario.
   **/
  public function insert($tabla = "", $columnas = [])
  {
    // Crear cadenas vacías para las columnas y los parámetros
    $columns = "";
    $params = "";

        // Recorrer el array asociativo de columnas y valores
        foreach ($columnas as $key => $value) {
            // Agregar el nombre de la columna a la cadena de columnas
            $columns .= $key . ",";

            // Agregar el marcador de parámetro a la cadena de parámetros
            $params .= ":" . $key . ",";
        }

        // Eliminar la última coma de las cadenas de columnas y parámetros
        $columns = rtrim($columns, ',');
        $params = rtrim($params, ',');


        if($tabla =="permissions"){

            // Consulta para verificar si el slug ya existe
            $sqlSlugCheck = "SELECT COUNT(*) FROM $tabla WHERE slug = :slug";
            $stmSlugCheck = $this->connection->prepare($sqlSlugCheck);
            $stmSlugCheck->bindValue(":slug", $columnas['slug']);
            $stmSlugCheck->execute();

            // Verificar si el slug ya existe
            if ($stmSlugCheck->fetchColumn() > 0) {
                return "El slug ya existe en la base de datos.";
            }

            // Construir la consulta SQL de inserción utilizando las cadenas formadas
            $sqlInsert = "INSERT INTO $tabla ($columns) VALUES ($params)";

            // Preparar la consulta SQL de inserción
            $stmInsert = $this->connection->prepare($sqlInsert);

            // Asignar valores a los parámetros utilizando enlaces de parámetros
            foreach ($columnas as $key => $value) {
                $stmInsert->bindValue(":" . $key, $value);
            }

            // Ejecutar la consulta preparada y retornar el resultado
            if ($stmInsert->execute()) {
                return $this->connection->lastInsertId();
            } else {
                return $this->connection->errorInfo();
            }


        }else{
  
          // Construir la consulta SQL de inserción utilizando las cadenas formadas
          $sql = "INSERT INTO $tabla ($columns) VALUES ($params)";
  
          // Preparar la consulta SQL
          $stm = $this->connection->prepare($sql);
  
          // Asignar valores a los parámetros utilizando enlaces de parámetros
          foreach ($columnas as $key => $value) {
              $stm->bindValue(":" . $key, $value);
          }
  
          /**Ejecutar la consulta preparada y retornarla */ 
          
          if ($stm->execute()) {
             
              return $this->connection->lastInsertId();
             
          } else {
              return $this->connection->errorInfo();
          }
        }

    }

  /**
   * Método para seleccionar todos los registros de una tabla en la base de datos.
   *
   * @param string $tabla El nombre de la tabla a seleccionar.
   *
   * @return array Retorna un array de todos los registros seleccionados.
   **/

 public function select($tabla = "")
  {

    $sql = "SELECT * FROM $tabla";

    $stm = $this->connection->prepare($sql);

    $stm->execute();

    return $stm->fetchAll();
  }

  public function selectSearch($tabla, $busqueda, $filtro)
  {

    $sql = "SELECT * FROM $tabla WHERE $filtro LIKE '%$busqueda%' ";
    $stm = $this->connection->prepare($sql);

    // Ejecuta la consulta SQL.
    $stm->execute();
    //return $sql;
    return $stm->fetchAll();
  }

  public function selectLimit($tabla = "", $columnas = [], $numPagina = 0)
  {

    $limit = 12;
    $id = "id_permission";
    
    $pagina = $numPagina != 0 ? $numPagina : 0;
    
    if (!$pagina) {
      $inicio = 0;
      $pagina = 1;
    } else {
      $inicio = ($pagina - 1) * $limit;
    }

    $sLimit = "LIMIT $inicio , $limit";

    /* Consulta de registros filtrados */
    $sql = "SELECT SQL_CALC_FOUND_ROWS " . implode(", ", $columnas) . " FROM $tabla $sLimit";
    $resultado = $this->connection->query($sql);
    $datos = $resultado->fetchAll();

    /* Consulta para total de registro*/
    $sqlTotal = "SELECT count($id) FROM $tabla ";
    $resTotal = $this->connection->query($sqlTotal);
    $row_total = $resTotal->fetchAll();
    $totalRegistros = $row_total[0];

    $output = [];
    $output['totalRegistros'] = $totalRegistros["count(id_permission)"];
    $output['totalFiltro'] = count($datos);
    $output['data'] = $datos;
    $output['paginaActual'] = $pagina;
    $output['totalPaginas'] = ceil($output['totalRegistros'] / $limit);

    // echo("<pre>");
    // print_r($output['paginacion']);
    // echo("</pre>");
    // die();
    return $output;
  }

  public function getDataById($tabla = "", $columnas = [])
  {
    $columns = "";
    $params = "";

    // Construye la cláusula WHERE de la consulta SQL en base a las columnas y valores especificados.
    foreach ($columnas as $key => $value) {
        $columns = $key;
        $params = $value;
    }

    // Construye la consulta SQL final.
    $sql = "SELECT * FROM $tabla WHERE $columns = $params";

  /**
   * Método para obtener todos los registros que coincidan con una condición en una tabla de la base de datos.
   *
   * @param string $tabla El nombre de la tabla a consultar.
   * @param array $columnas Un array asociativo que especifica la columna y el valor a buscar.
   *
   * @return array Retorna un array de registros que coinciden con la condición.
   */
  public function getRowById($tabla = "", $columnas = [])
  {
    $columns = "";
    $params = "";
    foreach ($columnas as $key => $value) {
      $columns = $key;
      $params = $value;
    }
    $sql = "SELECT * FROM $tabla WHERE $columns = $params";

        $stm = $this->connection->prepare($sql);
        $stm->execute();

        return $stm->fetchAll();
    }

    public function update($tabla = "", $columnas = [] ){

        $columns = "";

        $clave = array_key_last($columnas);
        $valor = array_pop($columnas);

        foreach ($columnas as $key => $value) {
            // Agregar el nombre de la columna a la cadena de columnas
            $columns .= $key . " = :" . $key . ",";
          
        }

        // Eliminar la última coma de las cadenas de columnas y parámetros
        $columns = rtrim($columns, ',');

        if($tabla =="permissions"){

            // Consulta para verificar si el slug ya existe
            $sqlSlugCheck = "SELECT COUNT(*) FROM $tabla WHERE slug = :slug";
            $stmSlugCheck = $this->connection->prepare($sqlSlugCheck);
            $stmSlugCheck->bindValue(":slug", $columnas['slug']);
            $stmSlugCheck->execute();

            // Verificar si el slug ya existe
            if ($stmSlugCheck->fetchColumn() > 0) {
                return "El slug ya existe en la base de datos.";
            }

            // Construir la consulta SQL de inserción utilizando las cadenas formadas
            $sql = "UPDATE $tabla SET $columns WHERE $clave = $valor";

            // Preparar la consulta SQL
            $stm = $this->connection->prepare($sql);
            // Asignar valores a los parámetros utilizando enlaces de parámetros
            foreach ($columnas as $key => $value) {
                $stm->bindValue(":" . $key, $value);
            }
            // Ejecutar la consulta preparada

            print_r($stm);
            // die();
            
            if ($stm->execute()) {
              
                return $this->connection->lastInsertId();
              
            } else {
                return $this->connection->errorInfo();
            }


        }else{

          // Construir la consulta SQL de inserción utilizando las cadenas formadas
          $sql = "UPDATE $tabla SET $columns WHERE $clave = $valor";

          // Preparar la consulta SQL
          $stm = $this->connection->prepare($sql);
          // Asignar valores a los parámetros utilizando enlaces de parámetros
          foreach ($columnas as $key => $value) {
              $stm->bindValue(":" . $key, $value);
          }
          // Ejecutar la consulta preparada

          print_r($stm);
          // die();
          
          if ($stm->execute()) {
            
              return $this->connection->lastInsertId();
            
          } else {
              return $this->connection->errorInfo();
          }

      }
    }

  function delete($tabla = "", $columnas = [])
  {
    $columns = "";
    $params = "";

    // Construye la cláusula WHERE de la consulta SQL en base a las columnas y valores especificados.
    foreach ($columnas as $key => $value) {
        $columns = $key;
        $params = $value;
    }

    // Construye la consulta SQL final.
    $sql = "DELETE FROM $tabla WHERE $columns = $params";

    // Prepara la consulta SQL.
    $stm = $this->connection->prepare($sql);

    $stm->execute();

    // Esta función devuelve un valor si se obtienen resultados de la consulta.
    // Sin embargo, dado que se trata de una operación de eliminación, es poco común
    // devolver resultados. En su lugar, se podría considerar devolver `true` si la eliminación
    // tiene éxito o lanzar una excepción en caso de error.
    return $stm->fetch();
}

}
