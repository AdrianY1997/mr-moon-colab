<?php

return new class
{
    protected $tableName = "bills";

    public function up()
    {
        $tableName = $this->tableName;

        return "CREATE TABLE IF NOT EXISTS $tableName (
            bill_id INT AUTO_INCREMENT,
            bill_serial VARCHAR(255) UNIQUE,
            bill_date VARCHAR(255),
            bill_total VARCHAR(255),
            user_id INT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            CONSTRAINT FK_UserBill FOREIGN KEY (user_id) REFERENCES users(user_id),
            PRIMARY KEY (bill_id)
        );";
    }

    public function down()
    {
        $tableName = $this->tableName;

        return "DROP TABLE IF EXISTS $tableName;";
    }
};
