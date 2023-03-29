<?php

use Lib\Foxy\Database\Schema\Blueprint;
use Lib\Foxy\Facades\Schema;

return new class
{
    public function up()
    {
        Schema::create("products", function (Blueprint $table) {
            $table->id();
            $table->string("ref")->unique();
            $table->string("name");
            $table->string("stock");
            $table->string("value");
        });
    }

    public function down()
    {
        Schema::dropIfExists("products");
    }
};
