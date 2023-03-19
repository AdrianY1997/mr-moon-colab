<?php

return new class
{
    protected $tableName = "reservations";

    public function up()
    {
        $tableName = $this->tableName;

        return "CREATE TABLE IF NOT EXISTS $tableName (
            rese_id INT AUTO_INCREMENT,
            rese_code VARCHAR(255) UNIQUE,
            rese_table VARCHAR(255),
            rese_date VARCHAR(255),
            user_id INT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            
            CONSTRAINT FK_UserRese FOREIGN KEY (user_id) REFERENCES users(user_id),

            PRIMARY KEY (rese_id)
        );";
    }

    public function down()
    {
        $tableName = $this->tableName;

        return "DROP TABLE IF EXISTS $tableName;";
    }
};
