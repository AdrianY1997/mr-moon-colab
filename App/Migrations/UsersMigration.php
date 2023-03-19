<?php

use Lib\Foxy\Core\Blueprint;
use Lib\Foxy\Core\Database;
use Lib\Foxy\Core\Schema;

return new class
{
    protected $name = "users";

    public function up()
    {
        return Schema::create(function (Blueprint $table) {
            $table->id($this->name);
            $table->string("name");

            return $table->create();
        });
    }

    public function down()
    {
        (new Database())->drop($this->name);
    }
};
