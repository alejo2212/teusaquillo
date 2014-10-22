<?php

namespace mvc\model\table {

  use mvc\interfaces\tableInterface;
  use mvc\model\modelClass;
  use mvc\config\configClass;

  /**
   * Clase general para las tablas el cual define el CRUD
   *
   * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
   */
  class tableBaseClass implements tableInterface {

    protected static $fieldDeleteAt = 'deleted_at';

    /**
     * Método para borrar un registro de una tabla X en la base de datos
     *
     * @param string $table Nombre de la tabla
     * @param array $fieldsAndValues Array con los campos por posiciones
     * asociativas y los valores por valores a tener en cuenta para el borrado.
     * Ejemplo $fieldsAndValues['id'] = 1
     * @param boolean $deletedLogical [optional] Borrado lógico [por defecto] o
     * borrado físico de un registro en una tabla de la base de datos
     * @return boolean
     * @throws \PDOException
     */
    public static function delete($fieldsAndValues, $deletedLogical = true, $table) {
      try {

        if ($deletedLogical === true) {
          $sql = "DELETE FROM $table ";

          $flag = 0;
          foreach ($fieldsAndValues as $field => $value) {
            if ($flag === 0) {
              $sql = $sql . 'WHERE ' . $table . '.' . $field . ' = ' . ((is_numeric($value) === true) ? $value : "'$value' " );
              $flag++;
            } else {
              $sql = $sql . 'AND ' . $table . '.' . $field . ' = ' . ((is_numeric($value) === true) ? $value : "'$value' " );
            }
          }

          modelClass::getInstance()->beginTransaction();
          modelClass::getInstance()->exec($sql);
          modelClass::getInstance()->commit();
        } else {
          $data[$this->fieldDeleteAt] = date(configClass::getFormatTimestamp());
          self::update($fieldsAndValues, $data, $table);
        }

        return true;
      } catch (\PDOException $exc) {
        // en caso de haber un error entonces se devuelve todo y se deja como estaba
        modelClass::getInstance()->rollback();
        throw $exc;
      }
    }

    /**
     * Método para obtener el nombre del campo más la tabla ya sea en formato
     * DB (.) o en formato HTML (_)
     *
     * @param string $field Nombre del campo
     * @param string $table Nombre de la tabla
     * @param string $html [optional] Por defecto traerá el nombre del campo en
     * versión DB
     * @return string
     */
    public static function getNameField($field, $table, $html = false) {
      $separator = ($html === true) ? '_' : '.';
      return $table . $separator . $field;
    }

    /**
     * Nombre de la tabla en la base de datos
     * @return string
     */
    public static function getNameTable() {

    }

    /**
     * Método para insertar en una tabla determinada de la base de datos en uso
     *
     * @param string $table Nombre de la tabla
     * @param array $data Array asociativo donde las claves son los nombres de
     * los campos y su valor sería el valor a insertar. Ejemplo:
     * $data['nombre'] = 'Erika'; $data['apellido'] = 'Galindo';
     * @return \PDOException|boolean
     */
    public static function insert($table, $data) {
      try {

        $sql = "INSERT INTO $table ";

        $line1 = '(';
        $line2 = 'VALUES (';
        foreach ($data as $field => $value) {
          $line1 = $line1 . '"' . $field . '",';
          $line2 = $line2 . ((is_numeric($value) === true) ? $value : "'" . $value . "'") . ', ';
        }

        $newLeng = strlen($line1) - 2;
        $line1 = substr($line1, 0, $newLeng) . ') ';

        $newLeng = strlen($line2) - 2;
        $line2 = substr($line2, 0, $newLeng) . ')';

        $sql = $sql . $line1 . $line2;

        modelClass::getInstance()->beginTransaction();
        modelClass::getInstance()->exec($sql);
        modelClass::getInstance()->commit();

        return true;
      } catch (\PDOException $exc) {
        modelClass::getInstance()->rollback();
        throw $exc;
      }
    }

    /**
     * Método para leer todos los registros de una tabla
     *
     * @param string $table Nombre de la tabla
     * @param array $fields Array con los nombres de los campos a solicitar
     * @param boolean $deletedLogical [optional] Indicación de borrado lógico
     * o borrado físico
     * @param array $orderBy [optional] Array con el o los nombres de los campos
     * por los cuales se ordenará la consulta
     * @param string $order [optional] Forma de ordenar la consulta
     * (por defecto NULL), pude ser ASC o DESC
     * @param integer $limit [optional] Cantidad de resultados a mostrar
     * @param integer $offset [optional] Página solicitadad sobre la cantidad
     * de datos a mostrar
     * @return mixed una instancia de una clase estandar, la cual tendrá como
     * variables publica los nombres de las columnas de la consulta.
     * @throws \PDOException
     */
    public static function getAll($table, $fields, $deletedLogical = true, $orderBy = null, $order = null, $limit = null, $offset = null) {
      try {

        $sql = 'SELECT ';

        foreach ($fields as $field) {
          $sql = $sql . $table . '.' . $field . ', ';
        }

        $newLeng = strlen($sql) - 2;
        $sql = substr($sql, 0, $newLeng);

        $sql = $sql . ' FROM ' . $table;

        if ($deletedLogical === true) {
          $sql = $sql . ' WHERE ' . $table . '.' . self::$fieldDeleteAt . ' IS NULL';
        }

        if ($orderBy !== null) {
          $sql = $sql . ' ORDER BY ';

          foreach ($orderBy as $value) {
            $sql = $sql . $table . '.' . $value . ', ';
          }

          $newLeng = strlen($sql) - 2;
          $sql = substr($sql, 0, $newLeng) . (($order !== null) ? " $order" : '');
        }

        if ($limit !== null) {
          $sql = $sql . ' LIMIT ' . $limit;
        }

        if ($limit !== null and $offset !== null) {
          $sql = $sql . ' LIMIT ' . $limit . ' OFFSET ' . $offset;
        }

        return modelClass::getInstance()->query($sql)->fetchAll(\PDO::FETCH_OBJ);
      } catch (\PDOException $exc) {
        throw $exc;
      }
    }

    /**
     * Método para actualizar un registro en una tabla de una base de datos
     *
     * @param array $ids Array asociativo con las posiciones por nombres de los
     * campos y los valores son quienes serían las llaves a buscar.
     * @param array $data Array asociativo con los datos a modificar,
     * las posiciones por nombres de las columnas con los valores por los nuevos
     * datos a escribir
     * @param string $table Nombre de la tabla a actualizar.
     * @return boolean
     * @throws \PDOException
     */
    public static function update($ids, $data, $table) {
      try {

        $sql = "UPDATE " . $table . " SET ";

        foreach ($data as $key => $value) {
          $sql = $sql . " " . $table . '.' . $key . " = '" . $value . "', ";
        }

        $newLeng = strlen($sql) - 2;
        $sql = substr($sql, 0, $newLeng);

        $flag = 0;
        foreach ($ids as $field => $value) {
          if ($flag === 0) {
            $sql = $sql . 'WHERE ' . $table . '.' . $field . ' = ' . ((is_numeric($value) === true) ? $value : "'$value' " );
          } else {
            $sql = $sql . 'AND ' . $table . '.' . $field . ' = ' . ((is_numeric($value) === true) ? $value : "'$value' " );
          }
          $flag++;
        }

        modelClass::getInstance()->beginTransaction();
        modelClass::getInstance()->exec($sql);
        modelClass::getInstance()->commit();

        return true;
      } catch (\PDOException $exc) {
        modelClass::getInstance()->rollback();
        throw $exc;
      }
    }

  }

}