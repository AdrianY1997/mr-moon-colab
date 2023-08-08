<?php

use FoxyMVC\Lib\Foxy\Facades\Schema;
use FoxyMVC\Lib\Foxy\Database\Schema\Blueprint;

return new class {
    private string $tableName = "galerias";

    public function up() {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("path");
        });

        Schema::insert($this->tableName, [
            "name" => "Galeria",
            "path" => "img/gallery/home-event.jpg"
        ]);

        Schema::insert($this->tableName, [
            "name" => "Galeria",
            "path" => "img/gallery/home-drink.jpg"
        ]);

        Schema::insert($this->tableName, [
            "name" => "Galeria",
            "path" => "img/gallery/unnamed (2).png"
        ]);

        Schema::insert($this->tableName, [
            "name" => "Galeria",
            "path" => "img/gallery/home-food.jpg"
        ]);

        Schema::insert($this->tableName, [
            "name" => "Galeria",
            "path" => "img/gallery/unnamed (1).png"
        ]);

        Schema::insert($this->tableName, [
            "name" => "Galeria",
            "path" => "img/gallery/granizado-de-cafe-2.jpg"
        ]);

        Schema::insert($this->tableName, [
            "name" => "Galeria",
            "path" => "img/gallery/unnamed (2).png"
        ]);

        Schema::insert($this->tableName, [
            "name" => "Galeria",
            "path" => "img/gallery/unnamed.png"
        ]);

        Schema::insert($this->tableName, [
            "name" => "Galeria",
            "path" => "img/gallery/unnamed (3).png"
        ]);

        Schema::insert($this->tableName, [
            "name" => "Galeria",
            "path" => "img/gallery/copteles.jpeg"
        ]);

        Schema::insert($this->tableName, [
            "name" => "Galeria",
            "path" => "img/gallery/cockteleles-modernos.jpg"
        ]);

        Schema::insert($this->tableName, [
            "name" => "Galeria",
            "path" => "img/gallery/50caf20e7f61dbe6fd88d1d18af34420.jpg"
        ]);
    }

    public function down() {
        Schema::dropIfExists($this->tableName);
    }
};
