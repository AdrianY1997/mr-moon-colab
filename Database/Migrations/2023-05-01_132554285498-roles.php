<?php

use FoxyMVC\Lib\Foxy\Facades\Schema;
use FoxyMVC\Lib\Foxy\Database\Schema\Blueprint;

return new class {
    private string $tableName = "roles";

    public function up() {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string("name");
        });

        Schema::insert($this->tableName, [
            "name" => "ADMIN"
        ]);
    }

    public function down() {
        Schema::dropIfExists($this->tableName);
    }
};
