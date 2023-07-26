<?php

use FoxyMVC\App\Models\Role;
use FoxyMVC\Lib\Foxy\Facades\Schema;
use FoxyMVC\Lib\Foxy\Database\Schema\Blueprint;

return new class {
    private string $tableName = "roles";

    public function up() {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string("name")->default(Role::USER, true);
        });

        Schema::insert($this->tableName, [
            "name" => Role::ADMIN
        ]);

        Schema::insert($this->tableName, [
            "name" => Role::USER
        ]);
    }

    public function down() {
        Schema::dropIfExists($this->tableName);
    }
};
