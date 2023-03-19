<?php

return new class
{
    protected $tableName = "product_menu";

    public function up()
    {
        $tableName = $this->tableName;

        return "CREATE TABLE IF NOT EXISTS $tableName (
            prod_id INT,
            menu_id INT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            
            CONSTRAINT FK_ProdMenu FOREIGN KEY (prod_id) REFERENCES products(prod_id),
            CONSTRAINT FK_MenuProd FOREIGN KEY (menu_id) REFERENCES menus(menu_id)
        );";
    }

    public function down()
    {
        $tableName = $this->tableName;

        return "DROP TABLE IF EXISTS $tableName;";
    }
};
