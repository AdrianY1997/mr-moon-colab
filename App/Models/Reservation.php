<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Database\MySQL;
use FoxyMVC\Lib\Foxy\Database\Table;
use PDOException;

class Reservation extends Table {
    // -- Generated
    protected static string $tableName = "reservations";
    public string $rese_id;
    public string $created_at;
    public string $updated_at;
    protected array $hidden = [
        "rese_id",
        "created_at",
        "updated_at"
    ];
    // ----

    // -- Here the columns

    public string $rese_urid;
    public string $rese_name;
    public string $rese_lastname;
    public string $rese_email;
    public string $rese_quantity;
    public string $rese_table;
    public string $rese_day;
    public string $rese_time;
    public string $rese_status;
    public string $rese_details;
    public string $user_id;

    protected array $fillable = [
        "rese_urid",
        "rese_name",
        "rese_lastname",
        "rese_email",
        "rese_quantity",
        "rese_table",
        "rese_day",
        "rese_time",
        "rese_status",
        "rese_details",
        "user_id",
    ];

    // ----

    public static function getHours($day) {
        $query = "SELECT rese_time, rese_status FROM " . static::$tableName . " WHERE rese_day = ? AND (rese_status = 'RESERVADO' OR rese_status = 'PENDIENTE')";
        try {
            $stmt = MySQL::connect()->prepare($query);
            $stmt->execute([$day]);
            $times = [];
            while ($time = $stmt->fetchObject()) array_push($times, $time);
            $stmt->closeCursor();
            return $times;
        } catch (PDOException $ex) {
            return false;
        }
    }
}
