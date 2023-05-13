<?php

namespace FoxyMVC\Lib\Foxy\Core\Base;

use PDO;
use PDOException;

use FoxyMVC\Lib\Foxy\Database\MySQL;

/**
 * Clase que representa un modelo básico para interactuar con una tabla en una base de datos.
 */
class Model {
    /**
     * @var MySQL Instancia de una clase que representa la conexión a la base de datos.
     */
    private MySQL $db;

    /**
     * @var string Nombre de la tabla en la base de datos.
     */
    private string $name;

    /**
     * Constructor.
     *
     * @param string $name Nombre de la tabla en la base de datos.
     */
    function __construct($name) {
        $this->db = new MySQL();
        $this->name = $name;
    }

    /**
     * Inserta un registro en una tabla de registros en una base de datos.
     *
     * @param array $args Arreglo de valores para insertar en la tabla de registros.
     */
    private function insertLog(array $args): void {
        $stmt = $this->db->connect()->prepare("INSERT INTO logs (logs_table_name, logs_params, logs_action) VALUES (?, ?, ?);");
        $stmt->execute([$this->name, ...$args]);
        $stmt->closeCursor();
    }

    /**
     * Devuelve los nombres de las columnas de una tabla en una base de datos que coinciden con las claves proporcionadas.
     *
     * @param array $keys Arreglo de claves para buscar en los nombres de las columnas.
     * @return array Arreglo con los nombres de las columnas que coinciden con las claves proporcionadas.
     */
    private function getColumnNames($keys): array|bool {
        $table = $this->name;
        $db = $this->db->getDbName();

        // Construir la consulta SQL para seleccionar los nombres de las columnas
        $columnKeys = implode(" OR ", array_map(function ($value) {
            return "COLUMN_NAME LIKE '%$value%'";
        }, $keys));
        $query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$db' AND TABLE_NAME = '$table' AND ($columnKeys)";

        // Ejecutar la consulta y devolver los resultados
        try {
            $stmt = $this->db->connect()->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_COLUMN);
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Inserta un registro en una tabla en una base de datos.
     *
     * @param array $data Arreglo asociativo de valores para insertar en la tabla.
     * @return bool Verdadero si el registro se insertó correctamente, falso en caso contrario.
     */
    public function insert(array $data): bool {
        $table = $this->name;
        $columnNames = $this->getColumnNames(array_keys($data));
        $columns = implode(", ", $columnNames);
        $values = rtrim(str_repeat("?, ", count($data)), ", ");
        $query = "INSERT INTO $table ($columns) VALUES ($values)";

        // Ejecutar la consulta e inserta los datos
        try {
            $stmt = $this->db->connect()->prepare($query);
            $stmt->execute(array_values($data));
            $this->insertLog([json_encode($data), MySQL::LOG_INSERT]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Devuelve registros de una tabla en una base de datos.
     *
     * @param array $keys Arreglo de claves para seleccionar las columnas a devolver.
     * @param array $where Arreglo asociativo opcional de condiciones para filtrar los registros a devolver.
     * @param string $operator Cadena opcional que especifica el operador lógico para combinar las condiciones en $where.
     * @return array|bool Arreglo con los registros seleccionados o falso en caso de error.
     */
    public function get(array $keys, array $where = [], string $operator = "AND"): array|bool {
        $table = $this->name;
        $columnNames = $this->getColumnNames($keys);
        $columns = implode(", ", $columnNames);

        // Construir la cláusula WHERE si se proporcionaron condiciones
        $whereText = "";
        if (!empty($where)) {
            $whereNames = $this->getColumnNames(array_keys($where));
            $conditions = array_map(function ($key) {
                return "$key = ?";
            }, $whereNames);
            $whereText = " WHERE " . implode(" $operator ", $conditions);
        }

        $query = "SELECT $columns FROM $table$whereText";

        // Ejecutar la consulta y devolver los resultados
        try {
            $stmt = $this->db->connect()->prepare($query);
            if (!empty($where)) {
                $stmt->execute(array_values($where));
            } else {
                $stmt->execute();
            }
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Devuelve todos los registros de una tabla en una base de datos.
     *
     * @param array $where Arreglo asociativo opcional de condiciones para filtrar los registros a devolver.
     * @param string $operator Cadena opcional que especifica el operador lógico para combinar las condiciones en $where.
     * @return array|bool Arreglo con los registros seleccionados o falso en caso de error.
     */
    public function getAll(array $where = [], string $operator = "AND"): array|bool {
        $table = $this->name;

        // Construir la cláusula WHERE si se proporcionaron condiciones
        $whereText = "";
        if (!empty($where)) {
            $whereNames = $this->getColumnNames(array_keys($where));
            $conditions = array_map(function ($key) {
                return "$key = ?";
            }, $whereNames);
            $whereText = " WHERE " . implode(" $operator ", $conditions);
        }

        $query = "SELECT * FROM $table$whereText";

        // Ejecutar la consulta y devolver los resultados
        try {
            $stmt = $this->db->connect()->prepare($query);
            if (!empty($where)) {
                $stmt->execute(array_values($where));
            } else {
                $stmt->execute();
            }
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }


    /**
     * Actualiza registros en una tabla en una base de datos.
     *
     * @param array $data Arreglo asociativo de valores para actualizar en la tabla.
     * @param array $where Arreglo asociativo de condiciones para filtrar los registros a actualizar.
     * @param string $operator Cadena opcional que especifica el operador lógico para combinar las condiciones en $where.
     * @return bool Verdadero si los registros se actualizaron correctamente, falso en caso contrario.
     */
    public function update(array $data, array $where, string $operator = "AND"): bool {
        $table = $this->name;
        $columnNames = $this->getColumnNames(array_keys($data));
        $set = implode(", ", array_map(function ($key) {
            return "$key = ?";
        }, $columnNames));

        // Construir la cláusula WHERE
        $whereNames = $this->getColumnNames(array_keys($where));
        $conditions = array_map(function ($key) {
            return "$key = ?";
        }, $whereNames);
        $whereText = " WHERE " . implode(" $operator ", $conditions);

        // Construir y ejecutar la consulta
        $query = "UPDATE $table SET $set$whereText";
        try {
            $stmt = $this->db->connect()->prepare($query);
            $stmt->execute(array_merge(array_values($data), array_values($where)));
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Elimina registros de una tabla en una base de datos.
     *
     * @param array $where Arreglo asociativo de condiciones para filtrar los registros a eliminar.
     * @param string $operator Cadena opcional que especifica el operador lógico para combinar las condiciones en $where.
     * @return bool Verdadero si los registros se eliminaron correctamente, falso en caso contrario.
     */
    public function delete(array $where, string $operator = "AND"): bool {
        $table = $this->name;

        // Construir la cláusula WHERE
        $whereNames = $this->getColumnNames(array_keys($where));
        $conditions = array_map(function ($key) {
            return "$key = ?";
        }, $whereNames);
        $whereText = " WHERE " . implode(" $operator ", $conditions);

        // Construir y ejecutar la consulta
        $query = "DELETE FROM $table$whereText";
        try {
            $stmt = $this->db->connect()->prepare($query);
            $stmt->execute(array_values($where));
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}