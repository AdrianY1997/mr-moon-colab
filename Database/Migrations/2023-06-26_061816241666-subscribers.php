<?php

use FoxyMVC\Lib\Foxy\Facades\Schema;
use FoxyMVC\Lib\Foxy\Database\Schema\Blueprint;

return new class {
    private string $tableName = "subscribers";

    public function up() {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("lastname");
            $table->string("email");
        });
    }

    public function down() {
        Schema::dropIfExists($this->tableName);
    }
};