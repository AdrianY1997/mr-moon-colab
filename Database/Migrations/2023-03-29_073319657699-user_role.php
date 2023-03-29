<?php

use Lib\Foxy\Database\Schema\Blueprint;
use Lib\Foxy\Facades\Schema;

return new class
{
    public function up()
    {
        Schema::create("user_role", function (Blueprint $table) {
            $table->integer("user_id")->references("users");
            $table->integer("role_id")->references("roles");
        });
    }

    public function down()
    {
        Schema::dropIfExists("user_role");
    }
};
