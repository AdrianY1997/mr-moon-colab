<?php

use FoxyMVC\Lib\Foxy\Facades\Schema;
use FoxyMVC\Lib\Foxy\Database\Schema\Blueprint;

return new class {
    private string $tableName = "users";

    public function up() {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string("nick")->unique();
            $table->string("email");
            $table->string("pass");
            $table->string("name");
            $table->string("lastname");
            $table->string("phone");
        });

        Schema::insert($this->tableName, [
            "nick" => "admin",
            "email" => "admin@mail.com",
            "pass" => password_hash("Password@2023;", PASSWORD_DEFAULT),
            "name" => "Administrador",
            "lastname" => "01"
        ]);
    }

    public function down() {
        Schema::dropIfExists($this->tableName);
    }
};
