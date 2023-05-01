<?php

use FoxyMVC\Lib\Foxy\Facades\Schema;
use FoxyMVC\Lib\Foxy\Database\Schema\Blueprint;

return new class {
    private string $tableName = "__tableName";

    public function up() {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
        });
    }

    public function down() {
        Schema::dropIfExists($this->tableName);
    }
};
