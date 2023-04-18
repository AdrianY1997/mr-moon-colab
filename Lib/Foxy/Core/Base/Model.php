<?php

namespace Lib\Foxy\Core\Base;

use Exception;
use Lib\Foxy\Database\MySQL;
use PDOException;

class Model
{
    private $db;
    private $name;

    function __construct($name)
    {
        $this->db = new MySQL();
        $this->name = $name;
    }

    /**
     * Inserta datos en una tabla de la base de datos.
     *
     * @param string $table (opcional) El nombre de la tabla en la que se insertarán los datos. Si no se especifica,
     * se utilizará el nombre de la tabla establecido en la instancia de la clase Model.
     * @param array $data Los datos a insertar en la tabla.
     * @return bool Devuelve true si se insertaron los datos correctamente, o false en caso contrario.
     * @throws Exception Si ocurre algún error durante la ejecución de la consulta.
     */
    public function insert(?string $table, array $data): bool
    {

        if (empty($table))
            $table = $this->name;

        $columns = implode(", ", array_keys($data));
        $values = rtrim(str_repeat("? ", count($data)), ", ");

        try {
            $stmt = $this->db->connect()->prepare("INSERT INTO $table ($columns) VALUES ($values)");
            $stmt->execute(array_values($data));

            // $this->insertLog([
            //     $table,
            //     json_encode($data),
            //     (new DateTime())->format('Y-m-d H:i:s')
            // ]);
            $stmt->closeCursor();
            return true;
        } catch (PDOException $e) {
            throw new Exception("Error al insertar en la tabla $table: " . $e->getMessage());
        }
    }

    /**
     * Realiza una consulta a la base de datos
     * 
     * Si se requieren todos los datos, usar en cambio 
     * 
     * `$model->getAll([columna => valor])`
     * 
     * @param string|array $keys Recibe las columnas que se requieren de la base de datos
     * 
     * Opciones: 
     * 
     * `string`: Unicamente traerá los datos de la columna seleccionada
     * 
     * `array`: Se debe indicar en las columnas requeridas separadas por comas
     * 
     * @param array $data Recibe los datos de búsqueda para la consulta WHERE con `[indice => valor]`
     * 
     * `indice` Nombre de la columna
     * 
     * `valor` El valor que se añadirá en la fila
     * 
     * `Ejemplo`: ["name" => "John Doe", "email" => "johndoe@mail.com"]
     * 
     * @return array|bool Retorna un arreglo con los datos de la consulta o `false` si ocurrió un error
     */
    public function get(array|string $keys, array $data): array|bool
    {
        $items = [];
        $key = "*";
        $where = "";

        if ($keys) {
            $key = "";
            if (is_array($keys)) {
                foreach ($keys as $k) {
                    $key .= $k . ", ";
                }
            } else {
                $key = $keys;
            }
        }

        if ($data) {
            $where = " WHERE ";
            if (is_array($data)) {
                foreach (array_keys($data) as $e) {
                    $where .= $e . "='" . $data[$e] . "' OR ";
                }
            }
        }

        $string = "SELECT " . trim(rtrim($key, ", ")) . " FROM " . $this->name . rtrim($where, 'OR ');
        $query = $this->db->connect()->prepare($string);

        try {
            $query->execute();
            while ($row = $query->fetch()) {
                $item = [];

                foreach (array_keys($row) as $r) {
                    if (!is_int($r)) {
                        $item[$r] = $row[$r];
                    }
                }
                array_push($items, $item);
            }
            $query->closeCursor();
            return $items;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Realiza una consulta a la base de datos si se requieren todos los datos
     * 
     * @param array $data Recibe los datos de búsqueda para la declaración WHERE con `[indice => valor]`
     * 
     * `indice` Nombre de la columna
     * 
     * `valor` El valor que se añadirá en la fila
     * 
     * `Ejemplo`: ["name" => "John Doe", "email" => "johndoe@mail.com"]
     * 
     * @param bool $one recibe un `true` si se requiere solo una fila de datos
     * 
     * @return array|bool Retorna un arreglo con los datos de la consulta o `false` si ocurrió un error
     */
    public function getAll(array $data, bool $one = false): array|bool
    {
        $items = [];
        $string = "";

        if ($data) {
            $string = " WHERE ";
            foreach (array_keys($data) as $e) {
                $string .= $e . "= '" . $data[$e] . "' AND ";
            };
        }

        $string = "SELECT * FROM " . $this->name . rtrim($string, 'AND ');

        var_dump($string);

        $query = $this->db->connect()->prepare($string);
        try {
            $query->execute();
            while ($row = $query->fetch()) {
                $item = [];

                foreach (array_keys($row) as $r) {
                    if (!is_int($r)) {
                        $item[$r] = $row[$r];
                    }
                }
                array_push($items, $item);
            }

            $query->closeCursor();
            return $one ? $items[0] : $items;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Actualiza la base de datos
     * 
     * @param array $keys Recibe los datos de búsqueda para la declaración WHERE con `[indice => valor]`
     * 
     * `indice` Nombre de la columna
     * 
     * `valor` El valor que se añadirá en la fila
     * 
     * `Ejemplo`: ["name" => "John Doe", "email" => "johndoe@mail.com"]
     * 
     * @param array $data Recibe las columnas que se van a actualizar es necesario indicar [`indice => valor`]
     * 
     * `indice` Nombre de la columna
     * 
     * `valor` El valor que se añadirá en la fila
     * 
     * `Ejemplo`: ["name" => "John Doe", "email" => "johndoe@mail.com"]
     * 
     * @return bool Retorna `verdadero` si la actualización se realiza correctamente, en caso contrario retorna `false`
     */
    public function update(array $keys, array $data): bool
    {
        $string = "";

        if ($keys) {
            $where = " WHERE ";
            foreach (array_keys($data) as $e) {
                $where .= $e . "= '" . $data[$e] . "' AND ";
            }
            $where = rtrim($where, ' AND ');
        }

        if ($data) {
            foreach ($data as $key => $val) {
                $string .= $key . " = '" . $val . "', ";
            }
            $string = rtrim($string, ', ');
        }

        $string = "UPDATE " . $this->name . " SET " . $string . $where;

        $query = $this->db->connect()->prepare($string);

        try {
            $query->execute();

            $query->closeCursor();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Elimina datos de la base de datos
     * 
     * @param array $data Recibe los datos de búsqueda para la declaración WHERE con `[indice => valor]`
     * 
     * `indice` Nombre de la columna
     * 
     * `valor` El valor que se añadirá en la fila
     * 
     * `Ejemplo`: ["name" => "John Doe", "email" => "johndoe@mail.com"]
     */
    public function delete($data)
    {
        if ($data) {
            $where = " WHERE ";
            foreach (array_keys($data) as $e) {
                $where .= $e . "= '" . $data[$e] . "' AND ";
            }
            $where = rtrim($where, ' AND ');
        }

        $string = "DELETE FROM " . $this->name . $where;

        $query = $this->db->connect()->prepare($string);

        try {
            $query->execute();

            $query->closeCursor();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function insertLog($args)
    {
        $stmt = $this->db->connect()->prepare("INSERT INTO logs (table_name, params, time) VALUES (?, ?, ?);");
        $stmt->execute($args);
        $stmt->closeCursor();
    }
}
