<?php

return new class
{
    protected $tableName = "roles";

    public function up()
    {
        $tableName = $this->tableName;

        return "CREATE TABLE IF NOT EXISTS $tableName (
            role_id INT AUTO_INCREMENT,
            
            role_name VARCHAR(255) UNIQUE,
            
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            
            PRIMARY KEY (role_id)
        );
        
        INSERT IGNORE $tableName (role_name) VALUES ('USER');";
    }

    public function down()
    {
        $tableName = $this->tableName;

        return "DROP TABLE IF EXISTS $tableName;";
    }
};
