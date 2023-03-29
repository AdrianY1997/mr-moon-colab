<?php

use Lib\Foxy\Database\Schema\Blueprint;
use Lib\Foxy\Facades\Schema;

return new class
{
    public function up()
    {
        Schema::create("bills", function (Blueprint $table) {
            $table->id();
            $table->string("serial")->unique();
            $table->string("date");
            $table->string("total");
            $table->integer("user_id")->references("users");
        });
    }

    public function down()
    {
        Schema::dropIfExists("bills");
    }
};
