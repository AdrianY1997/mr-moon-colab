<?php

return new class
{
    protected $tableName = "providers";

    public function up()
    {
        $tableName = $this->tableName;

        return "CREATE TABLE IF NOT EXISTS $tableName (
            prov_id INT AUTO_INCREMENT,
            prov_nit VARCHAR(255) UNIQUE,
            prov_name VARCHAR(255),
            prov_email VARCHAR(255),
            prov_phone VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (prov_id)
        );";
    }

    public function down()
    {
        $tableName = $this->tableName;

        return "DROP TABLE IF EXISTS $tableName;";
    }
};
