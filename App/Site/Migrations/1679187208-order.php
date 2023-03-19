<?php

return new class
{
    protected $tableName = "orders";

    public function up()
    {
        $tableName = $this->tableName;

        return "CREATE TABLE IF NOT EXISTS $tableName (
            orde_id INT AUTO_INCREMENT,
            orde_quantity VARCHAR(255),
            bill_id INT,
            prod_id INT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            
            CONSTRAINT FK_BillOrder FOREIGN KEY (bill_id) REFERENCES bills(bill_id),
            CONSTRAINT FK_ProdOrder FOREIGN KEY (prod_id) REFERENCES products(prod_id),

            PRIMARY KEY (orde_id)
        );";
    }

    public function down()
    {
        $tableName = $this->tableName;

        return "DROP TABLE IF EXISTS $tableName;";
    }
};
