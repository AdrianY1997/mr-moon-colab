<?php

use FoxyMVC\Lib\Foxy\Facades\Schema;
use FoxyMVC\Lib\Foxy\Database\Schema\Blueprint;

return new class {
    private string $tableName = "codes";

    public function up() {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string("email");
            $table->string("code");
            $table->integer("status");
        });
    }

    public function down() {
        Schema::dropIfExists($this->tableName);
    }
};
