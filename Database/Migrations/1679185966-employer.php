<?php

return new class
{
    protected $tableName = "employers";

    public function up()
    {
        $tableName = $this->tableName;

        return "CREATE TABLE IF NOT EXISTS $tableName (
            empl_id INT AUTO_INCREMENT,
            
            empl_position VARCHAR(255),
            user_id INT,

            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            
            PRIMARY KEY (empl_id),
            CONSTRAINT FK_UserEmpl FOREIGN KEY (user_id) REFERENCES users(user_id)
        );";
    }

    public function down()
    {
        $tableName = $this->tableName;

        return "DROP TABLE IF EXISTS $tableName;";
    }
};
