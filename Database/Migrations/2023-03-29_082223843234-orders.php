<?php

use Lib\Foxy\Database\Schema\Blueprint;
use Lib\Foxy\Facades\Schema;

return new class
{
    public function up()
    {
        Schema::create("orders", function (Blueprint $table) {
            $table->id();
            $table->string("quantity");
            $table->integer("bill_id")->references("bills");
            $table->integer("prod_id")->references("products");
        });
    }

    public function down()
    {
        Schema::dropIfExists("orders");
    }
};
