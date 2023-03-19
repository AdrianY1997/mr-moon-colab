<?php

return new class
{
    protected $tableName = "user_role";

    public function up()
    {
        $tableName = $this->tableName;

        return "CREATE TABLE IF NOT EXISTS $tableName (
            user_id INT,
            role_id INT DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            
            CONSTRAINT FK_UserRole FOREIGN KEY (user_id) REFERENCES users(user_id),
            CONSTRAINT FK_RoleUser FOREIGN KEY (role_id) REFERENCES roles(role_id)
        );";
    }

    public function down()
    {
        $tableName = $this->tableName;

        return "DROP TABLE IF EXISTS $tableName;";
    }
};
