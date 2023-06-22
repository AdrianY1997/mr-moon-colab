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
            $table->string("address");
            $table->string("phone");
            $table->string("img_path")->default("img/static/profiles/avatar1.png", true);
        });

        Schema::insert($this->tableName, [
            "nick" => "Administrator",
            "email" => "admin@mail.com",
            "pass" => password_hash("Admin@2023;", PASSWORD_DEFAULT),
        ]);

        Schema::insert($this->tableName, [
            "nick" => "Guest",
            "email" => "guest@mail.com",
            "pass" => password_hash("Guest@2023;", PASSWORD_DEFAULT),
        ]);
    }

    public function down() {
        Schema::dropIfExists($this->tableName);
    }
};