<?php

use FoxyMVC\Lib\Foxy\Facades\Schema;
use FoxyMVC\Lib\Foxy\Database\Schema\Blueprint;

return new class {
    private string $tableName = "employers";

    public function up() {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string("position");
            $table->integer("user_id")->references("users");
        });
    }

    public function down() {
        Schema::dropIfExists($this->tableName);
    }
};
