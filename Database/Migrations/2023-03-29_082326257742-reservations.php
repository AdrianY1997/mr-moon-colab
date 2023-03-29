<?php

use Lib\Foxy\Database\Schema\Blueprint;
use Lib\Foxy\Facades\Schema;

return new class
{
    public function up()
    {
        Schema::create("reservations", function (Blueprint $table) {
            $table->id();
            $table->string("code")->unique();
            $table->string("table");
            $table->string("date");
            $table->integer("user_id")->references("users");
        });
    }

    public function down()
    {
        Schema::dropIfExists("reservations");
    }
};
