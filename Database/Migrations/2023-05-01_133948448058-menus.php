<?php

use FoxyMVC\Lib\Foxy\Facades\Schema;
use FoxyMVC\Lib\Foxy\Database\Schema\Blueprint;

return new class {
    private string $tableName = "menus";

    public function up() {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("path");
        });

        Schema::insert($this->tableName, [
            "name" => "Bebidas",
            "path" => "img/menu/menu-bebidas.jpg",
        ]);

        Schema::insert($this->tableName, [
            "name" => "Principal",
            "path" => "img/menu/menu-principal.jpg",
        ]);

        Schema::insert($this->tableName, [
            "name" => "Comidas",
            "path" => "img/menu/menu-comidas.jpg",
        ]);
    }

    public function down() {
        Schema::dropIfExists($this->tableName);
    }
};
