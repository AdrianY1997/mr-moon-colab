<?php

use Lib\Foxy\Database\Schema\Blueprint;
use Lib\Foxy\Facades\Schema;

return new class
{
    public function up()
    {
        Schema::create("roles", function (Blueprint $table) {
            $table->id();
            $table->string("name");
        });

        Schema::query("INSERT INTO roles (role_name) VALUES ('USER')");
    }

    public function down()
    {
        Schema::dropIfExists("roles");
    }
};
