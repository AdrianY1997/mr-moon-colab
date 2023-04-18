<?php

use Lib\Foxy\Database\Schema\Blueprint;
use Lib\Foxy\Facades\Schema;

return new class
{
    public function up()
    {
        Schema::create("users", function (Blueprint $table) {
            $table->id();
            $table->string("nick")->unique();
            $table->string("email");
            $table->string("pass");
            $table->string("name");
            $table->string("lastname");
            $table->string("phone");
        });
    }

    public function down()
    {
        Schema::dropIfExists("users");
    }
};
