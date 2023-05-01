<?php

use FoxyMVC\Lib\Foxy\Facades\Schema;
use FoxyMVC\Lib\Foxy\Database\Schema\Blueprint;

return new class {
    private string $tableName = "orders";

    public function up() {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string("quantity");
            $table->integer("bill_id")->references("bills");
            $table->integer("prod_id")->references("products");
        });
    }

    public function down() {
        Schema::dropIfExists($this->tableName);
    }
};
