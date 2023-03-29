<?php

use Lib\Foxy\Database\Schema\Blueprint;
use Lib\Foxy\Facades\Schema;

return new class
{
    public function up()
    {
        Schema::create("employers", function (Blueprint $table) {
            $table->id();
            $table->string("position");
            $table->foreign("user_id", "users");
        });
    }

    public function down()
    {
        Schema::dropIfExists("employers");
    }
};
