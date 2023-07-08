<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Database\MySQL;
use FoxyMVC\Lib\Foxy\Database\Table;
use PDOException;

class Role extends Table {
    protected static string $tableName = "roles";

    public static function getUserRole($data) {
        $query = "
        SELECT r.role_name FROM " . static::$tableName . " as r, users as u, user_role as ur WHERE r.role_id = ur.role_id && ur.user_id = u.user_id && u.user_id = ?";
        try {
            $stmt = MySQL::connect()->prepare($query);
            $stmt->execute([$data]);
            $roles = [];
            while ($role = $stmt->fetchObject()) array_push($roles, $role);
            $stmt->closeCursor();
            return $roles;
        } catch (PDOException $ex) {
            return false;
        }
    }
}
