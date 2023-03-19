<?php

return new class
{
    protected $tableName = "__tableName";

    public function up()
    {
        $tableName = $this->tableName;

        return "CREATE TABLE IF NOT EXISTS $tableName (
            __acronym_id INT AUTO_INCREMENT,
            

            PRIMARY KEY (__acronym_id)
        );";
    }

    public function down()
    {
        $tableName = $this->tableName;

        return "DROP TABLE IF EXISTS $tableName;";
    }
};
