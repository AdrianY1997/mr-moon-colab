<?php

use Lib\Foxy\Database\Schema\Blueprint;
use Lib\Foxy\Facades\Schema;

return new class
{
    public function up()
    {
        Schema::create("codes", function (Blueprint $table) {
            $table->id();
            $table->string("email");
            $table->string("code");
            $table->string("status");
        });
    }

    public function down()
    {
        Schema::dropIfExists("product_menu");
    }
};
