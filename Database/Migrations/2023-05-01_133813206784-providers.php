<?php

use FoxyMVC\Lib\Foxy\Facades\Schema;
use FoxyMVC\Lib\Foxy\Database\Schema\Blueprint;

return new class {
    private string $tableName = "providers";

    public function up() {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string("nit")->unique();
            $table->string("name");
            $table->string("email");
            $table->string("phone");
        });
    }

    public function down() {
        Schema::dropIfExists($this->tableName);
    }
};
