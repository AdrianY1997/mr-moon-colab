<?php

use FoxyMVC\Lib\Foxy\Database\Schema\Blueprint;
use FoxyMVC\Lib\Foxy\Facades\Schema;

return new class
{
    public function up()
    {
        Schema::create("__tableName", function (Blueprint $table) {
            $table->isManyToMany();
            $table->id();
        });
    }

    public function down()
    {
        Schema::dropIfExists("__tableName");
    }
};
