<?php

return new class
{
    protected $tableName = "users";

    public function up()
    {
        $tableName = $this->tableName;

        return "CREATE TABLE IF NOT EXISTS $tableName (
            user_id INT AUTO_INCREMENT,

            user_nick VARCHAR(255) UNIQUE,
            user_pass VARCHAR(255),
            user_name VARCHAR(255),
            user_lastname VARCHAR(255),
            user_phone VARCHAR(255),
            user_email VARCHAR(255),

            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            
            PRIMARY KEY (user_id)
        );";
    }

    public function down()
    {
        $tableName = $this->tableName;

        return "DROP TABLE IF EXISTS $tableName;";
    }
};
