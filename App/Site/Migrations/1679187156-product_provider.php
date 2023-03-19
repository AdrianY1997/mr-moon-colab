<?php

return new class
{
    protected $tableName = "product_provider";

    public function up()
    {
        $tableName = $this->tableName;

        return "CREATE TABLE IF NOT EXISTS $tableName (
            prod_id INT,
            prov_id INT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            
            CONSTRAINT FK_ProdProv FOREIGN KEY (prod_id) REFERENCES products(prod_id),
            CONSTRAINT FK_ProvProd FOREIGN KEY (prov_id) REFERENCES providers(prov_id)
        );";
    }

    public function down()
    {
        $tableName = $this->tableName;

        return "DROP TABLE IF EXISTS $tableName;";
    }
};
