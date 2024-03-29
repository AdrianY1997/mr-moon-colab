<?php

use FoxyMVC\Lib\Foxy\Facades\Schema;
use FoxyMVC\Lib\Foxy\Database\Schema\Blueprint;

return new class {
    private string $tableName = "reservations";

    public function up() {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string("urid")->unique();
            $table->string("name");
            $table->string("lastname");
            $table->string("email");
            $table->string("quantity");
            $table->string("table");
            $table->string("day");
            $table->string("time");
            $table->text("details");
            $table->string("method");
            $table->text("pay_img");
            $table->string("status")->default("PENDING", true);
            $table->integer("user_id")->references("users");
        });
    }

    public function down() {
        Schema::dropIfExists($this->tableName);
    }
};
