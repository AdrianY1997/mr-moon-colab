<?php

use FoxyMVC\Lib\Foxy\Facades\Schema;
use FoxyMVC\Lib\Foxy\Database\Schema\Blueprint;

return new class {
    private string $tableName = "product_menu";

    public function up() {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->isManyToMany();
            $table->integer("prod_id")->references("products");
            $table->integer("menu_id")->references("menus");
        });
    }

    public function down() {
        Schema::dropIfExists($this->tableName);
    }
};
