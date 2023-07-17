<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Database\MySQL;
use FoxyMVC\Lib\Foxy\Database\Table;
use PDOException;

class Product extends Table {
    // -- Generated
    protected static string $tableName = "products";
    public string $prod_id;
    public string $created_at;
    public string $updated_at;
    protected array $hidden = [
        "prod_id",
        "created_at",
        "updated_at"
    ];
    // ----

    // -- Here the columns

    public string $prod_ref;
    public string $prod_name;
    public string $prod_desc;
    public string $prod_stock;
    public string $prod_value;

    protected array $fillable = [
        "prod_ref",
        "prod_name",
        "prod_desc",
        "prod_stock",
        "prod_value",
    ];

    // ----

    public static function getAllDataById($id) {
        $query = "
        SELECT pd.prod_ref, pd.prod_name, pd.prod_desc, pd.prod_stock, pd.prod_value, pv.prov_nit, pv.prov_name, pv.prov_email, pv.prov_phone
        FROM products as pd
        JOIN product_provider as pp ON pd.prod_id = pp.prod_id
        JOIN providers as pv ON pv.prov_id = pp.prov_id
        WHERE pd.prod_id = " . $id . "
        ";

        try {
            $stmt = MySQL::connect()->prepare($query);
            $stmt->execute();
            $product = $stmt->fetchObject();
            $stmt->closeCursor();
            return $product;
        } catch (PDOException $ex) {
            return false;
        }
    }
}