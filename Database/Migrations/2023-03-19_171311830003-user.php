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

        Schema::insert("users", [
            "nick" => "admin",
            "email" => "no.set@mail.com",
            "pass" => password_hash("123456789", PASSWORD_DEFAULT),
            "name" => "Administrador",
            "lastname" => "01",
            "phone" => "000"
        ]);
    }

    public function down()
    {
        Schema::dropIfExists("users");
    }
};
