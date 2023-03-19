<?php

return new class
{
    public function up()
    {
        $name = constant('DBNAME');

        return "USE $name;";
    }
};
