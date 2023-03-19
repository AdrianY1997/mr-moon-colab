<?php

return new class
{
    protected $tableName = "products";

    public function up()
    {
        $tableName = $this->tableName;

        return "CREATE TABLE IF NOT EXISTS $tableName (
            prod_id INT AUTO_INCREMENT,
            prod_ref VARCHAR(255) UNIQUE,
            prod_name VARCHAR(255),
            prod_stock VARCHAR(255),
            prod_value VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (prod_id)
        );";
    }

    public function down()
    {
        $tableName = $this->tableName;

        return "DROP TABLE IF EXISTS $tableName;";
    }
};
