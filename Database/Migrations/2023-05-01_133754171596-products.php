<?php

use FoxyMVC\Lib\Foxy\Facades\Schema;
use FoxyMVC\Lib\Foxy\Database\Schema\Blueprint;

return new class {
    private string $tableName = "products";

    public function up() {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string("ref")->unique();
            $table->string("name");
            $table->string("stock");
            $table->string("value");
        });
    }

    public function down() {
        Schema::dropIfExists($this->tableName);
    }
};
