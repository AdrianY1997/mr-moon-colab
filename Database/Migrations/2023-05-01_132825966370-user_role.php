<?php

use FoxyMVC\Lib\Foxy\Facades\Schema;
use FoxyMVC\Lib\Foxy\Database\Schema\Blueprint;

return new class {
    private string $tableName = "user_role";

    public function up() {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->isManyToMany();
            $table->integer("user_id")->references("users");
            $table->integer("role_id")->references("roles");
        });

        Schema::insert($this->tableName, [
            "user_id" => 1,
            "role_id" => 1
        ], true);
    }

    public function down() {
        Schema::dropIfExists($this->tableName);
    }
};
